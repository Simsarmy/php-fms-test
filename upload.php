<?php

require("includes/FileManagementSystem.php");

$postfile = $_FILES;

$filesystem = new FileSystem();

// Create the file.
$file = new File($postfile);

// Choose folder for the file
$parent = new Folder();
$parent->setPath("./");
$parent->setName("root");
$created = time();
$parent->setCreatedTime($created);

$filesystem->createFile($file, $parent);

//header("Location: index.php"); /* Redirect browser */
//exit();