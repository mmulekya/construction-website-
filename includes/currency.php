<?php
function convert_currency($amount, $country){
    switch($country){
        case "Kenya": return "KES ".number_format($amount*130,2);
        case "Tanzania": return "TZS ".number_format($amount*2500,2);
        case "Uganda": return "UGX ".number_format($amount*3800,2);
        case "UK": return "£".number_format($amount*0.80,2);
        case "India": return "₹".number_format($amount*82,2);
        case "USA":
        default: return "$".number_format($amount,2);
    }
}
?>