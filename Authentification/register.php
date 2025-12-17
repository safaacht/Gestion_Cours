<?php
include '../includes/connect_php.php';
include '../includes/header.php';
include '../includes/helper.php';


if(isset($_POST['register'])){

$email=$_POST['email'];
$password=$_POST['password'];
$passwordRepeated=$_POST['password_repeat'];
$user_name=$_POST['user_name'];

if(!input_valid($_POST['email']) || !input_valid($_POST['password']) || !input_valid($_POST['user_name'])){
    echo "Invalid input!";
    exit;
}

$email_pattern='/^[a-zA-Z0-9._%+-]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/';
if (!preg_match($email_pattern, $email)){
    echo "Email not valid";
    exit;
}

if(($passwordRepeated!=$password)){
    echo "Passwords are not the same";
    exit;

}
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$check = mysqli_prepare($connect, "SELECT id FROM users WHERE email = ?");
mysqli_stmt_bind_param($check, 's', $email);
mysqli_stmt_execute($check);
$result = mysqli_stmt_get_result($check);

if (mysqli_num_rows($result) > 0) {
    echo "Email already exists!";
    exit;
}

$sql="INSERT INTO users(email,password,user_name) VALUES(?,?,?)";
$stmt=mysqli_prepare($connect,$sql);
mysqli_stmt_bind_param($stmt,'sss',$email,$hashed_password,$user_name);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location:../courses/courses_list.php');exit;
}
?>
<section>
<form id="register_frm" method="POST">
    <label for="user_name"><b>Name</b></label>
    <input name="user_name" type="text" id="user_name" placeholder="Enter ur name..." required>
    <label for="email"><b>Email</b></label>
    <input name="email" type="text" id="email" placeholder="xxxxxx@gmail.com" required>
     <label for="password"><b>Password</b></label>
    <input name="password" type="password" id="password" placeholder="Enter Password..." required>
     <label for="password_repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password..." name="password_repeat" id="password_repeat" required>

    <button id="register" name="register">Sign up</button>
    <p>Already have an account?<a href="../Authentification/login.php">Log in</a></p>
    
</form>
</section>

<script>

</script>