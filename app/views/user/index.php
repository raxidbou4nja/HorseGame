<?php require APPROOT . '/views/user/incl/user_header.php'; ?>
<title>New Game</title>
</head>
<div class="container">
<?php require APPROOT . '/views/user/incl/user_navbar.php'; ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="container-fluid px-3 px-sm-5 my-5 text-center">
        <h2 class="text-white">Choose Your Game:</h2>
      </div>
        <div id="customers-cases" class="owl-carousel"> 
        
         <!--CASE 1 -->
        <div class="item shadow-lg">
          <div class="game-card-head">
            1 WINNER
          </div>
          <div>
            <div class="bg-white rounded"> <img src="<?php echo URLROOT.'/img/games/one_winner.png' ?>" alt="">
              <div class="edit p-2 mt-1" id="edit1">
                <div>
                  <div class="cost h1" id="case-cost-1" cost="1">$<span id="price">3</span><sup><small>.00</small></sup></div>
                </div>
                <div class="align-items-center">
                <label for="tickects">Tickects Pack:</label>
                 <div class="select" width="100%">
                  <select name="tickects" class="case-tickets" id="case-tickets-1" case="1" disabled>
                    <option value="3">3 tickects</option>
                    <option value="4">4 tickects</option>
                    <option value="5">5 tickects</option>
                  </select>
                </div>
              </div>
              <button type="submit" class="play-btn mt-3" id='play-btn-1' case="1" disabled>Play</button>
              <div class="status" id="status-case-1"></div>
            </div>
          </div>
        </div>
      </div>
        <!--END OF CASE 1 --> 

        <!--CASE 2 -->
        <div class="item shadow-lg">
          <div class="game-card-head">
           2 WINNERS
          </div>
          <div>
            <div class="bg-white rounded"> <img src="<?php echo URLROOT.'/img/games/two_winners.png' ?>" alt="">
              <div class="edit p-2 mt-1" id="edit2">
                <div>
                  <div class="cost h1" id="case-cost-2" cost="2">$<span id="price">6</span><sup><small>.00</small></sup></div>
                </div>
                <div class="align-items-center">
                <label for="tickects">Tickects Pack:</label>
                 <div class="select" width="100%">
                  <select name="tickects" class="case-tickets" id="case-tickets-2" case="2" disabled>
                    <option value="3">3 tickects</option>
                    <option value="4">4 tickects</option>
                    <option value="5">5 tickects</option>
                  </select>
                </div>
              </div>
              <button type="submit" class="play-btn mt-3" id='play-btn-2' case='2' disabled>Play</button>
              <div class="status" id="status-case-2"></div>
            </div>
          </div>
        </div>
      </div>
        <!--END OF CASE 2 --> 
        <!--CASE 3 -->
        <div class="item shadow-lg">
          <div class="game-card-head">
            3 WINNERS
          </div>
          <div>
            <div class="bg-white rounded"> <img src="<?php echo URLROOT.'/img/games/three_winners.png' ?>" alt="">
              <div class="edit p-2 mt-1" id="edit3">
                <div>
                  <div class="cost h1" id="case-cost-3" cost="3">$<span id="price">9</span><sup><small>.00</small></sup></div>
                </div>
                <div class="align-items-center">
                <label for="tickects">Tickects Pack:</label>
                 <div class="select" width="100%">
                  <select name="tickects" class="case-tickets" id="case-tickets-3" case="3">
                    <option value="3">3 tickects</option>
                    <option value="4">4 tickects</option>
                    <option value="5">5 tickects</option>
                  </select>
                </div>
              </div>
              <button type="submit" class="play-btn mt-3" id='play-btn-3' case='3'>Play</button>
              <div class="status" id="status-case-3"></div>
            </div>
          </div>
        </div>
      </div>
        <!--END OF CASE 3 -->  
        <!--CASE 4 -->
        <div class="item shadow-lg">
          <div class="game-card-head">
           4 WINNERS
          </div>
          <div>
            <div class="bg-white rounded"> <img src="<?php echo URLROOT.'/img/games/four_winners.png' ?>" alt="">
              <div class="edit p-2 mt-1" id="edit4">
                <div>
                  <div class="cost h1" id="case-cost-4" cost="4">$<span id="price">12</span><sup><small>.00</small></sup></div>
                </div>
                <div class="align-items-center">
                <label for="tickects">Tickects Pack:</label>
                 <div class="select" width="100%">
                  <select name="tickects" class="case-tickets" id="case-tickets-4" case="4" disabled>
                    <option value="3">3 tickects</option>
                    <option value="4">4 tickects</option>
                    <option value="5">5 tickects</option>
                  </select>
                </div>
              </div>
              <button type="submit" class="play-btn mt-3" id='play-btn-4' case='4' disabled>Play</button>
              <div class="status" id="status-case-4"></div>
            </div>
          </div>
        </div>
      </div>
        <!--END OF CASE 4 -->  
        <!--CASE 5 -->
        <div class="item shadow-lg">
          <div class="game-card-head">
            5 WINNERS
          </div>
          <div>
            <div class="bg-white rounded"> <img src="<?php echo URLROOT.'/img/games/five_winners.png' ?>" alt="" >
              <div class="edit p-2 mt-1" id="edit5">
                <div>
                  <div class="cost h1" id="case-cost-5" cost="5">$<span id="price">15</span><sup><small>.00</small></sup></div>
                </div>
                <div class="align-items-center">
                <label for="tickects">Tickects Pack:</label>
                 <div class="select" width="100%">
                  <select name="tickects" class="case-tickets" id="case-tickets-5" case="5" disabled>
                    <option value="3">3 tickects</option>
                    <option value="4">4 tickects</option>
                    <option value="5">5 tickects</option>
                  </select>
                </div>
              </div>
              <button type="submit" class="play-btn mt-3" id='play-btn-5' case='5' disabled>Play</button>
              <div class="status" id="status-case-5"></div>
            </div>
          </div>
        </div>
      </div>
        <!--END OF CASE 5 -->  

      </div>
      </div>
  </div>
  </div>

