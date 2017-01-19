<?php
include 'inc/config.php';
include 'inc/Database.php';
include 'inc/Session.php';
include 'inc/Format.php';
    $db = new Database();
    $fm = new Format(); 
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
                <?php
                    if(isset($_POST['username']))
                    {
                        $username =  $fm->validation($_POST['username']); 
                        $password =  $fm->validation($_POST['password']); 
                        $username =  mysqli_real_escape_string($db->link,$username);
                        $password =  mysqli_real_escape_string($db->link,$password);
                    if($username!='' && $password!=''){
                    $password = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $db->link->prepare("UPDATE teachers_info 
                    SET password=?
                    WHERE username = ?");
                    $stmt->bind_param("ss",$password,$username);
                    $sql = $db->update($stmt);
                    echo "<center><span class='label label-success'>Password changed</span></center><br>";
                    echo "<center>Go to <a href='teacher_login.php'>Login</a> page</center>";
                    }else{
                        echo "<center><span class='label label-success'>Fields must not be empty</span></center><br>";
                        echo "<center><button onclick='goBack()' class='btn btn-danger'>Go Back</button><center>

                    <script>
                    function goBack() {
                        window.history.back();
                    }
                    </script>";

                    }
            }




elseif(isset($_GET['action']))
{          
    if($_GET['action']=="reset")
    {
        $encrypt = $_GET['encrypt'];

        $stmt = $db->link->prepare("SELECT userid,token,expirydate,used FROM reset_password where token=?");
      
  $stmt->bind_param("s",$encrypt);
  $singleSQL = $db->select($stmt);
        if($singleSQL){
             $value= array_shift($singleSQL);
             $userid = $value['userid'];
             $expirydate = $value['expirydate'];
             $used = $value['used'];
            $datetime1 = new DateTime($expirydate,new DateTimezone('Asia/Dhaka'));
            $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
            $interval = $datetime1->diff($dt);
            $elapsed_min = $interval->format('%i');
            $elapsed_hr = $interval->format('%h');
            $elapsed_day = $interval->format('%d');
            $elapsed_hr=$elapsed_hr-12;
            if($elapsed_day==0 && $elapsed_hr == 0 && $elapsed_min<=15){
             if($used==0){
                $stmt = $db->link->prepare("delete from reset_password where userid =?");
                $stmt->bind_param("i",$userid);
                $deldata = $db->delete($stmt);

                  $stmt = $db->link->prepare("SELECT id,username FROM teachers_info where id=?");  
                  $stmt->bind_param("i",$userid);
                  $singleSQL = $db->select($stmt);
              if($singleSQL){
             $value= array_shift($singleSQL);
             $username = $value['username'];
             echo '<form action="teacher_reset.php" method="post" id="reset" >
             <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Your Username</label>
            <input class="form-control" id="user" name="username" type="text" value="'.$username.'" readonly>
            </div>
            <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Enter new password</label>
             <input class="form-control" id="password" name="password" type="password" placeholder="Enter new password">
            </div>
    
            <div class="form-group col-lg-2 col-lg-offset-3">
            <button class="form-control" onclick="mypasswordmatch();" type="submit" class="btn btn-success">Submit</button></p>
        </div>
    </form>';
    }
}else{
    echo "<center><span class='label label-danger'>You cannot use this link twice</span></center>";
}
}else{
    echo "<center><span class='label label-danger'>Link Expired</span></center>";
}
}else{
    echo "<center><span class='label label-danger'>Link Expired</span></center>";
}
        }
        else
        {
            $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
        }
    }

else
{
          echo "<script>window.location='teacher_login.php'</script>";
    
}?>
            </div>
        </div>
    </div>
    <!-- /.container -->
<?php include 'inc/footer.php'; ?>