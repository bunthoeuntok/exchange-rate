<?php include 'include/config.php' ?>
<?php include 'include/navbar.php' ?>
<?php include 'include/sidenav.php' ?>
<style>
    .dashboard {
        background-color: rgba(0,204,204, .4) !important;
        color: #FFF !important;
        font-weight: 800 !important;
    }
    .dashboard i{
        color: #FFF !important;
    }
    p.mp {
        text-align: center;
    }
</style>
</head>
<main>
    <div class="container-full">
        <script type="text/javascript">

            $(document).ready(function () {
                // 	// get all
                var main = $('#content');
                ajax_get('app/controllers/UserController.php', main);

                // Click to get update data
                var form = $('form#form');
                $('#update').click(function () {
                    var id = $('body').find('.checkitem:checked').val();

                    // get one
                    ajax_get('app/controllers/UserController.php', form, 'find', id);

                });

                // Insert new data or Update
                form.submit(function (event) {
                    form_submit(form);

                    event.preventDefault()
                });

                $('#delete').click(function () {
                    // var id = $('body').find('.checkitem:checked').map(function(){
                    // 	return $(this).val();
                    // }).get().join(' ');

                    // alert(id);

                    var ids = $('body').find('.checkitem:checked').map(function () {
                        return $(this).val();
                    }).get().join(' ');

                    deletes('app/controllers/UserController.php', ids);

                });
            });
        </script>
    </div>
</main>