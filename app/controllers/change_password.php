<?php


class change_password extends Framework{

  use filter;

   final public function __construct(){
    $this->auth = $this->model('auth');
    $this->categories = $this->model('categories');
  }

   final public function index(){
    return $this->view('account/change_password');
  }

   final public function msg(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'):

      $old_password          = $_POST['old_password'];
      $new_password          = $_POST['new_password'];
      $repeat_new_password   = $_POST['repeat_new_password'];
      // $row = $this->auth->check_if_email_existis( Session::get('email') )['row'];
      // $session_user_id = $this->auth->check_if_email_existis( Session::get('email') )['row']['id'];
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
            if($this->auth->change_user_password( $new_password_hashed, Session::get('id') ) == 'success'):
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

  // AJAX endpoint: POST /change_password/ajax
  final public function ajax(){
    header('Content-Type: application/json; charset=utf-8');
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
      http_response_code(405);
      echo json_encode(['success' => false, 'message' => 'Method not allowed']);
      return;
    }

    if(!Session::check('id')){
      http_response_code(401);
      echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập']);
      return;
    }

    $payload = $_POST;
    if(empty($payload)){
      $raw = file_get_contents('php://input');
      $decoded = json_decode($raw, true);
      if(is_array($decoded)) $payload = $decoded;
    }

    $old_password = isset($payload['old_password']) ? $payload['old_password'] : '';
    $new_password = isset($payload['new_password']) ? $payload['new_password'] : '';
    $repeat_new_password = isset($payload['repeat_new_password']) ? $payload['repeat_new_password'] : '';

    $database_old_password = $this->auth->check_if_email_existis( Session::get('email') )['row']['password'];

    if(!password_verify($old_password, $database_old_password)){
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Mật khẩu cũ không đúng']);
      return;
    }
    if(strlen($new_password) > 20 || empty($new_password) || empty($repeat_new_password)){
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Mật khẩu không hợp lệ']);
      return;
    }
    if($new_password !== $repeat_new_password){
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Mật khẩu mới không khớp']);
      return;
    }

    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    if($this->auth->change_user_password( $new_password_hashed, Session::get('id') ) == 'success'){
      echo json_encode(['success' => true, 'message' => 'Đổi mật khẩu thành công']);
    }else{
      http_response_code(500);
      echo json_encode(['success' => false, 'message' => 'Không thể cập nhật mật khẩu']);
    }
  }

} // end class change_password
