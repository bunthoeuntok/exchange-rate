<?php include 'include/config.php'?>
<?php include 'include/navbar.php'?>
<?php include 'include/sidenav.php'?>

<style>
    .user-right{
        background: #DCDCDC !important;
        color: #2E2E2E !important;
        font-weight: 800 !important;
    }
    .user-right i{
        color: #FF0000 !important;
    }
</style>
</head>
<body>
<div class="toolbar-controller">
    <div>
        <div class="action">
            <a class="waves-effect waves-ligth btn btn-small orange edit disabled" id="edit"><i class="material-icons left">edit</i>edit</a>
            <a class="waves-effect waves-ligth btn btn-small grey disabled" id="cancel"><i class="material-icons left">delete</i>delete</a>
        </div>
    </div>
    <div>
        <input type="text" class="validate-small no-margin" name="search" placeholder="Search...">
    </div>
</div>
<main class="main">
    <div class="container-full">
        <table>
            <thead>
            <tr>
                <th>Pages</th>
                <th>View</th>
                <th>Add</th>
                <th>Edit</th>
                <th>Delet</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Dashboard</td>
                <td>
                    <label class="checkbox-action">
                        <input type="checkbox" class="filled"/>
                        <span>&nbsp;</span>
                    </label>
                </td>
                <td>
                    <label class="checkbox-action">
                        <input type="checkbox" class="filled"/>
                        <span>&nbsp;</span>
                    </label>
                </td>
                <td>
                    <label class="checkbox-action">
                        <input type="checkbox" class="filled"/>
                        <span>&nbsp;</span>
                    </label>
                </td>
                <td>
                    <label class="checkbox-action">
                        <input type="checkbox" class="filled"/>
                        <span>&nbsp;</span>
                    </label>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</main>
<script>
    $(document).ready(function () {
        $('.filled').change(function () {
            $('#edit').removeClass('disabled')
            $('#cancel').removeClass('disabled')
        })
        $('#cancel').click(function () {
            $('#edit').addClass('disabled')
            $(this).addClass('disabled')
        })
        $('#edit').click(function () {
            $('#cancel').addClass('disabled')
            $(this).addClass('disabled')
        })
    })
</script>
</body>
</html>
