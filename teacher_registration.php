<?php 
include 'inc/config.php';
include 'inc/Database.php';
include 'inc/Session.php';
include 'inc/Format.php';
Session::init();
		$db = new Database();
        $fm = new Format(); 

if ($_SERVER['REQUEST_METHOD']=='POST') {
     $name =  $fm->validation($_POST['name']);
     $email =  $fm->validation($_POST['email']);
     $username =  $fm->validation($_POST['username']);
     $password =  $fm->validation($_POST['password']);
     $password = password_hash($password, PASSWORD_BCRYPT);
     $name =  mysqli_real_escape_string($db->link,$name);
     $email =  mysqli_real_escape_string($db->link,$email);
     $username =  mysqli_real_escape_string($db->link,$username);
     $password =  mysqli_real_escape_string($db->link,$password);
      if ($name == ""|| $email == ""|| $username == ""|| $password == "") {
        Session::set("message","Fields must not be empty !!!");
      }elseif(!preg_match("/^[\w]+$/", $username)) {
        Session::set("message","Only A-Z a-z 0-9 and _ are allowed in username !!!");
      }
    else{
        $stmt = $db->link->prepare("SELECT * FROM teachers_info where email = ? limit 1");           
          $stmt->bind_param("s",$email);
          $mailcheck = $db->select($stmt);
         if($mailcheck!= false){
            Session::set("message","Email already used !!!");
          }else{
          $stmt = $db->link->prepare("SELECT * FROM teachers_info where username = ? limit 1");       
          $stmt->bind_param("s",$username);
          $usernamecheck = $db->select($stmt);
         if($usernamecheck!= false){
            Session::set("message","Username already used !!!");
        }else{
            $stmt = $db->link->prepare("INSERT INTO teachers_info (name, email, username,password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $username,$password);
            $result = $db->insert($stmt);
            Session::set("message","Registration successful !!!");
            Session::set("color","success");
            echo "<script>window.location='teacher_login.php'</script>";  
            exit();
         }
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
                <a class="navbar-brand" href="index.php">Online exam system by Jahid</a>
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
                    <li>
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
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Registration
                        <strong>form</strong>
                    </h2>
                    <hr>
                     <?php 

                        if(Session::get("message")){ ?>
                          <center><span class="label label-<?php 
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
                        <div class="row">
                            
                            <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>E-mail</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="clearfix"></div>
                            
                            <div class="form-group col-lg-6 col-lg-offset-3">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <center>Go back to <a href="teacher_login.php">Login</a> page</center>
            </div>
        </div>
    </div>
    <!-- /.container -->
<?php include 'inc/teacher_footer.php'; ?>