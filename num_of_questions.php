<?php
include 'inc/teacher_header.php';
$exam_number=Session::get("exam_number");

if ($_SERVER['REQUEST_METHOD']=='POST') {
     $q_limit =  $fm->validation($_POST['q_limit']);
     $q_limit =  mysqli_real_escape_string($db->link,$q_limit);
	if ($q_limit == "") {
         Session::set("message","Fields must not be empty !!!");
  }elseif($q_limit<=0){
    Session::set("message","Invalid input please try again !!!");
  }
  else{
    $stmt = $db->link->prepare("UPDATE exam_count 
        SET q_limit = ?
        WHERE exam_no=?");

    $stmt->bind_param("ii",$q_limit,$exam_number);
    $db->update($stmt);
        Session::set("message","Number of questions to show to the students updated successfully !!!");
        Session::set("color","success");
        echo "<script>window.location='questionlist.php?id=$exam_number'</script>";  
        exit();
    }
}
if(Session::get("message")){ ?>
  <center><span class="label label-danger"><?php echo Session::get("message"); ?></span></center><br>
 <?php Session::unset_it("message");
}
?>
<form action="" name="addMcQuestion" method="post">
  <div class="form-group col-lg-6">
      <label>Please enter the number of questions you want to show to the students</label>
      <?php
      $stmt = $db->link->prepare("SELECT q_limit FROM exam_count WHERE exam_no = ?");            
      $stmt->bind_param("i",$exam_number);
      $singleSQL = $db->select($stmt);
      $i = 0;
      if($singleSQL){ ?>
      <?php
        while($row = array_shift($singleSQL)){ $i++;  ?>
          <input class="form-control" type="number" name="q_limit" value="<?php echo $row['q_limit']; ?>"/>
          </div>
          <div class="clearfix"></div>
      <?php } } ?>
    <div class="form-group col-lg-2">
    <input class="form-control" type="submit" value="Submit">
  </div><br><br><br>
</form>
<?php include 'inc/teacher_footer.php'; ?>