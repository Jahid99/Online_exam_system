<?php
include 'inc/header.php'; ?>
<div class="container">
<?php
if(isset($_SESSION['correct'])){
$correct = $_SESSION['correct'];
$token_id = Session::get("token_id");
$one = 1;
$one = 1;
$stmt = $db->link->prepare("UPDATE examinees_info 
      SET result = ?
      WHERE token_id = ?");

    $stmt->bind_param("is",$correct,$token_id);
    $updated_row = $db->update($stmt);
    $stmt = $db->link->prepare("SELECT * FROM examinees_info WHERE token_id = ?");
    $stmt->bind_param("s",$token_id);
    $singleSQL = $db->select($stmt);
     while($row = array_shift($singleSQL)){  
      $exam_number = $row['exam_id'];
      if($row['published'] == 1) { ?>
<table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Username</th>
   
        <th>Marks (<?php echo $_SESSION['q_limit']; ?>)</th>
    
      </tr>
    </thead>
    <tbody>
    <?php 
    $stmt = $db->link->prepare("SELECT * FROM examinees_info WHERE exam_id=?");
    
    $stmt->bind_param("i",$exam_number);
    $singleSQL = $db->select($stmt);
    $i = 0;
    while($row = array_shift($singleSQL)){ $i++; ?>
      <tr>

        <td><?php echo  $i; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['result']; ?></td>       
            
      </tr>
      
<?php  } ?>
</tbody>
  </table>

<center><span class="label label-info">Answer of the Questions</span></center><br>

<table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Question</th>
        <th>Answer</th>
    
      </tr>
    </thead>
    <tbody>
<?php 
$stmt = $db->link->prepare("SELECT * FROM questions WHERE exam_no=?");
  $stmt->bind_param("i",$exam_number);
  $singleSQL = $db->select($stmt);
  $i = 0;
  while($row = array_shift($singleSQL)){
    $i++;
    $question_id = $row['question_id'];
    $stmt = $db->link->prepare("SELECT * FROM answers WHERE question_id=? AND correct=?");   
    $stmt->bind_param("is",$question_id,$one);
    $sql2 = $db->select($stmt);
   while($row2 = array_shift($sql2)){ ?>
    <tr>
        <td><?php echo  $i; ?></td>
        <td><?php echo $row['question']; ?></td>
        <td><?php echo $row2['answer']; ?></td>   
      </tr>
 <?php }
  }
 ?>
 </tbody>
  </table>
     <?php  }else{ ?>
      <strong><h1>Thanks for participating!!!</h1></strong>
      <p>Result will be published on this page. We are waiting for your teacher's approval.</p>
   <?php  }

}
unset($_SESSION['check_for_suspension']); }else{
  echo "<center><span class='label label-danger'>You haven't participated in the exam yet !!!</span></center><br>";
  }?>
</div>
<?php
include 'inc/footer.php';
?>