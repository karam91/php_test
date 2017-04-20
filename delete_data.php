<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myDBPDO";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("DELETE FROM myGuests WHERE id = 3");
        $stmt->execute();

        echo "Record deleted successfully";
    } catch(PDOException $e) {
        echo $sql . "<br/>" . $e->getMessage();
    }

?>