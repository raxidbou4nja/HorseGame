<?php
class Comptes extends Controller{
    public function __construct()
    {
        $this->userModel = $this->model('Compte');
    }

    //fetch All user
    public function index(){
        if(isLoggedOut()){
           return redirect('comptes/login');
        }
        $data = $this->userModel->getComptes();
        $data = [
            'comptes' => $data
        ];
        $this->view('comptes/liste', $data);
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // process form
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = [
                'prenom' => trim($_POST['prenom']),
                'nom' => trim($_POST['nom']),
                'email' => trim($_POST['email']),
                'tel' => trim($_POST['tel']),
                'mot_de_passe' => trim($_POST['mot_de_passe']),
                'confirm_mot_de_passe' => trim($_POST['confirm_mot_de_passe']),
                'prenom_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'mot_de_passe_err' => '',
                'confirm_mot_de_passe_err' => '' 
            ];

            //valide name
            if(empty($data['prenom'])){
                $data['prenom_err'] = 'Please enter First Name';
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
            if(empty($data['mot_de_passe'])){
                $data['mot_de_passe_err'] = 'Please enter your password';
            }elseif(strlen($data['mot_de_passe']) < 6){
                $data['mot_de_passe_err'] = 'Password must be atleast six characters';
            }

            //validate confirm password
            if(empty($data['confirm_mot_de_passe'])){
                $data['confirm_mot_de_passe_err'] = 'Please confirm password';
            }else{
                if($data['mot_de_passe'] != $data['confirm_mot_de_passe'])
                {
                    $data['confirm_mot_de_passe_err'] = 'Password does not match';
                }
            }

            //make sure error are empty
            if(empty($data['prenom_err']) && empty($data['nom_err']) && empty($data['email_err']) && empty($data['tel_err']) && empty($data['mot_de_passe_err']) && empty($data['comfirm_mot_de_passe_err'])){
                $data['mot_de_passe'] = $data['mot_de_passe'];
                if($this->userModel->register($data)){
                    flash('register_success', 'you are registerd you can login now');
                    redirect('comptes/login');
                }
            }else{
                $this->view('comptes/register', $data);
            }
        }else{
            //init data
            $data = [
                'prenom' => '',
                'nom' => '',
                'email' => '',
                'tel' => '',
                'mot_de_passe' => '',
                'confirm_mot_de_passe' => '',
                'prenom_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'mot_de_passe_err' => '',
                'confirm_mot_de_passe_err' => '' 
            ];
            //load view
            $this->view('comptes/register', $data);          
        }
    }



