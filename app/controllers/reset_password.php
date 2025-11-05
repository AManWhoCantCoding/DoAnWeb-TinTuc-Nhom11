<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class reset_password extends Framework{

  final public function __construct(){
    $this->pwd = $this->model('pwdreset');
  }
  final public function index(){
    $this->view('account/reset_password');
  }

  final public function msg(){

      $mail = new PHPMailer(true);

      if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

       $userEmail = $_POST['email'];
       $selector = bin2hex(random_bytes(8));
       $validator    = bin2hex(random_bytes(32));
       $url = "http://localhost/Blog-with-mvc-system-master/create_new_password/msg/?selector=" . $selector . "&validator=" . $validator;

       $expires = date("U") . 1800; // the end time of your message; date("u") get current date

       if($this->pwd->select_pwd($userEmail) > 0){
          $this->pwd->delete_pwdreset($userEmail);
       }else{
         if($this->pwd->insert_pwd($userEmail, $selector, $validator, $expires)){
           //Create an instance; passing `true` enables exceptions
          try {
            
             $mail->isSMTP();                                           //Send using SMTP
             $mail->Host       = 'smtp.titan.email';                    //Set the SMTP server to send through
             $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
             $mail->Username   = 'email@company.com';                     //SMTP username
             $mail->Password   = 'password';                               //SMTP password
             $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
             $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

              //Recipients
              $mail->setFrom('hoxuantailoc1603@gmail.com', 'Mailer');
              $mail->addAddress('mohamedseabeai@gmail.com', 'Joe User');     //Add a recipient
              //$mail->addAddress('mohamedseabeai@gmail.com');               //Name is optional
              $mail->addReplyTo('hoxuantailoc1603@gmail.com', 'Information');

              //Content
              $mail->isHTML(true);                                  //Set email format to HTML
              $mail->Subject = 'from: hoxuantailoc1603@gmail.com <br>
              about: resteing your password click the link down blowe to create new password<br>
              to: mohamedseabeai@gmail.com';
              $mail->Body    = "<a href={$url}>{$url}</a>";
              //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
              if($mail->send()){
                $data['success'] = 'we send an e-mail to your email address check it.</p>';
                $this->view('account/reset_password', $data);
              }else{
                $data['error'] = 'somthing has been wrong try again later';
                $this->view('account/reset_password', $data);
              }

              } catch (Exception $e) {
                   $data['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                  $this->view('account/reset_password', $data);
              }

         }else{
            $data['error'] = 'you trying something invalid try again la';
            $this->view('account/reset_password', $data);
         } // end insert_pwd
       }// end select_pwd
     }else{
       $this->redirect('home');
     } // end REQUEST_METHOD post

  } // end msg

} // end class reset_password
