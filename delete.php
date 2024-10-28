<?php
    require_once('./connection.php');
    
    $id = $_POST["id"];

    if (isset($_POST["action"]) && $_POST['action'] == 'Save') {
        $stmt = $pdo->prepare('UPDATE books SET is_deleted = 1 WHERE id = :id');
        $stmt->execute(['id' => $id]);

        header("Location: ./book.php?id=$id");
        exit; 
    }
?>
