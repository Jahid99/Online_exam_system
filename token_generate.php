<?php 
include 'inc/teacher_header.php';
$check = 0;
$one = 1;
$exam_number = Session::get("exam_number");
?>
<?php 
if (!isset($_POST['publish']) && $_SERVER['REQUEST_METHOD']=='POST') {
    $number_of_students =  $fm->validation($_POST['number_of_students']);
    $number_of_students =  mysqli_real_escape_string($db->link,$number_of_students);
    if ($number_of_students == "") {
    Session::set("message","Fields must not be empty !!!");
    }elseif($number_of_students>=200){
      Session::set("message","You can not add more than 200 students !!!");
    }elseif($number_of_students<=0){
      Session::set("message","Invalid number of students !!!");
    }
  else{
   $stmt = $db->link->prepare("DELETE FROM examinees_info WHERE exam_id=?");
   $stmt->bind_param("i",$exam_number);
   $db->delete($stmt);
    for($i=1;$i<=$number_of_students;$i++){
    $j = mt_rand(12152, 925512215);
    $j = (string) $j;
    $k = substr(md5(time()), 0, 10);
    $e = $j.''.$k;
    $stmt = $db->link->prepare("INSERT INTO examinees_info (token_id, exam_id) VALUES (?, ?)");
    $stmt->bind_param("si",$e, $exam_number);
    $db->insert($stmt);
}
}
}
if(isset($_POST['publish']) && $_POST['publish'] != ""){
    $stmt = $db->link->prepare("UPDATE examinees_info 
        SET published = ?
        WHERE exam_id=?");
        $stmt->bind_param("ii",$one,$exam_number);
        $db->update($stmt);
}
 ?>
<div class="container">
<?php 
if(Session::get("message")){ ?>
  <center><span class="label label-danger"><?php echo Session::get("message"); ?></span></center><br>
 <?php Session::unset_it("message");
}
?>
 <form class="col-sm-offset-3" action="token_generate.php" name="addMcQuestion" method="post" >
        <div class="form-group col-lg-6">
                                <label>Please enter the number of participants</label>
        <input class="form-control" type="number" name="number_of_students" placeholder="Number of participants"/>
        </div>
        <div class="clearfix"></div>

        <input type="hidden" value="mc" name="type">
        <div class="form-group col-lg-2">
        <input class="form-control" class="form-control" type="submit" value="Submit">
        </div>
</form><br><br>
<div class="col-sm-offset-1">
    <?php        
      $stmt = $db->link->prepare("SELECT * FROM examinees_info WHERE exam_id=?");
      $stmt->bind_param("i",$exam_number);
      $singleSQL = $db->select($stmt);
    $i = 0;
      if($singleSQL){ ?>
  <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Name</th>
          <th>Username</th>
          <th>Token ID</th>
          <th>Marks</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>

      <?php
      while($row = array_shift($singleSQL)){ $i++; ?>
      <?php
      if($row['published']){
        Session::set("publish",1);
      }

?>
      <tr>
        <td><?php echo  $i; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['token_id']; ?></td>
        <td><?php echo $row['result']; ?></td>
        <td><?php
         if($row['used'] == 0){
            echo "Not yet registered";
         }else{
            echo "Registered";
         }
         ; ?></td> 
      </tr>   
<?php  }  }else{
    echo "<span class='label label-danger'>Please assign students</span><br><br>";
    $check = 1;
    }?>
</tbody>
  </table>
</div>
</div>
<?php
if($check!=1){ ?>
 <form action="token_generate.php" method="post">        
    <input type="hidden" value="mc" name="publish">
    <div class="form-group col-lg-6 col-lg-offset-3">
    <?php if(isset($_SESSION['publish']) && ($_SESSION['publish']) == 1) { ?>
    <?php if(isset($_SESSION['publish'])){
        unset($_SESSION['publish']);
      }
      ; ?>
    <input class="form-control" type="submit" value="Result Published">
    <?php }else{ ?>
      <input class="form-control" type="submit" value="Publish Result">      
     <?php  } ?>
    </div>
    <div class="clearfix"></div>
    </form><br>
<center><a href="questionlist.php?id=<?php echo $exam_number; ?>"><button type="button" class="btn btn-success">Click Here to add questions/set other options to this exam</button></a></center><br>
<br>
</div>
</div>
<?php } ?>
<?php include 'inc/teacher_footer.php'; ?>