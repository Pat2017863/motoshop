<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle file upload
    $targetDir = "uploads/"; // Directory where images will be saved
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Check if the file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($targetFilePath)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Attempt to upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Prepare an SQL statement to insert the product into the database
            $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdss", $name, $price, $description, $fileName); // "s" for string, "d" for double

            // Execute the statement
            if ($stmt->execute()) {
                echo "Product added successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url(viewbg.jpg) no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            font-size: 2.5em;
            color: #fff;
            text-shadow: 2px 2px 5px #000;
        }

        form {
            background: rgba(0, 0, 0, 0.7);
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }

        label {
            font-size: 1.2em;
            display: block;
            margin-bottom: 8px;
        }

        input, textarea, button {
            width: calc(100% - 20px);
            margin: 0 auto 15px auto;
            padding: 10px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
        }

        input, textarea {
            background: #f9f9f9;
            color: #333;
        }

        button {
            background: #007BFF;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0056b3;
        }

        .back-btn {
            display: block;
            text-align: center;
            background-color: #FFD700;
            color: #333;
            padding: 10px 20px;
            margin: 20px auto 0 auto;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            max-width: 200px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #FF8C00;
        }
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" required>
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" required>
        <label for="description">Description:</label>
        <textarea name="description"></textarea>
        <label for="image">Product Image:</label>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Add Product</button>
    </form>
    <a href="index.php" class="back-btn">Back to Dashboard</a>
</body>
</html>


