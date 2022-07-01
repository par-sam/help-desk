<?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("HTTP/1.0 405 Method Not Allowed");
        exit;
    }

    if (!file_exists("infos")) {
        echo "no_infos";
        exit;
    }

    $infos_file = explode("|", file_get_contents("infos"));
    $infos = array();

    foreach ($infos_file as $info) {
        $info = explode("@", $info);
        $infos[$info[0]] = $info[1];
    }

    if ($infos["step"] < 3) {
        echo "installation_not_finished";
        exit;
    }

    if ($infos["step"] < 3) {
        echo "installation_already_finished";
        exit;
    }

    $infos["step"] = 4;

    $infos_file = "";

    foreach ($infos as $key => $value) {
        if ($key == "step") {
            $infos_file .= $key . "@" . $value;
        } else {
            $infos_file .= $key . "@" . $value . "|";
        }
    }

    file_put_contents("infos", $infos_file);

    echo "success";
?>