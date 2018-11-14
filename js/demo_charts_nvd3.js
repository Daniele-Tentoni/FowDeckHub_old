var nvd3Charts = function() {
	
        var myColors = ["#33414E","#8DCA35","#00BFDD","#FF702A","#DA3610",
                        "#80CDC2","#A6D969","#D9EF8B","#FFFF99","#F7EC37","#F46D43",
                        "#E08215","#D73026","#A12235","#8C510A","#14514B","#4D9220",
                        "#542688", "#4575B4", "#74ACD1", "#B8E1DE", "#FEE0B6","#FDB863",                                                
                        "#C51B7D","#DE77AE","#EDD3F2"];
        d3.scale.myColors = function() {
            return d3.scale.ordinal().range(myColors);
        };
        
	var startChart9 = function() {

		//Donut chart example
		nv.addGraph(function() {
			var chart = nv.models.pieChart().x(function(d) {
				return d.label;
			}).y(function(d) {
				return d.value;
			}).showLabels(true)//Display pie labels
			.labelThreshold(.05)//Configure the minimum slice size for labels to show up
			.labelType("percent")//Configure what type of data to show in the label. Can be "key", "value" or "percent"
			.donut(true)//Turn on Donut mode. Makes pie chart look tasty!
			.donutRatio(0.35)//Configure how big you want the donut hole size to be.
			;;

			d3.select("#chart-10 svg").datum(exampleData()).transition().duration(350).call(chart);

			return chart;
		});

		//Pie chart example data. Note how there is only a single array of key-value pairs.
		function exampleData() {
			return [{
				"label" : "One",
				"value" : 29.765957771107
			}, {
				"label" : "Two",
				"value" : 0
			}, {
				"label" : "Three",
				"value" : 32.807804682612
			}, {
				"label" : "Four",
				"value" : 196.45946739256
			}, {
				"label" : "Five",
				"value" : 0.19434030906893
			}, {
				"label" : "Six",
				"value" : 98.079782601442
			}, {
				"label" : "Seven",
				"value" : 13.925743130903
			}, {
				"label" : "Eight",
				"value" : 5.1387322875705
			}];
		}

	};

	return {		
		init : function() {
			startChart9();
		}
	};
}();

nvd3Charts.init();