<?php
include 'db.php';

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the product details from the database
    $result = $conn->query("SELECT * FROM products WHERE id=$id");
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product ID provided.";
    exit;
}

// Handle form submission for updating product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle file upload if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Check if the file already exists
            if (!file_exists($targetFilePath) && in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    // Update product with the new image
                    $sql = "UPDATE products SET name='$name', price='$price', description='$description', image='$fileName' WHERE id=$id";
                } else {
                    echo "Error uploading image.";
                }
            } else {
                echo "Invalid file type or file already exists.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        // Update product without changing image
        $sql = "UPDATE products SET name='$name', price='$price', description='$description' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: manage_products.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        /* Styling similar to previous pages */
        body {
            background: url(motor.jpeg) no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
            width: 60%;
            max-width: 600px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }
        h1 {
            text-align: center;
            color: #FFD700;
        }
        label {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        textarea {
            height: 100px;
        }
        button {
            padding: 10px 20px;
            background-color: #FFD700;
            color: #333;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #FF8C00;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Edit Product</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" name="name" value="<?= $product['name'] ?>" required><br>

            <label for="price">Price:</label>
            <input type="number" name="price" value="<?= $product['price'] ?>" step="0.01" required><br>

            <label for="description">Description:</label>
            <textarea name="description" required><?= $product['description'] ?></textarea><br>

            <label for="image">Product Image (Optional):</label>
            <input type="file" name="image" accept="image/*"><br><br>

            <button type="submit">Update Product</button>
        </form>
    </div>

</body>
</html>
