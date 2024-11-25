<?php
require_once('./connection.php');

// Check if there is a search query
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Modify the SQL query to include a search condition
$stmt = $pdo->prepare('SELECT * FROM books WHERE is_deleted = 0 AND title LIKE :search');
$stmt->execute(['search' => '%' . $search . '%']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <style>
        * {
            margin: 5px;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f9;
            color: #333;
            padding-top: 20px;
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

        .page-title {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1 class="page-title">Welcome to my Book Store!</h1>

<!-- Search Form -->
<div class="search-bar">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search for a book..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<ul class="book-list">
    <?php while ($row = $stmt->fetch()) { ?>
        <li>
            <a href="./book.php?id=<?= $row['id']; ?>" class="book-section">
                <?= htmlspecialchars($row['title']); ?>
            </a>
        </li>
    <?php } ?>

    <?php if ($stmt->rowCount() === 0) { ?>
        <li>No books found.</li>
    <?php } ?>
</ul>

</body>
</html>
