<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require("includes/FileManagementSystem.php");

session_start();

// If a folder link was pressed, navigate to it's location
if(isset($_POST['folder'])) {
    $path = $_SESSION["currentdir"] . "/" . $_POST['folder'];
    // print_r("Path: " . $path . "<br />");
    chdir($path);
}
elseif (isset($_POST['up'])) {
    if(isset($_SESSION["currentdir"])) {
        chdir($_SESSION["currentdir"]);
    }
    chdir("..");
}
else {
    chdir("root");
}

$_SESSION["currentdir"] = getcwd();

// TODO MIGRATE THIS TO FUNCTION
// List breadcrumb
print("<h3>" . getcwd() . "<br /></h3>");

$filesystem = new FileSystem();
$filesystem->listFiles();