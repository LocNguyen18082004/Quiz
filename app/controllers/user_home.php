<?php 

class user_home extends DController {

    public function __construct(){
        $data = array();
        parent::__construct();
        Session::init();  // Khởi tạo session một lần ở đây
    }

    public function login(){
        $this->load->view('header');
        $this->load->view('login');
        $this->load->view('footer');
    }

    public function login_user(){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    
        $errors = [];
    
        // Kiểm tra email và mật khẩu
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email không hợp lệ";
        }
    
        if (strlen($password) < 3) {
            $errors[] = "Mật khẩu cần ít nhất 3 ký tự";
        }
    
        if (!empty($errors)) {
            $message['msg'] = implode(", ", $errors);
            header('Location:' . BASE_URL . "/user_home/login?msg=" . urlencode(serialize($message)));
            exit();
        }

        $table_user = 'tbl_users';
        $usermodel = $this->load->model('usermodel');
        $hashed_password = md5($password);  // Mã hóa mật khẩu bằng MD5 (khuyến nghị sử dụng password_hash)

        $count = $usermodel->login($table_user, $username, $hashed_password);
    
        if($count == 0){
            $message['msg'] = "Email hoặc mật khẩu sai, xin kiểm tra lại";
            header('Location:' . BASE_URL . "/user_home/login?msg=" . urlencode(serialize($message)));
        } else {
            $result = $usermodel->getLogin($table_user, $username, $hashed_password);
            Session::set('user', true);
            Session::set('email', $result[0]['email']);
            Session::set('name', $result[0]['name']);
            Session::set('user_id', $result[0]['user_id']);
    
            $message['msg'] = "Đăng nhập thành công";
            header('Location:' . BASE_URL . "/index/subject?msg=" . urlencode(serialize($message)));
        }
    }

    public function register(){
        $this->load->view('header');
        $this->load->view('register');
        $this->load->view('footer');
    }

    public function insert_dangky(){
        $table_user = "tbl_users";
    
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
    
        $errors = [];
    
        // Kiểm tra email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email không hợp lệ";
        } else {
            $email_parts = explode('@', $email);
            if (count($email_parts) != 2 || strlen($email_parts[0]) < 6 || !preg_match('/\.com$/', $email)) {
                $errors[] = "Email phải có ít nhất 6 ký tự trước dấu @ và phải kết thúc bằng '.com'.";
            }
        }
    
        // Kiểm tra mật khẩu
        if (strlen($password) < 4) {
            $errors[] = "Mật khẩu phải có ít nhất 4 ký tự.";
        }
    
        // Kiểm tra mật khẩu nhập lại
        if ($password !== $confirm_password) {
            $errors[] = "Mật khẩu nhập lại không khớp với mật khẩu.";
        }
    
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['postData'] = $_POST;
            header('Location:'.BASE_URL."/user_home/register");
            exit;
        }
    
        // Dữ liệu hợp lệ
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => md5($password)  // Mã hóa mật khẩu bằng MD5 (khuyến nghị sử dụng password_hash)
        );
    
        $usermodel = $this->load->model('usermodel');
        $result = $usermodel->insertuser($table_user, $data);
    
        if ($result !== false) {
            $message['msg'] = "Đăng ký thành công";
            header('Location:'.BASE_URL."/user_home/login?msg=".urlencode(serialize($message)));
        } else {
            $message['msg'] = "Đăng ký thất bại";
            header('Location:'.BASE_URL."/user_home/register?msg=".urlencode(serialize($message)));
        }
    }

    public function logout(){
        Session::destroy();
        $message['msg'] = "Đăng xuất thành công";
        header('Location:'.BASE_URL."/user_home/login?msg=".urlencode(serialize($message)));
    }
}

?>