<?php
include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Full Page Background */
        body {
            background: url(motobg.jpg) no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: #fff;
        }

        /* Container */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 20px;
        }

        /* Heading */
        h1 {
            font-size: 3rem;
            color: gold; /* Gold color */
            text-align: center;
            margin-bottom: 20px;
        }

        /* Table Styling */
        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #fff;
        }

        th {
            background-color: #FFD700;
            color: #000;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        tr:hover {
            background-color: #444;
        }

        /* Image Styling */
        img {
            width: 150px;
            height: auto;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: scale(1.1);
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }

        .modal:target {
            display: flex;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }

            th, td {
                font-size: 14px;
            }

            h1 {
                font-size: 2rem;
            }
        }

        /* Back Button Styling */
        .back-btn {
            background-color: #FFD700;
            color: #333;
            padding: 10px 20px;
            margin: 20px auto;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #FF8C00;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>View Products</h1>

        <!-- Products Table -->
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Created At</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td>
                        <?php if (!empty($row['image'])): ?>
                            <a href="#modal-<?= $row['id'] ?>">
                                <img src="uploads/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
                            </a>
                            <!-- Modal for enlarged image -->
                            <div id="modal-<?= $row['id'] ?>" class="modal">
                                <img src="uploads/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
                            </div>
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Back Button -->
        <a href="index.php" class="back-btn">Back to Dashboard</a>
    </div>
</body>
</html>

