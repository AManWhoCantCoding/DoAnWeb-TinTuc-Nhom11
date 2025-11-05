<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class messages extends Framework{

  use filter;

  public $results_per_page = 100;

  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->message = $this->model('contact');
  }

  final public function index(){
    if(isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page'])){
       $page = $_GET['page'];
       $results_per_page = $this->results_per_page;
       $start_from = ($page - 1) * $results_per_page;
     }else{
       return $this->redirect('page404');
     }
    $count = $this->message->select_message_data($start_from, $results_per_page)['count'];
    $row   = $this->message->select_message_data($start_from, $results_per_page)['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('contact/messages', $data);
  }

  final public function show(){
    $id = $this->getUrl()[2];
    if(!isset($this->getUrl()[2])){
      $this->redirect('dashboard');
    }
    $count = $this->message->select_single_message_data($id)['count'];
    $row   = $this->message->select_single_message_data($id)['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('contact/show', $data);
  }

  final public function add(){
      $this->view('contact/add_messages');
  }

  final public function add_msg(){

    $mail = new PHPMailer(true);

           if($_SERVER['REQUEST_METHOD']=="POST"){
               $username    = $_POST['username'];
               $email       = $_POST['email'];
               $phone       = $_POST['phone'];
               $subject     = $_POST['subject'];

               $username    = $this->filter_data($username, FILTER_SANITIZE_STRING);
               $email       = $this->filter_data($email, FILTER_SANITIZE_STRING);
               $phone       = $this->filter_data($phone, FILTER_SANITIZE_NUMBER_INT);
               $subject     = $this->filter_data($subject, FILTER_SANITIZE_STRING);

               $data = [
                 'username' => $username,
                 'email' => $email,
                 'phone' => $phone,
                 'subject' => $subject,
                 'emailError' => '',
                 'usernameError' => '',
                 'phoneError' => '',
                 'subjectError' => '',
               ];


               if(empty($data['username'])){
                 $data['usernameError'] = 'Username can not be empty';
               }
               if(empty($data['email'])){
                 $data['emailError'] = 'email can not be empty';
               }
               if(filter_var($data['email'], FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE) == null){
                 $data['emailError'] = 'not valid email';
               }
               if( empty($data['phone']) ){
                 $data['phoneError'] = 'phone can not be empty';
               }
               if(empty($data['subject'])){
                 $data['subjectError'] = 'subject can not be empty';
               }

          if( empty($data['usernameError']) && empty($data['emailError']) && empty($data['phoneError']) && empty($data['subjectError']) ){
                   try {
                       //Server settings
                      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                     //show message on success or failed output
                      $mail->isSMTP();                                           //Send using SMTP
                      $mail->Host       = 'smtp.titan.email';                    //Set the SMTP server to send through
                      $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
                      $mail->Username   = 'hoxuantailoc1603@gmail.com';                     //SMTP username
                      $mail->Password   = '123456';                               //SMTP password
                      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                      $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                       //Recipients
                       $mail->setFrom('hoxuantailoc1603@gmail.com', 'Mailer');
                       $mail->addAddress($email, $username);     //Add a recipient
                       $mail->addReplyTo('hoxuantailoc1603@gmail.com', 'Information');

                       //Content
                       $mail->isHTML(true);                                  //Set email format to HTML
                       $mail->Subject = "we are sorry about make you waste your time for us";
                       $mail->Body    = "{$subject}";
                       if($mail->send()){
                         $data['success'] = 'good success send message';
                         $this->view('contact/add_messages', $data);
                       }else{
                         $data['error'] = 'somthing has been wrong try again later';
                         $this->view('contact/add_messages', $data);
                       }
                       } catch (Exception $e) {
                           $data['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                           $this->view('contact/add_messages', $data);
                       }
                }else{
                  //echo 'error';
                  $data['error'] = 'there somthing errora add date';
                  $this->view('contact/add_messages', $data);
                }
           }else{
             $this->redirect('dashboard');
           } // end $_SERVER['REQUEST_METHOD']
  }


  final public function reply(){
    $id = $this->getUrl()[2];
    if(!isset($this->getUrl()[2])){
      $this->redirect('dashboard');
    }
    $count = $this->message->select_single_message_data($id)['count'];
    $row   = $this->message->select_single_message_data($id)['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('contact/reply_message', $data);
  }

  final public function reply_msg(){

    $mail = new PHPMailer(true);
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $message_id  = $_POST['message_id'];
        $username    = $_POST['username'];
        $email       = $_POST['email'];
        $phone       = $_POST['phone'];
        $subject     = $_POST['subject'];

        $username    = $this->filter_data($username, FILTER_SANITIZE_STRING);
        $email       = $this->filter_data($email, FILTER_SANITIZE_STRING);
        $phone       = $this->filter_data($phone, FILTER_SANITIZE_NUMBER_INT);
        $subject     = $this->filter_data($subject, FILTER_SANITIZE_STRING);

        $data = [
          'username' => $username,
          'email' => $email,
          'phone' => $phone,
          'subject' => $subject,
          'emailError' => '',
          'usernameError' => '',
          'phoneError' => '',
          'subjectError' => '',

          'count' => $this->message->select_single_message_data($message_id)['count'],
          'row'   => $this->message->select_single_message_data($message_id)['row']
        ];


        if(empty($data['username'])){
          $data['usernameError'] = 'Username can not be empty';
        }
        if(empty($data['email'])){
          $data['emailError'] = 'email can not be empty';
        }
        if(filter_var($data['email'], FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE) == null){
          $data['emailError'] = 'not valid email';
        }
        if( empty($data['phone']) ){
          $data['phoneError'] = 'phone can not be empty';
        }
        if(empty($data['subject'])){
          $data['subjectError'] = 'subject can not be empty';
        }

    if( empty($data['usernameError']) && empty($data['emailError']) && empty($data['phoneError']) && empty($data['subjectError']) ){
            try {

                //Server settings
               //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                     //show message on success or failed output
               $mail->isSMTP();                                           //Send using SMTP
               $mail->Host       = 'smtp.titan.email';                    //Set the SMTP server to send through
               $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
               $mail->Username   = 'hoxuantailoc1603@gmail.com';                     //SMTP username
               $mail->Password   = '123456';                               //SMTP password
               $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
               $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                //Recipients
                $mail->setFrom('hoxuantailoc1603@gmail.com', 'Mailer');
                $mail->addAddress($email, $username);     //Add a recipient
                $mail->addReplyTo('hoxuantailoc1603@gmail.com', 'Information');

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "we are sorry about make you waste your time for us";
                $mail->Body    = "{$subject}";
                if($mail->send()){
                  $data['success'] = 'good success send message';
                  $this->view('contact/reply_message', $data);
                }else{
                  $data['error'] = 'somthing has been wrong try again later';
                  $this->view('contact/reply_message', $data);
                }
                } catch (Exception $e) {
                     $data['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    $this->view('contact/reply_message', $data);
                }
         }else{
           //echo 'error';
           $data['error'] = 'there somthing errora add date';
           $this->view('contact/reply_message', $data);
         }
    }else{
      $this->redirect('dashboard');
    } // end $_SERVER['REQUEST_METHOD']

  }


  final public function delete($id){
    if(isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page'])){
       $page = $_GET['page'];
       $results_per_page = $this->results_per_page;
       $start_from = ($page - 1) * $results_per_page;
     }else{
       return $this->redirect('page404');
     }
    $data = [
      'count' => $this->message->select_message_data($start_from, $results_per_page)['count'],
      'row'   => $this->message->select_message_data($start_from, $results_per_page)['row']
    ];
    if($this->message->delete_message($id) == 'success'){
      $data['success'] = 'delete success';
      $this->view('contact/messages', $data);
    }else{
      $data['error']   = 'there is an error when delete data';
      $this->view('contact/messages', $data);
    }

  } // end delete


}
