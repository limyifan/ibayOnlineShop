<?php
require_once ("configuration.php");

?>
<?php
    session_start();
    $username = ltrim(rtrim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING))); //string
    $password = ltrim(rtrim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING))); //string


    if ($username == "admin" && $password == "1234") {
        $_SESSION['admin'] = true;
        $_SESSION['log_on'] = true; // set to false if this is not the administrator
    } else if (empty($username) && empty($password)) {
        $_SESSION['log_on'] = false;
        $_SESSION['admin'] = false;
    } else {
        $_SESSION['admin'] = false;
        $_SESSION['log_on'] = true;
    }
    ?>
    <body>

                <header class="header"  id="top" style=' position: relative;
  display: table;
  z-index: 2;
  width: 100%;
  height: 100%;
  background: url(../img/bg.jpg) no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;'>
                  <img src='img/bg.jpg' style='height: 125px; width: 100%; z-index: -20; position: absolute;'>
            <div class="text-vertical-center" style='  display: table-cell;
  text-align: center;
  vertical-align: middle;'>
                <h1>Welcome to Ibay</h1>
                <h3>The most popular online shopping website</h3>
            
            </div>
        </header>
        </div>
<!--
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#">Logo</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav" style='left: 400px;'>
                        <li ><a href="index.php">Home</a></li>
                        <li class="active"><a href="#">Products</a></li>
                        <li><a href="#">Deals</a></li>
                        <li><a href="#">Deals</a></li>
                        <li><a href="#">Deals</a></li>
                        <li><a href="#">Deals</a></li>
                        <li><a href="#">Deals</a></li>
                        <li><a href="#">Stores</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                    </ul>
                </div>
            </div>
        </nav>-->

          <?php
        $id = ltrim(rtrim(filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT)));

        /* Include "configuration.php" file */
        require_once "configuration.php";

        /* Connect to the database */
        $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception

        /* Perform query */
        $query = "SELECT categoryName,src from categories ";
        $statement = $dbConnection->prepare($query);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
   
        /* Manipulate the query result */
        if ($statement->rowCount() > 0) {
//            echo "<div class='slideshow-container'>";
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            echo" <nav class='navbar navbar-inverse'>
            <div class='container-fluid'>
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>                        
                    </button>
<!--                    <a class='navbar-brand' href='#'>Logo</a>-->
                </div>
                <div class='collapse navbar-collapse' id='myNavbar'>
                    <ul class='nav navbar-nav' style='left: 400px;'>
                        <li ><a href='index.php'>Home</a></li>";
            foreach ($result as $row) {
                echo "     <li><a href='". $row->src."'>". $row->categoryName."</a></li>";
         
            }
       
                if ($_SESSION['log_on']) {
                    echo "<li ><a href='index.php'>Editor</a></li>
                    <li ><a href='sub.php'>Subscribers</a></li>";
                }
                else {
                    
                }
        
            echo "  </ul>
                    <ul class='nav navbar-nav navbar-right'>
                        <li><a href='login_admin.php'><span class='glyphicon glyphicon-user'></span> Admin Login</a></li>
                        <li><a href='#'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li>
                    </ul>
                </div>
            </div>
        </nav>";
   
        }
        ?>
       