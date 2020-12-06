<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>
<!-- Chart code -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }

    #chartdiv1 {
        width: 100%;
        height: 500px;
    }

    .amcharts-export-menu-top-right {
        top: 10px;
        right: 0;
    }
</style>

<!-- Chart code -->
<script>
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "none",
        "marginRight": 70,
        "dataProvider": [
            <?php foreach ($visualize as $r) { ?> {
                    "country": "<?php echo $r->nama_kesatuan ?>",
                    "visits": <?php echo $r->tot_hilang ?>,
                    "color": "#FB0F00"
                },
            <?php } ?>
        ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": "Rekap Jumlah Kendaraan Hilang"
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 50
        },
        "export": {
            "enabled": true
        }

    });
</script>

<script>
    var chart = AmCharts.makeChart("chartdiv1", {
        "type": "serial",
        "theme": "light",
        "marginRight": 70,
        "dataProvider": [
            <?php foreach ($visualize as $r) { ?> {
                    "country": "<?php echo $r->nama_kesatuan ?>",
                    "visits": <?php echo $r->tot_temu ?>,
                    "color": "#FF0F88"
                },
            <?php } ?>
        ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": "Rekap Jumlah Kendaraan Ditemukan"
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 50
        },
        "export": {
            "enabled": true
        }

    });
</script>

<div class="right_col" role="main">


    <div class="dashboard_graph">

        <div class="row x_title">
            <div class="col-md-12">
                <h4>Jumlah Kendaraan Hilang dan Temu </h4>
                <small>Jumlah diambil dari rekap Kendaraan Hilang</small>
            </div>

        </div>

        <div class="col-md-6 col-sm-9 ">
            <div class="x_title">
                <h2>Summary Kendaraan Hilang</h2>
                <div class="clearfix"></div>
            </div>
            <div id="chartdiv" class="demo-placeholder"></div>
        </div>
        <div class="col-md-6 col-sm-3  bg-white">
            <div class="x_title">
                <h2>Summary Kendaraan Temu</h2>
                <div class="clearfix"></div>
            </div>
            <div id="chartdiv1" class="demo-placeholder"></div>


        </div>

        <div class="clearfix"></div>
    </div>

    <br />
</div>