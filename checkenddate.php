<?php 
include 'inc/config.php';
include 'inc/Database.php';
include 'inc/Session.php';
  Session::checkStudentSession();
$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $current_date = $dt->format('m/d/Y, H:i:s');
    $current_date_str =  strtotime($current_date);
    $ending_date = Session::get("end_date");
    if(isset($_SESSION['ready'])){
    if($current_date_str>$ending_date){ ?>
    	<script type="text/javascript">
    	window.location = 'start.php';
    	</script>
   <?php }else{ ?>
    	<script type="text/javascript">
    	window.location = 'quiz.php?question=<?php echo $_SESSION['rand_id'][0]; ?>';
    	</script>
  <?php  }  }else{
    echo "<script>window.location='start.php'</script>";
  }?>