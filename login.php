<?php 
session_start();
session_destroy();
 ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="static/css/material.css">
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
	<title>X-RATE | LOGIN</title>
</head>
<body>
<style>
   
</style>

<form class="login-form" method="POST" id="login-form">
    <div class="login-controller">
        <h4 class="font style teal-text">ECHANGE RATE</h4>
        <div class="input-field">
            <input placeholder="Username" type="text" name="username" id="username">
            <label>Enter Username</label>
        </div>
        <div class="input-field">
            <input placeholder="Password" type="password" name="password" id="password">
            <label>Enter Password</label>
        </div>
        <div class="login-controller-action">
            <button style="width: 100%" type="submit" class="waves-effect waves-green btn teal" id="login">login</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        // $('#login').click(function(){
        //     var username = $('#username').val();
        //     var password = $('#password').val();
        //     if (username == "") {
        //         M.toast({
        //             html: '<i class="material-icons left">error</i><span>The username or password you entered is incorrect.</span>',
        //             classes: 'red',
        //             displayLength: 1000
        //         })
        //     }
        //     else{
        //         M.toast({
        //             html: '<i class="material-icons left">check</i><span>The username or password you entered is incorrect.</span>',
        //             classes: 'teal',
        //             displayLength: 1000
        //         })
        //     }
        // })
        var form = $('#login-form');
        var url = 'app/controllers/UserController.php';

        var login_validate = form.validate({
            onfocusout: function(element) {
                this.element(element);  
            },
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
                
            },
            // Submit form if validate successful 
                // Insert if no id feild
                // Update if it has id feild
            submitHandler: function() {
                var username = $('#username').val();
                var password = $('#password').val();
                login(url, username, password);
            }
        });

    })
</script>
</body>
</html>