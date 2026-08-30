<?php
$page_title = "Refund Policy - Dizidex";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($page_title); ?></title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f5f8fc;
            font-family: Arial, Helvetica, sans-serif;
            color: #092957;
        }

        .policy-container {
            width: 100%;
            max-width: 850px;
            margin: 40px auto;
            padding: 0 18px;
        }

        .policy-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img {
            width: 70px;
            height: auto;
        }

        h1 {
            margin: 0 0 12px;
            text-align: center;
            color: #061e45;
            font-size: 32px;
            font-weight: 800;
        }

        .updated {
            text-align: center;
            color: #667892;
            font-size: 14px;
            margin-bottom: 35px;
        }

        h2 {
            color: #061e45;
            font-size: 21px;
            margin-top: 30px;
            margin-bottom: 12px;
        }

        p {
            font-size: 16px;
            line-height: 1.7;
            margin: 0 0 15px;
            color: #29466b;
        }

        ul {
            padding-left: 25px;
            margin-top: 10px;
        }

        li {
            color: #29466b;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 8px;
        }

        .important {
            background: #fff4f4;
            border-left: 4px solid #e53935;
            padding: 18px 20px;
            border-radius: 6px;
            margin: 25px 0;
        }

        .important strong {
            color: #c62828;
        }

        .support {
            background: #f1f7ff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
        }

        .support a {
            color: #1677e8;
            text-decoration: none;
            font-weight: 600;
        }

        .back-button {
            display: inline-block;
            margin-top: 30px;
            padding: 13px 22px;
            background: #3489ed;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
        }

        .back-button:hover {
            background: #2379dc;
        }

        @media (max-width: 600px) {

            .policy-container {
                margin: 15px auto;
                padding: 0 12px;
            }

            .policy-card {
                padding: 25px 20px;
                border-radius: 10px;
            }

            h1 {
                font-size: 27px;
            }

            h2 {
                font-size: 19px;
            }

            p,
            li {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

<div class="policy-container">

    <div class="policy-card">

        <div class="logo">
            <a href="/">
                <img src="/assets/images/logo.png" alt="Dizidex">
            </a>
        </div>

        <h1>Refund Policy</h1>

        <div class="updated">
            Last Updated: <?php echo date("d F Y"); ?>
        </div>

        <p>
            At <strong>Dizidex</strong>, we provide digital products that are
            delivered electronically. Because digital products can be accessed,
            downloaded, and copied immediately after purchase, all purchases
            are considered final once the product has been delivered or
            downloaded.
        </p>

        <div class="important">
            <strong>No Refunds After Delivery or Download</strong>
            <p style="margin-top: 8px;">
                Once you have received access to or downloaded the purchased
                digital product, the product is considered successfully
                delivered and <strong>we do not offer refunds, returns, or
                cancellations.</strong>
            </p>
        </div>

        <h2>1. Digital Product Delivery</h2>

        <p>
            After successful payment, the purchased digital product and/or
            download instructions are provided electronically. Delivery may
            occur immediately or through the contact details provided during
            checkout.
        </p>

        <p>
            Once the customer is able to access or download the product,
            the order is considered delivered.
        </p>

        <h2>2. No Refund Policy</h2>

        <p>
            Due to the nature of digital products, we do not accept requests
            for refunds after the product has been delivered or downloaded.
        </p>

        <p>
            This includes situations where the customer:
        </p>

        <ul>
            <li>Has already downloaded the product.</li>
            <li>Has accessed the provided files or instructions.</li>
            <li>No longer requires the product after purchase.</li>
            <li>Purchased the product by mistake.</li>
            <li>Changed their mind after completing the purchase.</li>
            <li>Has compatibility or installation difficulties that can be resolved with support.</li>
        </ul>

        <h2>3. Please Check Before Purchasing</h2>

        <p>
            Customers are advised to carefully review the product description,
            system requirements, compatibility information, and other details
            before completing the purchase.
        </p>

        <p>
            By completing the purchase, you acknowledge that you are purchasing
            a digital product and agree to this Refund Policy.
        </p>

        <h2>4. Installation & Technical Support</h2>

        <p>
            If you experience problems with downloading, installing, or using
            the product, please contact our support team. We will make reasonable
            efforts to assist you with installation and technical issues.
        </p>

        <div class="support">
            <strong>Need Help?</strong>

            <p style="margin-top: 8px; margin-bottom: 0;">
                For installation or technical support, contact us at
                <a href="mailto:contact@dizidex.com">
                    contact@dizidex.com
                </a>
            </p>
        </div>

        <h2>5. Order Completion</h2>

        <p>
            A successful payment followed by delivery or download access
            constitutes completion of the digital order. Once delivery has
            occurred, the order is not eligible for return or refund.
        </p>

        <a href="/" class="back-button">
            Back to Home
        </a>

    </div>

</div>

</body>
</html>