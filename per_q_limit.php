<?php
include 'inc/teacher_header.php';
$exam_number=Session::get("exam_number");

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $per_question_limit =  $fm->validation($_POST['per_question_limit']);
    $per_question_limit =  mysqli_real_escape_string($db->link,$per_question_limit);

    if ($per_question_limit == "") {
         Session::set("message","Fields must not be empty !!!");
    }elseif($per_question_limit<=0){
      Session::set("message","Invalid input please try again !!!");
    }
   else{
    $stmt = $db->link->prepare("UPDATE exam_count 
        SET per_q_time = ?
        WHERE exam_no=?");

    $stmt->bind_param("ii",$per_question_limit,$exam_number);
    $db->update($stmt);
        Session::set("message","Per question time limit updated successfully !!!");
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
                                <label>Please enter the per question time limit (in second.)</label>

           <?php

          $stmt = $db->link->prepare("SELECT per_q_time FROM exam_count WHERE exam_no = ?");
          $stmt->bind_param("i",$exam_number);
          $singleSQL = $db->select($stmt);      
            $i = 0;
            if($singleSQL){ ?>
             <?php
                while($row = array_shift($singleSQL)){ $i++;
          ?>
                                <input class="form-control" type="number" name="per_question_limit" value="<?php echo $row['per_q_time']; ?>"/>
                            </div>
                            <div class="clearfix"></div>
    <?php } } ?>
    <div class="form-group col-lg-2">
    <input class="form-control" type="submit" value="Submit">
    </div><br><br><br>
  </form>
<?php include 'inc/teacher_footer.php'; ?>