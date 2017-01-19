<?php
include 'inc/teacher_header.php';
$get_id = Session::get("exam_number");
$one = 1;
$zero = 0;
if(isset($_POST['desc'])){
	if(!isset($_POST['iscorrect']) || $_POST['iscorrect'] == ""){
		echo "<center><span class='label label-danger'>Sorry, important data to submit your question is missing. Please press back in your browser and try again and make sure you select a correct answer for the question.</span></center><br>";
		include 'inc/teacher_footer.php';
		exit();
	}
	if(!isset($_POST['type']) || $_POST['type'] == ""){
		echo "<center><span class='label label-danger'>Sorry, there was an error parsing the form. Please press back in your browser and try again</span></center><br>";
		include 'inc/teacher_footer.php';
		exit();
	}
	$question =  $fm->validation($_POST['desc']);
	$answer1 =  $fm->validation($_POST['answer1']);
	$answer2 =  $fm->validation($_POST['answer2']);
	if(!isset($_POST['for_tf'])){
	$answer3 =  $fm->validation($_POST['answer3']);
	$answer4 =  $fm->validation($_POST['answer4']);
	}
	$type =  $fm->validation($_POST['type']);
	$isCorrect =  $fm->validation($_POST['iscorrect']);
	$question =  mysqli_real_escape_string($db->link,$question);
	$answer1 =  mysqli_real_escape_string($db->link,$answer1);
	$answer2 =  mysqli_real_escape_string($db->link,$answer2);
	if(!isset($_POST['for_tf'])){
	$answer3 =  mysqli_real_escape_string($db->link,$answer3);
	$answer4 =  mysqli_real_escape_string($db->link,$answer4);
	}
	$type =  mysqli_real_escape_string($db->link,$type);
	$isCorrect =  mysqli_real_escape_string($db->link,$isCorrect);
	if(isset($_POST['for_tf']) && $isCorrect == ""){
	  $msg = '<center><span class="label label-danger">Fields must not be empty</span></center><br>';
	  echo "<script>window.location='addQuestions.php?msg=$msg'</script>";
	}
	elseif (!isset($_POST['for_tf']) && ($question == "" || $answer1 == ""|| $answer2 == ""|| $answer3 == ""|| $answer4 == ""|| $type == ""|| $isCorrect == "")) {
    $msg = '<center><span class="label label-danger">Fields must not be empty</span></center><br>';
	  echo "<script>window.location='addQuestions.php?msg=$msg'</script>";
	  exit();
  	}else{
	if($type == 'tf'){
	if((!$question) || (!$answer1) || (!$answer2) || (!$isCorrect)){
		echo "<center><span class='label label-danger'>Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.</span></center><br>";
		exit();
		}
	}
	if($type == 'mc'){
	if((!$question) || (!$answer1) || (!$answer2) || (!$answer3) || (!$answer4) || (!$isCorrect)){
		echo "<center><span class='label label-danger'>Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.</span></center><br>";
		exit();
		}
	}
	$stmt = $db->link->prepare("INSERT INTO questions (question, type,exam_no) VALUES (?, ?, ?)");
	$stmt->bind_param("ssi",$question, $type,$get_id);
	$sql = $db->insert($stmt);
	$lastId = $db->link->insert_id;;
	$stmt = $db->link->prepare("UPDATE questions
            SET
            question_id=?
            WHERE id=? LIMIT 1");
	$stmt->bind_param("ii",$lastId,$lastId);
	$updated_row = $db->update($stmt);
	if($type == 'tf'){
		if($isCorrect == "answer1"){

		 $stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		 $stmt->bind_param("iss",$lastId, $answer1, $one);
		 $sql2 = $db->insert($stmt);
    	 $stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		 $stmt->bind_param("iss",$lastId, $answer2, $zero);
		 $db->insert($stmt);
		$msg = 'Thanks, your question has been added';
	  echo "<script>window.location='addQuestions.php?msg=$msg'</script>";
	exit();
	}
	if($isCorrect == "answer2"){
		 $stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		 $stmt->bind_param("iss",$lastId, $answer2, $one);
		 $sql2 = $db->insert($stmt);
		 $stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		 $stmt->bind_param("iss",$lastId, $answer1, $zero);
		 $db->insert($stmt);
		$msg = 'Thanks, your question has been added';
	  echo "<script>window.location='addQuestions.php?msg=$msg'</script>";
	exit();
		}	
	}
	if($type == 'mc'){
		if($isCorrect == "answer1"){

		 $stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		 $stmt->bind_param("iss",$lastId, $answer1, $one);
		 $sql2 = $db->insert($stmt);
		 $stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		 $stmt->bind_param("iss",$lastId, $answer2, $zero);
		 $db->insert($stmt);
  		 $stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		 $stmt->bind_param("iss",$lastId, $answer3, $zero);
		 $db->insert($stmt);
		 $stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		 $stmt->bind_param("iss",$lastId, $answer4, $zero);
		 $db->insert($stmt);
		$msg = 'Thanks, your question has been added';
	  echo "<script>window.location='addQuestions.php?msg=$msg'</script>";
	exit();
	}
	if($isCorrect == "answer2"){
		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer2, $one);
		$sql2 = $db->insert($stmt);

		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer1, $zero);
		$db->insert($stmt);

		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer3, $zero);
		$db->insert($stmt);

		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer4, $zero);
		$db->insert($stmt);
		$msg = 'Thanks, your question has been added';
	  echo "<script>window.location='addQuestions.php?msg=$msg'</script>";
	exit();
	}
	if($isCorrect == "answer3"){
		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer3, $one);
		$sql2 = $db->insert($stmt);

		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer1, $zero);
		$db->insert($stmt);

	    $stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer2, $zero);
		$db->insert($stmt);

		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer4, $zero);
		$db->insert($stmt);
		$msg = 'Thanks, your question has been added';
	  echo "<script>window.location='addQuestions.php?msg=$msg'</script>";
	exit();
	}
	if($isCorrect == "answer4"){
		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer4, $one);
		$sql2 = $db->insert($stmt);

		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer1, $zero);
		$db->insert($stmt);


		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer2, $zero);
		$db->insert($stmt);


		$stmt = $db->link->prepare("INSERT INTO answers (question_id, answer, correct) VALUES (?, ?, ?)");
		$stmt->bind_param("iss",$lastId, $answer3, $zero);
		$db->insert($stmt);
		$msg = 'Thanks, your question has been added';
	  echo "<script>window.location='addQuestions.php?msg=$msg'</script>";
	exit();
		}
	}
}
}
$msg = "";
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
}
if(isset($_POST['reset']) && $_POST['reset'] != ""){
	$reset = preg_replace('/^[a-z]/', "", $_POST['reset']);
	mysqli_query("TRUNCATE TABLE questions")or die(mysql_error());
	mysqli_query("TRUNCATE TABLE answers")or die(mysql_error());
	$stmt = $db->link->prepare("SELECT id FROM questions LIMIT 1");
	$sql1 = $db->select($stmt);
    $stmt = $db->link->prepare("SELECT id FROM answers LIMIT 1");
	$sql2 = $db->select($stmt);
	if($sql1){ 
	$i = 0;
		while($row = array_shift($sql1)){ 
		$i++;
		$numQuestions = $i;

		}
	}
	if($sql2){ 
			$i = 0;
		while($row = array_shift($sql2)){ 
		$i++;
		$numAnswers = $i;

		}
	}
	if($numQuestions > 0 || $numAnswers > 0){
		echo "Sorry, there was a problem reseting the quiz. Please try again later.";
		exit();
	}else{
		echo "Thanks! The quiz has now been reset back to 0 questions.";
		exit();
	}
}
?>

