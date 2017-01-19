<?php
include 'inc/config.php';
include 'inc/Database.php';
include 'inc/Format.php';
include 'inc/Session.php';
 $fm = new Format();    
 $db = new Database();
         if ($_SERVER['REQUEST_METHOD']=='POST') {
            $fname =  $fm->validation($_POST['firstname']);
            $lname =  $fm->validation($_POST['lastname']);
            $email =  $fm->validation($_POST['email']);
            $body =  $fm->validation($_POST['body']);
            $fname =  mysqli_real_escape_string($db->link,$fname);
            $lname =  mysqli_real_escape_string($db->link,$lname);
            $email =  mysqli_real_escape_string($db->link,$email);
            $body =  mysqli_real_escape_string($db->link,$body);
            $errorf = "";
            $errorl = "";
            $errore = "";
            $errorb = "";
            if(empty($fname)){
                $errorf = "First name must not be empty!!!";
            }
            if(empty($lname)){
                $errorl = "Last name must not be empty!!!";
            }
            if(empty($email)){
                $errore = "Email must not be empty!!!";
            }
            if(empty($body)){
                $errorb = "Body must not be empty!!!";
            }else{
                $to = "$email";
                $from = "jahidulpathan@gmail.com";
                $headers = "From: $from\n";
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $subject = "Message from ".$fname."";
                $message = $body;

                $sendmail = mail($to, $subject, $message,$headers);
                if ($sendmail) {
                     Session::set("message","Your Message has been sent!!.");
                     Session::set("color","success");
                }else{
                    Session::set("message","Email not sent !!.");
                }
            }

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Online exam system by Jahid</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="brand">Online exam system</div>
    <div class="address-bar">by Jahid</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Online exam system by Jahid</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="howworks.php">How it works</a>
                    </li>
                    <li class="active">
                        <a href="contact.php">Contact us</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-5">
                   <div class="media">
                      <div class="media-left">
                        <a href="#">
                          <img class="media-object" src="img/jahid.jpg" alt="..." height="450px" width="450px">
                        </a>
                      </div>
                    </div>
            </div>
            <div class="col-lg-7">
                <div class="media-body"><br>
                    <center><i><h4 class="media-heading">Message from the developer</h4></i></center>
                    <center><p>Hi! I am Jahid.This is an online exam system built with PHP and AJAX. Enjoy!!!</p></center>
                    <?php 
                    if(Session::get("message")){ ?>
                      <br><center><span class="label label-<?php 
                      if(Session::get("color")){
                      echo Session::get("color");
                      Session::unset_it("color");
                    }else{
                        echo "danger";
                    }
                       ?>"><?php echo Session::get("message"); ?></span></center><br>
                     <?php Session::unset_it("message");
                    }
                    ?>
                    <form action="" method="post">      
                    <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Your first name:</label>
                    <?php 
                    if (isset($errorf)) {
                        echo "<span class='thetexterror' style='color:red'>$errorf</span>";                 }

                     ?>        
                    <input type="text" class="form-control" name="firstname" placeholder="Enter first name" />                   
                    </div>
                    <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Your last name:</label>
                    <?php 
                    if (isset($errorl)) {
                        echo "<span  class='thetexterror' style='color:red'>$errorl</span>";                 }

                     ?>
                    <input class="form-control" type="text" name="lastname" placeholder="Enter Last name" />
                   </div>
                   <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Your email address:</label>
                    <?php 
                    if (isset($errore)) {
                        echo "<span class='thetexterror' style='color:red'>$errore</span>";                 }

                     ?>
                    <input class="form-control" type="text" name="email" placeholder="Enter Email Address" />
                    </div>

                    </div>
                    <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Your message:</label>
                    <?php 
                    if (isset($errorb)) {
                        echo "<span class='thetexterror' style='color:red'>$errorb</span>";                 }

                     ?>
                    <textarea class="form-control" name="body"></textarea>
                    </div>
                    <div class="form-group col-lg-6 col-lg-offset-3">
                    <input class="btn btn-success" type="submit" name="submit" value="Send"/>
                    </div>
                </form>              
              </div>
            </div>
                </div><br>
                     <div style="margin-top:20px"></div>
                <center>
     </div>           
        </div>

    </div>
<?php include 'inc/footer.php'; ?>