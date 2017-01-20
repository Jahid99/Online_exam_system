<?php 
include 'inc/config.php';
include 'inc/Database.php';
include 'inc/Session.php';
include 'inc/Format.php';
Session::checkStudentSession();
    $db = new Database();
    $fm = new Format(); 

$msg = "";
if(isset($_GET['msg'])){
  echo $msg = $_GET['msg'];
  unset($msg);
}
?>
<?php 
        if(isset($_GET['action']) && isset($_GET['action'])=="logout"){
            Session::destroy();                               
        echo "<script>window.location='student_login.php'</script>";

             }
?> 
<html class="loading">
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
<style>
html {
    -webkit-transition: background-color 1s;
    transition: background-color 1s;
}
html, body {
    /* For the loading indicator to be vertically centered ensure */
    /* the html and body elements take up the full viewport */
    min-height: 100%;
}
html.loading {
    /* Replace #333 with the background-color of your choice */
    /* Replace loading.gif with the loading image of your choice */
    background: #333 url('loading.gif') no-repeat 50% 50%;

    /* Ensures that the transition only runs in one direction */
    -webkit-transition: background-color 0;
    transition: background-color 0;
}
body {
    -webkit-transition: opacity 1s ease-in;
    transition: opacity 1s ease-in;
}
html.loading body {
    /* Make the contents of the body opaque during loading */
    opacity: 0;

    /* Ensures that the transition only runs in one direction */
    -webkit-transition: opacity 0;
    transition: opacity 0;
}
</style>
</head>



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
                    <li  <?php if($currentpage=='start'){echo 'class="active"';} ?>>
                        <a href="start.php">Home</a>
                    </li>
                    <li id="hide_result"  <?php if($currentpage=='result'){echo 'class="active"';} ?>>
                        <a href="result.php">Result</a>
                    </li>
                    
                    <li>
                        <a href="?action=logout">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <?php
$zero = 0;
$one = 1;

array_push($_SESSION['rand_id'], 0);
array_push($_SESSION['rand_id'], 0);
array_push($_SESSION['rand_id'], 0);
array_push($_SESSION['rand_id'], 0);

