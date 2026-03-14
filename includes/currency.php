<?php
/**
 * BuildSmart Currency Conversion System
 * Converts project amounts to user's local currency
 * Ready for global expansion
 */

/**
 * Convert USD amount to local currency based on user country
 *
 * @param float $amount Amount in USD
 * @param string $country User's country
 * @return string Formatted amount with currency symbol
 */
function convert_currency($amount, $country) {

    switch($country){

        case "Kenya":
            $kes_rate = 130; // 1 USD = 130 KES (update as needed)
            return "KES ".number_format($amount * $kes_rate, 2);

        case "Tanzania":
            $tzs_rate = 2500; // 1 USD = 2500 TZS
            return "TZS ".number_format($amount * $tzs_rate, 2);

        case "Uganda":
            $ugx_rate = 3800; // 1 USD = 3800 UGX
            return "UGX ".number_format($amount * $ugx_rate, 2);

        case "USA":
            return "$".number_format($amount, 2);

        case "UK":
            $gbp_rate = 0.80; // 1 USD = 0.80 GBP (update regularly)
            return "£".number_format($amount * $gbp_rate, 2);

        case "India":
            $inr_rate = 82; // 1 USD = 82 INR
            return "₹".number_format($amount * $inr_rate, 2);

        default:
            return "$".number_format($amount, 2);
    }

}
?>