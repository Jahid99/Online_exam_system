<?php
Class Database{
	public $host   = DB_HOST;
	public $user   = DB_USER;
	public $pass   = DB_PASS;
	public $dbname = DB_NAME;
	
	public $link;
	public $error;
	
	public function __construct(){
		$this->connectDB();
	}

	private function connectDB(){
	$this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
	if(!$this->link){
		$this->error ="Connection fail".$this->link->connect_error;
		return false;
	}
 }
 public function select($Statement){
$Statement->execute();
$RESULT = array();
    $Statement->store_result();
    for ( $i = 0; $i < $Statement->num_rows; $i++ ) {
        $Metadata = $Statement->result_metadata();
        $PARAMS = array();
        while ( $Field = $Metadata->fetch_field() ) {
            $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
        }
        call_user_func_array( array( $Statement, 'bind_result' ), $PARAMS );
        $Statement->fetch();
    }
    return $RESULT;
 }
public function insert($stmt){
	$stmt->execute();
	
	if($stmt->errno){
		return false;
	} else {
		return true;
	}
	$stmt->close();
  }

public function update($stmt){
	$stmt->execute();
	if($stmt->errno){
		return false;
	} else {
		return true;
	}
	$stmt->close();
  }
  
  public function delete($stmt){
	
	$stmt->execute();
	if (mysqli_affected_rows($this->link) > 0) {
		return true;
	}else{
		return false;
	}
	$stmt->close();
  }

  }

