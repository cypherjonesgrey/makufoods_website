<?php
require 'config/database.php';

//get login form data
if(isset($_POST['submit'])) {
    $name = filter_vars($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_vars($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_vars($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $terms = filter_vars($_POST['terms'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //validate input values
    if(!$name) {
        $_SESSION['sigup'] = "Please enter your name";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter your email";
    } elseif(strlen($password) < 8) {
        //check if passwords less than 8 characters
        $_SESSION['signup'] = "Password should not be < 8 characters";
    }  else {
            //hash
            $hash_password = password_hash($password, 
            PASSWORD_DEFAULT);
           
            //check if name or email already exists in database
            $user_check_query = "SELECT * FROM users WHERE name='$name' OR email='$email'";
            $user_check_result =mysqli_query($connection, $user_check_query);
            if(mysqli_num_rows($user_check_result) >0) {
                $_SESSION['signin'] = "name or email already exist";
            } 
            elseif ($terms === "checked") {  
                $_SESSION['signup'] = "Accept terms & conditions"; 
        } 
     } 
    }
    //redirect back to login page if there was any problem
    if($_SESSION['signup']) {
        //pass form data back to signup page
        header('location' . ROOT . 'signup.php');
        die();
    } else {
       //insert new user into users table
       $insert_user_query = "INSERT INTO users (name, email, password, terms, is_admin)
       VALUES('$name', '$email', '$password', $terms, 0)";
       
       if(!mysqli_errno($connection)) {
        //rdirect to login page with success message
        $_SESSION['signup-success'] = "Registration successful. Login";
       } 
       else {
      //if button wasn't clicked, back to signup page
      header('location' . ROOT_URL . 'signup.php');
      die();
  }
 }

