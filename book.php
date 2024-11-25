<?php

require_once('./connection.php');

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

$stmt = $pdo->prepare('SELECT * FROM book_authors ba LEFT JOIN authors a ON ba.author_id=a.id WHERE ba.book_id = :id');
$stmt->execute(['id' => $id]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <a href="/index.php">Back</a>
    </nav>

    <h1><?= $book['title'];?></h1>
    
    <?php if ($book['cover_path']) { ?>
        <img src="<?= $book['cover_path']; ?>" alt="Cover of <?= htmlspecialchars($book['title']); ?>">
    <?php } ?>

    <h2>Authors:</h2>
    <ul>
        <?php while ( $author = $stmt->fetch() ) { ?>
            
            <li>
                    <?= $author['first_name']; ?> <?= $author['last_name']; ?>
            </li>
        
        <?php } ?>
    </ul>

    <p>Price: <?= round($book['price'], 2); ?> &euro;</p>

    <a href="./edit.php?id=<?= $id; ?>">Edit</a>

    <br><br>
    <form action="./delete.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="submit" name="action" value="Delete">
    </form>
</body>
</html>