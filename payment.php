<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode([
        "return_url" => "http://localhost/ECOM/orders.php",
        "website_url" => "http://localhost/ECOM/products.php",
        "amount" => "1000",
        "purchase_order_id" => "Order01",
        "purchase_order_name" => "test",
        "customer_info" => [
            "name" => "Test Bahadur",
            "email" => "test@khalti.com",
            "phone" => "9800000001"
        ]
    ]),
    CURLOPT_HTTPHEADER => array(
        'Authorization:key 3fae652a4ff14fb29a3758de55ea60a6',
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);
curl_close($curl);

// Decode the response to capture the payment URL
$response_data = json_decode($response, true);

// Return the payment URL
header( "Location:".$response_data['payment_url']);
?>

