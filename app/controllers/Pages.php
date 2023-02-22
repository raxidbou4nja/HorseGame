<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      if(isLoggedIn()){
        redirect('comptes');
      }
      $this->view('pages/index');
    }
  }