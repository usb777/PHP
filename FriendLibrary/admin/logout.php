<?php
include '../db_config.php';

session_start();
unset($_SESSION["login"]);

unset($_COOKIE["cookie_username"]);
 setcookie("cookie_username", $_COOKIE["cookie_username"],time()- 3500, '/') ; // We install cookie if logined
 setcookie("cookie_userid", $_COOKIE["cookie_userid"],time()- 3500, '/') ; // We install cookie if logined

session_destroy();
header( 'Location: '.$GLOBAL_HOST.'' ) ;

?>