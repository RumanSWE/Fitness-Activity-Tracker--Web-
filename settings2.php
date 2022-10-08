<?php

session_start();
if(!(isset($_SESSION['username'])))
{
    header("Location: login.php");
}

    require('connect.php');
    // If the values are posted, insert them into the database.
    $loggedInUsername = $_SESSION['username'];

    $query1 =  "SELECT age FROM user WHERE username = '$loggedInUsername';";
    $query2 = "SELECT height FROM user WHERE username = '$loggedInUsername';";
    $query3 = "SELECT weight FROM user WHERE username = '$loggedInUsername';";
    $query4 = "SELECT username FROM user WHERE username = '$loggedInUsername';";
    $query5 = "SELECT email FROM user WHERE username = '$loggedInUsername';";
    $query6 = "SELECT password FROM user WHERE username = '$loggedInUsername';";



    $result1 = mysqli_query($connection, $query1);

    if (mysqli_num_rows($result1) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result1)) {
            $ageDefault = $row["age"];
        }
    } else {
        echo "0 results";
    }

    $result2 = mysqli_query($connection, $query2);

    if (mysqli_num_rows($result2) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result2)) {
            $heightDefault = $row["height"];
        }
    } else {
        echo "0 results";
    }

    $result3 = mysqli_query($connection, $query3);

    if (mysqli_num_rows($result3) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result3)) {
            $weightDefault = $row["weight"];
        }
    } else {
        echo "0 results";
    }

    $result4 = mysqli_query($connection, $query4);

    if (mysqli_num_rows($result4) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result4)) {
            $userDefault = $row["username"];
        }
    } else {
        echo "0 results";
    }
    $result5 = mysqli_query($connection, $query5);

    if (mysqli_num_rows($result5) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result5)) {
            $emailDefault = $row["email"];
        }
    } else {
        echo "0 results";
    }
    $result6 = mysqli_query($connection,$query6);

    if (mysqli_num_rows($result6) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result6)) {
            $passDefault = $row["password"];
        }
    } else {
        echo "0 results";
    }
    if (isset($_POST["delAccount"]))
    {
        $sql = "DELETE FROM user WHERE username = '$loggedInUsername';";
		$sql2 = "DELETE FROM userdata WHERE username = '$loggedInUsername';";

        if (mysqli_query($connection, $sql)) {
			if(mysqli_query($connection,$sql2)){
            header("Location: logout.php");
            exit();
			}
			else
			{
				 echo "Error deleting record: " . mysqli_error($connection);
			}
		
        } else {
            echo "Error deleting record: " . mysqli_error($connection);
        }
    }




    if (isset($_POST['age']) && isset($_POST['weight']) && isset($_POST['height']) && isset($_POST['username'])&& isset($_POST['email']) && isset($_POST['password'])) {

	
        $age = $_POST['age'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $username = $_POST['username'];
        $email= $_POST['email'];
        $password= $_POST['password'];

        if($passDefault!=$password)
        {
            $password = md5($password);
        }
		
		if($loggedInUsername != $username)
		{
			$query1 = "UPDATE userdata SET username = '$username' WHERE username = '$loggedInUsername';";
			$result1 = mysqli_query($connection, $query1);

			if ($result1) {
				
			} else {
				$fmsg = "Settings Update Failed";
			}
		}

        $query = "UPDATE user SET age = '$age', height = '$height' , weight = '$weight',username = '$username',email = '$email', password = '$password' WHERE username = '$loggedInUsername';";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $smsg = "Settings Updated Successfully";
        } else {
            $fmsg = "Settings Update Failed";
        }
    }


?>
<!doctype html>
<html>
<head>

<meta charset="utf-8">

<title>Edit Information</title
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >


<link rel = "stylesheet" type = "text/css" href = "styles.css" />
 <link rel="stylesheet" href="mystyle.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css"
    type="text/css">
  <meta charset="UTF-8">
  <title>Activity Tracker</title>
  <!-- Pointer events polyfill for old browsers, see https://caniuse.com/#feat=pointer -->
  <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
</head>

<body>

<div class="container">
    <form class="form-signin" method="POST">

        <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
        <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>


        <h2 class="form-signin-heading">Edit Settings</h2>
        <br>
        <label>Age (i.e 23)</label>
        <input type="text" name="age" class="form-control" value = "<?php if($ageDefault == '0' ){} else{echo $ageDefault;} ?>" required>
        <label>Weight (Kg)</label>
        <input type="text" name="weight" class="form-control" value = "<?php if($weightDefault == '0' ){} else{echo $weightDefault;} ?>" required>
        <label>Height (Cm)</label>
        <input type="text" name="height" class="form-control" value = "<?php if($heightDefault == '0' ){} else{echo $heightDefault;} ?>" required>

        <label>Username</label>
        <input type="text" name="username" class="form-control" value = "<?php echo $userDefault; ?>" required>
        <label>Email</label>
        <input type="text" name="email" class="form-control" value = "<?php echo $emailDefault; ?>" required>
        <label>Password</label>
        <input type="password" name="password" class="form-control" value = "<?php echo $passDefault; ?>" required>



        <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
    </form>
    <form class="form-signin" method="POST">
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Delete Account" name="delAccount" >
		

    </form>
	<button class="btn btn-lg btn-primary btn-block" onclick="history.back()">Go Back</button>



</div>




</body>

</html>