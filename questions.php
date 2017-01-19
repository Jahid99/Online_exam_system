<?php 
include 'inc/config.php';
include 'inc/Database.php';
		$db = new Database();		
session_start();
$arrCount = "";
if(isset($_GET['question'])){
	$question = preg_replace('/[^0-9]/', "", $_GET['question']);
	$output = "";
	$answers = "";
	$q = "";
	$stmt = $db->link->prepare("SELECT id FROM questions");
  	$sql = $db->select($stmt);

  if($sql){ 
		$i = 0;
	while($row = array_shift($sql)){ 
	$i++;
	$numQuestions = $i;

	}
}
	if(!isset($_SESSION['answer_array']) || $_SESSION['answer_array'] < 1){
		$currQuestion = "1";
	}else{
		$arrCount = count($_SESSION['answer_array']);

	}

	if($arrCount == $_SESSION['q_limit']){ //Number of questions i want...
		
		echo 'finished|<p>Result will be published . We are waiting for your teacher\'s approval!!!</p>'; //Statement under dont
		exit();																							//work..used javascript window.location
																										//that will go to new page
	}
	if($arrCount >= $numQuestions){
		unset($_SESSION['answer_array']);
        echo "<script>window.location='index.php'</script>";
		
		exit();
	}

	$stmt = $db->link->prepare("SELECT * FROM questions WHERE id=?"); 
	$stmt->bind_param("i",$question);
	$singleSQL = $db->select($stmt);
		while($row = array_shift($singleSQL)){
			$id = $row['id'];
			$thisQuestion = $row['question'];
			$type = $row['type'];
			$question_id = $row['question_id'];
			$q = '<h2>'.$thisQuestion.'</h2>';
			$stmt = $db->link->prepare("SELECT * FROM answers WHERE question_id=? ORDER BY rand()");
			  $stmt->bind_param("i",$question);
			  $sql2 = $db->select($stmt);

			while($row2 = array_shift($sql2)){
				$answer = $row2['answer'];
				
				$correct = $row2['correct'];
				$answers .= '<label style="cursor:pointer;"><input type="radio" name="rads" value="'.$correct.'">'.$answer.'</label> 
				<input type="hidden" id="qid" value="'.$id.'" name="qid"><br /><br />
				';
			}
			$output = ''.$q.','.$answers.',<span id="btnSpan"><button  class="btn btn-success" onclick="post_answer()">Submit</button></span>';
			echo $output;
		   }
		}
?>