<?php include 'include/config.php' ?>
<?php include 'include/navbar.php' ?>
<?php include 'include/sidenav.php' ?>
<style>
    .index-active{
        background: #DCDCDC !important;
        color: #2E2E2E !important;
        font-weight: 800 !important;
    }
    .index-active i{
        color: #FF0000 !important;
    }
    p.mp {
        text-align: center;
    }
</style>
</head>
<main>
    <div class="container-full">
        <form id="form" method="post" action="app/controllers/UserController.php">
            <input type="text" name="id">
            <input type="text" name="username">
            <input type="text" name="email">
            <input type="text" name="password">
            <input type="submit" value="Submit">
        </form>
        <br>
        <button id="add">Add</button>
        <button id="update">Update</button>
        <button id="delete">Delete</button>
        <br>
        <div id="content">

        </div>
        <br>
        <br>
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