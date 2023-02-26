<?php require APPROOT . '/views/user/incl/user_header.php'; ?>
<title>Game Of <?php echo $data['winners'][0]->winners; ?> Winners</title>
<style>
  
.history-ticket-result div {
    width: 30px;
    height: 30px;
    border-radius: 28px;
    text-align: center;
    font-size: 17px;
    font-weight: bold;
    color: white;
    line-height: 32px;
    margin: 2px;
}
.result_popup{
    top: 28%;
    width: 400px;
    z-index: 10001;
    text-align: center;
    position: absolute;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    font-size: 50px;
}

#win_alert{
  background: #4caf5063;
}

#disorder_alert{
  background: #d1ecf191;
}
#lose_alert{
  background: #ff00004a;
}
#bonus_alert{
  background: #00bcd461;
}
</style>


</head>
<body>
<div class="container">
  <?php require APPROOT . '/views/user/incl/user_navbar.php'; ?>
  <div class="row bg-white mt-3 mb-3">
    <div class="col-md-12 text-center">
      <div class="row">
        <div class="container m-3 h2">
          <div class="h1"><i class="fa fa-trophy fa-2x"></i></div>
            PRIZES
        </div>
        <div class="col-md-6 h3">
          <div class="font-weight-bold prize-head" style="background: #2196f3;">ORDER</div>
            <div class="prize-body" style="border-color: #2196f3;">
                <span id="order_prize">$<?php echo ($data['winners'][0]->winners)*100; ?></span>
              </div>
        </div>
        <div class="col-md-6 h3">
          <div class="font-weight-bold prize-head" style="background: #3f51b5;">DISORDER</div>
          <div class="prize-body" style="border-color: #3f51b5;">
            <span id="disorder_prize">$<?php echo ($data['winners'][0]->winners)*50; ?></span>
          </div>
        </div> 
        <div class="container">
          <?php 
          if ($data['last_ticket']->played == $data['last_ticket']->pack) 
          {
            $active_last = 0;
            $result_or_hint = "Last Round Result";
          }
          else
          {
            $active_last = 1;
            $result_or_hint = "This Round Hints";
          }

           ?>

          <div class="font-weight-bold prize-head" style="background: #6c757d; margin-bottom: -20px;"><?php echo $result_or_hint ?></div>
          <div class="ticket-result hintspicker col-md-12 text-center d-flex justify-content-center mt-2" style="    padding: 20px; border: 3px solid #6c757d; width: fit-content; margin: auto;">

              <?php 
              if($active_last == 0){
                echo result_div($data['last_ticket']->result);
              }
              else
              {
                $hints_array = json_decode($data['last_ticket']->hints,true);
                echo hintsPicker($hints_array, $data['last_ticket']->winners);
              } 

              ?>
            </div>
        </div>       
      </div>
      <hr>


      <?php 

      $i = 1; foreach ($data['winners'] as $winner):
        if ($winner->pack != $winner->played):


        if ($winner->status != '' ) 
        {
          $history = 'old';
          $disabled = 'disabled';

          $result = json_decode($winner->result);
           // GET SUBMITTED NUMBERS
          $numbers = json_decode($winner->numbers);
          $show_result = result_diff($result, $numbers);
          $show_status = abbr_status($winner->status);
          if($data['available'] == 0){
            $show_result = result_diff($numbers, $result);
          }

        }
        else
        {
          $history = 'new';
          $disabled = '';
          $show_result = '';
          $show_status = '';
        }
          ?>
        <div class="form-group row p-3 <?php echo $history ?>">
          <div class="col-sm-3 h4 m-auto">
            Tickect #<?php echo $winner->id ?>
            <div class="ticket-result col-md-12 text-center d-flex justify-content-center" id="status-<?php echo $winner->id ?>"><?php echo $show_status ?></div>
            </div>
          <div class="col-sm-7 py-3" id="tickets-holder-<?php echo $winner->id ?>">
            <?php if ($history == 'new'): 

              //// SHOW IF IT'S AVAILABLE

              ?>
              <div id="numbers-holder-<?php echo $winner->id ?>">
                <?php for ($i=0; $i < $winner->winners; $i++): ?>
                <input id="<?php echo $i ?>" type="text" ticket="<?php echo $winner->id ?>" class="ticket_number ticket-<?php echo $winner->id ?>" <?php echo $disabled;  ?> value="<?php $numbers = json_decode($winner->numbers); echo @$numbers[$i] ?>" readonly>
                <?php endfor ?>
              </div>
              <div class="message text-danger mt-2" id="message-<?php echo $winner->id ?>"></div>
              <div class="picker text-danger mt-2" id="picker-<?php echo $winner->id ?>">
                <?php 

                for ($i=1; $i <= HORSES_NUMBERS_LIMIT; $i++) { 
                  echo '<button id="picker_btn_'.$i.'" class="picker_btn btn btn-info m-1" num="'.$winner->id.'">'.$i.'</button>';
                  echo ($i== 10)? '<br>':'';
                }

                 ?>
                 <br>
                 <button class="clear_all btn btn-primary m-1"><i class="fa fa-times"></i> Clear</button>
              </div>
            <?php 

              //// SHOW IF IT'S AVAILABLE

              endif ?>
              <div class="ticket-result col-md-12 text-center d-flex justify-content-center mt-2" id="result-<?php echo $winner->id ?>">
                <?php echo $show_result; ?>
              </div>
          </div>
          <div class="col-sm-2 m-auto">
            <button class="btn btn-info play-now p-3" ticket="<?php echo $winner->id ?>" <?php echo $disabled ?> ><i class="fa fa-magic"></i> Play</button>
          </div>
        </div>
      <hr>
      <?php ++$i; endif; endforeach; ?>
      <div class="container mb-4">
        <div class="headline">History</div>
        <div class="history row justify-content-center">
          <?php 


          $historyTicketsArray = array_group($data['historyTickets'], 'pack_serial');


          krsort($historyTicketsArray);

          foreach ($historyTicketsArray as $pack_serial => $pack_history):

          if ($pack_history[0]->pack == $pack_history[0]->played) 
          {
            $pack_history_result =  $pack_history[0]->result;
           
          }
          else
          {
            continue;
          }
          ?>
          <div class="col-md-5 m-4" style="border: 3px solid #6c757d;">
            <div class="font-weight-bold prize-head mb-2" style="background: #6c757d; margin: -18px auto">
              Course #<?php echo $pack_serial; ?>
            </div>
              <div class="ticket-result col-md-11 text-center row justify-content-center mt-2 m-auto p-2 shadow-sm">
                <?php echo result_div($pack_history_result) ?>
              </div>
            <div class="pt-4">
              <?php 
                foreach ($historyTicketsArray[$pack_serial] as $historyTicket):
                    $history_id = $historyTicket->id;
                    $history_numbers = json_decode($historyTicket->numbers);
                    $history_result = json_decode($historyTicket->result);
                    $history_status = $historyTicket->status;

                $show_history_result = result_diff($history_result, $history_numbers);
                $show_history_status = abbr_status($history_status);
                ?>
            <div class="d-flex justify-content-center col-md-6 m-auto mt-2">
              <div class="col-md-6 m-auto"><i class="fa fa-ticket"></i> #<?php echo $history_id ?></div>
              <div class="history-ticket-result col-md-12 text-center d-flex justify-content-center m-auto">
                <?php echo $show_history_result ?>
              </div>
              <div class="col-md-4 m-auto"><?php echo abbr_status($history_status) ?></div>
            </div>
            <hr>
            <?php endforeach; ?>
            </div>
          </div>

          <?php endforeach; ?>
          <?php if (!isset($history_id)): ?>
            <center class="h5 p-3">NO DATA</center>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="result_popup" style="display: none">
    YOU WIN
  </div>


