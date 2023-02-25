<?php require APPROOT . '/views/user/incl/user_header.php'; ?>
<title>Game Of <?php echo $data['winners'][0]->winners; ?> Winners</title>
</head>
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
              <?php echo ($data['winners'][0]->winners)*100; ?>$</div>
        </div>
        <div class="col-md-6 h3">
          <div class="font-weight-bold prize-head" style="background: #3f51b5;">DISORDER</div>
          <div class="prize-body" style="border-color: #3f51b5;">
          <?php echo ($data['winners'][0]->winners)*50; ?>$
          </div>
        </div> 
        <div class="container">
          <div class="font-weight-bold prize-head" style="background: #6c757d; margin-bottom: -20px;">Last Round Result</div>
          <div class="ticket-result  col-md-12 text-center d-flex justify-content-center mt-2" style="    padding: 20px; border: 3px solid #6c757d; width: fit-content; margin: auto;">

              <?php 
              if($data['available'] == 0){
                echo result_div($data['last_ticket']->result);
              }
              else
              {
                for ($i=0; $i < $data['winners'][0]->winners; $i++) { 
                  echo "<div class='h2 bg-info empty'>?</div>";
                }
              } 

              ?>
            </div>
        </div>       
      </div>
      <hr>
      <?php $i = 1; foreach ($data['winners'] as $winner):



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
              <div id="numbers-holder-<?php echo $winner->id ?>">
                <?php for ($i=0; $i < $winner->winners; $i++): ?>
                <input id="<?php echo $i ?>" type="text" ticket="<?php echo $winner->id ?>" class="ticket_number ticket-<?php echo $winner->id ?>" <?php echo $disabled;  ?> value="<?php $numbers = json_decode($winner->numbers); echo @$numbers[$i] ?>">
                <?php endfor ?>
              </div>
              <div class="message text-danger mt-2" id="message-<?php echo $winner->id ?>"></div>
              <div class="ticket-result col-md-12 text-center d-flex justify-content-center mt-2" id="result-<?php echo $winner->id ?>">
                <?php echo $show_result; ?>
              </div>
          </div>
          <div class="col-sm-2 m-auto">
            <button class="btn btn-info play-now p-3" ticket="<?php echo $winner->id ?>" <?php echo $disabled ?> ><i class="fa fa-magic"></i> Play</button>
          </div>
        </div>
      <hr>
      <?php ++$i; endforeach ?>
      <div class="container">
        <div class="h2">History</div>
        <div class="history">
          <?php $i = 1; foreach ($data['historyTickets'] as $historyTicket):



        if ($historyTicket->status != '' ) 
        {
          $history = 'old';
          $disabled = 'disabled';

          $result = json_decode($historyTicket->result);
           // GET SUBMITTED NUMBERS
          $numbers = json_decode($historyTicket->numbers);
          $show_status = abbr_status($winner->status);
          $show_result = result_diff($numbers, $result);
          

        }
        else
        {
          $history = 'new';
          $disabled = '';
          $show_result = '';
          $show_status = '';
        }
          ?>
        <div class="form-group row p-3">
          <div class="col-sm-3 h4 m-auto">
            Tickect #<?php echo $historyTicket->id ?>
            <div class="ticket-result col-md-12 text-center d-flex justify-content-center" id="status-<?php echo $historyTicket->id ?>"><?php echo $show_status ?></div>
            </div>
          <div class="col-sm-7 py-3">
              <div class="ticket-result col-md-12 text-center d-flex justify-content-center mt-2" id="result-<?php echo $historyTicket->id ?>">
                <?php echo $show_result; ?>
              </div>
          </div>
          <div class="col-sm-2 m-auto">
          </div>
        </div>
      <hr>
      <?php ++$i; endforeach ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php  require APPROOT . '/views/user/incl/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> 
<script>
$(".new:not(:first)").find('.ticket_number').attr('disabled','true');
$(".new:not(:first)").find('.play-now').attr('disabled','true');

  $('.play-now').on('click', function(event) {
    event.preventDefault();

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
                  if (data.status != '') {
                    $('#numbers-holder-'+num).html('');
                    $(".new:first").attr('class','form-group row p-3 old');
                    $(".old").find('.ticket_number').attr('disabled','true');
                    $(".old").find('.play-now').attr('disabled','true');
                    $(".new:first").find('.ticket_number').prop("disabled", false);
                    $(".new:first").find('.play-now').prop("disabled", false);
                  }

                  if (data.sound == 'O') {
                        $('#result-'+num).html(data.result);
                        var obj = document.createElement('audio');
                        obj.src = rootPath+'/sounds/order.wav'; 
                        obj.play(); 
                  }
                  else if (data.sound == 'D') {
                        var obj = document.createElement('audio');
                        obj.src = rootPath+'/sounds/disorder.wav'; 
                        obj.play(); 
                  }
                  else if (data.sound == 'L') {
                        var obj = document.createElement('audio');
                        obj.src = rootPath+'/sounds/loss.wav'; 
                        obj.play(); 
                  }
                },
      });
 });
</script>

</body>
</html>