<?php
include 'inc/teacher_header.php';
$get_exam_id = Session::get("userId");
 if (isset($_GET['delexam'])) {
          $delexam = $_GET['delexam'];
          $stmt = $db->link->prepare("DELETE from exam_count where id =? AND sir_exam_id=?");
           $stmt->bind_param("ii",$delexam ,$get_exam_id );
           $deldata = $db->delete($stmt);
          if($deldata){
            Session::set("message","Exam deleted successfully !!!");
            Session::set("color","success");
        }else{
          Session::set("message","Exam not deleted !!!");
        }
      }
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $topic =  $fm->validation($_POST['topic']);
  $q_limit =  $fm->validation($_POST['q_limit']);
  $per_question_limit =  $fm->validation($_POST['per_question_limit']);
  $topic =  mysqli_real_escape_string($db->link,$topic);
  $q_limit =  mysqli_real_escape_string($db->link,$q_limit);
  $per_question_limit =  mysqli_real_escape_string($db->link,$per_question_limit);
  if ($topic == "" || $q_limit == ""|| $per_question_limit == "") {
    Session::set("message","Fields must not be empty !!!");
  }elseif($q_limit<=0 || $per_question_limit<=0){
     Session::set("message","Invalid input please try again !!!");
  }
  else{
  $stmt = $db->link->prepare("SELECT * FROM exam_count");
  $singleSQL = $db->select($stmt);
  if($singleSQL){ 
    $i = 0;
    while($row = array_shift($singleSQL)){ 
    $i++;
    $exam_no = $i;

    }
  }
  $exam_no = $exam_no + 1;
  Session::set("exam_number",$exam_no);
  $stmt = $db->link->prepare("INSERT INTO exam_count (topic_name, sir_exam_id, exam_no,q_limit,per_q_time) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("siiii",$topic, $get_exam_id, $exam_no,$q_limit,$per_question_limit);
  $sql = $db->insert($stmt);
   echo "<script>window.location='token_generate.php'</script>";
}
}
?>
<style type="text/css">
.content{
	display:none;
}
</style>
<script>
function showDiv(el1){
	document.getElementById(el1).style.display = 'block';
}
</script>

<div class="container">
  <div class="row">
    <div style="width:700px;margin-left:auto;margin-right:auto;text-align:center;">
        <center><button class='btn btn-success' onClick="showDiv('mc')">Create new exam</button></center>
    </div><br>
<div class="content" id="mc">
    <form action="" name="addMcQuestion" method="post">
       <div class="form-group col-lg-6">
            <label>Please enter the topic of the exam</label>
            <input class="form-control" type="text" name="topic" placeholder="Please enter the topic" />
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-6">
            <label>Please enter the number of questions you want to show to the students</label>
            <input class="form-control" type="number" name="q_limit" placeholder="Question Limit" />
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-6">
            <label>Please enter the per question time limit (in second.)</label>
            <input class="form-control" type="number" name="per_question_limit" placeholder="Per Question Limit"/>
        </div>
        <div class="clearfix"></div>
<div class="form-group col-lg-2">
  <input class="form-control" type="submit" value="Add Topic">
</div>
</form><br><br><br>
 </div>
<div class="">
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
<?php 
    $stmt = $db->link->prepare("SELECT * FROM exam_count WHERE sir_exam_id=?");
    $stmt->bind_param("i",$get_exam_id);
    $singleSQL = $db->select($stmt);
    if($singleSQL){ ?>
    <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Topic</th>
        <th>Edit Name</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $_SESSION['ex_id'] = array();
    $i = 0;
    while($row = array_shift($singleSQL)){ $i++; ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><strong><a href="questionlist.php?id=<?php echo $row['exam_no']; ?>"><?php echo $row['topic_name']; ?><a></strong></td>
        <?php array_push($_SESSION['ex_id'], $row['exam_no']); ?>
      
        <td ><a href="editExamName.php?editexam=<?php echo $row['id']; ?>">Edit</a></td>
        <td ><a onclick="return confirm('Are you sure to delete');" href="?delexam=<?php echo $row['id']; ?>">X</a></td>
      </tr>
      
<?php  } }else{
  echo "<br><center><span class='label label-danger'>You haven't created any exam yet</span></center><br><br>";
}
if(isset($_SESSION['exam_no'])){
  unset($_SESSION['exam_no']);
}
?>
    </tbody>
  </table>
  </div>
  </div>
  </div>
<?php include 'inc/teacher_footer.php'; ?>
<script>
        $("#hide").hide();
</script>