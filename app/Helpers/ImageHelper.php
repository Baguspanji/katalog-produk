<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Compress and convert image to WebP format
     *
     * @param string|null $filePath The uploaded file path from request
     * @param string $disk The storage disk to use (default: 'public')
     * @param string $directory The directory to save the image
     * @param int $quality Compression quality (0-100, default: 80)
     * @return string|null The saved file path or null on failure
     */
    public static function compressAndConvertToWebp(
        ?string $filePath,
        string $disk = 'public',
        string $directory = 'images',
        int $quality = 80
    ): ?string {
        if (!$filePath || !Storage::disk('local')->exists($filePath)) {
            return null;
        }

        try {
            // Read the original image
            $imageContent = Storage::disk('local')->get($filePath);

            // Initialize ImageManager with GdDriver
            $manager = new ImageManager(new GdDriver());
            $image = $manager->read($imageContent);

            // Resize if needed (example: max width 2000px, maintain aspect ratio)
            if ($image->width() > 2000) {
                $image->scaleDown(width: 2000);
            }

            // Convert to WebP with compression
            $webpImage = $image->toWebp(quality: $quality);

            // Generate filename
            $originalName = pathinfo($filePath, PATHINFO_FILENAME);
            $fileName = $originalName . '.webp';
            $savedPath = $directory . '/' . $fileName;

            // Save to storage
            Storage::disk($disk)->put($savedPath, $webpImage);

            // Delete original uploaded file
            Storage::disk('local')->delete($filePath);

            return $savedPath;
        } catch (\Exception $e) {
            Log::error('Image compression failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get image URL from path
     *
     * @param string|null $path The image path in storage
     * @param string $disk The storage disk
     * @return string|null The full URL or null
     */
    public static function getImageUrl(?string $path, string $disk = 'public'): ?string
    {
        if (!$path) {
            return null;
        }

        return Storage::disk($disk)->url($path) ?? asset('storage/' . $path);
    }
}