    public function add(){
        if(isLoggedOut()){
           return redirect('comptes/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // process form
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = [
                'prenom' => trim($_POST['prenom']),
                'nom' => trim($_POST['nom']),
                'email' => trim($_POST['email']),
                'tel' => trim($_POST['tel']),
                'mot_de_passe' => trim($_POST['mot_de_passe']),
                'confirm_mot_de_passe' => trim($_POST['confirm_mot_de_passe']),
                'prenom_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'mot_de_passe_err' => '',
                'confirm_mot_de_passe_err' => '' 
            ];

            //valide name
            if(empty($data['prenom'])){
                $data['prenom_err'] = 'Please enter First Name';
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
            if(empty($data['mot_de_passe'])){
                $data['mot_de_passe_err'] = 'Please enter your password';
            }elseif(strlen($data['mot_de_passe']) < 6){
                $data['mot_de_passe_err'] = 'Password must be atleast six characters';
            }

            //validate confirm password
            if(empty($data['confirm_mot_de_passe'])){
                $data['confirm_mot_de_passe_err'] = 'Please confirm password';
            }else{
                if($data['mot_de_passe'] != $data['confirm_mot_de_passe'])
                {
                    $data['confirm_mot_de_passe_err'] = 'Password does not match';
                }
            }

            //make sure error are empty
            if(empty($data['prenom_err']) && empty($data['nom_err']) && empty($data['email_err']) && empty($data['tel_err']) && empty($data['mot_de_passe_err']) && empty($data['comfirm_mot_de_passe_err'])){
                $data['mot_de_passe'] = $data['mot_de_passe'];
                if($this->userModel->register($data)){
                    flash('account_message', 'New account Has Been Added');
                    redirect('comptes/index');
                }
            }else{
                $this->view('comptes/add', $data);
            }
        }else{
            //init data
            $data = [
                'prenom' => '',
                'nom' => '',
                'email' => '',
                'tel' => '',
                'mot_de_passe' => '',
                'confirm_mot_de_passe' => '',
                'prenom_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'mot_de_passe_err' => '',
                'confirm_mot_de_passe_err' => '' 
            ];
            //load view
            $this->view('comptes/add', $data);          
        }
    }


    public function edit($id){

        if(isLoggedOut()){
           return redirect('comptes/login');
        }
               if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // process form
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = [
                'prenom' => trim($_POST['prenom']),
                'nom' => trim($_POST['nom']),
                'email' => trim($_POST['email']),
                'tel' => trim($_POST['tel']),
                'etat' => trim($_POST['etat']),
                'mot_de_passe' => trim($_POST['mot_de_passe']),
                'prenom_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'mot_de_passe_err' => ''
            ];

            //valide name
            if(empty($data['prenom'])){
                $data['prenom_err'] = 'Please enter First Name';
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
            if(empty($data['mot_de_passe'])){
                $data['mot_de_passe_err'] = 'Please enter your password';
            }elseif(strlen($data['mot_de_passe']) < 6){
                $data['mot_de_passe_err'] = 'Password must be atleast six characters';
            }

            //make sure error are empty
            if(empty($data['prenom_err']) && empty($data['nom_err']) && empty($data['email_err']) && empty($data['tel_err']) && empty($data['mot_de_passe_err']) ){
                $data['mot_de_passe'] = $data['mot_de_passe'];

                if($this->userModel->updateCompte($data,$id)){
                    flash('account_message', $data['nom']."'s ".'Account Has Been Updated.');
                    redirect('comptes/index');
                }
            }else{
                $this->view('comptes/edit', $data);
            }
        }else{
           $info = $this->userModel->getUserById($id);
           $data = [
                'id' => $info->id,
                'prenom' => $info->prenom,
                'nom' => $info->nom,
                'email' => $info->email,
                'tel' => $info->tel,
                'etat' => $info->etat,
                'mot_de_passe' => $info->mot_de_passe,
                'confirm_mot_de_passe' => $info->mot_de_passe,
                'prenom_err' => '',
                'nom_err' => '',
                'email_err' => '',
                'tel_err' => '',
                'mot_de_passe_err' => '',
                'confirm_mot_de_passe_err' => '',
                'etat_err' => ''

            ];
            $this->view('comptes/edit', $data);
        }
    }


    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // process form
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
           $data = [
               'email' => trim($_POST['email']),
               'mot_de_passe' => trim($_POST['mot_de_passe']),
               'email_err' => '',
               'mot_de_passe_err' => ''
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
            if(empty($data['mot_de_passe'])){
                $data['mot_de_passe_err'] = 'Please enter your password';
            }elseif(strlen($data['mot_de_passe']) < 6){
                $data['mot_de_passe_err'] = 'Password must be atleast six characters';
            }
            
            //make sure error are empty
            if(empty($data['email_err']) && empty($data['mot_de_passe_err'])){
                $loggedInUser = $this->userModel->login($data['email'], $data['mot_de_passe']);
                if($loggedInUser){
                    //create session
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['mot_de_passe_err'] = 'Password incorrect';
                    $this->view('Comptes/login', $data);
                }
            }else{
                $this->view('Comptes/login', $data);
            }

        }else{
            //init data f f
            $data = [
                'email' => '',
                'mot_de_passe' => '',
                'email_err' => '',
                'mot_de_passe_err' => ''
            ];
            //load view
            $this->view('Comptes/login', $data);          
        }
    }


    //fetch All user
    public function deleteCompte($id){
        if(isLoggedOut()){
           return redirect('comptes/login');
        }
        
        if($this->userModel->SoftDeleteCompte($id)){
                    flash('account_message', $id."'s ".'Account Has Been Deleted.');
                    redirect('comptes/index');
                }else{
                    redirect('comptes/index');
                }
    }

    //setting user section variable
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;
        redirect('comptes/index');
    }

    //logout and destroy user session
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        session_destroy();
        redirect('comptes/login');
    }
}