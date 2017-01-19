<?php 
ob_start();
	/**
	* Sesstion Class
	*/
	class Session
	{
		public static function init(){
			session_start();
		}	
		public static function set($key,$val){
			$_SESSION[$key] = $val;
		}	
		public static function get($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key];
			
		}else{
			return false;
		}		
	}

	public static function checkSession(){
		self::init();
		if(self::get("login") == false){
			self::destroy();
   echo "<script>window.location='teacher_login.php'</script>";

		}
	}

	public static function checkStudentSession(){
		self::init();
		if(self::get("stdlogin") == false){
			self::destroy();
   echo "<script>window.location='student_login.php'</script>";


		}
	}

	public static function checkLogin(){
		self::init();
		if(self::get("login") == true){
			
   echo "<script>window.location='create_exam.php'</script>";

		}
	}

	public static function checkStudentLogin(){
		self::init();
		if(self::get("stdlogin") == true){
   echo "<script>window.location='start.php'</script>";

		}
	}

	public static function destroy(){
		session_destroy();
		//header("location:login.php");
	}

	public static function unset_it($key){
		unset($_SESSION[$key]);
		//header("location:login.php");
	}

}
ob_end_clean();
 ?>