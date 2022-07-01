<?php
    // display errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("HTTP/1.0 405 Method Not Allowed");
        exit;
    }

    if (!file_exists("infos")) {
        echo "infos_file_dont_exists";
        exit;
    }

    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $mail = isset($_POST["mail"]) ? $_POST["mail"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $password_confirm = isset($_POST["password_confirm"]) ? $_POST["password_confirm"] : "";

    if (!$username || !$mail || !$password || !$password_confirm) {
        echo "fields_required";
        exit;
    }

    if ($password != $password_confirm) {
        echo "pass_not_match";
        exit;
    }

    $password_list = explode("\n", file_get_contents("https://raw.githubusercontent.com/duyet/bruteforce-database/master/1000000-password-seclists.txt"));

    if ($password == $username || $password == $mail || array_search($password, $password_list)) {
        echo "pass_not_secure";
        exit;
    }

    if (strlen($password) < 8) {
        echo "pass_too_short";
        exit;
    }

    include "db.php";

    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :username");
    $stmt->execute([
        "username" => $username
    ]);

    if ($stmt->rowCount()) {
        echo "username_exists";
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `mail` = :mail");
    $stmt->execute([
        "mail" => $mail
    ]);

    if ($stmt->rowCount()) {
        echo "mail_exists";
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO `users` (`username`, `mail`, `password`, `token`, `ranks`) VALUES (:username, :mail, :password, :token, '[]');");
    $stmt->execute([
        "username" => $username,
        "mail" => $mail,
        "password" => $password,
        "token" => bin2hex(random_bytes(32))
    ]);

    $infos_file = explode("|", file_get_contents("infos"));
    $infos = array();

    foreach ($infos_file as $info) {
        $info = explode(":", $info);
        $infos[$info[0]] = $info[1];
    }

    $infos["step"] = 3;

    $infos_file = "";

    foreach ($infos as $key => $value) {
        if ($key == "step") {
            $infos_file .= $key . ":" . $value;
        } else {
            $infos_file .= $key . ":" . $value . "|";
        }
    }

    file_put_contents("infos", $infos_file);

    echo "success";

?>