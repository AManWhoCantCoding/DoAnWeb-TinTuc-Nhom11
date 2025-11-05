<?php


class change_password extends Framework{

  use filter;

  final public function __construct(){
    $this->auth = $this->model('auth');
  }

  final public function index(){
    return $this->view('account/change_password');
  }

  final public function msg(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'):

      $old_password          = $_POST['old_password'];
      $new_password          = $_POST['new_password'];
      $repeat_new_password   = $_POST['repeat_new_password'];
      $database_old_password = $this->auth->check_if_email_existis( Session::get('email') )['row']['password'];

      $data  = [
        'old_password' => $old_password,
        'new_password' => $new_password,
        'repeat_new_password' => $repeat_new_password,
        'database_old_password' => $database_old_password,
        'password_error' => '',
      ];



      $data['old_password'] = $this->filter_data($data['old_password'], FILTER_SANITIZE_STRING);
      $data['new_password'] = $this->filter_data($data['new_password'], FILTER_SANITIZE_STRING);
      $data['repeat_new_password'] = $this->filter_data($data['repeat_new_password'], FILTER_SANITIZE_STRING);

      if(!password_verify($data['old_password'], $data['database_old_password'])):
        $data['password_error'] = 'wrong old password';
      endif;

      if(password_verify($data['old_password'], $data['database_old_password'])):
          if(strlen($data['new_password']) > 20 ):
            $data['password_error'] = 'password must not be more than 15 character and can not be empty';
          endif;
          if(empty($data['new_password']) || empty($data['repeat_new_password'])):
            $data['password_error'] = 'your password can not empty';
          endif;
          if($data['new_password'] !== $data['repeat_new_password']):
            $data['password_error'] = 'new password dose not matched';
          endif;
      endif; // end $old_password === $database_old_password

      if(empty($data['password_error'])):
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            if($this->auth->change_user_password( $new_password_hashed, Session::get('admin_id') ) == 'success'):
                $data['success'] = 'password changed successfully';
                return $this->view('account/change_password', $data);
            else:
                $data['error'] = 'somthing wrong rtying to send data please try again later';
                return $this->view('account/change_password', $data);
            endif;
       else:
        return $this->view('account/change_password', $data);
      endif; // end !isset($data['password_error'])


    else:
      return $this->redirect('change_password');
    endif; // end $_SERVER['REQUEST_METHOD']
  }// end emethod msg

} // end class change_password
