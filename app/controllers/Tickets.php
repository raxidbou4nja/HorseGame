<?php
class Tickets extends Controller{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->ticketModel = $this->model('Ticket');
    }

    //fetch All user
    public function index(){
       if(isLoggedOut()){
          return redirect('users/login');
      }
          // Redirect To games Page;
          return redirect('users');

    }



    //fetch All user
    public function winners($winners){
       if(isLoggedOut()){
          return redirect('users/login');
      }

        $winners_tickets = $this->ticketModel->getTicketsByWinners($winners);
        if (!$winners_tickets) {
          return redirect('users');
        }

        $available = $this->ticketModel->countTicketsByWinners($winners);
        $last_ticket = $this->ticketModel->getLastTicketByWinners($winners);
        $history_tickets = $this->ticketModel->getHistoryTicketsByWinners($winners);

        $info = $this->userModel->getUserById($_SESSION['user_id']);
        //$info = ['articles' => $winners, 'data' => $data ];
        $this->view('ticket/winners', ['info' => $info, 'winners' => $winners_tickets, 'available' => $available, 'last_ticket' => $last_ticket, 'historyTickets' => $history_tickets]);
    }


    public function buyTickets(){
       
      if(isLoggedOut())
      {
          return redirect('users/login');
      }

      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if ($_SERVER['HTTP_REFERER'] != current_url()) 

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

        $user = $this->userModel->getUserById($_SESSION['user_id']);

        $winners = $this->ticketModel->getAvailableTicketsByWinners($_POST['winners']);

        if ($winners) 
        {
          return false;
        }

        $winners = (int) $_POST['winners'];
        $pack =  (int) $_POST['pack'];
        //$info = $this->userModel->getUserById($_SESSION['user_id']);

        if ($winners < 1 || $winners > 5 || empty($winners)) {
          return false;
        }

        if ($pack < 3 || $pack > 5 || empty($pack)) {
          return false;
        }

        $cost = -$winners*$pack;


        if ($user->score < $winners*$pack) {
           $text = '<div class="h4 mb-1 alert alert-danger">You Don\'t Have Enough money</div>' ;
           $text .=  '<a type="submit" href="'.URLROOT.'/users/deposit" class="play-btn mt-3 text-dark">Deposit Money</a>';
           echo $text;
          return false;
        }


        $this->userModel->updateUserCredit($cost, $_SESSION['user_id']);

        $random_result = json_encode(random_numbers($winners));
        //// Give a unique Pack Number

        $pack_serial = time();

        for ($i=0; $i < $pack; $i++) { 
            if (!$this->ticketModel->purchaseTickets($_POST['winners'],$random_result,$pack_serial,$pack)) {
              return false;
            }
        }

           $text = '<div class="h3 mb-1">You Have Tickets</div>' ;
           $text .= '<div class="h2">'.$pack.'</div>' ;
           $text .=  '<a type="submit" href="'.URLROOT.'/tickets/winners/'.@$_POST['winners'].'" class="play-btn mt-3 text-dark">Try You Chance</a>';
           echo $text;
        
    }
  }


    //fetch All user
    public function checkAvailableWinners(){
        
        if(isLoggedOut()){
           return redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
        
        if($num_of_tickets = $this->ticketModel->getAvailableTicketsByWinners(@$_POST['winners'])){
           $text = '<div class="h3 mb-1">You Have Tickets</div>' ;
           $text .= '<div class="h2">'.$num_of_tickets.'</div>' ;
           $text .=  '<a type="submit" href="'.URLROOT.'/tickets/winners/'.@$_POST['winners'].'" class="play-btn mt-3 text-dark">Try You Chance</a>';
           echo $text;
         }
     }
    }

    //setting user section variable
    public function playTicket(){
        if(isLoggedOut()){
           return redirect('users/login');
        }
        /// DECLARING MESSAGE OF RESULT
        $message['error'] = "";
        $message['result'] = "";
        $message['status'] = "";
        $message['sound'] = "";

        // DETECT POST METHOD
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

         $ticket = $this->ticketModel->findAvailableTicketByNumber(@$_POST['num']);

        if (!$ticket)
        {
          return false;
        }

           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           /// GENERATE A SET OF NUMBERS 
           $random_result = $ticket->result;
           // GET SUBMITTED NUMBERS
           $submitted_numbers = string_to_json(@$_POST['numbers']);

           // MAKE THEM ARRAY AND CHECK SUBMITTED NUMBERS
          $submitted_numbers_array = json_decode($submitted_numbers,true);



          if(check_duplicate($submitted_numbers_array)){
            $message['error'] = "You Inserted Duplicated Number!";
            echo json_encode($message);
            return false;
          }

          if(!check_ints($submitted_numbers_array)){
            $message['error'] = "Use Numbers Between 1 until ".HORSES_NUMBERS_LIMIT."!";
            echo json_encode($message);
            return false;
          }

          if(!check_ints($submitted_numbers_array)){
            $message['error'] = "Use Only Numbers Between 1 until ".HORSES_NUMBERS_LIMIT."!";
            echo json_encode($message);
            return false;
          }

          if(check_range($submitted_numbers_array)){
            $message['error'] = "Use Numbers Between 1 until ".HORSES_NUMBERS_LIMIT."!";
            echo json_encode($message);
            return false;
          }



          $random_result_array = json_decode($random_result,true);

          $arrays_diff = array_intersect($submitted_numbers_array, $random_result_array);


          if ($submitted_numbers_array == $random_result_array) {
            $sql_status = 'O'; /// MEANS 'ORDER'
            $prize = $ticket->winners*100;
            $this->userModel->updateUserCredit($prize,$_SESSION['user_id']);
            $this->userModel->updateUserLevel(+80,$_SESSION['user_id']);
          }
          else if (count($arrays_diff) == $ticket->winners)  {
            $sql_status = 'D'; /// MEANS 'DESORDER'
            $prize = $ticket->winners*50;
            $this->userModel->updateUserCredit($prize,$_SESSION['user_id']);
            $this->userModel->updateUserLevel(+20,$_SESSION['user_id']);
          }
          else if ($ticket->winners > 4 AND count($arrays_diff) > 4) {

            $sql_status = 'B'; /// MEANS 'BONUS'
            $prize = $ticket->winners*4;
            $this->userModel->updateUserCredit($prize,$_SESSION['user_id']);
            $this->userModel->updateUserLevel(+10,$_SESSION['user_id']);


          } 
          else if ($ticket->winners > 3 AND count($arrays_diff) > 3) {

            $sql_status = 'B'; /// MEANS 'BONUS'
            $prize = $ticket->winners*3;
            $this->userModel->updateUserCredit($prize,$_SESSION['user_id']);
            $this->userModel->updateUserLevel(+5,$_SESSION['user_id']);

          } 
          else if ($ticket->winners > 2 AND count($arrays_diff) > 2) {

            $sql_status = 'B'; /// MEANS 'BONUS'
            $prize = $ticket->winners*2;
            $this->userModel->updateUserCredit($prize,$_SESSION['user_id']);
            $this->userModel->updateUserLevel(+2,$_SESSION['user_id']);

          } 
          else
          {
            $sql_status = 'L'; /// MEANS 'LOSS'
            $this->userModel->updateUserLevel(+1,$_SESSION['user_id']);
          }

          // Return Status alert abbr_status('L' OR 'O' OR 'D')
          $status = abbr_status($sql_status,@$prize);

          $show_result = result_diff($random_result_array,$submitted_numbers_array);
          foreach($submitted_numbers_array as $check_win)
            {

            }

              $message['result'] = $show_result;
              $message['status'] = $status;
              $message['sound'] =  $sql_status;
         }
            

          $hints = json_decode($ticket->hints,true);
          $submitted = json_decode(string_to_json(@$_POST['numbers']), true);
          $random = json_decode($ticket->result,true);

          $hints_array = make_hints_array(@$submitted,$random,$hints);

          $hints = json_encode($hints_array);
          

          $message['hints'] = hintsPicker($hints_array, $ticket->winners);
          
          $user = $this->userModel->getUserById($_SESSION['user_id']);

          $message['new_score'] = $user->score;
          $message['new_level'] = $user->level;


          echo json_encode($message);


        $ticket = $this->ticketModel->updatePlayedTicketsByPackSerial(@$ticket->pack_serial,$hints);

        if(!$this->ticketModel->updateTicket(@$submitted_numbers,@$_POST['num'],$random_result,$sql_status))
        {

          $message['error'] = "ERROR 404";
          return json_encode($message);
        }
    }

}