<?php
require_once "config.php";

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$index = 0;

while (true) {
    $settings = $db->query("SELECT * FROM `parameter`;")->fetch(PDO::FETCH_ASSOC);
    $a = $settings["a"];
    $y1c = $settings["y1"];
    $y2c = $settings["y2"];
    $y3c = $settings["y3"];
    $y1 = pow(sin($a * $index), 2);
    $y2 = pow(cos($a * $index), 2);
    $y3 = sin($a * $index) * cos($a * $index);

    $helper = array();

    if ($y1c) {
        $helper["y1"] = $y1;
    }
    if ($y2c) {
        $helper["y2"] = $y2;
    }
    if ($y3c) {
        $helper["y3"] = $y3;
    }

    $msg = json_encode($helper);
    SSE(++$index, $msg);
    sleep(1);
}

function SSE($id, $msg)
{
    echo "id: $id\n";
    echo "event: data\n";
    echo "data: $msg\n\n";

    ob_flush();
    flush();
}