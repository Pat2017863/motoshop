<?php
include 'db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");
    header('Location: manage_products.php');
}

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Full Page Background */
        body {
            background: url(edit.jpg) no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: #fff;
            height: 100vh;
        }

        /* Container to center content */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            flex-direction: column;
        }

        /* Table Styling */
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 40px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #fff;
        }

        th {
            background-color: #FFD700;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        tr:hover {
            background-color: #444;
        }

        /* Button Styling */
        a {
            text-decoration: none;
            padding: 8px 16px;
            margin: 0 10px;
            background-color: #FFD700;
            color: #333;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #FF8C00;
        }

        /* Back Button Styling */
        .back-button {
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #FFD700;
            color: #333;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            width: 200px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #FF8C00;
        }

        /* Heading */
        h1 {
            color: gold;
            margin-top: 40px;
            font-size: 2.5rem;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                width: 95%;
            }

            th, td {
                font-size: 14px;
            }

            h1 {
                font-size: 2rem;
            }

            .back-button {
                width: 100%;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Products</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td>
                        <a href="update_product.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="manage_products.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Back to Dashboard Button -->
        <a href="index.php" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>
