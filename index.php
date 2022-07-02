<?php
    if (!file_exists("assets/scripts/infos")) {
        header("Location: install");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/scripts/jquery.js"></script>
    <link rel="stylesheet" href="assets/scripts/styles.css">
</head>
<body id="main_body" class="backdrop-blur-sm">
    <nav class="absolute shadow-md w-full">
        <div class="container mx-auto px-4 flex items-center justify-between flex-wrap">
            <h1 class="text-5xl text-white left-0 mt-2 mb-4 hidden">Help Desk</h1>
            <img class="w-14 h-14 my-2" src="assets/images/icon.png" alt="Logo">
            <div class="flex items-center">
                <a href=".." class="text-white hover:text-gray-500 mx-2 text-xl">Accueil</a>
                <a href="tickets" class="text-white hover:text-gray-500 mx-2 text-xl">Tickets</a>
                <a href="users" class="text-white hover:text-gray-500 mx-2 text-xl">Utilisateurs</a>
                <a href="settings" class="text-white hover:text-gray-500 mx-2 text-xl">Paramètres</a>
            </div>
            <div class="flex items-center ml-4">
                <img src="assets/images/users/1.png" class="w-10 h-10 rounded" alt="">
                <div class="flex flex-col ml-2">
                    <h2 class="text-xl font-bold text-white">samnx</h2>
                    <h2 class="text-md text-red-500">Administrateur</h2>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex flex-col h-screen">
        <div id="help_header" class="flex flex-col w-full items-center justify-center h-1/2">
            <h2 class="text-center text-4xl text-gray-800">Bienvenue sur le Help Desk!</h2>
        </div>
        <div id="help_cats" class="flex h-1/2">

        </div>
    </div>

    <script src="assets/scripts/index.js"></script>
</body>
</html>