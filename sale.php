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

        if(isset($_SESSION['user'])) {
            // header('Location: dashboard.php');
            
        }  else 
            header('Location: login.php');

     ?>
<style>
    main{
        margin: 0 !important;
        padding: 0 !important;
        overflow: hidden;
    }
    .table{
        margin-top: 0px !important;
    }
    .sale {
        background-color: rgba(0,204,204, .4) !important;
        color: #FFF !important;
        font-weight: 800 !important;
    }
    .sale i{
        color: #FFF !important;
    }
</style>
</head>
<body>
<nav>
    <div class="nav-wrapper container-full">
        <a href="#!" class="brand-logo">
            <span class="light-text">Money</span>
            <span class="bold-text">Exchage</span>
        </a>
        <ul class="right">
            <li class="profile">
                <img src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1" class="dropdown-trigger btn-floating z-depth-0"
                     data-target='dropdown1' alt="">
                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#!">one</a></li>
                    <li><a href="#!">two</a></li>
                    <li class="divider" tabindex="-1"></li>
                    <li><a href="#!">three</a></li>
                    <li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
                    <li><a href="login.php"><i class="material-icons">exit_to_app</i>Sign out</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="divider"></div>
</nav>
<main class="main">
    <div class="pa-0 container-full">
        <div class="row no-margin">
            <div class="col s12 l8 pa-0" style="height: calc(100vh - 56px); overflow-y:auto;">
                <div id="content"></div>
            </div>
            <div class="col s12 l4 pa-0"
            style="border-left: 1px solid #e0e0e0;height: calc(100vh - 56px); overflow-y:auto;"
            >
                <table>
                    <thead>
                        <tr>
                            <th>Saler</th>
                        </tr>
                    </thead>
                </table>
                <div class="container-full">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="input-field col s6 margin-top">
                            <select name="gender">
                                <option value="Male">រៀល</option>
                                <option value="Female">ដុល្លា</option>
                                <option value="Female">បាត</option>
                            </select>
                            <label>From money</label>
                        </div>
                        <div class="input-field col s6 margin-top">
                            <select name="gender">
                                <option value="Male">រៀល</option>
                                <option value="Female">ដុល្លា</option>
                                <option value="Female">បាត</option>
                            </select>
                            <label>To money</label>
                        </div>
                    </div>
                    <div class="input-field">
                        <input name="name" placeholder="Epmloyee's name" type="text">
                        <label>Employee's name</label>
                    </div>
                    <div class="input-field">
                        <input name="name" placeholder="Epmloyee's name" type="text">
                        <label>Employee's name</label>
                    </div>
                    <div class="input-field">
                        <input name="name" placeholder="Epmloyee's name" type="text">
                        <label>Employee's name</label>
                    </div>
                    <div class="modal-card-foot">
                        <button type="button" class="grey lighten-1 waves-effect waves-ligth btn cancel">cancel</button>
                        <button type="submit" class="waves-effect waves-ligth btn">save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    $(document).ready(function() {
        var main = $('#content');
        var form = $('#transfer-form');
        var url = 'app/controllers/UserController.php';

        var transfer_validate = form.validate({
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                name: {
                    required: true
                }

            },
            // Submit form if validate successful
            // Insert if no id feild
            // Update if it has id feild
            submitHandler: function() {
                form_submit(form, function() {
                    paginate(url, main);
                });
            }
        });

        paginate(url, main);

        $('#add').click(function() {
            transfer_validate.resetForm();
            document.getElementById('transfer-form').reset();
        })
        $('#edit').click(function() {
            var id = ($('.check-action:checked').val());
            find_one(url, form, id);
        });

        $('#delete').click(function() {
            var ids = $('body').find('.check-action:checked').map(function() {
                return $(this).val();
            }).get().join(' ');

            var result = confirm('Want to delete?');

            if(result) {
                deletes(url, ids, function() {
                    paginate(url, main);
                });
            }
        })
    });
</script>
</body>
</html>