if(isset($_GET['question'])){
    $question = preg_replace('/[^0-9]/', "", $_GET['question']);
    if($_SESSION['frst']==0){
    $_SESSION['key'] = array_search($_SESSION['rand_id'][0], $_SESSION['rand_id']);   
    $_SESSION['key']++;
    $next = $_SESSION['key'];
    $prev = 0;
    $next = $_SESSION['rand_id'][$next];
    $_SESSION['check_for_suspension'] = 1;
    $token_id = Session::get("token_id");
    $stmt = $db->link->prepare("UPDATE examinees_info 
        SET result = ?
        WHERE token_id = ?");

        $stmt->bind_param("is",$zero,$token_id);
        $db->update($stmt);
        }else{
        $next = $_SESSION['key'];
        $prev = $_SESSION['rand_id'][$next-2];
        $next = $_SESSION['rand_id'][$next];
    }

    
    if(!isset($_SESSION['qid_array']) && $question != $_SESSION['rand_id'][0]){

        if(isset($_SESSION['stdlogin'])){
            $token_id = Session::get("token_id");
            $stmt = $db->link->prepare("UPDATE examinees_info 
        SET suspended=?
        WHERE token_id = ?");

        $stmt->bind_param("is",$one,$token_id);
        $db->update($stmt);

        $msg = 'Your account has been suspended';
          
        echo "<script>window.location='student_login.php?msg=$msg'</script>";

          Session::set("stdlogin",false);

        }else{
            echo "<script>window.location='student_login.php'</script>";

        }
        exit();
    }
    if(isset($_SESSION['qid_array']) && in_array($question, $_SESSION['qid_array'])){
        $msg = "Sorry, Cheating is not allowed. You will now have to start over. Haha.";
       
        unset($_SESSION['answer_array']);
        unset($_SESSION['qid_array']);
 
        if(isset($_SESSION['stdlogin'])){
            $token_id = Session::get("token_id");
            $stmt = $db->link->prepare("UPDATE examinees_info 
        SET suspended=?
        WHERE token_id = ?");

        $stmt->bind_param("is",$one,$token_id);
        $db->update($stmt);

          $msg = 'Your account has been suspended';
           echo "<script>window.location='student_login.php?msg=$msg'</script>";
          Session::set("stdlogin",false);

    }else{
       echo "<script>window.location='student_login.php'</script>";
    }
        session_destroy();
        exit();
    }
    if(isset($_SESSION['lastQuestion']) && $_SESSION['lastQuestion'] != $prev){
        $msg = "Sorry, Cheating is not allowed.... You will now have to start over. MoHaha.";
        unset($_SESSION['answer_array']);
        unset($_SESSION['qid_array']);

        if(isset($_SESSION['stdlogin'])){
            $token_id = Session::get("token_id");
            $stmt = $db->link->prepare("UPDATE examinees_info 
        SET suspended=?
        WHERE token_id = ?");

        $stmt->bind_param("is",$one,$token_id);
        $db->update($stmt);

          $msg = 'Your account has been suspended';
          echo "<script>window.location='student_login.php?msg=$msg'</script>";
          Session::set("stdlogin",false);

    }else{
      echo "<script>window.location='student_login.php'</script>";
    }
       session_destroy();
        exit();
    }
}
?>

<script type="text/javascript">
function countDown(secs,elem) {
    var element = document.getElementById(elem); 
    //localStorage.setItem('highscore', secs);
    document.cookie = 'username='+secs;
    element.innerHTML = "You have "+secs+" seconds remaining.";
    
    if(secs < 1) {
        document.cookie = "username=<?php echo $_SESSION['per_q_limit'];?>";
        var xhr = new XMLHttpRequest();
        var url = "userAnswers.php";
            var vars = "radio=0"+"&qid="+<?php echo $question; ?>;
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            //alert("You did not answer the question in the allotted time. It will be marked as incorrect.");
            clearTimeout(timer);

            var url = 'quiz.php?question=<?php echo $next; ?>';// This line and its next line works if
            window.location = url;                             //we put it in xhr.send(vars)

    }
}
xhr.send(vars);
        document.cookie = "username=<?php echo $_SESSION['per_q_limit'];?>";
       // document.getElementById('counter_status').innerHTML = "";
        //document.getElementById('btnSpan').innerHTML = '<h2>Times Up!</h2>';
        //document.getElementById('btnSpan').innerHTML += '<a href="quiz.php?question=<?php echo $next; ?>">Click here now</a>';
        
    }
    secs--;
    var timer = setTimeout('countDown('+secs+',"'+elem+'")',1000);
}
</script>
<script>
function getQuestion(){
    var hr = new XMLHttpRequest();
        hr.onreadystatechange = function(){
        if (hr.readyState==4 && hr.status==200){
            //localStorage.setItem('highscore', <?php echo Session::get("per_q_limit");?>);
            var response = hr.responseText.split("|");
            if(response[0] == "finished"){
                
                document.getElementById('status').innerHTML = response[1];
                window.location='result.php';
            }
            var nums = hr.responseText.split(",");
            document.getElementById('question').innerHTML = nums[0];
            document.getElementById('answers').innerHTML = nums[1];
            document.getElementById('answers').innerHTML += nums[2];
           // alert(<?php echo $question; ?>);
        }
    }
hr.open("GET", "questions.php?question=" + <?php echo $question; ?>, true);
  hr.send();
}
function x() {
        document.cookie = "username=<?php echo $_SESSION['per_q_limit'];?>";
        var rads = document.getElementsByName("rads");
        for ( var i = 0; i < rads.length; i++ ) {
        if ( rads[i].checked ){
        var val = rads[i].value;
        return val;
        }
    }
}
function post_answer(){
   document.cookie = "username=<?php echo $_SESSION['per_q_limit'];?>";
    var p = new XMLHttpRequest();
            var id = document.getElementById('qid').value;
           // document.write(id);
            var url = "userAnswers.php";
            var vars = "qid="+id+"&radio="+x();
            p.open("POST", url, true);
            p.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            p.onreadystatechange = function() {
        if(p.readyState == 4 && p.status == 200) {
            document.getElementById("status").innerHTML = '';
           // alert("Thanks, Your answer was submitted"+ p.responseText);
            document.cookie = "username=<?php echo $_SESSION['per_q_limit'];?>";
            //var url = 'quiz.php?question=<?php echo $next; ?>';
            var url = 'quiz.php?question=<?php echo $next; ?>';
            window.location = url;
    }
}
p.send(vars);
document.getElementById("status").innerHTML = "processing...";
    
}
</script>
<script>
window.oncontextmenu = function(){
    return false;
}
</script>


<body onLoad="getQuestion()">

<div id="status">
<center><div id="counter_status"></div></center></div></center>
<div class="container">
<div id="question"></div>
<div class="radio">
<div id="answers"></div>
</div>
</div>


<script type="text/javascript">

function getCookie(name)
  {
    var re = new RegExp(name + "=([^;]+)");
    var value = re.exec(document.cookie);
    return (value != null) ? unescape(value[1]) : null;
  }



  var time_cnt = (getCookie("username"));


//time_cnt=localStorage.getItem('highscore');
        
countDown(time_cnt,"counter_status");
</script>
<?php include 'inc/footer.php'; ?>
<script>
   $( "html" ).removeClass( "loading" );
   $("#hide_result").hide();
</script>
