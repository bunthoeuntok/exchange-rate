<?php include 'include/config.php'?>
<?php include 'include/navbar.php'?>
<?php include 'include/sidenav.php'?>
<style>
    .employee-active{
        background: #DCDCDC !important;
        color: #2E2E2E !important;
        font-weight: 800 !important;
    }
    .employee-active i{
        color: #FF0000 !important;
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
        <div class="modal-background"></div>
        <form class="modal-card" action="app/controllers/EmployeeController.php" method="post" id="employee-form">
            <div class="modal-card-head">
                <p>Modal Header</p>
            </div>
            <div class="modal-card-body">
                <input type="hidden" name="id">
                 <div class="input-field margin-top">
                    <input name="name" placeholder="Role's name" type="text" class="validate">
                    <label>Role's name</label>
                </div>
                <div class="row">
                    <div class="input-field s6 col">
                        <select name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label>Gender</label>
                    </div>
                    <div class="input-field s6 col">
                        <input name="birth_date" class="date" type="text" data-format="Y-m-d" data-large-default="true" data-theme="my-style" data-large-mode="true" data-translate-mode="true"/>
                        <label>Date of Birth</label>
                    </div>
                </div>
                <div class="input-field">
                    <input type="text" name="phone" placeholder="Phone number">
                    <label>Phone number</label>
                </div>
                <div class="input-field">
                    <input type="text" name="address" placeholder="Address">
                    <label>Address</label>
                </div>
                <div class="input-field">
                    <input type="text" name="social_id" placeholder="Social ID">
                    <label>Social ID</label>
                </div>
                <div class="input-field">
                    <input name="hired_date" class="date" type="text" data-format="Y-m-d" data-large-default="true" data-theme="my-style" data-large-mode="true" data-translate-mode="true" data-min-year="2018" data-max-year="2030"/>
                    <label>Hired Date</label>
                </div>
            </div>
            <div class="modal-card-foot">
                <button type="button" class="grey lighten-1 waves-effect waves-ligth btn cancel">cancel</button>
                <button type="submit" class="waves-effect waves-ligth btn">save</button>
            </div>
         </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var main = $('#content');
            var form = $('#employee-form');
            var url = 'app/controllers/EmployeeController.php';

            var employee_validate = form.validate({
                onfocusout: function(element) {
                    this.element(element);  
                },
                rules: {
                    name: {
                        required: true
                    },
                    social_id: {
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
                employee_validate.resetForm();
                document.getElementById('employee-form').reset();
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