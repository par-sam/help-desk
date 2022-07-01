<?php
    $infos = array();

    if (file_exists("../assets/scripts/infos")) {
        $infos_file = explode("|", file_get_contents("../assets/scripts/infos"));
    
        foreach ($infos_file as $info) {
            $info = explode(":", $info);
            $infos[$info[0]] = $info[1];
        }

    }

    $etape = isset($infos["step"]) ? $infos["step"] : 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk - Installation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../assets/scripts/jquery.js"></script>
</head>
<body style="background-color: #161616;" class="text-white">
    <h1 class="absolute text-3xl m-2">Help Desk - Installation</h1>

    <div id="notification" class="flex text-black absolute bottom-0 right-0 bg-white rounded-md p-2 m-4 hidden">
        <div id="notification_icon"></div>
        <div class="flex flex-col ml-2">
            <h2 id="notification_title" class="text-xl font-bold"></h2>
            <h2 id="notification_content" class="text-md"></h2>
        </div>
    </div>

<?php
    switch ($etape) {
        case 1:
?>
            <div class="flex flex-col h-screen justify-center items-center">
                <div class="flex flex-col items-center bg-white rounded-md w-1/4 text-center px-2">
                    <h2 class="text-3xl text-black">Nx Support Panel</h2>
                    <h2 class="text-xl text-gray-500 mb-4">Installation du site</h2>
                    <button id="launch_installation" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mb-4">Lancer l'installation</button>
                </div>
            </div>
<?php
            break;
        case 2:
?>
            <div class="flex flex-col h-screen justify-center items-center">
                <div class="flex flex-col items-center bg-white rounded-md w-1/4 text-center px-2">
                    <h2 class="text-3xl text-black">Etape 2</h2>
                    <h2 class="text-xl text-gray-500 mb-4">Création de l'utilisateur Administrateur</h2>

                    <input id="admin_username" class="w-full p-2 border-2 shadow rounded-md mb-2 text-black outline-none" type="text" placeholder="Nom d'utilisateur">
                    <input id="admin_mail" class="w-full p-2 border-2 shadow rounded-md mb-2 text-black outline-none" type="text" placeholder="Adresse mail">
                    <input id="admin_password" class="w-full p-2 border-2 shadow rounded-md mb-2 text-black outline-none" type="password" placeholder="Mot de passe">
                    <input id="admin_password_confirm" class="w-full p-2 border-2 shadow rounded-md mb-2 text-black outline-none" type="password" placeholder="Confirmer le mot de passe">
                    <button id="admin_create" class="w-full p-2 rounded-md bg-blue-500 text-white mb-4">Créer</button>
                </div>
            </div>
<?php
            break;
        case 3:
?>
            <div class="flex flex-col h-screen justify-center items-center">
                <div class="flex flex-col items-center bg-white rounded-md w-1/4 text-center px-2">
                    <h2 class="text-5xl m-2">🎉</h2>
                    <h2 class="text-3xl text-black mb-4">Installation terminée</h2>
                    <h2 class="text-xl text-black mb-2">L'installation du Help Desk est terminée</h2>
                    <h2 class="text-xl text-black mb-4">Vous pouvez désormais commencer à l'utiliser</h2>
                    <button id="start_btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mb-4">Démarrer</button>
                </div>
            </div>
<?php
    }
    
?>
    <script src="../assets/scripts/index.js"></script>
</body>
</html>