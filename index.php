<?php
    if (!file_exists("assets/scripts/infos")) {
        header("Location: install");
        exit;
    }

    $infos_file = explode("|", file_get_contents("assets/scripts/infos"));
    
    $infos = array();

    foreach ($infos_file as $info) {
        $info = explode(":", $info);
        $infos[$info[0]] = $info[1];
    }

    $version = $infos["version"];
    $latest = substr_replace(file_get_contents("https://raw.githubusercontent.com/par-sam/help-desk/main/latest"), "", -1);

    echo $version == $latest ? "Up to date" : "Update available";
?>