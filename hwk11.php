<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

## set up 2 cookies. 
## NumVisits changes everytime the page has been visited.
## pre_reader changes only when the user logs in or registers
## ----------------- Cookies --------------------------------------------------
if (!isset ($_COOKIE["numVisits"])){
    $pre_reader = 1;
    $numVisits = 1;
    setcookie ("numVisits", $numVisits, time()+120);
    setcookie ("pre_reader", $pre_reader, time()+120);
} else {
    $numVisits = $_COOKIE["numVisits"];
    $numVisits++;
    setcookie ("numVisits", $numVisits, time()+120);

    $pre_reader = $_COOKIE["pre_reader"];
    setcookie ("pre_reader", $pre_reader, time()+120);
 }

## ----------------------------------------------------------------------------

## This if statement only runs when the pre_reader cookie's content increments to more than 1 which only happens when the reader logs in

if ($GLOBALS["pre_reader"] > 1){
    if (isset($_POST["paris_attack"])){
        paris_attack();
    } else if (isset($_POST["debate"])){
        debate();
    } else if (isset($_POST["airbnb"])){
        airbnb();
    } else if (isset($_POST["football"])){
        football();
    } else if (isset($_POST["ibm"])){
        ibm();
    } else{
      $script = $_SERVER['PHP_SELF'];
      $file = fopen("./main_page.html", "r");
      while (!feof($file)){
         $line = fgets ($file);
         print $line;
      }
      fclose($file);
    }
} else {
    if (isset($_POST["submitted"])){
        sign_up();
    } else if (isset($_POST["check"])){ 
	check();
    } else if (isset($_POST["registration"])){
        registration();
    } else if (isset($_POST["re_check"])){
 	re_check();
    } else if (isset($_POST["paris_attack"])){
        paris_attack();
    } else if (isset($_POST["debate"])){
        debate();
    } else if (isset($_POST["airbnb"])){
        airbnb();
    } else if (isset($_POST["football"])){
        football();
    } else if (isset($_POST["ibm"])){
        ibm();
    } else{
        wlcome();
    }
}

##-----------------------------------------------------------------------------
## This wlcome() function runs if the user vistis the page for the first time

function wlcome() {
  $script = $_SERVER['PHP_SELF'];
  $file = fopen("./welcome_page.html", "r");
  while (!feof($file)){
     $line = fgets ($file);
     print $line;
  }
  fclose($file);
}

##------------------------------------------------------------------------------

## sign_up() generates a sign page. This fuction runs when the user clicks on any link before logging in to his account.

function sign_up(){
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
##-----------------------------------------------------------------------------
## check() checks if the user inputted the right username & password.
## if the user successfully logs in, then this function runs the Home Page again with full access to any articles.
## Otherwise the page asks the user to try again

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
      $pre_reader = $_COOKIE["pre_reader"];
      $pre_reader++;
      setcookie ("pre_reader", $pre_reader, time()+120);

      $script = $_SERVER['PHP_SELF'];
      print "Thank you for logging in.";
      $file = fopen("./main_page.html", "r");
      while (!feof($file)){
         $line = fgets ($file);
         print $line;
      }
      fclose($file);
  }
  else{
     print "Sorry. Login failed. Please try again";
     sign_up();
  }
}

##-----------------------------------------------------------------------------
## This function generates a page for the visitor to register

function registration(){
  $script = $_SERVER['PHP_SELF'];
  
  $file = fopen("./sign_up.html", "r");
  while (!feof($file)){
    $line = fgets ($file);
    print $line;
  }
  fclose($file);
}

##-----------------------------------------------------------------------------
## re_check() checks if the user name already exists in the system. If it does than the function asks the visitor for a different user name
## Else it increments the pre_reader cookie, saves the new account in the system and gives the user full access to the articles

function re_check() {
  $script = $_SERVER['PHP_SELF'];

  $user = $_POST["usr"];
  $user = trim ($user);
  $passwd = $_POST["psswrd"];
  $passwd = trim ($passwd);

  # generate user login info
  $user_info = $user . ":" . $passwd . "\n";

  # open file for reading
  $file = fopen ("./passwd", "r");
  $found = FALSE;
  while (!feof($file)){
    $line = fgets ($file);
    $line = trim ($line);
    $info = explode(":", $line);
    if ($info[0] == $user) {
      $found = TRUE;
      break;
    }
  }  

  if ($found) {
    print "User Name has been taken. Please try another one";
    registration();
  } else {
      $pre_reader = $_COOKIE["pre_reader"];
      $pre_reader++;
      setcookie ("pre_reader", $pre_reader, time()+120);
      
      $file = fopen ("./passwd", "a");
      fwrite($file, "$user_info");
      fclose($file);

      $script = $_SERVER['PHP_SELF'];
      print "Thank you for Registering";
      $file = fopen("./main_page.html", "r");
      while (!feof($file)){
         $line = fgets ($file);
         print $line;
      }
      fclose($file);
  }
}
##-----------------------------------------------------------------------------

function paris_attack(){
  $script = $_SERVER['PHP_SELF'];

  $file = fopen("./paris_attack.html", "r");
  while (!feof($file)){
    $line = fgets ($file);
    print $line;
  }
  fclose($file);
}

function debate(){
  $script = $_SERVER['PHP_SELF'];

  $file = fopen("./debate.html", "r");
  while (!feof($file)){
    $line = fgets ($file);
    print $line;
  }
  fclose($file);
}

function airbnb(){
  $script = $_SERVER['PHP_SELF'];

  $file = fopen("./airbnb.html", "r");
  while (!feof($file)){
    $line = fgets ($file);
    print $line;
  }
  fclose($file);
}

function football(){
  $script = $_SERVER['PHP_SELF'];

  $file = fopen("./football.html", "r");
  while (!feof($file)){
    $line = fgets ($file);
    print $line;
  }
  fclose($file);
}

function ibm(){
  $script = $_SERVER['PHP_SELF'];

  $file = fopen("./ibm.html", "r");
  while (!feof($file)){
    $line = fgets ($file);
    print $line;
  }
  fclose($file);
}


##------------------------END of PHP-------------------------------------------
?>
