<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables
$name = $usrName = $password = $email = $website = $comment = "";
$error_name = $error_usrName = $error_password = $error_email = $error_website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $error_name = "Name Required";
    } else {
        $name = strip($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $error_name = "Use only letters and spaces.";
        }
    }

    if (empty($_POST["usrName"])) {
        $error_usrName = "User Name Required";
    } else {
        $usrName = strip($_POST["usrName"]);
        // check if usrName contains only letters, a-z and A-Z
        if (!ctype_alpha($usrName)) {
           $error_usrName = "Use letters only with no spaces."; 
        } elseif (strlen($usrName) < 4) {
           $error_usrName = "Use at least four letters with no spaces."; 
          }
    }
    

        if (empty($_POST["password"])) {
        $error_password = "Password Required";
    } else {
        $password = strip($_POST["password"]);
        // Password must have an uppercase letter, a lowercase letter, a number and is at least eight charters long.
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
          $error_password = "Password must have an uppercase letter, a lowercase letter, a number and is at least eight charters long.";
        }
    }

    
    if (empty($_POST["email"])) {
        $error_email = "Email Required";
    } else {
        $email = strip($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error_email = "Invalid email format"; 
        }
    }
    
      if (empty($_POST["website"])) {
        $error_website = "Website Required";
      } else {
        $website = strip($_POST["website"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
          $error_website = "Invalid URL"; 
        }
      }

      if (empty($_POST["comment"])) {
        $comment = "";
      } else {
        $comment = strip($_POST["comment"]);
      }
}

function strip($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
      Name: <input type="text" name="name" value="<?php echo $name; ?>">
      <span class="error">* <?php echo $error_name;?></span>
      <br><br>
      User Name: <input type="text" name="usrName" value="<?php echo $usrName; ?>">
      <span class="error">* <?php echo $error_usrName; ?></span>
      <br><br>
      Password: <input type="password" name="password" value="<?php echo $password; ?>">
      <span class="error">* <?php echo $error_password; ?></span>
      <br><br>
      Email: <input type="email" name="email" value="<?php echo $email; ?>">
      <span class="error">* <?php echo $error_email; ?></span>
      <br><br>
      Your Website: <input type="url" name="website" value="<?php echo $website; ?>">
      <span class="error">* <?php echo $error_website; ?></span>
      <br><br>
      Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
      <br><br>
      <input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $usrName;
echo "<br>";
echo $password;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
?>

</body>
</html>
