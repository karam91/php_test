<?php
    require "header.php";

    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "DKN";

    //$username = $_SESSION["username"];
    //$name     = $_SESSION["name"];
    
    $username = "redeteus";
    $name     = "Ghang seok Seo";

    $customer = null;
    $branches = array();
    
    if (isset($_GET['id'])) {
        echo "==================================================================================";
    }

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT name
                                     , tel
                                     , email
                                     , address
                                     , city
                                     , province
                                     , postal
                                     , map
                                  FROM Branches
                                 WHERE is_open = 'Y'"
                               );
        $stmt->execute();

        while($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            array_push($branches, $result);            
        }
        
        $stmt = null;        
        $conn = null;

    } catch(PDOException $e) {
        echo $e->getMessage();
        // echo "<script type='text/javascript'>alert('Error: " . $e->getMessage() . "');</script>";
        //header("Location:503.html");
    }
?>

    <div class="container">
    <?php
        foreach($branches as $row) {
    ?>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Contact
                        <strong><?php echo $row->name ?> Branch</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-8">
                    <!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
                    <?php echo $row->map ?>
                </div>
                <div class="col-md-4">
                    <p>Phone:
                        <strong><?php echo $row->tel ?></strong>
                    </p>
                    <p>Email:
                        <strong><a href="mailto:<?php echo $row->email ?>"><?php echo $row->email ?></a></strong>
                    </p>
                    <p>Address:<br/>
                        <strong><?php echo $row->address ?>
                            <br><?php echo $row->city ?>, <?php echo $row->province ?> <?php echo $row->postal ?></strong>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php
        }
    ?>
        

    </div>
    <!-- /.container -->

<?php
    require "footer.php";
?>
