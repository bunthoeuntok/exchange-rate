<?php include 'include/config.php'?>
<?php include 'include/navbar.php'?>
<?php include 'include/sidenav.php'?>
<style>
    .users {
        background-color: rgba(0,204,204, .4) !important;
        color: #FFF !important;
        font-weight: 800 !important;
    }
    .users i{
        color: #FFF !important;
    }
</style>
</head>
<body>
    <header>
        <?php include_once 'include/toolbar.php'; ?>
    </header>
    <main class="main">
        <div class="container-full">
            <div id="content"></div>
        </div>
    </main>
    <footer class="fixed-footer white">
        
    </footer>

    <div id="modal" class="modal">
        <form class="modal-card" action="app/controllers/UserController.php" method="post" id="user-form">
            <div class="modal-card-head">
                <p>Modal Header</p>
            </div>
            <div class="modal-card-body">
                <input type="hidden" name="id">
                <div class="input-field">
                    <label>Employee's name</label>
                    <select name="emp_id" id="emp-name-option">
                        
                    </select>
                </div>
                <div class="input-field">
                    <label>Employee's role</label>
                    <select name="role_id">
                        <option value="3">Saler</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <div class="input-field">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div class="input-field">
                    <label>Password</label>
                     <input type="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="modal-card-foot">
                <button type="button" class="grey lighten-1 waves-effect waves-ligth btn cancel">cancel</button>
                <button type="submit" class="waves-effect waves-green btn">save</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var main = $('#content');
            var form = $('#user-form');
            var url = 'app/controllers/UserController.php';

            var user_validate = form.validate({
                onfocusout: function(element) {
                    this.element(element);  
                },
                rules: {
                    emp_id: {
                        required: true
                    },
                    role_id: {
                        required: true
                    }, 
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
                    form_submit(form, function() {
                        paginate(url, main);
                    });
                }
            });

            paginate(url, main);

            $('#add').click(function() {
                user_validate.resetForm();
                document.getElementById('user-form').reset();
                var position = $('#emp-name-option');
                option(url, position);
                
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
            });

            $('body').on('click', '.toolbar-footer li a', function() {
                var page = $(this).attr('data-page');
                paginate(url, main, page);
            })
        });
    </script>
</body>
</html>
