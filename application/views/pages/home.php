<script>
    console.log('test');
</script>
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.PieChart);

        // Add data
        chart.data = [{
            "country": "Lithuania",
            "litres": 501.9
        }, {
            "country": "Czechia",
            "litres": 301.9
        }, {
            "country": "Ireland",
            "litres": 201.1
        }, {
            "country": "Germany",
            "litres": 165.8
        }, {
            "country": "Australia",
            "litres": 139.9
        }, {
            "country": "Austria",
            "litres": 128.3
        }, {
            "country": "UK",
            "litres": 99
        }, {
            "country": "Belgium",
            "litres": 60
        }, {
            "country": "The Netherlands",
            "litres": 50
        }];

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "litres";
        pieSeries.dataFields.category = "country";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;

        // This creates initial animation
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;

    }); // end am4core.ready()
</script>
<div class="right_col" role="main">


    <div class="dashboard_graph">

        <div class="row x_title">
            <div class="col-md-6">
                <h4>Persentase Kehilangan Kendaraan <small></small></h4>
            </div>
            <div class="col-md-6">
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                    <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-sm-9 ">
            <div id="chartdiv" class="demo-placeholder"></div>
        </div>
        <div class="col-md-3 col-sm-3  bg-white">
            <div class="x_title">
                <h2>Curanmor 4 Bulan terakhir</h2>
                <div class="clearfix"></div>
            </div>

            <div class="col-md-12 col-sm-12 ">
                <div>
                    <p>Facebook Campaign</p>
                    <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <p>Twitter Campaign</p>
                    <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div>
                    <p>Conventional Media</p>
                    <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <p>Bill boards</p>
                    <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="clearfix"></div>
    </div>

    <br />
</div>