<?php
include 'inc/config.php';
include 'inc/Database.php';
include 'inc/Session.php';
include 'inc/Format.php';
Session::checkSession();
    $db = new Database();
    $fm = new Format(); 
    if(isset($_GET['action']) && isset($_GET['action'])=="logout"){
        Session::destroy();
         echo "<script>window.location='teacher_login.php'</script>";
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
    <div class="address-bar">Hello! <?php echo Session::get("name") ?></div>

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
                <a class="navbar-brand" href="index.html">Online Exam by Jahid</a>
            </div>
             <?php 
    $path = $_SERVER['SCRIPT_FILENAME'];
        $currentpage = basename($path,'.php');

 ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li  <?php if($currentpage=='create_exam'){echo 'class="active"';} ?>>
                        <a href="create_exam.php">My Exams</a>
                    </li>
                    
                    <?php 
                        if(isset($_GET['id'])){
                        $id = preg_replace('/[^0-9]/', "", $_GET['id']);
                        //echo $id;

                          $stmt = $db->link->prepare("SELECT * FROM exam_count WHERE exam_no=?");
                          $stmt->bind_param("i",$id);
                          $singleSQL = $db->select($stmt);

                        // $query = "SELECT * FROM exam_count WHERE exam_no=$id";
                        // $singleSQL = $db->select($query);
                        if($singleSQL){ 
                        while($row = array_shift($singleSQL)){  

                            Session::set("exam_no",$row['exam_no']);
                            Session::set("topic_name",$row['topic_name']);

                            ?>

                    <li  <?php if($currentpage=='questionlist'){echo 'class="active"';} ?>>
                        <a href="questionlist.php?id=<?php echo $row['exam_no']; ?>"><?php echo $row['topic_name']; ?></a>
                    </li>
                    
                    <?php } } }elseif(isset($_SESSION['topic_name'])){ ?>
                    <li id="hide">
                        <a href="questionlist.php?id=<?php echo Session::get("exam_no"); ?>"><?php echo Session::get("topic_name"); ?></a>
                    </li>
                       <?php } ?>

                    
                    <li>
                        <a href="?action=logout">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
