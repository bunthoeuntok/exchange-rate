<?php include 'include/config.php'?>
<?php include 'include/navbar.php'?>
<?php include 'include/sidenav.php'?>
<style>
    .rate {
        background-color: rgba(0,204,204, .4) !important;
        color: #FFF !important;
        font-weight: 800 !important;
    }
    .rate i{
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
        <form class="modal-card" action="app/controllers/CurrencyRateController.php" method="post" id="currency-rate-form">
            <div class="modal-card-head">
                <p>Modal Header</p>
            </div>
            <div class="modal-card-body">
                <input type="hidden" name="id">
                 <div class="row">
                    <div class="input-field col s6 margin-top">
                        <select name="from_cur" id="from_cur"></select>
                        <label>From money</label>
                    </div>
                    <div class="input-field col s6 margin-top">
                        <select name="to_cur" id="to_cur"></select>
                        <label>To money</label>
                    </div>
                </div>
                    <input type="hidden" name="updated_by" value="<?php echo $_SESSION['user']->id ?>">
                <div class="input-field margin-top">
                    <input type="text" name="ex_rate" placeholder="Currency Rate">
                    <label>Currency Rate</label>
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
            var form = $('#currency-rate-form');
            var url = 'app/controllers/CurrencyRateController.php';

            var currency_rate_validate = form.validate({
                onfocusout: function(element) {
                    this.element(element);  
                },
                rules: {
                    ex_rate: {
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
                currency_rate_validate.resetForm();
                document.getElementById('currency-rate-form').reset();
                var from = $('#from_cur');
                var to = $('#to_cur');
                option(url, from, to);
            })
            $('#edit').click(function() {
                var from = $('#from_cur');
                var to = $('#to_cur');
                option(url, from, to);
                var id = ($('.check-action:checked').val());
                find_one(url, form, id);
            });

            $('#delete').click(function() {
                // var ids = $('body').find('.check-action:checked').map(function() {
                //     return $(this).val();
                // }).get().join(' ');

                // var result = confirm('Want to delete?');

                // if(result) {
                //     deletes(url, ids, function() {
                //         paginate(url, main); 
                //     });
                // }
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


            $('#from_cur').change(function() {
                var value = $(this).val();
                $('#to_cur').find('option[value="1"]').css('display', 'none');
                $('select').formSelect();
            });

            $('body').on('click', '.toolbar-footer li a', function() {
                var page = $(this).attr('data-page');
                paginate(url, main, page);
            })
        });
    </script>
</body>
</html>
