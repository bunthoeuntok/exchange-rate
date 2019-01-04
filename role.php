<?php include 'include/config.php'?>
<?php include 'include/navbar.php'?>
<?php include 'include/sidenav.php'?>
    <style>
        .department-active {
            background: #DCDCDC !important;
            color: #2E2E2E !important;
            font-weight: 800 !important;
        }
        .department-active i{
            color: #FF0000 !important;
        }
    </style>
    <title></title>
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
        <form class="modal-card" action="app/controllers/RoleController.php" method="post" id="role-form">
            <div class="modal-card-head">
                <p>Modal Header</p>
            </div>
            <div class="modal-card-body">
                <input type="hidden" name="id">
                 <div class="input-field margin-top">
                    <input name="name" placeholder="Role's name" type="text" class="validate">
                    <label>Role's name</label>
                </div>
                <div class="input-field">
                    <textarea name="description" placeholder="Description"></textarea>
                    <label>Description</label>
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
            var form = $('#role-form');
            var url = 'app/controllers/RoleController.php';

            var role_validate = form.validate({
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
                role_validate.resetForm();
                document.getElementById('role-form').reset();
            })
            $('#edit').click(function() {
                var id = ($('.check-action:checked').val());
                find_one(url, form, id);
            });

            $('#delete').click(function() {
                var ids = $('body').find('.check-action:checked').map(function() {
                    return $(this).val();
                }).get().join(' ');
                //show modal comfirm delete
                showalert()
                
                $('body').on('click', '.delete', function(){
                    deletes(url, ids, function() {
                        paginate(url, main); 
                        closealert()
                    });
                })
            })
        });
    </script>

</body>
</html>
