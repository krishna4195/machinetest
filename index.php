<?php
// Initialize the session
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
// Include config file
include 'backend/database.php';
 
$username = $password = "";
$username_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["email"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["email"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = md5(trim($_POST["password"]));
    }
    
    if($_POST["email"] !='' && $_POST["password"] !=''){
        $sql = "SELECT id, email, password FROM users WHERE email ='".$username."' and password='".$password."'";
       
              if ($result=mysqli_query($conn,$sql))
              {
              $rowcount=mysqli_num_rows($result);
          
             
               } 
                if($rowcount == 1){                    
                    
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to home page
                            header("location: home.php");
                        
                } else{
                    $username_err = "No account found with that username.";
                }
                mysqli_free_result($result);
            
            
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
	<script src="ajax/ajax.js"></script>
	
	
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px;
    margin: 0px auto;
    margin-top: 100px;}
	.error{color:red;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="index.php" id="login" method="post" role="form" >
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="email" class="form-control" value="<?php echo $username; ?>" required>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
           
        </form>
    </div>    
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script>
$(function() {
	
	$("#login").validate({
	  rules: {
		email: {
		  required: true,
		  email: true
		},
		password: {
			required: true,
			
		  },
		
	  },
	  messages: {
		 email: "Please enter a valid email address",
		 password: "Please enter the password"

	  },
	   submitHandler: function(form) {
		form.submit();
	   }
	});
});
</script>

</html>
