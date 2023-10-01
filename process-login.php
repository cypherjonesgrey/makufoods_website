<?php
require 'config/database.php';

//get login form data
if(isset($_POST['submit'])) {
    $name = filter_vars($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_vars($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_vars($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //validate input values
    if(!$name) {
        $_SESSION['sigin'] = "Please enter your name";
    } elseif (!$email) {
        $_SESSION['signin'] = "Please enter your email";
    }elseif ( strlen($password) < 8) {
        $_SESSION['signin'] = "Password should be 8+ characters";
    } /*else {
        //check if passwords don't match for password confirmation
        if($password1 !== $password2){
            $_SESSION['signin'] = "Passwords don't match";
        } else {
            //hash
            $hash_password = password_hash($password1, 
            PASSWORD_DEFAULT);
           
            //check if name or email already exists in database
            $user_check_query = "SELECT * FROM users WHERE name='$name' OR email='$email'";
            $user_check_result =mysqli_query($connection, $user_check_query);
            if(mysqli_num_rows($user_check_result) >0) {
                $_SESSION['signin'] = "name or email already exist";
            } 
        }
    }*/
    //redirect back to login page if there was any problem
    if($_SESSION['signin']) {
        //pass form data back to login page
        header('location' . ROOT . 'login.php');
        die();
    } else {
       //insert new user into users table
       $insert_user_query = "INSERT INTO users (name, email, password, is_admin)
       VALUES('$name', '$email', '$password', 0)";
       
       if(!mysqli_errno($connection)) {
        //rdirect to login page with success message
        $_SESSION['signin-success'] = "Registration successful. Login successful";
       }
    }
} else {
    //if button wasn't clicked, back to login page
    header('location' . ROOT_URL . 'login.php');
    die();
}