//[Dashboard Javascript]

//Project:	CrmX Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	
	 window.Apex = {
      stroke: {
        width: 3
      },
      markers: {
        size: 0
      },
      tooltip: {
        fixed: {
          enabled: true,
        }
      }
    };
    
    var randomizeArray = function (arg) {
      var array = arg.slice();
      var currentIndex = array.length,
        temporaryValue, randomIndex;

      while (0 !== currentIndex) {

        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
      }

      return array;
    }

    // data for the sparklines that appear below header area
    var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];

    var spark1 = {
      chart: {
        type: 'area',
        height: 200,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        curve: 'smooth'
      },
      fill: {
        opacity: 0.3,
        type: 'gradient',
		gradient: {
		  gradientToColors: ['#689f38', '#689f38']
		},
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
		labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
      yaxis: {
        min: 0
      },
	  xaxis: {
		type: 'datetime',
	  },
      colors: ['#DCE6EC'],
		tooltip: {
			theme: 'dark'
  		},
    }
	
	var spark2 = {
      chart: {
        type: 'area',
        height: 200,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        curve: 'smooth'
      },
      fill: {
        opacity: 0.3,
        type: 'gradient',
		gradient: {
		  gradientToColors: ['#ff8f00', '#ff8f00']
		},
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
	  labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
      yaxis: {
        min: 0
      },
	  xaxis: {
		type: 'datetime',
	  },
      colors: ['#DCE6EC'],
		tooltip: {
			theme: 'dark'
  		},
    };
	
	 var spark3 = {
      chart: {
        type: 'area',
        height: 200,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        curve: 'smooth'
      },
      fill: {
        opacity: 0.3,
        type: 'gradient',
		gradient: {
		  gradientToColors: ['#ee1044', '#ee1044']
		},
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
	  labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
	  xaxis: {
		type: 'datetime',
	  },
      yaxis: {
        min: 0
      },
      colors: ['#DCE6EC'],
		tooltip: {
			theme: 'dark'
  		},
    };
	
	var spark4 = {
      chart: {
        type: 'area',
        height: 165,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        curve: 'smooth'
      },
      fill: {
        opacity: 1,
        type: 'gradient',
		gradient: {
		  gradientToColors: ['#38649f', '#38649f']
		},
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
	  labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
      yaxis: {
        min: 0
      },
	  xaxis: {
		type: 'datetime',
	  },
      colors: ['#38649f'],
		tooltip: {
			theme: 'dark'
  		},
    };
	
	var spark1 = new ApexCharts(document.querySelector("#spark1"), spark1);
    spark1.render();
	var spark2 = new ApexCharts(document.querySelector("#spark2"), spark2);
    spark2.render();
    var spark3 = new ApexCharts(document.querySelector("#spark3"), spark3);
    spark3.render();
    var spark4 = new ApexCharts(document.querySelector("#spark4"), spark4);
    spark4.render();
	

		
// table
	$('#invoice-list').DataTable({
	  'paging'      : true,
	  'lengthChange': false,
	  'searching'   : false,
	  'ordering'    : true,
	  'info'        : true,
	  'autoWidth'   : true,
	});	
	
	

	

	
	var optionsBar = {
		  chart: {
			type: 'bar',
			height: 460,
			width: '100%',
			stacked: true,
		  },
		  plotOptions: {
			bar: {
			  columnWidth: '45%',
			}
		  },
		  colors:['#689f38', '#ee1044'],
		  series: [{
			name: "Clothing",
			data: [42, 52, 16, 55, 59, 51, 45, 32, 26, 33, 44, 51, 42, 56],
		  }, {
			name: "Food Products",
			data: [6, 12, 4, 7, 5, 3, 6, 4, 3, 3, 5, 6, 7, 4],
		  }],
		  labels: [10,11,12,13,14,15,16,17,18,19,20,21,22,23],
		  xaxis: {
			labels: {
			  show: false
			},
			axisBorder: {
			  show: false
			},
			axisTicks: {
			  show: false
			},
		  },
		  yaxis: {
			axisBorder: {
			  show: false
			},
			axisTicks: {
			  show: false
			},
			labels: {
			  style: {
				color: '#78909c'
			  }
			}
		  },

		}

		var chartBar = new ApexCharts(document.querySelector('#bar'), optionsBar);
		chartBar.render();
	
	var optionDonut = {
	  chart: {
		  type: 'donut',
		  width: '100%'
	  },
	  dataLabels: {
		enabled: false,
	  },
	  plotOptions: {
		pie: {
		  donut: {
			size: '45%',
		  },
		  offsetY: 0,
		},
		stroke: {
		  colors: undefined
		}
	  },
		responsive: [{
			breakpoint: 1500,
			options: {	
				chart: {
					  width: '94%'
				  },
			},
		}],
		responsive: [{
			breakpoint: 1400,
			options: {	
				chart: {
					  width: '100%'
				  },
			},
		}],
		responsive: [{
			breakpoint: 1350,
			options: {	
				chart: {
					  width: '110%'
				  },
			},
		}],
	  colors:['#689f38', '#389f99', '#38649f', '#ff8f00', '#ee1044'],
	  
	  series: [21, 23, 19, 14, 6],
	  labels: ['Clothing', 'Food Products', 'Electronics', 'Kitchen', 'Gardening'],
	  legend: {
		position: 'bottom'
	  }
	}

	var donut = new ApexCharts(
	  document.querySelector("#donut"),
	  optionDonut
	)
	donut.render();
	
	var myConfig = {
        "type": "line",
		"utc": true,
        "plot": {
          "animation": {
            "delay": 500,
            "effect": "ANIMATION_SLIDE_LEFT"
          }
        },
        "plotarea": {
          "margin": "50px 25px 70px 46px"
        },
        "scale-y": {
          "values": "0:100:25",
          "line-color": "none",
          "guide": {
            "line-style": "solid",
            "line-color": "#d2dae2",
            "line-width": "1px",
            "alpha": 0.5
          },
          "tick": {
            "visible": false
          },
          "item": {
            "font-color": "#8391a5",
            "font-family": "Arial",
            "font-size": "10px",
            "padding-right": "5px"
          }
        },
        "scale-x": {
          "line-color": "#d2dae2",
          "line-width": "2px",
          "values": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          "tick": {
            "line-color": "#d2dae2",
            "line-width": "1px"
          },
          "guide": {
            "visible": false
          },
          "item": {
            "font-color": "#8391a5",
            "font-family": "Arial",
            "font-size": "10px",
            "padding-top": "5px"
          }
        },
        "legend": {
          "layout": "x4",
          "background-color": "none",
          "shadow": 0,
          "margin": "auto auto 15 auto",
          "border-width": 0,
          "item": {
            "font-color": "#707d94",
            "font-family": "Arial",
            "padding": "0px",
            "margin": "0px",
            "font-size": "9px"
          },
          "marker": {
            "show-line": "true",
            "type": "match",
            "font-family": "Arial",
            "font-size": "10px",
            "size": 4,
            "line-width": 2,
            "padding": "3px"
          }
        },
        "crosshair-x": {
          "lineWidth": 1,
          "line-color": "#707d94",
          "plotLabel": {
            "shadow": false,
            "font-color": "#000",
            "font-family": "Arial",
            "font-size": "10px",
            "padding": "5px 10px",
            "border-radius": "5px",
            "alpha": 1
          },
          "scale-label": {
            "font-color": "#ffffff",
            "background-color": "#707d94",
            "font-family": "Arial",
            "font-size": "10px",
            "padding": "5px 10px",
            "border-radius": "5px"
          }
        },
        "tooltip": {
          "visible": false
        },
        "series": [{
          "values": [69, 68, 54, 48, 70, 74, 98, 70, 72, 68, 49, 69],
          "text": "Kenmore",
          "line-color": "#389f99",
          "line-width": "2px",
          "shadow": 0,
          "marker": {
            "background-color": "#fff",
            "size": 3,
            "border-width": 1,
            "border-color": "#389f99",
            "shadow": 0
          },
          "palette": 0
        }, {
          "values": [51, 53, 47, 60, 48, 52, 75, 52, 55, 47, 60, 48],
          "text": "Craftsman",
          "line-width": "2px",
          "line-color": "#38649f",
          "shadow": 0,
          "marker": {
            "background-color": "#fff",
            "size": 3,
            "border-width": 1,
            "border-color": "#38649f",
            "shadow": 0
          },
          "palette": 1,
          "visible": 1
        }, {
          "values": [42, 43, 30, 50, 31, 48, 55, 46, 48, 32, 50, 38],
          "text": "DieHard",
          "line-color": "#ee1044",
          "line-width": "2px",
          "shadow": 0,
          "marker": {
            "background-color": "#fff",
            "size": 3,
            "border-width": 1,
            "border-color": "#ee1044",
            "shadow": 0
          },
          "palette": 2,
          "visible": 1
        }, {
          "values": [25, 15, 26, 21, 24, 26, 33, 25, 15, 25, 22, 24],
          "text": "Land's End",
          "line-color": "#ff8f00",
          "line-width": "2px",
          "shadow": 0,
          "marker": {
            "background-color": "#fff",
            "size": 3,
            "border-width": 1,
            "border-color": "#ff8f00",
            "shadow": 0
          },
          "palette": 3
        }]
      };

    zingchart.render({
      id: 'myChart',
      data: myConfig,
      height: 500,
      width: '100%'
    });
	

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



                


