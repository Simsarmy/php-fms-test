<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="js/libs/jquery/jquery.js"></script>
    </head>
    <body>
        <h2>File listing</h2>
        <?php // Debug
            /*
            include("includes/FileManagementSystem.php");
        
            $filesystem = new FileSystem();
            print($filesystem->getRootFolder());
            */
        ?>
        <?php include("list.php"); ?>
        <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
            <input type="submit" value="Up" id="up" name="up">
            <!-- <input type="submit" value="Down" id="down" name="down"> -->
        </form>
        <h2>Upload a new file</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload file" name="submit">
        </form>
    </body>
    <script src="js/scripts.js"></script>
</html>