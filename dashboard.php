<?php include 'include/config.php' ?>
<?php include 'include/navbar.php' ?>
<?php
include 'include/sidenav.php';
$conn = mysqli_connect('127.0.0.1', 'root', '', 'money_exchange');
$query = 'SELECT gender, count(*) as number FROM ex_employees GROUP BY gender';
$result = mysqli_query($conn, $query);
?>
<script src="static/js/chart.js"></script>
</head>
<style>
    .dashboard {
        background-color: rgba(0, 204, 204, .4) !important;
        color: #FFF !important;
        font-weight: 800 !important;
    }

    .dashboard i {
        color: #FFF !important;
    }

    p.mp {
        text-align: center;
    }
</style>
</head>
<main>
    <div class="container-full">
        <div class="row no-margin">
            <div class="col s12 m6 xl3">
                <div class="card">
                    <div class="card-content">
                        <p>Employee</p>
                        <div class="">
                          <b>12</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 xl3">
                <div class="card">
                    <div class="card-content">
                        <p>Users</p>
                        <div class="">
                            <b>2</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 xl3">
                <div class="card">
                    <div class="card-content">
                        <p>Total Transition</p>
                        <div class="">
                            <b>20</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 xl3">
                <div class="card">
                    <div class="card-content">
                        <p>Transfer Money Today</p>
                        <div class="">
                            <b>$150.00</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-margin">
            <div class="col s12 l6">
                <div class="card">
                    <div class="card-content">
                        <div style="width: 100%; min-height: 300px" id="chart_div"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 l6">
                <div class="card">
                    <div class="card-content">
                        <div style="width: 100%; min-height: 300px" id="chart_div1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages': ['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart1);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart1() {

            // Create the data table.
            var data = google.visualization.arrayToDataTable([
                ['Gender', 'Number'],
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "['" . $row["gender"] . "', " . $row["number"] . "],";
                }
                ?>

            ]);

            // Set chart options
            var options = {
                series: {
                    0: {color: '#393F62'},
                },
                is3D: true,
                title: 'Percentage of Male and Female Employee',
                chartArea: {left: '40', right: 15, bottom: 60, top: 60, width: "100%", height: "100%"}
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages': ['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart2);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart2() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'New');
            data.addRows([
                ['7am', 4],
                ['9am', 12],
                ['11am', 15],
                ['1pm', 3],
                ['3pm', 6],
                ['5pm', 2]
            ]);

            // Set chart options
            var options = {
                curveType: 'function',
                legend: {position: 'none'},
                // series: {
                //     0: {color: '#393F62'},
                // },
                is3D: true,
                title: 'Percentage of Male and Female Employee',
                chartArea: {
                    left: '40',
                    right: 15,
                    bottom: 60,
                    top: 60,
                    width: "100%", height: "100%"
                }

            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));
            chart.draw(data, options);
        }

        $(window).resize(function () {
            drawChart1();
            drawChart2();
        });

    </script>
</main>