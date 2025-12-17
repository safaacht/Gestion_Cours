<?php
session_start();
include '../includes/header.php';
include '../includes/connect_php.php';
?>

<section>
    <form id="login_form" method="POST">
        <label for="email"><b>Email</b></label>
        <input type="email" name="email" placeholder="enter ur email">
        <label for="password"><b>Password</b></label>
        <input type="password" name="password" placeholder="enter ur password">

        <button type="submit" name="login">Log in</button>
        <p>Don't have an account?<a href="../Authentification/register.php">Sign up</a></p>

    </form>
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