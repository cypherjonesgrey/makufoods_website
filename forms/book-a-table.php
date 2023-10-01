<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'makufoods@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $buy_item = new PHP_Email_Form;
  $buy_item->ajax = true;
  
  $buy_item->to = $receiving_email_address;
  $buy_item->from_name = $_POST['name'];
  $buy_item->from_email = $_POST['email'];
  $buy_item->subject = "New Product Request From Website";

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $book_a_table->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $buy_item->add_message( $_POST['name'], 'Name');
  $buy_item->add_message( $_POST['email'], 'Email');
  $buy_item->add_message( $_POST['phone'], 'Phone', 4);
  $buy_item->add_message( $_POST['date'], 'Date', 4);
  $buy_item->add_message( $_POST['time'], 'Time', 4);
  $buy_item->add_message( $_POST['item'], '# of item', 1);
  $buy_item->add_message( $_POST['category'], 'Category');
  $buy_item->add_message( $_POST['message'], 'Message');

  echo $buy_item->send();
?>
