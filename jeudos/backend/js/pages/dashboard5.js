//[Dashboard Javascript]

//Project:	CrmX Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	
	    var ts2 = 1484418600000;
		var dates = [];
		var spikes = [5, -5, 3, -3, 8, -8]
		for (var i = 0; i < 120; i++) {
		  ts2 = ts2 + 86400000;
		  var innerArr = [ts2, dataSeries[1][i].value];
		  dates.push(innerArr)
		}

		var options = {
		  chart: {
			type: 'area',
			stacked: false,
			height: 505,
			zoom: {
			  type: 'x',
			  enabled: true
			},
			toolbar: {
			  autoSelected: 'zoom'
			}
		  },
		  dataLabels: {
			enabled: false
		  },
		  series: [{
			name: 'Balance ($)',
			data: dates
		  }],
		  markers: {
			size: 0,
		  },
		  fill: {
			type: 'gradient',
			gradient: {
			  shadeIntensity: 1,
			  inverseColors: false,
			  opacityFrom: 0.5,
			  opacityTo: 0,
			  stops: [0, 90, 100]
			},
		  },
		  yaxis: {
			min: 20000000,
			max: 250000000,
			labels: {
			  formatter: function (val) {
				return (val / 1000000).toFixed(0);
			  },
			},
			title: {
			  text: 'Price'
			},
		  },
		  xaxis: {
			type: 'datetime',
		  },

		  tooltip: {
			shared: false,
			y: {
			  formatter: function (val) {
				return (val / 1000000).toFixed(0)
			  }
			}
		  }
		}

		var chart = new ApexCharts(
		  document.querySelector("#balancehistory"),
		  options
		);

		chart.render();
	
	
//dashboard_daterangepicker
	
	if(0!==$("#dashboard_daterangepicker").length) {
		var n=$("#dashboard_daterangepicker"),
		e=moment(),
		t=moment();
		n.daterangepicker( {
			startDate:e, endDate:t, opens:"left", ranges: {
				Today: [moment(), moment()], Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")], "Last 7 Days": [moment().subtract(6, "days"), moment()], "Last 30 Days": [moment().subtract(29, "days"), moment()], "This Month": [moment().startOf("month"), moment().endOf("month")], "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
			}
		}
		, a),
		a(e, t, "")
	}
	function a(e, t, a) {
		var r="",
		o="";
		t-e<100||"Today"==a?(r="Today:", o=e.format("MMM D")): "Yesterday"==a?(r="Yesterday:", o=e.format("MMM D")): o=e.format("MMM D")+" - "+t.format("MMM D"), n.find(".subheader_daterange-date").html(o), n.find(".subheader_daterange-title").html(r)
	}
	
	
}); // End of use strict




                


