<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require("FileInterface.php");
require("FileSystemInterface.php");
require("FolderInterface.php");

class File implements FileInterface {
    
    private $CreatedTime;
    private $ModifiedTime;
    private $Name;
    private $ParentFolder;
    private $Path;
    private $Size;
    
    public function __construct($postfile) {
        self::defaultValues($postfile);
    }
    
    public function defaultValues($postfile) {
        $this->postdata = $postfile;
        $this->defaultfilename = basename($postfile["fileToUpload"]["name"]);
        //$this->setSize($size);
        //$this->setCreatedTime($created);
        //$this->setParentFolder($parent);
    }

    public function getCreatedTime() {
        return $this->CreatedTime;
    }

    public function getModifiedTime() {
        return $this->ModifiedTime;
    }

    public function getName() {
        return $this->Name;
    }

    public function getParentFolder() {
        return $this->ParentFolder;
    }

    public function getPath() {
        return $this->Path;
    }

    public function getSize() {
        return $this->Size;
    }

    public function setCreatedTime($created) {
        $this->CreatedTime = $created;
    }

    public function setModifiedTime($modified) {
        $this->ModifiedTime = $modified;
    }

    public function setName($name) {
        $this->Name = $name;
    }

    public function setParentFolder(\FolderInterface $parent) {
        $this->ParentFolder = $parent;
    }

    public function setSize($size) {
        $this->Size = $size;
    }

}

class Folder implements FolderInterface {
    
    private $CreatedTime;
    private $Name;
    private $Path;
    
    public function getCreatedTime() {
        return $this->CreatedTime;
    }

    public function getName() {
        return $this->Name;
    }

    public function getPath() {
        return $this->Path;
    }

    public function setCreatedTime($created) {
        $this->CreatedTime = $created;
    }

    public function setName($name) {
        $this->Name = $name;
    }

    public function setPath($path) {
        $this->Path = $path;
    }

}

class FileSystem implements FileSystemInterface {
    
    public function listFiles() {
        $folders = new Folder();
        $folders->setPath($_SESSION["currentdir"]);
        echo "<table>";
        echo "<tr><th>Name</th><th>Last modified</th><th>Size</th><th>Description</th></tr>";
        $this->getFolders($folders);
        $this->getFiles($folders);
        echo "</table>";
    }
    
    public function checkRoot() {
        //strpos();
    }
    
    public function createFile(\FileInterface $file, \FolderInterface $parent) {
        // Expected path: PATH-TO-INDEX.PHP/PATH/NAME
        $target_dir = __DIR__ . $parent->getPath() . $parent->getName();
    }

    public function createFolder(\FolderInterface $folder, \FolderInterface $parent) {
        
    }

    public function createRootFolder(\FolderInterface $folder) {
        if (!file_exists("../root")) {
            $folder = new folder();
            $folder->setPath(__DIR__ . "/");
            $folder->setName("root");
            $folder->setCreatedTime(time());
            $parent = new Folder();
            $this->createFolder($folder, $parent);
        }
    }

    public function deleteFile(\FileInterface $file) {
        
    }

    public function deleteFolder(\FolderInterface $folder) {
        
    }
    
    public function getRootFolder() {
        $pathtoindex = str_replace("includes", "", __DIR__);
        if (file_exists("../root")) {
            return $pathtoindex . "root";
        }
        else {
            self::createRootFolder();
            return $pathtoindex . "root";
        }
    }

    public function getDirectorySize(\FolderInterface $folder) {
        
    }

    public function getFileCount(\FolderInterface $folder) {
        
    }

    public function getFiles(\FolderInterface $folder) {
        $files = scandir($folder->getPath());
        foreach ($files as $file) {
            if (!is_dir($file)) {
                echo "<tr>";
                echo "<td><span>File: </span><a  href='". basename($folder->getPath()) . "/" . $file ."'>". $file ."</a></td>";
                echo "</tr>";
            }
        }
    }

    public function getFolderCount(\FolderInterface $folder) {
        
    }

    public function getFolders(\FolderInterface $folder) {
        
        $folders = scandir($folder->getPath());
        foreach ($folders as $folder) {
            if (is_dir($folder) && $folder != "." && $folder != "..") {
                echo "<tr>";
                //echo "<td><a href='index.php?folder=". $folder ."'>". $folder ."</a></td>";
                echo "<td><span>Folder: </span><a class='folder' href='#'</a>" . $folder ."</td>";
                echo "</tr>";
            }
        }
        
    }

    public function renameFile(\FileInterface $file, $newName) {
        
    }

    public function renameFolder(\FolderInterface $folder, $newName) {
        
    }

    public function updateFile(\FileInterface $file) {
        
    }

}