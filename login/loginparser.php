<?php
session_start();
date_default_timezone_set( "America/Los_Angeles" );
header('Access-Control-Allow-Origin: https://tgtpos.com');
function checkCase($row,$posts) {
    if ( $row === $posts){
    return true;
    } else {
    return false;
    };
    }
   
    //if(isset($_POST[ 'username' ])){echo "p";};
    //if(isset($_POST[ 'password' ])){echo "e";};
    
    
    if ( isset( $_POST[ 'username' ] ) && isset( $_POST[ 'password' ] ) ) {
 
        $server = "localhost";
        $admin = "johnnzh5_admin";
        $passphrase = "2?{0GH3A2$,=";
        $db = "johnnzh5_tgtpos_db";
        $conn = new mysqli($server, $admin, $passphrase, $db);
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
      $atTime = time();echo "con";
      $uname = trim( $_POST[ 'username' ] );
      $pword = trim( $_POST[ 'password' ] );
      $sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$pword'";
      $result = mysqli_query( $conn, $sql );
      $row = mysqli_fetch_row( $result );
      if ( mysqli_num_rows( $result ) === 1 ) {
    
        if ( checkCase(array($row[1], $row[2]), array($uname, $pword)) ) { 
          $uname = $row[ '1' ];echo "case";
          $atTime = time();
          mysqli_query( $conn, "UPDATE users SET `login_record` = $atTime WHERE username = '$uname'" );
          $_SESSION[ 'privilege' ] = $row[ '3' ];
          $_SESSION[ 'username' ] = $row[ '1' ];
          $_SESSION[ 'userid' ] = $row[ '0' ];
          $_SESSION[ 'checkin' ] = $atTime;
          $_SESSION[ 'last_login' ] = $row[ '4' ];
          mysqli_free_result( $result );
          mysqli_close( $conn );
          echo "success"; 
        } else {
          echo 'Invalid Credentials - Check Case';
        }
      } else {
        echo 'Invalid Credentials';
      }
      
    }
?>