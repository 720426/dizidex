<?php
$page_title = "About Us - Dizidex";
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

        .about-container {
            width: 100%;
            max-width: 850px;
            margin: 40px auto;
            padding: 0 18px;
        }

        .about-card {
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
            font-size: 34px;
            font-weight: 800;
        }

        .intro {
            text-align: center;
            font-size: 17px;
            line-height: 1.7;
            color: #365d91;
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
            margin: 0 0 16px;
            color: #29466b;
        }

        .highlights {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 30px 0;
        }

        .highlight {
            background: #f1f7ff;
            border-radius: 8px;
            padding: 22px 12px;
            text-align: center;
        }

        .highlight-number {
            font-size: 25px;
            font-weight: 800;
            color: #1677e8;
            margin-bottom: 7px;
        }

        .highlight-text {
            font-size: 13px;
            color: #365d91;
        }

        .support-box {
            background: #f1f7ff;
            border-radius: 8px;
            padding: 22px;
            margin-top: 30px;
        }

        .support-box a {
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

            .about-container {
                margin: 15px auto;
                padding: 0 12px;
            }

            .about-card {
                padding: 25px 20px;
            }

            h1 {
                font-size: 28px;
            }

            .intro {
                font-size: 16px;
            }

            h2 {
                font-size: 19px;
            }

            p {
                font-size: 15px;
            }

            .highlights {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="about-container">

    <div class="about-card">

        <div class="logo">
            <a href="/">
                <img src="/assets/images/logo.png" alt="Dizidex">
            </a>
        </div>

        <h1>About Dizidex</h1>

        <p class="intro">
            Making useful digital products and software more accessible,
            affordable, and easy to use.
        </p>

        <h2>Who We Are</h2>

        <p>
            At <strong>Dizidex</strong>, we are focused on providing
            affordable digital products that empower small businesses,
            freelancers, students, and everyday users.
        </p>

        <p>
            We believe that access to useful software and digital resources
            should not always come with a high price. Our goal is to make
            quality digital products more accessible while providing a
            simple and convenient purchasing experience.
        </p>

        <div class="highlights">

            <div class="highlight">
                <div class="highlight-number">3+</div>
                <div class="highlight-text">
                    Years of Domain Knowledge
                </div>
            </div>

            <div class="highlight">
                <div class="highlight-number">4.9/5</div>
                <div class="highlight-text">
                    Average Customer Rating
                </div>
            </div>

            <div class="highlight">
                <div class="highlight-number">24/7</div>
                <div class="highlight-text">
                    Customer Support
                </div>
            </div>

        </div>

        <h2>What We Do</h2>

        <p>
            We provide a range of digital products and software-related
            resources designed to help our customers work, study, create,
            and manage their everyday digital needs.
        </p>

        <p>
            Our products are delivered digitally, allowing customers to
            receive their purchases quickly without waiting for physical
            delivery.
        </p>

        <h2>Our Customers</h2>

        <p>
            Dizidex is built with practical users in mind. We aim to support
            <strong>small businesses, freelancers, students, creators, and
            individuals</strong> who are looking for affordable digital
            solutions.
        </p>

        <h2>Customer Support</h2>

        <p>
            We believe good customer service is just as important as the
            product itself. Our support team is available to help customers
            with product-related questions, downloads, and installation
            guidance whenever assistance is needed.
        </p>

        <div class="support-box">

            <strong>Need Help?</strong>

            <p style="margin-top: 8px; margin-bottom: 0;">
                Contact our support team at
                <a href="mailto:contact@dizidex.com">
                    contact@dizidex.com
                </a>
            </p>

        </div>

        <h2>Our Commitment</h2>

        <p>
            Our aim is to build a trusted digital marketplace by offering
            affordable products, clear information, responsive support, and
            a straightforward customer experience.
        </p>

        <p>
            Thank you for choosing <strong>Dizidex</strong>.
        </p>

        <a href="/" class="back-button">
            Back to Home
        </a>

    </div>

</div>

</body>
</html>