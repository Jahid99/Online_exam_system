<?php
include 'inc/teacher_header.php';
$exam_number = Session::get("exam_number");
$one = 1;
$zero = 0;
?>
<?php
if(isset($_POST['for_tf'])){
	$answer1 =  $fm->validation($_POST['answer1']);
	$answer2 =  $fm->validation($_POST['answer2']);
	$question =  $fm->validation($_POST['question']);
	$isCorrect =  $fm->validation($_POST['iscorrect']);
	$id =  $fm->validation($_POST['id']);
	$answer1 =  mysqli_real_escape_string($db->link,$answer1);
	$answer2 =  mysqli_real_escape_string($db->link,$answer2);
	$question =  mysqli_real_escape_string($db->link,$question);
	$isCorrect =  mysqli_real_escape_string($db->link,$isCorrect);
	$id =  mysqli_real_escape_string($db->link,$id);
	$stmt = $db->link->prepare("UPDATE questions
                SET
                question=?
                WHERE id=? LIMIT 1");
	$stmt->bind_param("si",$question,$id);
	$updated_row = $db->update($stmt);
	$stmt = $db->link->prepare("SELECT * FROM answers WHERE question_id=?");
    $stmt->bind_param("i",$id);
    $singleSQL = $db->select($stmt);
    if($singleSQL){ 
    	while($row = array_shift($singleSQL)){ 
		$row_id = $row['id'];
		break;
		}
	}
	if($isCorrect == "answer1"){
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer1,$one,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");

		$stmt->bind_param("ssi",$answer2,$zero,$row_id);
		$updated_row = $db->update($stmt);
		Session::set("message","Question updated successfully !!!");
		Session::set("color","success");
		echo "<script>window.location='questionlist.php?id=$exam_number'</script>";
		exit();
	}
	if($isCorrect == "answer2"){
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer2,$one,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer1,$zero,$row_id);
		$updated_row = $db->update($stmt);
		Session::set("message","Question updated successfully !!!");
		Session::set("color","success");
		echo "<script>window.location='questionlist.php?id=$exam_number'</script>";
		exit();
		}
}
if(isset($_POST['for_mc'])){
	$answer1 =  $fm->validation($_POST['answer1']);
	$answer2 =  $fm->validation($_POST['answer2']);
	$answer3 =  $fm->validation($_POST['answer3']);
	$answer4 =  $fm->validation($_POST['answer4']);
	$question =  $fm->validation($_POST['question']);
	$isCorrect =  $fm->validation($_POST['iscorrect']);
	$id =  $fm->validation($_POST['id']);
	$answer1 =  mysqli_real_escape_string($db->link,$answer1);
	$answer2 =  mysqli_real_escape_string($db->link,$answer2);
	$answer3 =  mysqli_real_escape_string($db->link,$answer3);
	$answer4 =  mysqli_real_escape_string($db->link,$answer4);
	$question =  mysqli_real_escape_string($db->link,$question);
	$isCorrect =  mysqli_real_escape_string($db->link,$isCorrect);
	$id =  mysqli_real_escape_string($db->link,$id);
	$stmt = $db->link->prepare("UPDATE questions
                SET
                question=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("si",$question,$id);
		$updated_row = $db->update($stmt);


	$stmt = $db->link->prepare("SELECT * FROM answers WHERE question_id=?");
  	$stmt->bind_param("i",$id);
  	$singleSQL = $db->select($stmt);
  if($singleSQL){ 
	while($row = array_shift($singleSQL)){ 
		$row_id = $row['id'];
		break;
		}
	}
if($isCorrect == "answer1"){
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");

		$stmt->bind_param("ssi",$answer1,$one,$row_id);
		$updated_row = $db->update($stmt);

		$row_id++;

		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");

		$stmt->bind_param("ssi",$answer2,$zero,$row_id);
		$updated_row = $db->update($stmt);

		$row_id++;

		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");

		$stmt->bind_param("ssi",$answer3,$zero,$row_id);
		$updated_row = $db->update($stmt);

		$row_id++;

		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");

		$stmt->bind_param("ssi",$answer4,$zero,$row_id);
		$updated_row = $db->update($stmt);


		Session::set("message","Question updated successfully !!!");
		Session::set("color","success");
		echo "<script>window.location='questionlist.php?id=$exam_number'</script>";
		exit();
}

if($isCorrect == "answer2"){
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer2,$one,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");

		$stmt->bind_param("ssi",$answer1,$zero,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");

		$stmt->bind_param("ssi",$answer3,$zero,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer4,$zero,$row_id);
		$updated_row = $db->update($stmt);
		Session::set("message","Question updated successfully !!!");
		Session::set("color","success");
		echo "<script>window.location='questionlist.php?id=$exam_number'</script>";
		exit();
}

if($isCorrect == "answer3"){
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer3,$one,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer1,$zero,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer2,$zero,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer4,$zero,$row_id);
		$updated_row = $db->update($stmt);
		Session::set("message","Question updated successfully !!!");
		Session::set("color","success");
		echo "<script>window.location='questionlist.php?id=$exam_number'</script>";
		exit();
}

if($isCorrect == "answer4"){
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer4,$one,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer1,$zero,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer2,$zero,$row_id);
		$updated_row = $db->update($stmt);
		$row_id++;
		$stmt = $db->link->prepare("UPDATE answers
                SET
                answer=?,correct=?
                WHERE id=? LIMIT 1");
		$stmt->bind_param("ssi",$answer3,$zero,$row_id);
		$updated_row = $db->update($stmt);
		Session::set("message","Question updated successfully !!!");
		Session::set("color","success");
		echo "<script>window.location='questionlist.php?id=$exam_number'</script>";
		exit();
}
}
if(isset($_GET['editques']) && isset($_GET['type']) && $_GET['type']=='tf'){
$id =  $_GET['editques'];
	 $type='tf';
	  $stmt = $db->link->prepare("SELECT * FROM questions WHERE question_id=? AND type=? AND exam_no=?");
	  $stmt->bind_param("isi",$id,$type,$exam_number);
	  $singleSQL = $db->select($stmt);
	  if(!$singleSQL){
	  
   echo "<script>window.location='404.php'</script>";

    	exit();
	  }

 $stmt = $db->link->prepare("SELECT * FROM questions WHERE question_id=?");
  $stmt->bind_param("i",$id);
  $singleSQL = $db->select($stmt);
    if($singleSQL){ 
while($row = array_shift($singleSQL)){  ?>
	<div class="container">
	<div class="box">
	<form action="editQuestions.php" name="addQuestion" method="post">
    <strong>Edit your question here</strong>
    	<br />
    		<textarea id="tfDesc" name="question" style="width:400px;height:95px;"><?php echo $row['question']?></textarea>
    	  <br />
    	<br />
    	<strong>Please select whether true or false is the correct answer</strong>
    	<?php
    	$stmt = $db->link->prepare("SELECT * FROM answers WHERE question_id=?");
  $stmt->bind_param("i",$id);
  $singleSQL = $db->select($stmt);
  $i = 0;
    if($singleSQL){ 
while($row = array_shift($singleSQL)){ $i++; ?>

    	<br />
            <input type="text" id="answer1" name="answer<?php echo $i;?>" value="<?php echo $row['answer']; ?>" readonly>&nbsp;
              <label style="cursor:pointer; color:#06F;">
            <input type="radio" name="iscorrect" value="answer<?php echo $i;?>" <?php

             if($row['correct'] == 1){
             	echo 'checked="checked"';
             }

             ?>>Correct Answer?</label>
    	  <br />
  <?php } } } } ?>
<br />
    	<input type="hidden" value="tf" name="for_tf">
    	<input type="hidden" value="<?php echo $id; ?>" name="id">
    	<input class='btn btn-success' type="submit" value="Update">
    </form><br>
</div>
</div>
<?php }
elseif(isset($_GET['editques']) && isset($_GET['type']) && $_GET['type']=='mc'){
$id =  $_GET['editques'];
$type='mc';
	  $stmt = $db->link->prepare("SELECT * FROM questions WHERE question_id=? AND type=? AND exam_no=?");
	  $stmt->bind_param("isi",$id,$type,$exam_number);
	  $singleSQL = $db->select($stmt);
	  if(!$singleSQL){
   echo "<script>window.location='404.php'</script>";
    	exit();
	  }
 $stmt = $db->link->prepare("SELECT * FROM questions WHERE question_id=?");
  $stmt->bind_param("i",$id);
  $singleSQL = $db->select($stmt);
    if($singleSQL){ 
while($row = array_shift($singleSQL)){  ?>
<div class="container">
	<div class="box">
<form action="editQuestions.php" name="addMcQuestion" method="post">
    <strong>Please edit question here</strong>
        <br />
        <textarea id="mcdesc" name="question" style="width:400px;height:95px;"><?php echo $row['question']?></textarea>
        <br />
      <br />
      <?php
    	$stmt = $db->link->prepare("SELECT * FROM answers WHERE question_id=?");
  $stmt->bind_param("i",$id);
  $singleSQL = $db->select($stmt);
  $i = 0;
    if($singleSQL){ 
while($row = array_shift($singleSQL)){ $i++; ?>
    <strong>Edit the <?php if($i==1){echo 'first';}elseif($i==2){echo 'second';}elseif($i==3){echo 'third';}else{echo 'fourth';}?> answer for the question</strong>
    	<br />
        <input type="text" id="mcanswer<?php echo $i;?>" name="answer<?php echo $i;?>" value="<?php echo $row['answer']; ?>">&nbsp;
          <label style="cursor:pointer; color:#06F;">
          <input type="radio" name="iscorrect" value="answer<?php echo $i;?>"
          <?php

             if($row['correct'] == 1){
             	echo 'checked="checked"';
             }
             ?>
          >Correct Answer?
        </label>
      <br />
    <br />
   <?php } } ?>
    <input type="hidden" value="mc" name="type">
    <input type="hidden" value="tf" name="for_mc">
    <input type="hidden" value="<?php echo $id; ?>" name="id">
    <input class='btn btn-success' type="submit" value="Add To Quiz">
    </form><br>
</div>
</div>
<?php } } }
?>
<?php include 'inc/teacher_footer.php'; ?>