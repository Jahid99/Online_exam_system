<?php
include 'inc/config.php';
include 'inc/Database.php';
    $db = new Database();
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
                    <li class="active">
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
                    <div class="jumbotron">
                    <h2>For the test creators</h2>
                    <p>1. First you will have to create an exam for your students.</p>
                    <p>2. Register and create an exam.You can create multiple exams</p>
                    <p>3. You can set the number of questions you want to show to the students.Suppose you want to make 100 questions.you have 10 students.You want each student will get 25 of questions randomly from 100 questions.you can do it there.</p>
                    <p>4. You will have to set the per question time limit.</p>
                    <p>5. You will have to set the number of students who will perticipate in the exam.Suppose you want 5 students will perticipate in the exam.then you have to enter 5 and you will get 5 unique token IDs for that exam.You will have to give each token ID to each student.Students who will register using these token ID's can perticiapte in the exam.</p>
                    <p>6. Then you have set questions for the exam.</p>
                    <p>7. Then you must have to adjust the starting time and ending time of the exam.Student will not be able to perticipate in the exam before the starting time.They will not be able to perticipate in the exam after the ending time.</p>
                    <p>8. After the end of the exam go to the 'ASSIGN NUMBER OF STUDENTS FOR THIS EXAM' option and there you can publish the result to the students.Then the students will be able see their marks as well as their competitors marks.They will also see the answers of the questions.</p>
                    <h2>For the test takers</h2>
                    <p>1. You have to register with the token ID you get from your teacher.</p>
                    <p>2. You can perticipate in an exam once.</p>
                    <p>3. If you do not give answer to a question within the given time.You will get zero marks for that question.</p>
                    <p>4. Don't try to cheat by changing the url or trying to go back when the exam is running.Your account will get suspension.</p>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>