<?php  require APPROOT . '/views/user/incl/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> 
<script>
$(".new:not(:first)").find('.ticket_number').attr('disabled','true');
$(".new:not(:first)").find('.play-now').attr('disabled','true');
$(".picker:not(:first)").hide();

  $('.play-now').on('click', function(event) {
    event.preventDefault();

    var order_prize = $('#order_prize').html();
    var desorder_prize = $('#desorder_prize').html();

    var num = $(this).attr('ticket');
    var numbers = '';
        $('.ticket-'+num).each(function () {
          numbers = numbers+$(this).val()+',';
        });
    $.ajax({ url: rootPath+'/tickets/playTicket',
               data: {'numbers':numbers,'num':num},
               type: 'POST',
               dataType: "JSON",
               success: function (data) {

                  $('#message-'+num).html(data.error);
                  $('#result-'+num).html(data.result);
                  $('#status-'+num).html(data.status);
                  $('.hintspicker').html(data.hints);
                  if (data.status != '') {
                    $('#new_score').html(data.new_score);
                    $('#new_level').html(data.new_level);
                    $('#numbers-holder-'+num).html('');
                    $('#picker-'+num).remove();
                    $(".new:first").attr('class','form-group row p-3 old');
                    $(".old").find('.ticket_number').attr('disabled','true');
                    $(".old").find('.play-now').attr('disabled','true');
                    $(".new:first").find('.play-now').prop("disabled", false);
                    $(".new:first").find('.ticket_number').prop("disabled", false);
                    $(".picker").first().show();
                    setTimeout(function(){$(".result_popup").hide();}, 3000)
                  }

                  if (data.sound == 'O') {
                        $('.result_popup').html("YOU WIN </br> Order Prize +"+order_prize).attr('id','win_alert').show();
                        $('#result-'+num).html(data.result);
                        var obj = document.createElement('audio');
                        obj.src = rootPath+'/sounds/order.wav'; 
                        obj.play(); 
                  }
                  else if (data.sound == 'D') {
                        $('.result_popup').html("YOU WIN </br> Disorder Prize +"+desorder_prize).attr('id','disorder_alert').show();
                        var obj = document.createElement('audio');
                        obj.src = rootPath+'/sounds/disorder.wav'; 
                        obj.play(); 
                  }
                  else if (data.sound == 'B') {
                        $('.result_popup').html("YOU WIN </br> Bonus Prize +$$").attr('id','bonus_alert').show();
                        var obj = document.createElement('audio');
                        obj.src = rootPath+'/sounds/bonus.wav'; 
                        obj.play(); 
                  }
                  else if (data.sound == 'L') {
                        $('.result_popup').html("YOU LOSE </br> This Ticket").attr('id','lose_alert').show();
                        var obj = document.createElement('audio');
                        obj.src = rootPath+'/sounds/loss.wav'; 
                        obj.play(); 
                  }
                },
      });
 });

     
    $('.clear_all').click(function() {
    $('.ticket_number').val('');
    $('.picker_btn').each(function(){
     $(this).removeClass("btn-danger").addClass("btn-info").prop('disabled',false);
    });

  });



    $('.ticket_number').click(function() {
      var ticket = $(this).attr('ticket');

      $(this).val('');
      $('.picker_btn').each(function(){
       $(this).removeClass("btn-danger").addClass("btn-info").prop('disabled',false);
     });

      $('.ticket-'+ticket).each(function(){
        var number = $(this).val();
        $("#picker_btn_"+number).removeClass("btn-info").addClass('btn-danger').prop('disabled',true);
      });
    });

    $('.picker_btn').on('click', function(event) {
      event.preventDefault();

      $(this).attr("disabled", 'true');

      ticket = $(this).attr('num');
      number = $(this).html();

      $('.ticket-'+ticket).each(function(){
        if ($(this).val() == '') {
          $(this).val(number);
          return false;
        }
      });

      $('.picker_btn').each(function(){
        $(this).removeClass("btn-danger").addClass("btn-info").prop('disabled',false);
      });

      $('.ticket-'+ticket).each(function(){
        var number = $(this).val();
        $("#picker_btn_"+number).removeClass("btn-info").addClass('btn-danger').prop('disabled',true);
      });


    });
</script>

</body>
</html>