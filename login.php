<?php  //Start the Session
session_start();
 require('connect.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['username']) and isset($_POST['password'])){
//3.1.1 Assigning posted values to variables.
$username = $_POST['username'];
$password = $_POST['password'];
$mdHash = md5($password);
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM `user` WHERE username='$username' and password='$mdHash'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$_SESSION['username'] = $username;
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
$fmsg = "Invalid Login Credentials.";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
header("Location: home.php");
 
 
}else{
//3.2 When the user visits the page first time, simple login form will be displayed.
?> 
<html>
<head>

    <title>Login Page</title>
	
<link rel="stylesheet" href="mystyle.css">
  
  <meta charset="UTF-8">
  <title>Activity Tracker</title>

</head>

<body>


<div class="Logincontainer">
     <a href="/Website/index.html" class="titleIcon">Flow<font color="#3cbc8c">Track</font></a>
      <form class="loginSubContain" method="POST">
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        <h2 class="">Login To Your Account</h2>


	  <input type="text" class="inputLogin" name="username" class="" placeholder="Email" required>
        <input type="password" name="password" id="inputPassword" class="inputLogin" placeholder="Password" required>
        
        <button class="loginButton" type="submit">Sign In</button>
        
      </form>
</div>

<div class="signUpContainer">
	<form class="loginSubContain">
	<h1 class="h2_login">New Here?</h1>
	<p>Sign Up For Free And Expereince Flow Track</p>
	<button onclick="window.location.href='register.php'" class="signupButton" type="button">Sign Up</button>
	
	</form>
</div>

</body>

</html>

<?php } ?>
	