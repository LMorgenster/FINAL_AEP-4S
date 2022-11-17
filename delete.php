<?php

if(isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crud_aep";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM users WHERE id=$id";
    $connection->query($sql);
    
}

header("location: /CRUD_AEP/index.php");
exit;

?>