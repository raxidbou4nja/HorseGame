<?php require APPROOT . '/views/inc/header.php'; ?>

<nav class="navbar shadow profile-navbar row" style="background:#c7a079;">
    <div class="col-md-3">
        <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="40px" class="round">
    </div>
    <div class="col-md-3 d-flex">
        Your level:
        <div class="score-output">
            100
        </div>
    </div>
    <div class="col-md-3  d-flex">
        your score:
        <div class="score-output">
            100
        </div>
    </div>
    <div class="col-md-3 text-center">
        <i class="fa fa-sign-out"></i>
        LogOut
    </div>
</nav>

<style>
.card-carousel {
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;

}

.card-carousel .my-card {
  height: 20rem;
  width: 15rem;
  position: relative;
  z-index: 1;
  -webkit-transform: scale(0.6) translateY(-2rem);
  transform: scale(0.6) translateY(-2rem);
  opacity: 0;
  cursor: pointer;
  pointer-events: none;
  background: #2e5266;
  background: linear-gradient(to top, #2e5266, #6e8898);
  transition: 1s;
  border-radius: 21px 20px 0px 0px;
}

.card-carousel .my-card:after {
  content: '';
  position: absolute;
  height: 2px;
  width: 100%;
  border-radius: 100%;
  background-color: rgba(0,0,0,0.3);
  bottom: -5rem;
  -webkit-filter: blur(4px);
  filter: blur(4px);
}

.card-carousel .my-card.active {
  z-index: 3;
  -webkit-transform: scale(1) translateY(0) translateX(0);
  transform: scale(1) translateY(0) translateX(0);
  opacity: 1;
  pointer-events: auto;
  transition: 1s;
}

.card-carousel .my-card.prev, .card-carousel .my-card.next {
  z-index: 2;
  -webkit-transform: scale(0.8) translateY(-1rem) translateX(0);
  transform: scale(0.8) translateY(-1rem) translateX(0);
  opacity: 0.6;
  pointer-events: auto;
  transition: 1s;

}
.game-card-head{
    text-align: center;
    font-size: 26px;
    font-style: italic;
    border-radius: 21px 20px 0px 0px;
    background:  #c7a079;
}

:root {
  --background-gradient: linear-gradient(30deg, #f39c12 30%, #f1c40f);
  --gray: #34495e;
  --darkgray: #2c3e50;
}

select {
  /* Reset Select */
  appearance: none;
  outline: 0;
  border: 0;
  box-shadow: none;
  /* Personalize */
  flex: 1;
  padding: 0 1em;
  color: #fff;
  background-color: var(--darkgray);
  background-image: none;
  cursor: pointer;
}
/* Remove IE arrow */
select::-ms-expand {
  display: none;
}
/* Custom Select wrapper */
.select {
  position: relative;
  display: flex;
  width: 100%;
  height: 3em;
  border-radius: .25em;
  overflow: hidden;
}
/* Arrow */
.select::after {
  content: '\25BC';
  position: absolute;
  top: 0;
  right: 0;
  padding: 1em;
  background-color: #34495e;
  transition: .25s all ease;
  pointer-events: none;
}
/* Transition */
.select:hover::after {
  color: #f39c12;
}

.play-btn{
    background:#b68869; 
    border:none;
    padding:3px 20px; 
    font-size:18px;
    position: absolute;
    bottom:0;
    width: 100%;

}

</style>


<div class="container mt-4">
<div class="card-carousel">
<div class="my-card">
    <div class="card-head game-card-head">
        Case 1
        <img src="<?php echo URLROOT.'/img/games/race_of_one.png' ?>" alt="" width="100%" height="200px">
    </div>
    <div class="card-body game-card-body p-0">
    <div class="select" width="100%">
        <select name="" id="">
            <option value="">3 tickects</option>
            <option value="">4 tickects</option>
            <option value="">5 tickects</option>
        </select>
    </div>
        <button type="submit" class="play-btn">Play</button>
    </div>
  </div>
  <div class="my-card">
    <div class="card-head game-card-head">
        Case 2
        <img src="<?php echo URLROOT.'/img/games/race_of_two.jpg' ?>" alt="" width="100%">
    </div>
    <div class="card-body game-card-body p-0">
    <div class="select" width="100%">
        <select name="" id="">
            <option value="">3 tickects</option>
            <option value="">4 tickects</option>
            <option value="">5 tickects</option>
        </select>
    </div>
        <button type="submit" class="play-btn">Play</button>
    </div>
  </div>
  <div class="my-card"></div>
  <div class="my-card"></div>
  <div class="my-card"></div>
</div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>


<script>
$num = $('.my-card').length;
$even = $num / 2;
$odd = ($num + 1) / 2;

if ($num % 2 == 0) {
  $('.my-card:nth-child(' + $even + ')').addClass('active');
  $('.my-card:nth-child(' + $even + ')').prev().addClass('prev');
  $('.my-card:nth-child(' + $even + ')').next().addClass('next');
} else {
  $('.my-card:nth-child(' + $odd + ')').addClass('active');
  $('.my-card:nth-child(' + $odd + ')').prev().addClass('prev');
  $('.my-card:nth-child(' + $odd + ')').next().addClass('next');
}

$('.my-card').click(function() {
  $slide = $('.active').width();
  console.log($('.active').position().left);
  
  if ($(this).hasClass('next')) {
    $('.card-carousel').stop(false, true).animate({left: '-=' + $slide});
  } else if ($(this).hasClass('prev')) {
    $('.card-carousel').stop(false, true).animate({left: '+=' + $slide});
  }
  
  $(this).removeClass('prev next');
  $(this).siblings().removeClass('prev active next');
  
  $(this).addClass('active');
  $(this).prev().addClass('prev');
  $(this).next().addClass('next');
});


// Keyboard nav
$('html body').keydown(function(e) {
  if (e.keyCode == 37) { // left
    $('.active').prev().trigger('click');
  }
  else if (e.keyCode == 39) { // right
    $('.active').next().trigger('click');
  }
});
</script>