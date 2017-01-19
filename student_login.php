<?php
include 'inc/config.php';
include 'inc/Database.php';
include 'inc/Session.php';
include 'inc/Format.php';
Session::checkStudentLogin();
    $db = new Database();
    $fm = new Format(); 

if ($_SERVER['REQUEST_METHOD']=='POST') {
  $username =  $fm->validation($_POST['username']);
  $password =  $fm->validation($_POST['password']);
  $username =  mysqli_real_escape_string($db->link,$username);
  $password =  mysqli_real_escape_string($db->link,$password);
  if ($username == "" || $password == "") {
    Session::set("message","Fields must not be empty !!!");
  }else{
  $stmt = $db->link->prepare("SELECT * FROM examinees_info WHERE username=?");
  $stmt->bind_param("s",$username);
  $selected_row = $db->select($stmt);
  if($selected_row){
    $value= array_shift($selected_row);;
          $dbpassword = $value['password'];
        if(password_verify($password, $dbpassword)){
          if($value['suspended']==1){
          $msg = 'Your account has been suspended';
          echo "<script>window.location='student_login.php?msg=$msg'</script>";

  }else{
          Session::set("stdlogin",true);
          Session::set("name",$value['name']);
          Session::set("exam_id",$value['exam_id']);
          Session::set("token_id",$value['token_id']);
          echo "<script>window.location='start.php'</script>";
  }
  }else{
    Session::set("message","Username and Password do not matched !!!");
  }
    }
    else{
      Session::set("message","Username and Password do not matched !!!");
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
                    <h2 class="intro-text text-center">Login
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

              if (isset($_GET['msg'])) {

                        $msg = $_GET['msg']; 
                        echo '<center><span class="label label-danger">'.$msg.'</span></center><br>';

              }

              if(Session::get("message")){ ?>
                <center><span class="label label-info"><?php echo Session::get("message"); ?></span></center><br>
               <?php Session::unset_it("message");
              }

        ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            
                            <div class="form-group col-lg-6 col-lg-offset-3">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <center>Don't have an account?<a href="student_registration.php">Register</a> here</center><br>

                <center>Forgot password?<a href="student_forgotpassword.php">Click here</a></center>
            </div>
      </div>
    </div>
    <!-- /.container -->
<?php include 'inc/footer.php'; ?>