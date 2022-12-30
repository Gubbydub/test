<?php

//print_r($_POST);
//
//exit();
include_once __DIR__ . '/../config/db_connect.php';

$name = $_POST['name'];
$message = $_POST['message'];
$post_id = $_POST['post_id'];

$insert = $pdo->prepare("INSERT INTO `comments`
                              (`author`, `comment_text`, `post_id`)
                                VALUES
                              (:author, :comment_text, :post_id )");
$insert->execute([
        ':author' => $name,
        ':comment_text' => $message,
        ':post_id' => $post_id,
    ]);

header("Location: /post.php?id=$post_id");