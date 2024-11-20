<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

        <?php

            $amt = (int)$_GET['total_amt'];
        ?>
    <div class="form-container">
        <h2>Checkout</h2>
        <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
            <!-- AMOUNT -->
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" id="amount" name="amount" value="<?= $amt ?>" required>
            </div>

            <!-- TAX AMOUNT -->
            <input type="hidden" id="tax_amount" name="tax_amount" value="0" required>

            <!-- TOTAL AMOUNT -->
            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="text" id="total_amount" name="total_amount" value="<?= $amt ?>" required>
            </div>

            <!-- TRANSACTION UUID -->
            <input type="hidden" id="transaction_uuid" name="transaction_uuid" required>

            <!-- PRODUCT CODE -->
            <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
            
            <!-- SERVICE CHARGE -->
            <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>

            <!-- DELIVERY CHARGE -->
            <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>

            <!-- SUCCESS URL -->
            <input type="hidden" id="success_url" name="success_url" value="http://localhost/pharmacy_system2/pharmacy_system/success.php" required>

            <!-- FAILURE URL -->
            <input type="hidden" id="failure_url" name="failure_url" value="http://localhost/pharmacy_system2/pharmacy_system/failure.php" required>
        
            <!-- SIGNED FIELDS -->
            <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
            
            <!-- SIGNATURE -->
            <input type="hidden" id="signature" name="signature" required>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/hmac-sha256.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/enc-base64.min.js"></script>
    <script>
        // Variables
        var idx = Date.now();
        const id = `${idx}`.replace(".", "-");

        const secret = "8gBm/:&EnhH.1/q";
        const message = `total_amount=<?= $amt ?>,transaction_uuid=${id},product_code=EPAYTEST`;
        const hash = CryptoJS.enc.Base64.stringify(CryptoJS.HmacSHA256(message, secret));

        // Elements
        const uuid = document.getElementById("transaction_uuid");
        const sig = document.getElementById("signature");
        

        // Assignments
        uuid.value = id;
        sig.value = hash;
    </script>
</body>
</html>
