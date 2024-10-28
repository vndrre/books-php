<?php
    require_once('./connection.php');
    $stmt = $pdo->query('SELECT * FROM books WHERE is_deleted = 0');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
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

        /* Container for Books */
        .book-list {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            list-style-type: none;
        }

        /* Each Book Item */
        .book-list li {
            margin: 10px 0;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .book-list li:last-child {
            border-bottom: none;
        }

        /* Book Links */
        .book-section {
            text-decoration: none;
            color: #007acc;
            font-size: 18px;
            transition: color 0.2s ease;
        }

        .book-section:hover {
            color: #005f99;
        }

        .page-title{
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<ul class="book-list">
    <h1 class="page-title">Welcome to my Book Store!</h1>
    <?php while ($row = $stmt->fetch()) { ?>
        <li>
            <a href="./book.php?id=<?= $row['id']; ?>" class="book-section">
                <?= htmlspecialchars($row['title']); ?>
            </a>
        </li>
    <?php } ?>
</ul>

</body>
</html>
