$(function(){        
    /* reportrange */
    if($("#reportrange").length > 0){   
        $("#reportrange").daterangepicker({                    
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM.DD.YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment()            
          },function(start, end) {
              $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
        
        $("#reportrange span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    }
    /* end reportrange */
    
    /* Rickshaw dashboard chart */
    /*var seriesData = [ [], [] ];
    var random = new Rickshaw.Fixtures.RandomData(1000);

    for(var i = 0; i < 100; i++) {
    random.addData(seriesData);
    }

    var rdc = new Rickshaw.Graph( {
            element: document.getElementById("dashboard-chart"),
            renderer: 'area',
            width: $("#dashboard-chart").width(),
            height: 250,
            series: [{color: "#33414E",data: seriesData[0],name: 'New'}, 
                     {color: "#1caf9a",data: seriesData[1],name: 'Returned'}]
    } );

    rdc.render();

    var legend = new Rickshaw.Graph.Legend({graph: rdc, element: document.getElementById('dashboard-legend')});
    var shelving = new Rickshaw.Graph.Behavior.Series.Toggle({graph: rdc,legend: legend});
    var order = new Rickshaw.Graph.Behavior.Series.Order({graph: rdc,legend: legend});
    var highlight = new Rickshaw.Graph.Behavior.Series.Highlight( {graph: rdc,legend: legend} );        

    var rdc_resize = function() {                
            rdc.configure({
                    width: $("#dashboard-area-1").width(),
                    height: $("#dashboard-area-1").height()
            });
            rdc.render();
    }

    var hoverDetail = new Rickshaw.Graph.HoverDetail({graph: rdc});

    window.addEventListener('resize', rdc_resize);        

    rdc_resize();*/
    /* END Rickshaw dashboard chart */
    
    /* Donut dashboard chart */
    /*Morris.Donut({
        element: 'dashboard-donut-1',
        data: [
            {label: "Returned", value: 2513},
            {label: "New", value: 764},
            {label: "Registred", value: 311}
        ],
        colors: ['#33414E', '#1caf9a', '#FEA223'],
        resize: true
    });*/
    /* END Donut dashboard chart */
	
	
    /* Bar dashboard chart */
    /*Morris.Bar({
        element: 'dashboard-bar-1',
        data: [
            { y: 'Oct 10', a: 75, b: 35 },
            { y: 'Oct 11', a: 64, b: 26 },
            { y: 'Oct 12', a: 78, b: 39 },
            { y: 'Oct 13', a: 82, b: 34 },
            { y: 'Oct 14', a: 86, b: 39 },
            { y: 'Oct 15', a: 94, b: 40 },
            { y: 'Oct 16', a: 96, b: 41 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['New Users', 'Returned'],
        barColors: ['#33414E', '#1caf9a'],
        gridTextSize: '10px',
        hideHover: true,
        resize: true,
        gridLineColor: '#E5E5E5'
    });*/
    /* END Bar dashboard chart */
    
    /* Line dashboard chart */
    /*Morris.Line({
      element: 'dashboard-line-1',
      data: [
        { y: '2014-10-10', a: 2,b: 4},
        { y: '2014-10-11', a: 4,b: 6},
        { y: '2014-10-12', a: 7,b: 10},
        { y: '2014-10-13', a: 5,b: 7},
        { y: '2014-10-14', a: 6,b: 9},
        { y: '2014-10-15', a: 9,b: 12},
        { y: '2014-10-16', a: 18,b: 20}
      ],
      xkey: 'y',
      ykeys: ['a','b'],
      labels: ['Sales','Event'],
      resize: true,
      hideHover: true,
      xLabels: 'day',
      gridTextSize: '10px',
      lineColors: ['#1caf9a','#33414E'],
      gridLineColor: '#E5E5E5'
    }); */
    /* EMD Line dashboard chart */
    /* Moris Area Chart */
      /*Morris.Area({
      element: 'dashboard-area-1',
      data: [
        { y: '2014-10-10', a: 17,b: 19},
        { y: '2014-10-11', a: 19,b: 21},
        { y: '2014-10-12', a: 22,b: 25},
        { y: '2014-10-13', a: 20,b: 22},
        { y: '2014-10-14', a: 21,b: 24},
        { y: '2014-10-15', a: 34,b: 37},
        { y: '2014-10-16', a: 43,b: 45}
      ],
      xkey: 'y',
      ykeys: ['a','b'],
      labels: ['Sales','Event'],
      resize: true,
      hideHover: true,
      xLabels: 'day',
      gridTextSize: '10px',
      lineColors: ['#1caf9a','#33414E'],
      gridLineColor: '#E5E5E5'
    });*/
    /* End Moris Area Chart */
    /* Vector Map */
    
    var load_event_by_region = function(region) {
        $.ajax({
            type: "POST",
            url: "ajax/event_ajax.php?event_map_details",
            dataType: "json",
            data: "region=" + region,
            success: function (result) {
                $("#event_list").html("");
                var elem = "";
                if(result.result == true) {
                    result.content.forEach(function(value){
                        // Mostro la tabellina degli eventi disponibili, colorandoli se sono completi oppure no.
                        elem += "<div class=\"progress-list\">";
                        if(value.Cont > 7) {
                            elem += "   <div class=\"pull-left\"><a href=\"events.php?event_id=" + value.Id + "\"><strong class=\"text-success\">" + value.Name + "</strong></a></div>";
                            elem += "   <div class=\"pull-right\">" + value.Cont + "/8 Decklist uploaded</div>";
                            elem += "   <div class=\"progress progress-small progress-striped active\">";
                            elem += "       <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"" + value.Cont + "\" aria-valuemin=\"0\" aria-valuemax=\"8\" style=\"width: " + value.Cont / 8 * 100 + "%;\">50%</div>";
                        } else if(value.Cont > 0) {
                            elem += "   <div class=\"pull-left\"><a href=\"events.php?event_id=" + value.Id + "\"><strong class=\"text-warning\">" + value.Name + "</strong></a></div>";
                            elem += "   <div class=\"pull-right\">" + value.Cont + "/8 Decklist uploaded</div>";
                            elem += "   <div class=\"progress progress-small progress-striped active\">";
                            elem += "       <div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"" + value.Cont + "\" aria-valuemin=\"0\" aria-valuemax=\"8\" style=\"width: " + value.Cont / 8 * 100 + "%;\">50%</div>";
                        } else {
                            elem += "   <div class=\"pull-left\"><a href=\"events.php?event_id=" + value.Id + "\"><strong class=\"text-danger\">" + value.Name + "</strong></a></div>";
                            elem += "   <div class=\"pull-right\">" + value.Cont + "/8 Decklist uploaded</div>";
                            elem += "   <div class=\"progress progress-small progress-striped active\">";
                            elem += "       <div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"" + value.Cont + "\" aria-valuemin=\"0\" aria-valuemax=\"8\" style=\"width: " + value.Cont / 8 * 100 + "%;\">50%</div>";
                        }
                        elem += "   </div>";
                        elem += "</div>";
                    });
                } else {
                    if(result.error === "no_data") {
                        elem += "<p>There are no data to show about the event in this nation.";
                    } else {
                        elem += "<p>There was a problem, contact the system administrator with the bug report button.</p>";
                        console.log(result);
                    }
                }
                $("#event_list").html(elem);
            },
            error: function(error) {
                console.log(error);
            }
        });
    };
    
    var inizialize_map = function(values) {
        var jvm_wm = new jvm.WorldMap({
            container: $('#dashboard-map-seles'),
            map: 'world_mill_en',
            backgroundColor: '#FFFFFF',
            regionStyle: {selected: {fill: '#B64645'}, initial: {fill: '#E5E5E5'}},
            series: {
                regions: [{
                    values: values,
                    scale: ['#ff0000', '#00ff1d'],
                    normalizeFunction: 'polynomial'
                }]
            },
            onRegionClick: function(e, code){
                load_event_by_region(code);
            }
        });
    };
    
    // Devo caricare anche i markers.
    $.ajax({
		type: "POST",
		url: "ajax/event_ajax.php?event_map",
		dataType: "json",
		success: function (result) {
            console.log(result);
            inizialize_map(result.content);
        },
		error: function(error) {
            console.log(error);
        }
	});
    /* END Vector Map */

    $(".x-navigation-minimize").on("click",function(){
        setTimeout(function(){
            rdc_resize();
        },200);    
    });
    
});