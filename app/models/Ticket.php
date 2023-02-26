<?php
class Ticket {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }


    //PURCHASE A TICKET OR MORE TICKETS
    public function purchaseTickets($winners,$result, $pack_serial, $pack){
        $this->db->query('INSERT INTO tickets (userid, winners, result, pack_serial, pack) VALUES (:userid,:winners, :result, :pack_serial, :pack)');
        $this->db->bind(':userid', $_SESSION['user_id']);
        $this->db->bind(':winners', $winners);
        $this->db->bind(':result', $result);
        $this->db->bind(':pack_serial', $pack_serial);
        $this->db->bind(':pack', $pack);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateTicket($numbers, $num,$result,$status){

        $this->db->query('UPDATE tickets SET numbers = :numbers, result = :result, status = :status WHERE userid = :userid AND id = :id AND status IS NULL');

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

    public function findAvailableTicketByNumber($id){

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

        $this->db->query('SELECT * FROM tickets WHERE winners = :winners AND userid = :userid ORDER BY status ASC');
        $this->db->bind(':winners', $winners);
        $this->db->bind(':userid', $_SESSION['user_id']);

        $result = $this->db->resultSet();

        if($this->db->rowCount() > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getHistoryTicketsByWinners($winners){

        $this->db->query('SELECT * FROM tickets WHERE winners = :winners AND userid = :userid ORDER BY id DESC LIMIT 50');
        $this->db->bind(':winners', $winners);
        $this->db->bind(':userid', $_SESSION['user_id']);

        $result = $this->db->resultSet();

        if($this->db->rowCount() > 0){
            return $result;
        }else{
            return false;
        }
    }


    public function getLastTicketByWinners($winners){

        $this->db->query('SELECT * FROM tickets WHERE winners = :winners AND userid = :userid ORDER BY id DESC LIMIT 1');
        $this->db->bind(':winners', $winners);
        $this->db->bind(':userid', $_SESSION['user_id']);

        $result = $this->db->single();

        if($this->db->rowCount() > 0){
            return $result;
        }else{
            return false;
        }
    }


    public function countTicketsByWinners($winners){
        $this->db->query('SELECT * FROM tickets WHERE winners = :winners AND userid = :userid AND  status IS NULL');
        $this->db->bind(':winners', $winners);
        $this->db->bind(':userid', $_SESSION['user_id']);
        $this->db->single();
        return $this->db->rowCount();

    }


    public function getTicketByWinners($winners){
        $this->db->query('SELECT * FROM tickets WHERE winners = :winners AND userid = :userid AND status IS NULL');
        $this->db->bind(':winners', $winners);
        $this->db->bind(':userid', $_SESSION['user_id']);
        $this->db->single();
        return $this->db->rowCount();

    }


    public function updatePlayedTicketsByPackSerial($pack_serial,$hints){
        $this->db->query('UPDATE tickets SET played = played+1, hints = :hints WHERE pack_serial = :pack_serial AND userid = :userid');
        $this->db->bind(':pack_serial', $pack_serial);
        $this->db->bind(':hints', $hints);
        $this->db->bind(':userid', $_SESSION['user_id']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
        }



}