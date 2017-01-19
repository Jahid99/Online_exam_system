<?php
include 'inc/teacher_header.php';
$get_exam_id = Session::get("userId");
      if (isset($_GET['editexam'])) {
          $editexam = $_GET['editexam'];
      }
      if ($_SERVER['REQUEST_METHOD']=='POST') {
        $topic_name =  $fm->validation($_POST['topic_name']);
        $topic_name =  mysqli_real_escape_string($db->link,$topic_name);
      if ($topic_name == "") {
           Session::set("message","Fields must not be empty !!!");
      }else{
      $stmt = $db->link->prepare("UPDATE exam_count 
          SET topic_name = ?
          WHERE sir_exam_id=?");
      $stmt->bind_param("si",$topic_name,$get_exam_id);
      $db->update($stmt);
      unset($_SESSION['topic_name']);
         Session::set("message","Exam name updated succesfully!!!");
         Session::set("color","success");
         echo "<script>window.location='create_exam.php'</script>";
          exit();
      }
  }
?>

<form action="" name="addMcQuestion" method="post">
<div class="form-group col-lg-6">                           
<?php
  $stmt = $db->link->prepare("SELECT topic_name FROM exam_count WHERE id = ?  AND sir_exam_id=?");
  $stmt->bind_param("ii",$editexam,$get_exam_id);
  $singleSQL = $db->select($stmt);                      
  $i = 0;
  if($singleSQL){ ?>
  <label>Please enter the exam name</label>
   <?php
  while($row = array_shift($singleSQL)){ $i++;  ?>

  <input class="form-control" type="text" name="topic_name" value="<?php echo $row['topic_name']; ?>"/>
  </div>
  <div class="clearfix"></div>
  <div class="form-group col-lg-2">
  <input class="form-control" type="submit" value="Submit">
  <?php } } ?>  
  </div><br><br><br>
   </form>
<?php include 'inc/teacher_footer.php'; ?>
<script>
$(document).ready(function(){
   
        $("#hide").hide();
  
});
</script>