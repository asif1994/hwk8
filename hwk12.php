<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

$list = [];
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
  fclose($file);

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
	      <input type = "hidden" name = "page" value = $user />
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
      $user = $_POST["page"];
      session_start();

      if (!isset($_SESSION["question_num"])){
        $_SESSION["answer"] = "";
        $_SESSION["score"] = 0;
        $_SESSION["question_num"] = 1;
        $_SESSION["start"] = time();
      }

      $total_questions = 6;

      print <<<TOP
        <html>
        <head>
        <title> Astronomy Quiz </title>
        </head>
        <body>
TOP;
        $question_num = $_SESSION["question_num"];
	$answer = $_SESSION["answer"];
	$score = $_SESSION["score"];
	$start = $_SESSION["start"];

	if (time() - $start >= 30){
	  print <<<NOTIME
          <h2> Sorry, Out of Time </h2>
          <p>
          <b> Sorry! </b>
          You're out of time.
          <br>
          Your score is $score.
          <br>`
          </p>
NOTIME;
        $result = $user . ":" . $score . "\n";
        $file = fopen("./results.txt", "a");
        fwrite($file, "$result");
        fclose($file);

        session_destroy();
	}
	else {
	  if ($question_num == 1){
	    $status = "inactive";
	    $_SESSION['status'] = $status;

            $question_num++;
            $_SESSION["question_num"] = $question_num;
	    print_r ($GLOBALS['status']);
            print <<<FIRST
	    <h2> TRUE / FALSE </h2>
            <form method="POST" action="$script">
            <p> <b> 1) According to Kepler the orbit of the earth is a circle 
	  	       with the sun at the center. </b>
	  	<br>
		<input type="radio" name="TF2" value="True"> True </input>
		<input type="radio" name="TF1" value="False"> False </input>
		<br>
		score $score
		<br>
		<input type = "hidden" name = "page" value = $user />
		<input type="submit" name="questions" value="NEXT"/>
            </p>
	    </form>
FIRST;
            $status = "active";
            $_SESSION['status'] = $status;
	}
        else if ($question_num == 2){
          if (isset($_POST["TF1"])){
	     $score += 10;
	  }
	  $question_num++;
	  $_SESSION["question_num"] = $question_num;
	  $_SESSION["score"] = $score;

          print <<<SECOND
	  <h2> TRUE / FALSE </h2>
          <form method="POST" action="$script">
          <p>   <b> 2) Ancient astronomers did consider the heliocentric model 
		of the solar system but rejected it because they could 
		not detect parallax. </b>
		<br>
                <input type="radio" name="TF2" value="True"> True </input>
                <input type="radio" name="TF1" value="False"> False </input>
                <br>
                Score: $score
                <br>
		<input type = "hidden" name = "page" value = $user />
                <input type="submit" name="questions" value="NEXT"/>
          </p>
	  </form>
SECOND;
	}
        else if ($question_num == 3){
          if (isset($_POST["TF2"])){
             $score += 10;
          }
          $question_num++;
          $_SESSION["question_num"] = $question_num;
          $_SESSION["score"] = $score;

          print <<<THIRD
	  <h2> Multiple Choice </h2>
          <form method="POST" action="$script">
          <p>   <b> 3) The total amount of energy that a star emits is directly 
		related to its </b>
		<br>
		<input type="checkbox" name="MC_1" value="False"> surface gravity and
		magnetic field </input><br>
		<input type="checkbox" name="MC_2" value="True"> radius and 
		temperature </input><br>
		<input type="checkbox" name="MC_3" value="False"> pressure and volume
		</input><br>
		<input type="checkbox" name="MC_4" value="False"> location and 
		velocity </input>
		<br>
                Score: $score
                <br>
		<input type = "hidden" name = "page" value = $user />
                <input type="submit" name="questions" value="NEXT"/>
          </p>
          </form>
THIRD;
        }
	else if ($question_num == 4) {
	   if ((isset($_POST["MC_2"])) && !(isset($_POST["MC_1"])) && !(isset($_POST["MC_3"])) && !(isset($_POST["MC_4"])))
	   {
	       $score += 10;
	   }
          $question_num++;
          $_SESSION["question_num"] = $question_num;
          $_SESSION["score"] = $score;


          print <<<FOURTH
 	  <h2> Multiple Choice </h2>
          <form method="POST" action="$script">
          <p>
	  <b> 4) Stars that live the longest have </b>
  	  <br>
	  <input type="checkbox" name="MC_1" value="False"> high mass </input><br>
	  <input type="checkbox" name="MC_2" value="False"> high temperature </input><br>
	  <input type="checkbox" name="MC_3" value="False"> lots of hydrogen </input><br>
	  <input type="checkbox" name="MC_4" value="True"> small mass </input>
	  <br>
	  Score: $score      
	  <br>
	  <input type = "hidden" name = "page" value = $user />
          <input type="submit" name="questions" value="NEXT"/>
          </p>
          </form>
FOURTH;
	}

	else if ($question_num == 5){
           if ((isset($_POST["MC_4"])) && !(isset($_POST["MC_1"])) && !(isset($_POST["MC_2"])) && !(isset($_POST["MC_3"])))
           {
               $score += 10;
           }
	  $answer = "galaxy";
          $question_num++;
          $_SESSION["question_num"] = $question_num;
          $_SESSION["score"] = $score;
	  $_SESSION["answer"] = $answer;

          print <<<FIFTH
          <h2> Fill in the Blank </h2>
          <form method="POST" action="$script">
	  <b> 5) A collection of a hundred billion stars, gas, and dust is called a
		<input type="text" name="FB1" value="" id="Q5"/>. </b>
	  <br>
          Score: $score
	  <br>
	  <input type = "hidden" name = "page" value = $user />
          <input type="submit" name="questions" value="NEXT"/>
          </p>
	  </form>
FIFTH;
        }

        else if ($question_num == 6){
	   $data = trim($_POST["FB1"]);
	   $data = strtolower($data);
           if ($answer == $data)
           {
               $score += 10;
           }
          $answer = "age";
          $question_num++;
          $_SESSION["question_num"] = $question_num;
          $_SESSION["score"] = $score;
          $_SESSION["answer"] = $answer;

          print <<<SIXTH
          <h2> Fill in the Blank </h2>
          <form method="POST" action="$script">
          <b> 6) The inverse of the Hubble's constant is a measure of the 
	<input type="text" name="FB2" value="" id="Q6"/> of the universe.</b>
          <br>
          Score: $score
          <br>
	  <input type = "hidden" name = "page" value = $user />
          <input type="submit" name="questions" value="SUBMIT"/>
          </p>
          </form>
SIXTH;
        }
        else if ($question_num > 6){
           $data = trim($_POST["FB2"]);
           $data = strtolower($data);
           if ($answer == $data)
           {
               $score += 10;
           }
          print <<<LAST
          <h2> Thank you for Taking the Quiz </h2>
          <p>
          <b> Congrations! </b>
	  You've completed this quiz.
          <br>
          Your score is $score.
          <br>`
          </p>
LAST;
	$result = $user . ":" . $score . "\n";
	$file = fopen("./results.txt", "a");
	fwrite($file, "$result");
        fclose($file);

	session_destroy(); 
	}

}
	print <<<BOTTOM
          </body>
          </html>
BOTTOM;

}
##--------------------------END OF QUESTIONS-------------------------------------
?>
