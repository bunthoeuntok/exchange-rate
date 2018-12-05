<?php include 'include/config.php'?>
<?php include 'include/navbar.php'?>
<?php include 'include/sidenav.php'?>
<style>
    .currency-active{
        background: #DCDCDC !important;
        color: #2E2E2E !important;
        font-weight: 800 !important;
    }
    .currency-active i{
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
        <form class="modal-card" action="app/controllers/CurrencyController.php" method="post" id="currency-form">
            <div class="modal-card-head">
                <p>Modal Header</p>
            </div>
            <div class="modal-card-body">
                <input type="hidden" name="id">
                 <div class="input-field margin-top">
                    <input name="name" placeholder="Currency's name" type="text" class="validate">
                    <label>Currency's name</label>
                </div>
                 <div class="input-field">
                    <input name="symbol" placeholder="Khmer name" type="text" class="validate">
                    <label>Khmer name</label>
                </div>
                 <div class="input-field">
                    <input name="country" placeholder="Country" type="text" class="validate">
                    <label>Country</label>
                </div>
                 <div class="input-field">
                    <input name="unit_price" placeholder="Unit Price" type="text" class="validate">
                    <label>Unit Price</label>
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
            var form = $('#currency-form');
            var url = 'app/controllers/CurrencyController.php';

            var role_validate = form.validate({
                onfocusout: function(element) {
                    this.element(element);  
                },
                rules: {
                    name: {
                        required: true
                    },
                    symbol: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    unit_price: {
                        required: true,
                        number: true
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

</main>
</body>
</html>
