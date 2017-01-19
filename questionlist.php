<?php
 if(!isset($_GET['id']) && !isset($_GET['delques']) && !isset($_GET['action'])){
        echo "<script>window.location='404.php'</script>";
    exit();
  }
include 'inc/teacher_header.php';
  if(isset($_GET['id'])){
  $id = preg_replace('/[^0-9]/', "", $_GET['id']);
  Session::set("exam_number",$id);
  if(!in_array($id, $_SESSION['ex_id'])){
    echo "<script>window.location='404.php'</script>";
  }
} 
 $exam_number=Session::get("exam_number");
        if (isset($_GET['delques'])) {
          $delques = $_GET['delques'];
           $stmt = $db->link->prepare("DELETE from questions where id =? AND exam_no=?");
           $stmt->bind_param("ii",$delques ,$exam_number );
           $deldata = $db->delete($stmt);
          if($deldata){
            $exm_id=Session::get("exam_number");   
            $encoded = urlencode('Question deleted successfully');
            echo "<script>window.location='questionlist.php?id=$exm_id&msg=$encoded'</script>";           
                }   else {
                    echo "<span class='error'>Question Not Deleted !!.</span>";
                }
        }
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
  $stmt = $db->link->prepare("SELECT * FROM exam_count WHERE exam_no=?");
  $stmt->bind_param("i",$id);
  $singleSQL = $db->select($stmt);
    if($singleSQL){ 
      while($row = array_shift($singleSQL)){ 
       $question_limit = $row['q_limit'];
      } } ?>
<div class="container">
<?php 
    
  $stmt = $db->link->prepare("SELECT * FROM questions WHERE exam_no=?");
  $stmt->bind_param("i",$id);
  $singleSQL = $db->select($stmt);
    if($singleSQL){ ?>
    <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Question</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
   <?php $i = 0; 
    while($row = array_shift($singleSQL)){ $i++; ?>
    <?php  Session::set("exam_no",$row['exam_no']); ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['question']; ?></td>
        <td ><a href="editQuestions.php?editques=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>">Edit</a></td>
        <td ><a onclick="return confirm('Are you sure to delete');" href="?delques=<?php echo $row['id']; ?>">X</a></td>
      </tr>   
<?php  }  ?>
 </tbody>
  </table><br>
<div style="width:700px;margin-left:auto;margin-right:auto;text-align:center;">
    <h2><a href="addQuestions.php">Add More questions</a></h2>
</div>
<?php
 }else{
  echo "<br><center><span class='label label-danger'>No question has been set yet</span></center><br>"; ?>
  <div style="width:700px;margin-left:auto;margin-right:auto;text-align:center;">
    <h2><a href="addQuestions.php">Add questions</a></h2>
</div>
<?php  } ?>
  <div style="width:700px;margin-left:auto;margin-right:auto;text-align:center;">
    <h2><a href="token_generate.php">Assign number of students for this exam</a></h2>
  </div>
  <div style="width:700px;margin-left:auto;margin-right:auto;text-align:center;">
    <h2><a href="num_of_questions.php">Set the number of questions you want to show to the students</a></h2>
  </div>

  <div style="width:700px;margin-left:auto;margin-right:auto;text-align:center;">
    <h2><a href="per_q_limit.php">Set the time limit for each question</a></h2>
  </div>

  <div style="width:700px;margin-left:auto;margin-right:auto;text-align:center;">
    <h2><a href="time_limit.php">Set the end time and start time for the exam</a></h2><br>
</div>
<?php 
if($question_limit){
  echo '<center><span class="label label-info">Please set at least '.($question_limit).' questions because you have set the limit of '.$question_limit.' questions</span></center><br>';
}
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
 document.getElementById("demo").innerHTML ='<center>'+day+' Days '+hour+' Hours '+min+' Minutes '+sec+' Seconds remaining to start the exam<strong><a href="time_limit.php"> Change it here</a></strong></center>';

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
   document.getElementById("demo").innerHTML = '<center>Student can now paticipate or you can <strong><a href="time_limit.php">Set the start time and end time for the exam</a></strong></center>';
}

}
var inter = setInterval(countDown, 1000);
</script>
</div>
<?php include 'inc/teacher_footer.php'; ?>