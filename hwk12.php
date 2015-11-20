<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


if (isset($_POST["check"])) {
    check();
} else if (isset($_POST["questions"])) {
    questions();
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
    <form method = "post" action = $script>
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
      $script = $_SERVER['PHP_SELF'];
      print <<<WELCOME
	<html>
	<head>
	<title> Astronomy Quiz </title>
	</head>
	<body>
	<center>
	<h1> Astronomy Quiz </h1>
	</center>
        <form method="POST" action=$script>
	  <p> You will be given 6 questions in this quiz. You have 15 minutes to complete this quiz. <br /><br/>
	      Click below when you are ready to start the quiz. <br>
	      <input type=submit name="questions" value="START"/>
	  </p>
          </form>
	  </body>
	  </html>
WELCOME;
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
function questions(){
      $script = $_SERVER['PHP_SELF'];

      session_start();

      if (!isset($_SESSION["question_num"])){
        $_SESSION["answer"] = "";
        $_SESSION["score"] = 0;
        $_SESSION["question_num"] = 1;
      }

      $total_questions = 6;

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
	$score = $_SESSION["score"];

	if ($question_num == 1){
  	  $answer = "False";
          $_SESSION["answer"] = $answer;
          $question_num++;
          $_SESSION["question_num"] = $question_num;

          print <<<FIRST
          <form method="POST" action="$script">
          <p>   <b> 1) According to Kepler the orbit of the earth is a circle 
		       with the sun at the center. </b>
		<br>
		<input type="radio" name="TF1" value="True"> True </input>
		<input type="radio" name="TF1" value="False"> False </input>
		<br>
		score $score
		<br>
		<input type="submit" name="questions" value="NEXT"/>
          </p>
	  </form>
FIRST;
	}
        else if ($question_num == 2){
          if ($answer == $_POST["TF1"]){
	     $score += 10;
	  }
	  $answer = "True";
          $question_num++;
	  $_SESSION["answer"] = $answer;
          $_SESSION["question_num"] = $question_num;
	  $_SESSION["score"] = $score;

          print <<<SECOND
          <form method="POST" action="$script">
          <p>   <b> 2) Ancient astronomers did consider the heliocentric model 
		of the solar system but rejected it because they could 
		not detect parallax. </b>
		<br>
                <input type="radio" name="TF2" value="True"> True </input>
                <input type="radio" name="TF2" value="False"> False </input>
                <br>
                score $score
                <br>
                <input type="submit" name="questions" value="NEXT"/>
          </p>
	  </form>
SECOND;
	}
        else if ($question_num == 3){
          if ($answer == $_POST["TF2"]){
             $score += 10;
          }
          $answer = "True";
          $question_num++;
          $_SESSION["answer"] = $answer;
          $_SESSION["question_num"] = $question_num;
          $_SESSION["score"] = $score;

          print <<<THIRD
          <form method="POST" action="$script">
          <p>   <b> 3) The total amount of energy that a star emits is directly 
		related to its </b>
		<br>
		<input type="checkbox" name="MC1" value="False"> surface gravity and 
		magnetic field </input><br>
		<input type="checkbox" name="MC1" value="True"> radius and temperature 
		</input><br>
		<input type="checkbox" name="MC1" value="False"> pressure and volume 
		</input><br>
		<input type="checkbox" name="MC1" value="False"> location and velocity 
		</input>
		<br>
                score $score
                <br>
                <input type="submit" name="questions" value="NEXT"/>
          </p>
          </form>
THIRD;
        }

	print <<<BOTTOM
          </body>
          </html>
BOTTOM;
}
##--------------------------END OF QUESTIONS-------------------------------------



?>
