<?php
// Start a session to keep track of any session data (like user login)
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Full Page Background */
        body {
            background: url('racing.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Dashboard Styling */
        .dashboard {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
        }

        h1 {
            font-size: 3rem;
            color: #FFD700; /* Gold color */
            margin-bottom: 30px;
        }

        /* Button Styling */
        button {
            background-color: #FFD700;
            color: #333;
            padding: 15px 30px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #FF8C00;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard {
                width: 80%;
                padding: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            button {
                width: 100%;
                font-size: 16px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Piston Garage</h1>
        <!-- Button to Add Products -->
        <button onclick="location.href='add_product.php'">Add Products</button>
        <!-- Button to View Products -->
        <button onclick="location.href='view_products.php'">View Products</button>
        <!-- Button to Manage Products -->
        <button onclick="location.href='manage_products.php'">Manage Products</button>
    </div>
</body>
</html>