<script>
function showDiv(el1,el2){
	document.getElementById(el1).style.display = 'block';
	document.getElementById(el2).style.display = 'none';
}
</script>
<script>
function resetQuiz(){
	var x = new XMLHttpRequest();
			var url = "addQuestions.php";
			var vars = 'reset=yes';
			x.open("POST", url, true);
			x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			x.onreadystatechange = function() {
		if(x.readyState == 4 && x.status == 200) {
			document.getElementById("resetBtn").innerHTML = x.responseText;
			
	}
}
x.send(vars);
document.getElementById("resetBtn").innerHTML = "processing...";
	
}
</script>
<style type="text/css">
.content{
	margin-top:48px;
	margin-left:auto;
	margin-right:auto;
	width:780px;
	border:#333 1px solid;
	border-radius:12px;
	-moz-border-radius:12px;
	padding:12px;
	display:none;
}
</style>


<body>
   <div style="width:700px;margin-left:auto;margin-right:auto;text-align:center;">
   <p style="color:#06F;"><?php echo $msg; ?></p>
	<h2>What type of question would you like to create?</h2>
    <button class='btn btn-success' onClick="showDiv('tf', 'mc')">True/False</button>&nbsp;&nbsp;<button class='btn btn-success' onClick="showDiv('mc', 'tf')">Multiple Choice</button>&nbsp;&nbsp;
    
   </div>
  <div class="content" id="tf">
  	<h3>True or false</h3>

    	<form action="addQuestions.php" name="addQuestion" method="post">
    <strong>Please type your new question here</strong>
    	<br />
    		<textarea id="tfDesc" name="desc" style="width:400px;height:95px;"></textarea>
    	  <br />
    	<br />
    	<strong>Please select whether true or false is the correct answer</strong>
    	<br />
            <input type="text" id="answer1" name="answer1" value="True" readonly>&nbsp;
              <label style="cursor:pointer; color:#06F;">
            <input type="radio" name="iscorrect" value="answer1">Correct Answer?</label>
    	  <br />
   		<br />
            <input type="text" id="answer2" name="answer2" value="False" readonly>&nbsp;
              <label style="cursor:pointer; color:#06F;">
              <input type="radio" name="iscorrect" value="answer2">Correct Answer?
            </label>
    	  <br />
    	<br />
    	<input type="hidden" value="tf" name="for_tf">
    	<input type="hidden" value="tf" name="type">
    	<input class='btn btn-success' type="submit" value="Add To Quiz">
    </form>
    
 </div><br>
 <div class="content" id="mc">
  	<h3>Multiple Choice</h3>
    <form action="addQuestions.php" name="addMcQuestion" method="post">
    <strong>Please type your new question here</strong>
        <br />
        <textarea id="mcdesc" name="desc" style="width:400px;height:95px;"></textarea>
        <br />
      <br />
    <strong>Please create the first answer for the question</strong>
    	<br />
        <input type="text" id="mcanswer1" name="answer1">&nbsp;
          <label style="cursor:pointer; color:#06F;">
          <input type="radio" name="iscorrect" value="answer1">Correct Answer?
        </label>
      <br />
    <br />
    <strong>Please create the second answer for the question</strong>
    <br />
        <input type="text" id="mcanswer2" name="answer2">&nbsp;
          <label style="cursor:pointer; color:#06F;">
          <input type="radio" name="iscorrect" value="answer2">Correct Answer?
        </label>
      <br />
    <br />
    <strong>Please create the third answer for the question</strong>
    <br />
        <input type="text" id="mcanswer3" name="answer3">&nbsp;
          <label style="cursor:pointer; color:#06F;">
          <input type="radio" name="iscorrect" value="answer3">Correct Answer?
        </label>
      <br />
    <br />
    <strong>Please create the fourth answer for the question</strong>
    <br />
        <input type="text" id="mcanswer4" name="answer4">&nbsp;
          <label style="cursor:pointer; color:#06F;">
          <input type="radio" name="iscorrect" value="answer4">Correct Answer?
        </label>
      <br />
    <br />
    <input type="hidden" value="mc" name="type">
    <input class='btn btn-success' type="submit" value="Add To Quiz">

    </form>
 </div><br>

<?php include 'inc/teacher_footer.php'; ?>