</div>
<?php require APPROOT . '/views/user/incl/user_footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> 
<script>
  jQuery(document).ready(function($) {
            "use strict";
            //  CASES CAROUSEL HOOK
            $('#customers-cases').owlCarousel({
 //               loop: true,
                center: true,
                margin:-38,              
                dots:false,
//                autoplayTimeout: 5000,
//                smartSpeed: 450,
                responsive: {
                  0: {
                    items: 1
                  },
                  768: {
                    items: 2
                  },
                  1170: {
                    items: 3
                  }
                }
            });


          var owl = $('.owl-carousel');
            owl.owlCarousel();
            // Listen to owl events:
            owl.on('changed.owl.carousel', function(event) {
                var index_item = parseInt(event.item.index)+1;
                $('.case-tickets').prop('disabled', true);
                $('.play-btn').prop('disabled', true);
                $('#case-tickets-'+index_item).prop('disabled', false);
                $('#play-btn-'+index_item).prop('disabled', false);
                
                // DETECT PREVIOUS TICKETS
                if ('#status-case-'+index_item != '') {
                    $('#status-case-'+index_item).html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
                    
                    var winners = $('#play-btn-'+index_item).attr('case');
                            
                      $.ajax({ url: rootPath+'/tickets/checkAvailableWinners',
                                 data: {'winners':winners},
                                 type: 'POST',
                                 success: function (data) {
                                      if (data == '') {
                                        $('#status-case-'+index_item).remove();
                                      }else{
                                        $('#edit'+index_item).html(data);
                                      }
                                  },
                        });
                }
     
            });

            owl.trigger('to.owl.carousel', [2, 0]);

          });


$('.case-tickets').on('change', function() {

   var case_num =  $(this).attr('case');
   var case_price =  $('#case-cost-'+case_num).attr('cost');
   var case_tickets =  $(this).val();
   $('#case-cost-'+case_num).find('#price').html(parseInt(case_price)*parseInt(case_tickets));

});


$('.play-btn').on('click', function() {

  var case_num = $(this).attr('case');
  
  var pack = $('#case-tickets-'+case_num).val();

  $('#status-case-'+case_num).html('<i class="fa fa-spinner fa-spin fa-2x"></i>');

  $.ajax({ url: rootPath+'/tickets/buyTickets',
             data: {'winners':case_num, 'pack':pack},
             type: 'POST',
             success: function (data) {
                  if (data == '') {
                    $('#status-case-'+case_num).remove();
                  }else{
                    $('#edit'+case_num).html(data);
                  }
              },
    });

});
  </script>

  </body>
</html>