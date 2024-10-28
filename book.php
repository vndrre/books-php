<?php
    require_once('./connection.php');
    
    $id = $_GET["id"];
    $stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $book = $stmt->fetch();

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($book['title']); ?></title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Body Styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Container for Book Details */
        .book-container {
            width: 90%;
            max-width: 600px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Book Title Styling */
        .title {
            font-size: 28px;
            margin-bottom: 20px;
            color: #222;
        }

        /* Back Button Styling */
        .button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007acc;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }

        .button:hover {
            background-color: #005f99;
        }
    </style>
</head>
<body>
    <div class="book-container">
        <h1 class="title"><?= htmlspecialchars($book['title']); ?></h1>
        <p>Price: $<?= htmlspecialchars(number_format($book['price'], 2)); ?></p>

        <a href="/edit.php?id=<?= $id; ?>" class="button">Edit</a>
        <a href="/" class="button">Go Back to Book Store</a>

        <!-- Delete Button -->
        <form action="delete.php" method="post" style="display: inline;">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="submit" value="Delete" class="button">
        </form>
    </div>
</body>
</html>
