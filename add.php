<?php
$nameErr = "";
$emailErr = "";
$numberErr = "";
$name = "";
$email = "";
$number = "";
$comment = "";
function test_input($data) {
$data = trim($data);
$data =stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
function form_submission_success($msg = 'Form submitted'){
echo $msg.'<br>';
}   
if (empty($_POST["name"])) {
$nameErr = "Name is required";
form_submission_success($nameErr);
} else {
$name = test_input($_POST["name"]);
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
$nameErr = "Only letters and white space allowed";
form_submission_success($nameErr);
}
}
if (empty($_POST["email"])) {
$emailErr = "Email is required";
form_submission_success($emailErr);
} else {
$email = test_input($_POST["email"]);
// check if e-mail address is well-formed
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Invalid email format";
form_submission_success($emailErr);
}
}
if (empty($_POST["number"])) {
$numberErr = "Contact Number is required";
form_submission_success($numberErr);
} else {
$number = test_input($_POST["number"]);
// check if number only contains letters and whitespace
if (!preg_match("/^[a-zA-Z ]*$/",$number)) {
$numberErr = "Only letters and white space allowed";
form_submission_success($numberErr);
}
}
if (empty($_POST["comment"])) {
$comment = "";
} else {
$comment = test_input($_POST["comment"]);
}
function submit_database(){
}
} else {
?>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
Full Name: <input type="text" name="name" value="<?php echo $name;?>">
<span class="error">* <?php echo $nameErr;?></span>
<br><br>
Contact E-mail: <input type="text" name="email" value="<?php echo $email;?>">
<span class="error">* <?php echo $emailErr;?></span>
<br><br>
Contact Number: <input type="text" name="number" value="<?php echo $number;?>">
<span class="error">* <?php echo $numberErr;?></span>
<br><br>
Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
<br><br>
<input type="submit" name="submit" value="Submit">  
</form>
<?php } ?>