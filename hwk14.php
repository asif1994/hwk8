<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

if (isset($_POST["submit"])) {
    submit();
} else {
    user();
}

function user(){
  $user = trim($_POST["user"]);
  
  $file = fopen ("./passwd", "r");
  $found = FALSE;
  while (!feof($file)){
    $line = fgets ($file);
    $line = trim ($line);
    $info = explode(":", $line);
    if ($info[0] == $user) {
      $response = $user;
      $found = TRUE;
      //echo $response;
      break;
    }
  }
  if (!$found){
     $response = " ";
  }
  echo $response;
  fclose($file);
}

function submit(){
  $user = trim($_POST["user"]);
  $password = md5(trim($_POST["password"]));
  
  $info = $user . ":" . $password . "\n";

  $file = fopen ("./passwd", "r");
  $found = FALSE;
  while (!feof($file)){
    $line = fgets ($file);
    $line = trim ($line);
    $line = explode(":", $line);
    if ($user == $line[0]) {
      $found = TRUE;
      break;
    }
  }
  fclose($file);

  if ($found){
       print "User Name has been taken, Please try again!";
       $file = fopen ("./hwk14.html", "r");
       while (!feof($file)){
   	 $line = fgets ($file);
	 print $line;
       }
       fclose($file);
  }
  else {
     $file = fopen ("./passwd", "a");
     fwrite($file, "$info");
     fclose($file);
     print "Thank You";
  }
}
?>
