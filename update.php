<?php
require_once "config.php";

if (isset($_POST["a"])){
    $query = "UPDATE `parameter` SET `a`=".$_POST["a"].",`y1`=".(isset($_POST["y1"])?1:0).",`y2`=".(isset($_POST["y2"])?1:0).",`y3`=".(isset($_POST["y3"])?1:0)." WHERE 1";
    $db->query($query);
}

header("Location:index.php");
