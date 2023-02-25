<?php
class Ticket {
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

    //register new user
    public function purchaseTickets($winners){
        $this->db->query('INSERT INTO tickets (userid, winners) VALUES (:userid,:winners)');
        $this->db->bind(':userid', $_SESSION['user_id']);
        $this->db->bind(':winners', $winners);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateTicket($numbers, $num,$result,$status){

        $this->db->query('UPDATE tickets SET numbers = :numbers,result = :result,status = :status WHERE userid = :userid AND id = :id AND status IS NULL');

        $this->db->bind(':numbers', $numbers);
        $this->db->bind(':status', $status);
        $this->db->bind(':result', $result);
        $this->db->bind(':userid', $_SESSION['user_id']);
        $this->db->bind(':id', $num);

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


    public function findTicketsByNumber($id){
        $userid =  $_SESSION['user_id'];
        $this->db->query('SELECT * FROM tickets WHERE id = :id AND userid = :userid');
        $this->db->bind(':id', $id);
        $this->db->bind(':userid', $userid);

        $result = $this->db->single();

        if($this->db->rowCount() > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function findAvailableTicketsByNumber($id){

        $this->db->query('SELECT * FROM tickets WHERE id = :id AND userid = :userid AND status IS NULL');
        $this->db->bind(':id', $id);
        $this->db->bind(':userid', $_SESSION['user_id']);

        $result = $this->db->single();

        if($this->db->rowCount() > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getAvailableTicketsByWinners($winners){

        $this->db->query('SELECT * FROM tickets WHERE winners = :winners AND userid = :userid AND status IS NULL');
        $this->db->bind(':winners', $winners);
        $this->db->bind(':userid', $_SESSION['user_id']);

        $result = $this->db->single();

        if($this->db->rowCount() > 0){
            return $this->db->rowCount();
        }else{
            return false;
        }
    }

    public function getTicketsByWinners($winners){

        $this->db->query('SELECT * FROM tickets WHERE winners = :winners AND userid = :userid ORDER BY status ASC,id DESC LIMIT 15');
        $this->db->bind(':winners', $winners);
        $this->db->bind(':userid', $_SESSION['user_id']);

        $result = $this->db->resultSet();

        if($this->db->rowCount() > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getTicketByWinners($winners){
        $this->db->query('SELECT * FROM tickets WHERE winners = :winners AND status IS NULL');
        $this->db->bind(':winners', $winners);
        $this->db->single();
        return $this->db->rowCount();

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