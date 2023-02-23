<?php
class User extends Controller{
    public function __construct()
    {
        $this->userModel = $this->model('Compte');
    }

    //fetch All user
    public function index(){
//        if(isLoggedOut()){
//           return redirect('user/login');
//        }
        $data = $this->userModel->getComptes();
        $data = [
            'comptes' => $data
        ];
        $this->view('user/new_game', $data);
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // process form
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = [
                'name' => trim($_POST['name']),
                'nom' => trim($_POST['nom']),
                'email' => trim($_POST['email']),
                'tel' => trim($_POST['tel']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];

            //valide name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter First Name';
            }

            if(empty($data['nom'])){
                $data['nom_err'] = 'Please enter Last Name';
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
            //Validate Tel
            if(empty($data['tel'])){
                $data['tel_err'] = 'Please enter your Number Phone';
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

            //make sure error are empty
            if(empty($data['name_err']) && empty($data['nom_err']) && empty($data['email_err']) && empty($data['tel_err']) && empty($data['password_err']) && empty($data['comfirm_password_err'])){
                $data['password'] = $data['password'];
                if($this->userModel->register($data)){
                    flash('register_success', 'you are registerd you can login now');
                    redirect('user/login');
                }
            }else{
                $this->view('user/register', $data);
            }
        }else{
            //init data
            $data = [
                'name' => '',
                'nom' => '',
                'email' => '',
                'tel' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];
            //load view
            $this->view('user/register', $data);          
        }
    }



    public function add(){
        if(isLoggedOut()){
           return redirect('user/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // process form
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = [
                'name' => trim($_POST['name']),
                'nom' => trim($_POST['nom']),
                'email' => trim($_POST['email']),
                'tel' => trim($_POST['tel']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];

            //valide name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter First Name';
            }

            if(empty($data['nom'])){
                $data['nom_err'] = 'Please enter Last Name';
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
            //Validate Tel
            if(empty($data['tel'])){
                $data['tel_err'] = 'Please enter your Number Phone';
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

            //make sure error are empty
            if(empty($data['name_err']) && empty($data['nom_err']) && empty($data['email_err']) && empty($data['tel_err']) && empty($data['password_err']) && empty($data['comfirm_password_err'])){
                $data['password'] = $data['password'];
                if($this->userModel->register($data)){
                    flash('account_message', 'New account Has Been Added');
                    redirect('user/index');
                }
            }else{
                $this->view('user/add', $data);
            }
        }else{
            //init data
            $data = [
                'name' => '',
                'nom' => '',
                'email' => '',
                'tel' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];
            //load view
            $this->view('user/add', $data);          
        }
    }


    public function edit($id){

        if(isLoggedOut()){
           return redirect('user/login');
        }
               if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // process form
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = [
                'name' => trim($_POST['name']),
                'nom' => trim($_POST['nom']),
                'email' => trim($_POST['email']),
                'tel' => trim($_POST['tel']),
                'etat' => trim($_POST['etat']),
                'password' => trim($_POST['password']),
                'name_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'password_err' => ''
            ];

            //valide name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter First Name';
            }

            if(empty($data['nom'])){
                $data['nom_err'] = 'Please enter Last Name';
            }

            //validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{
                //check for email
                if($this->userModel->findUserByEmailAndId($data['email'], $id)){
                    $data['email_err'] = 'Email already exist';
                }
            }
            //Validate Tel
            if(empty($data['tel'])){
                $data['tel_err'] = 'Please enter your Number Phone';
            }
            //validate password 
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter your password';
            }elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be atleast six characters';
            }

            //make sure error are empty
            if(empty($data['name_err']) && empty($data['nom_err']) && empty($data['email_err']) && empty($data['tel_err']) && empty($data['password_err']) ){
                $data['password'] = $data['password'];

                if($this->userModel->updateCompte($data,$id)){
                    flash('account_message', $data['nom']."'s ".'Account Has Been Updated.');
                    redirect('user/index');
                }
            }else{
                $this->view('user/edit', $data);
            }
        }else{
           $info = $this->userModel->getUserById($id);
           $data = [
                'id' => $info->id,
                'name' => $info->name,
                'nom' => $info->nom,
                'email' => $info->email,
                'tel' => $info->tel,
                'etat' => $info->etat,
                'password' => $info->password,
                'confirm_password' => $info->password,
                'name_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'etat_err' => ''

            ];
            $this->view('user/edit', $data);
        }
    }


    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // process form
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


    //fetch All user
    public function deleteCompte($id){
        if(isLoggedOut()){
           return redirect('user/login');
        }
        
        if($this->userModel->SoftDeleteCompte($id)){
                    flash('account_message', $id."'s ".'Account Has Been Deleted.');
                    redirect('user/index');
                }else{
                    redirect('user/index');
                }
    }

    //setting user section variable
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;
        redirect('user/index');
    }

    //logout and destroy user session
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        session_destroy();
        redirect('user/login');
    }
}