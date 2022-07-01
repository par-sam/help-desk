<?php
    // display errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("HTTP/1.0 405 Method Not Allowed");
        exit;
    }

    if (file_exists("infos")) {
        echo "infos_file_exists";
        exit;
    }

    include "db.php";

    $latest = substr_replace(file_get_contents("https://raw.githubusercontent.com/par-sam/help-desk/main/latest"), "", -1);

    $date = date("Y-m-d H:i:s");

    $stmt = $pdo->prepare("CREATE TABLE `users` (`id` INT NOT NULL AUTO_INCREMENT,`username` VARCHAR(100),`mail` VARCHAR(255),`password` VARCHAR(255),`token` VARCHAR(100),`ranks` VARCHAR(8000),PRIMARY KEY (`id`));");
    $stmt->execute();

    $stmt = $pdo->prepare("CREATE TABLE `tickets` (`id` INT NOT NULL AUTO_INCREMENT,`user_id` INT,`title` VARCHAR(255),`content` TEXT,`date` DATETIME,`status` VARCHAR(255),`category` VARCHAR(255),`priority` VARCHAR(255),`labels` VARCHAR(8000),`solved_date` DATETIME,`solved_by` INT,PRIMARY KEY (`id`));");
    $stmt->execute();

    $stmt = $pdo->prepare("CREATE TABLE `comments` (`id` INT NOT NULL AUTO_INCREMENT,`ticket_id` INT,`user_id` INT,`content` TEXT,`date` DATETIME,PRIMARY KEY (`id`));");
    $stmt->execute();

    $stmt = $pdo->prepare("CREATE TABLE `files` (`id` INT NOT NULL AUTO_INCREMENT,`comment_id` INT,`user_id` INT,`name` VARCHAR(255),`path` VARCHAR(255),`date` DATETIME,PRIMARY KEY (`id`));");
    $stmt->execute();

    $stmt = $pdo->prepare("CREATE TABLE `categories` (`id` INT NOT NULL AUTO_INCREMENT,`name` VARCHAR(255),PRIMARY KEY (`id`));");
    $stmt->execute();

    $stmt = $pdo->prepare("CREATE TABLE `priorities` (`id` INT NOT NULL AUTO_INCREMENT,`name` VARCHAR(255),PRIMARY KEY (`id`));");
    $stmt->execute();

    $stmt = $pdo->prepare("CREATE TABLE `labels` (`id` INT NOT NULL AUTO_INCREMENT,`name` VARCHAR(255),PRIMARY KEY (`id`));");
    $stmt->execute();

    $stmt = $pdo->prepare("CREATE TABLE `ranks` (`id` INT NOT NULL AUTO_INCREMENT,`name` VARCHAR(255),`permissions` VARCHAR(8000),PRIMARY KEY (`id`));");
    $stmt->execute();

    $stmt = $pdo->prepare("INSERT INTO `ranks` (`name`, `permissions`) VALUES ('Administrator', :admin);");
    $stmt->execute([
        "admin" => "[\"admin\"]"
    ]);

    $file = fopen("infos", "w");
    fwrite($file, "version@$latest|installation_date@$date|db@true|step@2");
    fclose($file);

    echo "success";
?>