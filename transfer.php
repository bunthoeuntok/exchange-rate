<?php include 'include/config.php'?>
<?php include 'include/navbar.php'?>
<?php include 'include/sidenav.php'?>
<style>
    .transfer {
        background-color: rgba(0,204,204, .4) !important;
        color: #FFF !important;
        font-weight: 800 !important;
    }
    .transfer i{
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
        <form class="modal-card" action="app/controllers/TransferController.php" method="post" id="transfer-form">
            <div class="modal-card-head">
                <p>Modal Header</p>
            </div>
            <div class="modal-card-body">
                <input type="hidden" name="id">
                 <div class="row">
                    <div class="input-field col s6 margin-top">
                        <select name="sender" disabled="true">
                            <option value="<?php echo $_SESSION['user']->id ?>"><?php echo $_SESSION['user']->name; ?></option>
                        </select>
                        <label>Sender</label>
                    </div>
                    <div class="input-field col s6 margin-top">
                        <select name="receiver" id="receiver"></select>
                        <label>To Sender</label>
                    </div>
                </div>
                <div class="input-field margin-top">
                    <select name="cur_id" id="cur_id"></select>
                    <label>Currency Type</label>
                </div>
                <div class="input-field margin-top">
                    <input type="text" name="amount" placeholder="Amount">
                    <label>Amount</label>
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
            var form = $('#transfer-form');
            var url = 'app/controllers/TransferController.php';
            
            var transfer_validate = form.validate({
                onfocusout: function(element) {
                    this.element(element);  
                },
                rules: {
                    amount: {
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

                var receiver = $('#receiver');
                var cur_id = $('#cur_id');
                option(url, receiver);
                option('app/controllers/CurrencyController.php', cur_id);
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
