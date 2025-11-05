<?php



class contact_us extends Framework{

  use filter;
  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->contact = $this->model('contact');
  }
  final public function index(){
    $this->view('account/contact_us');
  }

  final public function msg(){

      if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

       $email    = $_POST['email'];
       $fullname = $_POST['fullname'];
       $phone    = $_POST['phone'];
       $subject  = $_POST['subject'];
       $created_at   = date('Y-m-d H-i-s');

       $data = [
         'fullname' => $fullname,
         'fullnameError' => '',
         'email' => $email,
         'emailError' => '',
         'phone' => $phone,
         'phoneError' => '',
         'subject' => $subject,
         'subjecteError' => '',
         ];

       $data['fullname'] = $this->filter_data($data['fullname'], FILTER_SANITIZE_STRING);
       $data['email']    = $this->filter_data($data['email'], FILTER_SANITIZE_EMAIL);
       $data['phone']    = $this->filter_data($data['phone'], FILTER_SANITIZE_NUMBER_INT);
       $data['subject']  = $this->filter_data($data['subject'], FILTER_SANITIZE_STRING);

        if(empty( $data['email'] )){
             $data['emailError'] = 'email can not be empty';
        }
        if(filter_var( $data['email'] , FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE) == null){
             $data['emailError'] = 'not valid email';
        }

       if(empty( $data['phone'] )){
            $data['phoneError'] = 'user phone can not be empty';
       }
       if( !is_numeric( $data['phone'] ) ){
            $data['phoneError'] = 'not valid phone';
       }



       if(strlen($data['fullname']) > 40 || empty($data['fullname'])){
         $data['fullnameError'] = 'username must not be more than 40 character and can not be empty';
       }
       if(strlen($data['subject']) > 200 || empty($data['subject'])){
         $data['subjecteError'] = 'Subject must not be more than 200 character and can not be empty';
       }
       if(empty($data['emailError']) && empty($data['fullnameError']) &&
          empty($data['phoneError']) && empty($data['subjecteError'])){
        if($this->contact->add_contact($email, $fullname, $phone, $subject, $created_at) == 'success'){
             $data['success'] = 'your message has been sent.</p>';
             $this->view('account/contact_us', $data);
          }else{
             $data['error'] = 'you trying something invalid try again la';
             $this->view('account/contact_us', $data);
          } // end insert_pwd
       }else{
         $this->view('account/contact_us', $data);
       }




     }else{
       $this->redirect('home');
     } // end REQUEST_METHOD post

  } // end msg

} // end class reset_password
