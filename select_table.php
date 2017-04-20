<?php
    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
    echo "<title>List of Guests</title>";
    echo "</head>";
    echo "<body>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th></tr>";

    class TableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }


    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myDBPDO";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT id, firstname, lastname FROM myGuests");
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
    echo "</table>";
    echo "</body>";
    echo "</html>";

?>