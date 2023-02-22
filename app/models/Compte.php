<?php
class Compte {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getComptes(){
        $this->db->query('SELECT *
                            FROM Comptes 
                            WHERE deleted_at IS NUll
                            ORDER BY created_at DESC');
        $result = $this->db->resultSet();
        return $result;
    }

    //register new user
    public function register($data){
        $this->db->query('INSERT INTO comptes (prenom, nom, email, tel, mot_de_passe, created_at) VALUES (:prenom, :nom, :email, :tel, :mot_de_passe, now())');
        $this->db->bind(':prenom', $data['prenom']);
        $this->db->bind(':nom', $data['nom']);
        $this->db->bind(':tel', $data['tel']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mot_de_passe', $data['mot_de_passe']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateCompte($data, $id){

        $this->db->query('UPDATE comptes SET prenom = :prenom, nom = :nom, email = :email, tel = :tel, mot_de_passe = :mot_de_passe, updated_at = now(), etat = :etat WHERE id = :id');

        $this->db->bind(':prenom', $data['prenom']);
        $this->db->bind(':nom', $data['nom']);
        $this->db->bind(':tel', $data['tel']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mot_de_passe', $data['mot_de_passe']);
        $this->db->bind(':etat', $data['etat']);
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM comptes WHERE email = :email');
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
        $this->db->query('SELECT * FROM comptes WHERE email = :email AND id != :id');
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
    public function login($email, $mot_de_passe){
        $this->db->query('SELECT * FROM comptes where email = :email');
        $this->db->bind(':email', $email);
       
        $row = $this->db->single();

        $db_mot_de_passe = $row->mot_de_passe;

        if($mot_de_passe == $db_mot_de_passe){
            return $row;
        }else{
            return false;
        }
    }

    public function getUserById($id){
        $this->db->query('SELECT * FROM comptes WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return redirect('comptes/index');
        }
    }

    //delete a Compte
    public function SoftDeleteCompte($id){
        $this->db->query('UPDATE comptes SET deleted_at = now() WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

}


}