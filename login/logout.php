<?phpsession_start();foreach($_SESSION as $key => $value){	$_SESSION[$key] = "";	unset($_SESSION[$key]);}foreach($_COOKIE as $key => $value){	$_COOKIE[$key] = "";	unset($_COOKIE[$key]);}header('location: https://tgtpos.com/login/');?>