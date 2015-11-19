<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


if (isset($_POST["check"])) {
    check();
} else if (isset($_POST["first_q"])) {
    first_q();
} else {
    login();
}

## ------------------------LOGIN FUNCTION---------------------------------------
function login(){
  $script = $_SERVER['PHP_SELF'];
  print <<<signUp
    <html>
    <head>
    <title> User Login </title>
    </head>
    
    <body>
    <center>
    <h2> Please Login to Continue </h2>
    <form method = "post" action = "$script">
    <table width = "400px" height="100px">
    <tr>
    <td> User name: </td>
    <td colspan="2"> <input name="usr" type = "text" size = "40" /> </td>
    </tr>
    <tr>
    <td> Password: </td>
    <td colspan="2"> <input name="passwd" type = "password" size = "40" /> </td>
    </tr>
    <tr>
    <td> <input type = "submit" name="check" value = "Submit" /> </td>
    <td> <input type = "reset" value = "Clear" /> </td>
    <td align="right"> <input type = "submit" name="registration" value = "First Time User"/> </td>
    </tr>
    </table>
    </form>
    </center>
    </body>
    </html>
signUp;
}
##--------------------------END OF LOGIN---------------------------------------

##-------------------------CHECK FUNCTION--------------------------------------
function check(){
  $script = $_SERVER['PHP_SELF'];
  $user = $_POST["usr"];
  $user = trim ($user);
  $passwd = $_POST["passwd"];
  $passwd = trim ($passwd);

  # generate user login info
  $user_info = $user . ":" . $passwd;

  # open file for reading
  $file = fopen ("./passwd", "r");
  $found = FALSE;
  while (!feof($file)){
    $line = fgets ($file);
    $line = trim ($line);
    if ($line == $user_info) {
      $found = TRUE;
      break;
    }
  }
  if ($found){
      session_start();

      if (!isset($_SESSION["question_num"])){
	$_SESSION["answer"] = "";
	$_SESSION["score"] = 0;
	$_SESSION["question_num"] = 0;
      }

      $total_questions = 6;

      $script = $_SERVER['PHP_SELF'];
      print <<<TOP
	<html>
	<head>
	<title> Astronomy Quiz </title>
	</head>
	<body>
	<center>
	<h1> Astronomy Quiz </h1>
	</center>
TOP;
	$score = $_SESSION["score"];
	$question_num = $_SESSION["question_num"];
	
	if ($question_num == 0){
	  print <<<FIRST
	  <form method="POST" action="$script">
	  <p> You will be given $total_questions questions in this quiz. You have 15 minutes to complete this quiz. <br /><br/>
	      Click below when you are ready to start the quiz. <br>
	      <input type=submit name="first_q" value="START"/>
	  </p>
          </form>
	  </body>
	  </html>
FIRST;
	}
  }
  else{
     login();
     print '<script type="text/javascript">';
     print "alert('Sorry, Login Failed. Please Try Again!')";
     print '</script>';
  }
}
##----------------------------END OF CHECK-------------------------------------

##---------------------------FIRST_Q FUCNTION----------------------------------
function first_q(){
      $script = $_SERVER['PHP_SELF'];
      print <<<TOP
        <html>
        <head>
        <title> Astronomy Quiz </title>
        </head>
        <body>
        <h2> TRUE / FALSE </h2>
TOP;
        $question_num = $_SESSION["question_num"];
	$answer = $_SESSION["answer"];

	$answer = "False";
        $_SESSION["answer"] = $answer;

        $question_num++;
        $_SESSION["question_num"] = $question_num;

          print <<<FIRST
          <form method="POST" action="$script">
          <p> 	<b> 1) According to Kepler the orbit of the earth is a circle 
		       with the sun at the center. </b>
		<br>
		<input type="radio" name="TF1" value="True"> True </input>
		<input type="radio" name="TF1" value="False"> False </input>
		<br>
		<input type="submit" name="submit_q1" value="NEXT"/>
          </p>
          </form>
          </body>
          </html>
FIRST;
}
##--------------------------END OF FIRST_Q-------------------------------------



?>
