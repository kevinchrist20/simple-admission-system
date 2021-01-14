<?php
	date_default_timezone_set('UTC');
	
	$server = "local";
	$link = "";
	$base = "";

	if ($server == "remote") {
		define("DBNAME", "");
		define("HOST", "");
		define("USER", "");
		define("PASSWORD", "");
	} else {
		define("DBNAME", "gtuc_db");
		define("HOST", "localhost");
		define("USER", "root");
		define("PASSWORD", "");
	}

    $conn = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
	$GLOBALS['CONNECTION'] = $conn;
	
	if (mysqli_connect_errno()) {
		die("Connection failed: Try again later");
		exit();
	}

    $exp_date = date('d M, Y');
    $normal_date = date("d-m-Y_H-i-s");
    $script = $_SERVER['SCRIPT_NAME'];
	$script = explode("/", $script);
	$script = $script[count($script) - 1];
	$file_size = 20 * 1024 * 1024;


	function sterilize($data, $strip = false) {
		global $conn;
		$data = htmlspecialchars($data);
		$data = filter_var($data, FILTER_SANITIZE_STRING);
		$data = mysqli_real_escape_string($conn, $data);
		if ($strip)
			$data = strip_sql($data);
		return $data;
	}

	function join_name($fname, $lname, $oname){
		return $fname . " " . $lname . " ". $oname;
	}

	function validate_date($date, $format = 'Y-m-d'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	function sanitize($data) {
		$conn = $GLOBALS['CONNECTION'];
		$data = htmlentities(trim($data));
		$data = filter_var($data, FILTER_SANITIZE_STRING);
		$data = mysqli_real_escape_string($conn, $data);
		return $data;
	}

	function record_exists($table, $where, $data) {
		global $conn;
		$query = "SELECT * FROM `$table` WHERE $where = '$data'";
		$result = mysqli_query($conn, $query) or die(ip_logger(sanitize(mysqli_error($conn))));

		if (mysqli_num_rows($result) > 0)
			return true;
		return false;
	}

	function shortener($data) {
		$data = substr($data, 0, 250) . "...";
		return $data;
    }
    
    function encrypt_password($pass) {
		$options = ['cost' => 12, ];
		$pass = password_hash($pass, PASSWORD_BCRYPT, $options);
		return $pass;
	}
	
	function verify_password($pass, $hashed) {
		return password_verify($pass, $hashed);
	}

	function check_user_session($key) {
		return isset($_SESSION[$key]);
	}

	function store_session($key, $user) {
		if(!is_string($key))
			return null;
		else 
			$_SESSION[$key] = $user;
	}

	function get_user_session($key) {
		if(!isset($_SESSION[$key]))
			return null;
		else
			return $_SESSION[$key];
	}

    function get_ip_address() {
		$ip = "";
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} elseif (!empty($_SERVER['HTTP_FORWARDED'])) {
			$ip = $_SERVER['HTTP_FORWARDED'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	function capitalize($string) {
		return ucwords(strtolower($string));
	}

	function check_file_type($data) {
		return in_array(get_file_type($data), array("pdf","doc"));
	}

    function ip_logger($data) {
		global $normal_date, $conn;
		$address = get_ip_address();
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$sql = "INSERT INTO `ip_logger` VALUES (NULL, '$address', '$user_agent', '$data', '$normal_date')";
		$query = mysqli_query($conn, $sql) or die();
	}
	
	    
    function strip_sql($data) {
		$my_tags = array(
			'!', '@', '#', '$', '%', '^', '&', '*',
			'(', ')', '~', '\\', '/', '[', ']', '{',
			'}','+', '\'', '"', '<', '>', '?', '/',
			';', ':', '`', '=', ",", '.');
		$data = str_replace($my_tags, "", $data);

		return $data;
	}
    
    function get_file_type($data) {
		return strtolower(pathinfo($data, PATHINFO_EXTENSION));
	}

	function isset_file($name) {
		return (isset($_FILES[$name]) && $_FILES[$name]['error'] != UPLOAD_ERR_NO_FILE);
	}
?>
