<?php include 'include/config.php'?>
<?php include 'include/navbar.php'?>
<?php include 'include/sidenav.php'?>
<style>
    .users {
        background: #0cc !important;
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
<div class="modal" id="modal">

        <form class="modal-card" action="app/controllers/UserController.php" method="post" id="user-form">
            <section class="modal-card-head">
                <p>Modal title</p>
            </section>
            <section class="modal-card-body">
                <input type="hidden" name="id">
                 <div class="input-field margin-top">
                    <input name="name" placeholder="Role's name" type="text" class="validate">
                    <label>Role's name</label>
                </div>
                <div class="input-field">
                    <textarea name="description" placeholder="Description"></textarea>
                    <label>Description</label>
                </div>
            </section>
            <section class="modal-card-foot">
                <button type="button" class="grey lighten-1 waves-effect waves-ligth btn cancel">cancel</button>
                <button type="submit" class="waves-effect waves-ligth btn">save</button>
            </section>
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
                user_validate.resetForm();
                document.getElementById('user-form').reset();
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
