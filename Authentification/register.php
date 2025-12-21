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
<section class="auth-wrapper">
    <div class="auth-card">
        <h2>Create Account</h2>
        <p class="subtitle">Join our learning platform today</p>

        <form id="register_frm" method="POST">
            <div class="form-group">
                <label for="user_name">Full Name</label>
                <input name="user_name" type="text" class="auth-input" placeholder="John Doe" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input name="email" type="email" class="auth-input" placeholder="name@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" class="auth-input" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label for="password_repeat">Confirm Password</label>
                <input name="password_repeat" type="password" class="auth-input" placeholder="••••••••" required>
            </div>

            <button type="submit" name="register" class="btn-primary-auth">Sign Up</button>
            
            <div class="auth-footer">
                Already have an account? <a href="login.php">Log in</a>
            </div>
        </form>
    </div>
</section>

<script>

</script>