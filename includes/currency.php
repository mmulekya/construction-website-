<?php
// Example currency conversion rates (USD base)
$currency_rates = [
    "USA" => 1,
    "UK" => 0.82,
    "EU" => 0.93,
];

// Convert USD to target currency
function convertCurrency($amount, $country){
    global $currency_rates;
    $rate = $currency_rates[$country] ?? 1;
    return number_format($amount * $rate, 2);
}

// Get currency symbol
function getCurrencySymbol($country){
    switch($country){
        case "UK": return "£";
        case "EU": return "€";
        default: return "$";
    }
}
?>