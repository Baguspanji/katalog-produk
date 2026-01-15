<?php

namespace App\Helpers;

class PhoneHelper
{
    /**
     * Get and format a phone number
     *
     */
    public static function getPhoneNumber(): ?string
    {
        $phoneNumber = '0812-3456-7890';
        $digits = preg_replace('/\D/', '', $phoneNumber);

        // return 62xxx
        return preg_replace('/^0/', '62', $digits);
    }

    /**
     * Generate a WhatsApp link with a message about a product
     *
     * @param string $productName The name of the product to include in message
     * @param string|null $message Optional custom message (uses productName if not provided)
     * @return string|null The WhatsApp link or null if phone number is invalid
     */
    public static function generateWhatsAppLink(string $productName, ?string $message = null): ?string
    {
        $phoneNumber = self::getPhoneNumber();

        // Use custom message or default with product name
        $text = $message ?? "Halo, saya tertarik dengan: {$productName}";

        // URL encode the message
        $encodedText = urlencode($text);

        // WhatsApp link format: https://wa.me/[country-code][number]?text=[message]
        return "https://wa.me/{$phoneNumber}?text={$encodedText}";
    }
}
