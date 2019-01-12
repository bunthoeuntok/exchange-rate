<?php include 'include/config.php'?>
<?php include 'include/navbar.php'?>
<?php include 'include/sidenav.php'?>
<style>
    .employee {
        background-color: rgba(0,204,204, .4) !important;
        color: #FFF !important;
        font-weight: 800 !important;
    }
    .employee i{
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
        <form class="modal-card" action="app/controllers/EmployeeController.php" method="post" id="employee-form">
            <div class="modal-card-head">
                <p>Modal Header</p>
            </div>
            <div class="modal-card-body">
                <input type="hidden" name="id">
                 <div class="input-field">
                    <label>Employee's name</label>
                    <input name="name" placeholder="Epmloyee's name" type="text">
                </div>
                <div class="row">
                    <div class="input-field s12 m6 col">
                        <label>Gender</label>
                        <select name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="input-field s12 m6 col">
                        <label>Date of Birth</label>
                        <input name="birth_date" placeholder="Date of Birth" class="date" type="text" data-format="Y-m-d" data-large-default="true" data-theme="my-style" data-large-mode="true" data-translate-mode="true"/>
                    </div>
                </div>
                <div class="input-field">
                    <label>Phone number</label>
                    <input type="text" name="phone" placeholder="Phone number">
                </div>
                <div class="input-field">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="Address">
                </div>
                <div class="row">
                    <div class="input-field s6 col">
                        <label>Social ID</label>
                        <input type="text" name="social_id" placeholder="Social ID">
                    </div>
                    <div class="input-field s6 col">
                        <label>Hired Date</label>
                        <input name="hired_date" placeholder="Hired date" class="date" type="text" data-format="Y-m-d" data-large-default="true" data-theme="my-style" data-large-mode="true" data-translate-mode="true" data-min-year="2018" data-max-year="2030"/>
                    </div>
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
                    gender: {
                        required: true
                    },
                    birth_date: {
                        required: true
                    },
                    phone: {
                        required: true,
                        number: true
                    },
                    address: {
                        required: true
                    },
                    social_id: {
                        required: true
                    },
                    hired_date: {
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

                showalert()
                
                $('body').on('click', '.delete', function(){
                    deletes(url, ids, function() {
                        paginate(url, main); 
                    });
                    closealert()
                })
            })
        });
    </script>
</body>
</html>
