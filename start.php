<?php 
include 'inc/header.php';
$one = 1;
$exam_id = Session::get("exam_id");
$token_id = Session::get("token_id");
?>
<?php
  $_SESSION['frst']=0;
  $_SESSION['key']=0;
?>
<?php 
 if(isset($_SESSION['lastQuestion']) || $_SESSION['frst']==1){
        
       
        unset($_SESSION['answer_array']);
        unset($_SESSION['qid_array']);
        unset($_SESSION['lastQuestion']);
        $_SESSION['frst']=0;
        $_SESSION['key']=0;  
    }
 if(isset($_SESSION['check_for_suspension']) && $_SESSION['check_for_suspension']==1){ 
        if(isset($_SESSION['stdlogin'])){
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
        unset($_SESSION['check_for_suspension']);   
    }


 ?>
<script>
getit=localStorage.getItem('pathan');
if(getit=='12'){
   // document.write("Cheating is not allowed.Your Account has been suspended.Please Contact with your exam controller");
    $(document).ready(function(){
      // $("h3,button").hide();
});
}
function startQuiz(url){
    window.location = url;
}
function refresh_page(){
    location.reload();
}
localStorage.setItem('highscore', <?php echo Session::get("per_q_limit");?>);
</script>
</head>
<body>
<center><span class="label label-info">Exam on : <?php echo Session::get("exam_topic");; ?></span></center>
<?php 
  $exam_id = Session::get("exam_id");
  $stmt = $db->link->prepare("SELECT * FROM questions WHERE exam_no=? ORDER BY rand()");
  $stmt->bind_param("i",$exam_id);
  $singleSQL = $db->select($stmt);
    $i = 0;
    if($singleSQL){
    while($row = array_shift($singleSQL)){ $i++; ?>
      <tr>
        <td><?php //echo $row['id']; ?></td>
        <td><?php// echo $row['question']; ?></td>
        <?php 
        if($i==1){
        $_SESSION['rand_id'] = array($row['id']);
    }else{
        array_push($_SESSION['rand_id'], $row['id']);
    }
         ?>
      </tr>
      
<?php  }  }?>

<?php 
$num_of_questions_set = $i;
$test = 3;
if(isset($_SESSION['rand_id'])){
$key = array_search($_SESSION['rand_id'][0], $_SESSION['rand_id']);
}
 ?>
    </tbody>
  </table>

 <?php 
  $stmt = $db->link->prepare("SELECT * FROM exam_count WHERE exam_no=?");
  $stmt->bind_param("i",$exam_id);
  $singleSQL = $db->select($stmt);
    $i = 0;
    while($row = array_shift($singleSQL)){ $i++; ?>
      <?php  
      Session::set("q_limit",$row['q_limit']);
      Session::set("per_q_limit",$row['per_q_time']);
      Session::set("exam_topic",$row['topic_name']);
       ?>
<?php  } 
  $query = "SELECT start_and_end_exam_time FROM exam_count WHERE exam_no = ?";
  $stmt->bind_param("i",$exam_id);
  $singleSQL = $db->select($stmt);
    $i = 0;
    if($singleSQL){ ?>
    <?php
    while($row = array_shift($singleSQL)){ $i++;  ?>
    <?php 
    $start_and_end = explode(" ",$row['start_and_end_exam_time']);
    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $current_date = $dt->format('m/d/Y, H:i:s');
    $starting_date = $start_and_end[0] .' '.$start_and_end[1];
    $ending_date = $start_and_end[2] .' '.$start_and_end[3];
    $current_date_str =  strtotime($current_date);
    $starting_date_str =  strtotime($starting_date);
    $ending_date_str =  strtotime($ending_date);
    Session::set("end_date", $ending_date_str);
    if($current_date_str>$starting_date_str  && $current_date_str<$ending_date_str){

    $stmt = $db->link->prepare("SELECT * FROM examinees_info WHERE token_id = ?");
    $stmt->bind_param("s",$token_id);
    $singleSQL = $db->select($stmt);
  while($row = array_shift($singleSQL)){ 

    if($row['result']==NULL) { 
 if($num_of_questions_set>=Session::get("q_limit")) { $_SESSION['ready']=0; ?>
<center><h3>Click below when you are ready to start the quiz</h3></center>
<center><button type="button" class="btn btn-success"  onClick="
startQuiz('checkenddate.php')
">Click Here To Begin</button></center><br>
<?php }else{
  echo '<br><br><center><span class="label label-danger">Please tell your teacher to set at least '.Session::get('q_limit').' questions because he has set the limit of '.Session::get('q_limit').' questions</span></center><br>';
  include 'inc/footer.php';
  exit();
  } ?>
<?php }
else{
  $_SESSION['correct'] = $row['result'];
  echo "<br><br><center><span class='label label-danger'>You have already participated in the exam</span></center><br><br>";
}
}
    }else if($current_date_str>$ending_date_str){
      echo "<br><br><center><span class='label label-danger'>Sorry time over</span></center><br>";
      include 'inc/footer.php';
      exit();
    }else{
      echo '<br><br><center><span class="label label-info">Contest will start at '.$starting_date.'</span></center><br>';
    }
}}
  $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
  $current_date = $dt->format('Y/m/d, H:i:s');
  $starting_date = $start_and_end[0] .' '.$start_and_end[1];
  $seconds = strtotime($starting_date) - strtotime($current_date);
  $days    = floor($seconds / 86400);
  $hours   = floor(($seconds - ($days * 86400)) / 3600);
  $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
  $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
?>
<center><p id="demo">Loading...</p></center>
<script type="text/javascript">
  var sec = <?php echo $seconds; ?> 
  var min = <?php echo $minutes; ?> 
  var hour = <?php echo $hours; ?> 
  var day = <?php echo $days; ?> 
function countDown(){
 document.getElementById("demo").innerHTML = day+' Days '+hour+' Hours '+min+' Minutes '+sec+' Seconds remaining';
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
   setTimeout(function(){ location.reload(); }, 2000);
}
}
<?php 

if($current_date_str<$starting_date_str){ ?>
  var inter = setInterval(countDown, 1000);
<?php }else{ ?>
document.getElementById("demo").innerHTML = '<center>Contest is running.Will end at <?php echo $ending_date;?></center>';
<?php }
 ?>
window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#quiz';
        window.location.reload();
    }
}
</script>
<?php include 'inc/footer.php'; ?>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Rules & Regulations</h4>
        </div>
        <div class="modal-body">
          
                    <p>1. You can perticipate in an exam once.</p>
                    <p>2. If you do not give answer to a question within the given time.You will get zero marks for that question.</p>
                    <p>3. Don't try to cheat by changing the url or trying to go back when the exam is running.Your account will get suspension.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
<script type="text/javascript">
    if(window.location.hash) {
        $('#myModal').modal('show');
        
   }
</script>

