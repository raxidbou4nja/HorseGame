<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontawesome.min.css">
  <link href="//db.onlinewebfonts.com/c/5d1d6d747b45d6aff710054b95e79a1f?family=HP+Simplified" rel="stylesheet" type="text/css"/>
  <title><?php echo SITENAME; ?></title>
  <style type="text/css">
    a:hover {
      text-decoration:none;
    }
    #brandhead{
      z-index: 1001;
    }
    .bronze-color{
      color: #b68869 !important;
    }
    .btn-font-bronze{
      font-size: 26px;
      color: #b68869 !important;
      padding: 8px 33px;
      border-radius: 7px;
      box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
    }
    .infos{
      position: absolute;
      font-family: HP Simplified;
      font-size: 53px;
      font-weight: bolder;
    }

    /*sidebar */
    #wrapper {
    padding-right: 250px;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled {
    padding-right: 0;
}

#sidebar-wrapper {
    padding-top: 100px;
    z-index: 1000;
    position: fixed;
    top:0;
    left: 0;
    width: 0;
    height: 100%;
    margin-right: -250px;
    overflow-y: auto;
    background: #303030;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
    width: 250px;
}

#page-content-wrapper {
    width: 100%;
    position: absolute;
    padding: 15px;
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right: -250px;
}

Sidebar Styles */

.sidebar-nav {
    position: absolute;
    top: 0;
    width: 250px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sidebar-nav li {
    text-indent: 20px;
    line-height: 40px;
    list-style:none;
}

.sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #999999;
    padding: 10px;
    font-size:30px;
    font-family: HP Simplified;
    color: white;
}

.sidebar-nav li a:hover {
    text-decoration: none;
    color: #fff;
    background: rgba(255,255,255,0.2);
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
    text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
    height: 65px;
    font-size: 18px;
    line-height: 60px;
}

.sidebar-nav > .sidebar-brand a {
    color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
    color: #fff;
    background: none;
}

@media(min-width:768px) {
    #wrapper {
        padding-left: 0;
    }

    #wrapper.toggled {
        padding-left: 0;
    }

    #sidebar-wrapper {
        width: 400px;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 0;
    }

    #page-content-wrapper {
        padding: 20px;
        position: relative;
    }

    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 250px;
    }
}
    
    */
  </style>
</head>
<body>
  <?php require APPROOT . '/views/inc/navbar.php'; ?>
  <div class="container">
  
