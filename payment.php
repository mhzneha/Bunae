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
    CURLOPT_POSTFIELDS =>'{
    "return_url": "http://localhost/ECOM/orders.php",
    "website_url": "http://localhost/ECOM/product.php",
    "amount": "1000",
    "purchase_order_id": "Order01",
        "purchase_order_name": "test",

    "customer_info": {
        "name": "Test Bahadur",
        "email": "test@khalti.com",
        "phone": "9800000001"
    }
    }

    ',
    CURLOPT_HTTPHEADER => array(
        'Authorization:key 3fae652a4ff14fb29a3758de55ea60a6',
        'Content-Type: application/json',
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khalti Integration</title>
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
</head>
<body>
    <h1>Pay with Khalti</h1>
    <button id="payButton">Pay with Khalti</button>

    <script>
        var khaltiConfig = {
            publicKey: "live_public_key_869119a676d24c159c2155077e796cd6", 
            productIdentity: "Order01",
            productName: "Sample Product",
            productUrl: "http://localhost/ECOM/orders.php",
            eventHandler: {
                onSuccess(payload) {
                    console.log("Payment Successful!", payload);
                    alert("Payment successful. Redirecting...");
                    window.location.href = "http://localhost/ECOM/orders.php?status=success";
                },
                onError(error) {
                    console.error("Payment Error:", error);
                    alert("Something went wrong. Please try again.");
                },
                onClose() {
                    console.log("Payment popup closed.");
                }
            }
        };

        var khaltiCheckout = new KhaltiCheckout(khaltiConfig);

        document.getElementById("payButton").onclick = function () {
            khaltiCheckout.show({ amount: 1000 });
        };
    </script>
</body>
</html>
