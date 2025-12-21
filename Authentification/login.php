<?php
include '../includes/header.php';
include '../includes/connect_php.php';
?>

<section class="auth-wrapper">
    <div class="auth-card">
        <h2>Welcome Back</h2>
        <p class="subtitle">Please enter your details to log in</p>

        <form id="login_form" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" class="auth-input" placeholder="name@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="auth-input" placeholder="••••••••" required>
            </div>

            <button type="submit" name="login" class="btn-primary-auth">Log In</button>

            <div class="auth-footer">
                Don't have an account? <a href="register.php">Sign up</a>
            </div>
        </form>
    </div>
</section>

<?php
if(isset($_POST['login'])){ 
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user=mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);


        if($user){
            if(password_verify($password,$user['password'])){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                
                header('location:../courses/courses_list.php');exit;
            }else{
                echo "Password invalid!";
            }
        }else {
            echo "Email not found!";
        }

    }else{
        echo "Fill all inputs!";
    }
}




?>