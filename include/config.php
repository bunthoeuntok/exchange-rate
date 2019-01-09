<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="static/css/sass/material.css">
    <link rel="stylesheet" href="static/icons/material-icons.css">
    <link rel="stylesheet" href="static/date/datedropper.min.css">
    <link rel="stylesheet" href="static/date/my-style.css">
    <link rel="stylesheet" href="static/css/app.css">
    <link rel="stylesheet" type="text/css" href="static/css/main.css">

    <script src="static/js/jquery.min.js"></script>
    <script src="static/js/function.js"></script>
    <script src="static/js/action.js"></script>
    <script src="static/js/jquery.localize.min.js"></script>
    <script src="static/js/jquery.validate.min.js"></script>
    <script src="static/js/materialize.min.js"></script>
    <script src="static/js/datedropper.min.js"></script>
    <script src="static/js/app.js"></script>

    <?php 
        session_start();

        if(isset($_SESSION['user']) && $_SESSION['user']->role_id == 1) {
            // header('Location: dashboard.php');
            
        }  else 
            header('Location: login.php');

     ?>