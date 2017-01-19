<?php
include 'inc/teacher_header.php';
$exam_number=Session::get("exam_number");
if ($_SERVER['REQUEST_METHOD']=='POST') {
$start_date =  $fm->validation($_POST['start_date']);
$start_time =  $fm->validation($_POST['start_time']);
$end_date =  $fm->validation($_POST['end_date']);
$end_time =  $fm->validation($_POST['end_time']);
$start_date =  mysqli_real_escape_string($db->link,$start_date);
$start_time =  mysqli_real_escape_string($db->link,$start_time);
$end_date =  mysqli_real_escape_string($db->link,$end_date);
$end_time =  mysqli_real_escape_string($db->link,$end_time);
    if ($start_date == "" || $start_time == "" || $end_date == "" || $end_time == "") {
         Session::set("message","Fields must not be empty !!!");
    }else{
    if(($start_date[2])=='/' && ($start_date[5])=='/' && ($end_date[2])=='/' && ($end_date[5])=='/'){
    $start_date_arr = explode("/",$start_date);
       $i = $start_date_arr[0];
       $j = $start_date_arr[1];
       $z = $start_date_arr[2];

    if(checkdate($i,$j,$z)){
    $start_time_arr = preg_match('#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $start_time);

    if ( $start_time_arr == 1 )
    {
      $end_date_arr = explode("/",$end_date);

     $a = $end_date_arr[0];
     $b = $end_date_arr[1];
     $c = $end_date_arr[2];

    if(checkdate($a,$b,$c)){
$end_time_arr = preg_match('#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $end_time);
if ( $end_time_arr == 1 )
{
$start_and_end_exam_time = $start_date.' '.$start_time.' '.$end_date.' '.$end_time;
$stmt = $db->link->prepare("UPDATE exam_count 
      SET start_and_end_exam_time = ?
      WHERE exam_no = ?");
    $stmt->bind_param("si",$start_and_end_exam_time,$exam_number);
    $updated_row = $db->update($stmt);
       Session::set("message","Start time and end time updated succesfully !!!");
       Session::set("color","success");
       echo "<script>window.location='questionlist.php?id=$exam_number'</script>";
       exit();
}
else
{
  echo "<center><span class='label label-danger'>Please maintain the hh:mm:ss(24 hr.) format for date</span></center><br>";
}


}else{
	echo "<center><span class='label label-danger'>Please maintain the mm/dd/yyyy format for date(Example : 11/25/2017)</span></center><br>";
}
}
else
{
  echo "<center><span class='label label-danger'>Please maintain the hh:mm:ss(24 hr.) format for date</span></center><br>";
}



}else{
	echo "<center><span class='label label-danger'>Please maintain the mm/dd/yyyy format for date(Example : 11/25/2017)</span></center><br>";
}

}else{
	echo "<center><span class='label label-danger'>Please maintain the mm/dd/yyyy format for date(Example : 11/25/2017)</span></center><br>";
}
}
}
 ?>
<div class="container">
<?php 
if(Session::get("message")){ ?>
  <center><span class="label label-danger"><?php echo Session::get("message"); ?></span></center><br>
 <?php Session::unset_it("message");
}
?>
 <form action="" name="addMcQuestion" method="post">
<?php
  $stmt = $db->link->prepare("SELECT start_and_end_exam_time FROM exam_count WHERE exam_no = ?");
  $stmt->bind_param("i",$exam_number);
  $singleSQL = $db->select($stmt);
    $i = 0;
    if($singleSQL){ ?>
     <?php
    while($row = array_shift($singleSQL)){ $i++;  ?>
    <?php 
    $start_and_end = explode(" ",$row['start_and_end_exam_time']);
     ?>
      <div class="form-group col-lg-6">
            <label>Please Enter the start date (mm/dd/yyyy)</label>
           <input class="form-control" type="text" name="start_date"  value="<?php echo $start_and_end[0]; ?>"/>
        </div>
        <div class="clearfix"></div>

      <div class="form-group col-lg-6">
            <label>Please Enter the start time in 24 hour format</label>
           <input class="form-control" type="text" name="start_time" value="<?php echo $start_and_end[1]; ?>"/>
        </div>
        <div class="clearfix"></div>

      <div class="form-group col-lg-6">
            <label>Please enter the end date (mm/dd/yyyy)</label>
            <input class="form-control" type="text" name="end_date" value="<?php echo $start_and_end[2]; ?>"/>
        </div>
        <div class="clearfix"></div>

      <div class="form-group col-lg-6">
            <label>Please enter the end time in 24 hour format</label>
            <input class="form-control" type="text" name="end_time" value="<?php echo $start_and_end[3]; ?>"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-2">
    <input class="form-control" type="submit" value="Submit">
    </div>
        <div class="clearfix"></div>
    <?php } } ?>
    </form>
<?php
	$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	$current_date = $dt->format('Y/m/d, H:i:s');
	$starting_date = $start_and_end[0] .' '.$start_and_end[1];
  $seconds = strtotime($starting_date) - strtotime($current_date);
  $days    = floor($seconds / 86400);
  $hours   = floor(($seconds - ($days * 86400)) / 3600);
  $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
  $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
?>

<p id="demo"></p>
<script type="text/javascript">
	var sec = <?php echo $seconds; ?> 
	var min = <?php echo $minutes; ?> 
	var hour = <?php echo $hours; ?> 
	var day = <?php echo $days; ?> 
function countDown(){
document.getElementById("demo").innerHTML ='<center>'+day+' Days '+hour+' Hours '+min+' Minutes '+sec+' Seconds remaining</center>';
 sec--;
 if(sec<0){
 	sec = 59;
 	min--
 }

if(min<0){
	hour--;
	min=59
}
if(hour<0){
	day--;
	hour=24;
}
if((day==0 && hour==0 && min==0 && sec==0) || (day<0)){
	clearInterval(inter);
	 document.getElementById("demo").innerHTML = '<center><span class="label label-info">Students can now paticipate</span><center><br>';
}
}
var inter = setInterval(countDown, 1000);
</script>
</div>
<?php include 'inc/teacher_footer.php'; ?>