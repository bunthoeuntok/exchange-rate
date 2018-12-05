<?php include "include/config.php"; ?>
	<title>X-RATE | LOGIN</title>
</head>
<body>
<style>
   
</style>

<form class="login-form" action="">
    <div class="login-controller">
        <h4 class="font style teal-text">ECHANGE RATE</h4>
        <div class="input-field">
            <input placeholder="Mail" type="text" name="username" id="username">
            <label>Enter Username</label>
        </div>
        <div class="input-field">
            <input placeholder="Password" type="password" name="password" id="password">
            <label>Enter Password</label>
        </div>
        <div class="login-controller-action">
            <button type="button" class="waves-effect waves-green btn teal" id="login"><i class="material-icons left">call_missed_outgoing</i>login</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#login').click(function(){
            var username = $('#username').val();
            var password = $('#password').val();
            if (username == "") {
                M.toast({
                    html: '<i class="material-icons left">error</i><span>The username or password you entered is incorrect.</span>',
                    classes: 'red',
                    displayLength: 1000
                })
            }
            else{
                M.toast({
                    html: '<i class="material-icons left">check</i><span>The username or password you entered is incorrect.</span>',
                    classes: 'teal',
                    displayLength: 1000
                })
            }
        })
    })
</script>
</body>
</html>