<?php
class User {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUsers(){
        $this->db->query('SELECT *
                            FROM users 
                            WHERE deleted_at IS NUll
                            ORDER BY created_at DESC');
        $result = $this->db->resultSet();
        return $result;
    }

    //register new user
    public function register($data){
        $this->db->query('INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :password, now())');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateUser($data, $id){

        $this->db->query('UPDATE users SET name = :name, email = :email, password = :password, updated_at = now() WHERE id = :id');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function updateUserCredit($prize, $userid){

        $this->db->query('UPDATE users SET score = score+:score WHERE id = :id');

        $this->db->bind(':score', $prize);
        $this->db->bind(':id', $userid);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function updateUserLevel($points, $userid){

        $this->db->query('UPDATE users SET level = level+:level WHERE id = :id');

        $this->db->bind(':level', $points);
        $this->db->bind(':id', $userid);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    //find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    //find user by email
    public function findUserByEmailAndId($email,$id){
        $this->db->query('SELECT * FROM users WHERE email = :email AND id != :id');
        $this->db->bind(':email', $email);
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function login($email, $password){
        $this->db->query('SELECT * FROM users where email = :email');
        $this->db->bind(':email', $email);
       
        $row = $this->db->single();

        $db_password = $row->password;

        if($password == $db_password){
            return $row;
        }else{
            return false;
        }
    }

    public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $_SESSION['user_id']);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return redirect('Users/index');
        }
    }

    //delete a Compte
    public function SoftDeleteUser($id){
        $this->db->query('UPDATE users SET deleted_at = now() WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

}


}