<?php
class Users extends Controller{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    //fetch All user
    public function index(){
       if(isLoggedOut()){
          return redirect('users/login');
      }
        $info = $this->userModel->getUserById($_SESSION['user_id']);

        $this->view('user/index',  ['info' => $info]);
    }

    public function register(){
        if(isLoggedIn())
            {
              return redirect('users');
            }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if ($_SERVER['HTTP_REFERER'] != current_url()) 
            {
                   return redirect('users/register');
            }
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'terms_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];

            //valide name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter your Name';
            }

            //validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{
                //check for email
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email already exist';
                }
            }

            //validate password 
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter your password';
            }elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be atleast six characters';
            }

            //validate confirm password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm password';
            }else{
                if($data['password'] != $data['confirm_password'])
                {
                    $data['confirm_password_err'] = 'Password does not match';
                }
            }

            //valide name
            if(@$_POST['check_terms'] != "1"){
                $data['terms_err'] = 'Please Accept Terms Of Use';
            }


            //make sure error are empty
            if(empty($data['name_err'])  && empty($data['email_err']) && empty($data['password_err']) && empty($data['comfirm_password_err']) && @$_POST['check_terms'] != "1" ){
                $data['password'] = $data['password'];
                if($this->userModel->register($data)){
                    flash('register_success', 'you are registerd you can login now');
                    redirect('users/login');
                }
            }else{
                $this->view('user/register', $data);
            }
        }else{
            //init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'terms_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];
            //load view
            $this->view('user/register', $data);          
        }
    }


    public function login(){
           if(isLoggedIn()){
              return redirect('users');
          }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if ($_SERVER['HTTP_REFERER'] != current_url()) 
            {
                   return redirect('users');
            }

           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
           $data = [
               'email' => trim($_POST['email']),
               'password' => trim($_POST['password']),
               'email_err' => '',
               'password_err' => ''
           ];

            //validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                    //user found
                }else{
                    $data['email_err'] = 'User not found';
                }
            }

            //validate password 
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter your password';
            }elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be atleast six characters';
            }
            
            //make sure error are empty
            if(empty($data['email_err']) && empty($data['password_err'])){
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if($loggedInUser){
                    //create session
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['password_err'] = 'Password incorrect';
                    $this->view('user/login', $data);
                }
            }else{
                $this->view('user/login', $data);
            }

        }else{
            //init data f f
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            //load view
            $this->view('user/login', $data);          
        }
    }


public function profile(){

        if(isLoggedOut()){
           return redirect('users/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if ($_SERVER['HTTP_REFERER'] != current_url()) 
            {
                   return redirect('users');
            }
           // process form
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            //valide name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter First Name';
            }


            //validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{
                //check for email
                if($this->userModel->findUserByEmailAndId($data['email'], $_SESSION['user_id'])){
                    $data['email_err'] = 'Email already exist';
                }
            }

            //validate password 
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter your password';
            }elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be atleast six characters';
            }

            //make sure error are empty
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) ){
                $data['password'] = $data['password'];

                if($this->userModel->updateUser($data, $_SESSION['user_id'])){
                    flash('account_message', 'Your Account Has Been Updated.');
                    redirect('users/profile');
                }
            }else{
                $this->view('user/profile', $data);
            }
        }else{
           $info = $this->userModel->getUserById($_SESSION['user_id']);
           $data = [

                'info' => $info,
                'name' => $info->name,
                'email' => $info->email,
                'password' => $info->password,
                'name_err' => '',
                'email_err' => '',
                'password_err' => ''

            ];
            $this->view('user/profile', $data);
        }
    }



public function deposit(){

        if(isLoggedOut()){
           return redirect('users/login');
        }

          $info = $this->userModel->getUserById($_SESSION['user_id']);

           $data = [

                'info' => $info

            ];

            if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                if ($_SERVER['HTTP_REFERER'] != current_url()) {
                   return redirect('users');
                }

                if ($info->level < 20) {
                    flash('account_message', 'Failed To Add 100$ To Your Account. Game Over');
                    return redirect('users/deposit');
                }
                
                if($this->userModel->updateUserCredit(100, $_SESSION['user_id']) && $this->userModel->updateUserLevel(-20, $_SESSION['user_id'])){

                    flash('account_message', '100$ Credit has been Added Successfully');
                    redirect('users/deposit');

                }else{
                    $this->view('user/deposit', $data);
                }
            }else{
                $this->view('user/deposit', $data);
            }
    }
    //fetch All user
/*    public function deleteCompte($id){
        if(isLoggedOut()){
           return redirect('users/login');
        }
        
        if($this->userModel->SoftDeleteCompte($id)){
                    flash('account_message', 'Account Has Been Deleted.');
                    redirect('users/index');
                }else{
                    redirect('users/index');
                }
    }*/

    //setting user section variable
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;
        redirect('users/index');
    }

    //logout and destroy user session
    public function log_out(){
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        session_destroy();
        redirect('users/login');
    }
}