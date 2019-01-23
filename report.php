<?php include 'include/config.php' ?>
<?php include 'include/navbar.php' ?>
<?php include 'include/sidenav.php' ?>
<style>
    .reports {
        background-color: rgba(0, 204, 204, .4) !important;
        color: #FFF !important;
        font-weight: 800 !important;
    }

    .reports i {
        color: #FFF !important;
    }

    .action, .actions {
        display: none !important;
        visibility: hidden !important;
    }
    .style-search{
        display: none !important;
    }
    .none {
        display: block !important;
        width: 100% !important;
    }

    input {
        color: #666;
        font-weight: 400;
        background: #fff;
        height: 28px !important;
        margin: 0 !important;
        box-sizing: border-box !important;
        background: #fff !important;

    }
    label{
        all: unset;
    }
    .boxs-report{
        display: grid;
        width: 100%;
        grid-template-columns: repeat( auto-fit, minmax(200px, 1fr));
        box-sizing: border-box;
    }
    .box-report{
        margin-right: 8px;
        margin-top: 8px;
        margin-bottom: 8px;
    }
    .select-wrapper .caret {
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        margin: 2px 0;
        line-height: 10px;
        z-index: 0;
        fill: rgba(0, 0, 0, 0.87);
    }
    .toolbar-controller{
        height: auto !important;
    }
</style>
</head>
<body>
<header>
    <?php include 'include/toolbar.php'?>
    <div class="container-full">

    </div>
</header>
<main class="main">
    <div class="container-full">
        <div id="content"></div>
    </div>
</main>
<script type="text/javascript">
    $(document).ready(function () {
        $('input').val('');
        $('.select-wrapper input').val('');
        $('.select-wrapper input').attr('placeholder','Select Name');
        var main = $('#content');
        var url = 'app/controllers/ReportController.php';
        var form = $('#search');

        var test = find_all(url, main);
        console.log(test)

    });


</script>
</body>
</html>
