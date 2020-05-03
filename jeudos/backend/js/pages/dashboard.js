//[Dashboard Javascript]

//Project:	CrmX Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	
	
	
	Apex.grid = {
	  padding: {
		right: 0,
		left: 0
	  }
	}

	Apex.dataLabels = {
	  enabled: false
	}

	var randomizeArray = function (arg) {
	  var array = arg.slice();
	  var currentIndex = array.length, temporaryValue, randomIndex;

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
		id: 'sparkline1',
		group: 'sparklines',
		type: 'area',
		height: 295,
		sparkline: {
		  enabled: true
		},
	  },
	  stroke: {
		curve: 'straight'
	  },
	  fill: {
		opacity: 1,
		colors: ['#689f38']
	  },
	  series: [{
		name: 'Sales',
		data: randomizeArray(sparklineData)
	  }],
	  labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
	  yaxis: {
		min: 0
	  },
	  xaxis: {
		type: 'datetime',
	  },
	  colors: ['#689f38'],
	  
	}
	
	new ApexCharts(document.querySelector("#spark1"), spark1).render();
	
	
	window.Apex = {
	  chart: {
		foreColor: '#666666',
		toolbar: {
		  show: false
		},
	  },
	  colors: ['#689f38', '#ff8f00'],
	  stroke: {
		width: 3
	  },
	  dataLabels: {
		enabled: false
	  },
	  grid: {
		borderColor: "#f7f7f7",
	  },
	  xaxis: {
		axisTicks: {
		  color: '#cccccc'
		},
		axisBorder: {
		  color: "#cccccc"
		}
	  },
	  fill: {
		type: 'gradient',
		gradient: {
		  gradientToColors: ['#ff8f00', '#689f38']
		},
	  },
	  tooltip: {
		x: {
		  formatter: function (val) {
			return moment(new Date(val)).format("HH:mm:ss")
		  }
		}
	  },
	  yaxis: {
		opposite: true,
		labels: {
		  offsetX: -10
		}
	  }
	};

	var trigoStrength = 3
	var iteration = 11

	function getRandom() {
	  var i = iteration;
	  return (Math.sin(i / trigoStrength) * (i / trigoStrength) + i / trigoStrength + 1) * (trigoStrength * 2)
	}

	function getRangeRandom(yrange) {
	  return Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min
	}

	function generateMinuteWiseTimeSeries(baseval, count, yrange) {
	  var i = 0;
	  var series = [];
	  while (i < count) {
		var x = baseval;
		var y = ((Math.sin(i / trigoStrength) * (i / trigoStrength) + i / trigoStrength + 1) * (trigoStrength * 2));

		series.push([x, y]);
		baseval += 300000;
		i++;
	  }
	  return series;
	}



	function getNewData(baseval, yrange) {
	  var newTime = baseval + 300000;
	  return {
		x: newTime,
		y: Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min
	  };
	}

	var optionsColumn = {
	  chart: {
		height: 350,
		type: 'bar',
		animations: {
		  enabled: true,
		  easing: 'linear',
		  dynamicAnimation: {
			speed: 1000
		  }
		},
		// dropShadow: {
		//   enabled: true,
		//   left: -14,
		//   top: -10,
		//   opacity: 0.05
		// },
		events: {
		  animationEnd: function (chartCtx) {
			const newData = chartCtx.w.config.series[0].data.slice()
			newData.shift();
			window.setTimeout(function () {
			  chartCtx.updateOptions({
				series: [{
				  data: newData
				}],
				xaxis: {
				  min: chartCtx.minX,
				  max: chartCtx.maxX
				},
				subtitle: {
				  text: parseInt(getRangeRandom({min: 1, max: 20})).toString() + '%',
				}
			  }, false, false);
			}, 300);
		  }
		},
		toolbar: {
		  show: false
		},
		zoom: {
		  enabled: false
		}
	  },
	  dataLabels: {
		enabled: false
	  },
	  stroke: {
		width: 0,
	  },
	  series: [{
		name: 'Load Average',
		data: generateMinuteWiseTimeSeries(new Date("12/12/2019 00:20:00").getTime(), 12, {
		  min: 10,
		  max: 110
		})
	  }],
	  subtitle: {
		text: '40%',
		floating: true,
		align: 'right',
		offsetY: 0,
		style: {
		  fontSize: '22px'
		}
	  },
	  fill: {
		type: 'gradient',
		gradient: {
		  shade: 'dark',
		  type: 'vertical',
		  shadeIntensity: 0.5,
		  inverseColors: false,
		  opacityFrom: 1,
		  opacityTo: 0.8,
		  stops: [0, 100]
		}
	  },
	  xaxis: {
		type: 'datetime',
		range: 2700000
	  },
	  legend: {
		show: true
	  },
	};



	var chartColumn = new ApexCharts(
	  document.querySelector("#columnchart1"),
	  optionsColumn
	);
	chartColumn.render();

	var optionsLine = {
	  chart: {
		height: 350,
		type: 'line',
		stacked: true,
		animations: {
		  enabled: true,
		  easing: 'linear',
		  dynamicAnimation: {
			speed: 1000
		  }
		},
		dropShadow: {
		  enabled: true,
		  opacity: 0.3,
		  blur: 5,
		  left: -7,
		  top: 22
		},
		events: {
		  animationEnd: function (chartCtx) {
			const newData1 = chartCtx.w.config.series[0].data.slice()
			newData1.shift()
			const newData2 = chartCtx.w.config.series[1].data.slice()
			newData2.shift()
			window.setTimeout(function () {
			  chartCtx.updateOptions({
				series: [{
				  data: newData1
				}, {
				  data: newData2
				}],
				subtitle: {
				  text: parseInt(getRandom() * Math.random()).toString(),
				}
			  }, false, false);
			}, 300);
		  }
		},
		toolbar: {
		  show: false
		},
		zoom: {
		  enabled: false
		}
	  },
	  dataLabels: {
		enabled: false
	  },
	  stroke: {
		curve: 'straight',
		width: 5,
	  },
	  grid: {
		padding: {
		  left: 0,
		  right: 0
		}
	  },
	  markers: {
		size: 0,
		hover: {
		  size: 0
		}
	  },
	  series: [{
		name: 'Running',
		data: generateMinuteWiseTimeSeries(new Date("12/12/2019 00:20:00").getTime(), 12, {
		  min: 30,
		  max: 110
		})
	  }, {
		name: 'Waiting',
		data: generateMinuteWiseTimeSeries(new Date("12/12/2019 00:20:00").getTime(), 12, {
		  min: 30,
		  max: 110
		})
	  }],
	  xaxis: {
		type: 'datetime',
		range: 2700000
	  },
	  subtitle: {
		text: '20',
		floating: true,
		align: 'right',
		offsetY: 0,
		style: {
		  fontSize: '22px'
		}
	  },
	  legend: {
		show: true,
		floating: true,
		horizontalAlign: 'left',
		onItemClick: {
		  toggleDataSeries: false
		},
		position: 'top',
		offsetY: -33,
		offsetX: 60
	  },
	};

	var chartLine = new ApexCharts(
	  document.querySelector("#linechart1"),
	  optionsLine
	);
	chartLine.render();
	
	window.setInterval(function () {

	  iteration++;

	  chartColumn.updateSeries([{
		data: [...chartColumn.w.config.series[0].data,
		  [
			chartColumn.w.globals.maxX + 210000,
			getRandom()
		  ]
		]
	  }])

	  chartLine.updateSeries([{
		data: [...chartLine.w.config.series[0].data,
		  [
			chartLine.w.globals.maxX + 300000,
			getRandom()
		  ]
		]
	  }, {
		data: [...chartLine.w.config.series[1].data,
		  [
			chartLine.w.globals.maxX + 300000,
			getRandom()
		  ]
		]
	  }])


	}, 3000)
	
	
	$('.countnm').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 5000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			}
		});
	});
	
	
	
	
	
	
	$('.owl-carousel').owlCarousel({
		loop: true,
		margin: 10,
		responsiveClass: true,
		autoplay: true,
		responsive: {
		  0: {
			items: 1,
			nav: false
		  },
		  600: {
			items: 1,
			nav: false
		  },
		  1000: {
			items: 1,
			nav: false,
			margin: 20
		  }
		}
	  });
	
	//-----demo-6	
	var chart = new Chartist.Line('.ct-chart-6', {
	  labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
	  series: [
		[12, 9, 7, 8, 5, 4, 6, 2, 3, 3, 4, 6],
		[4,  5, 3, 7, 3, 5, 5, 3, 4, 4, 5, 5],
		[5,  3, 4, 5, 6, 3, 3, 4, 5, 6, 3, 4],
		[3,  4, 5, 6, 7, 6, 4, 5, 6, 7, 6, 3]
	  ]
	}, {
	  low: 0
	});

	// Let's put a sequence number aside so we can use it in the event callbacks
	var seq = 0,
	  delays = 80,
	  durations = 500;

	// Once the chart is fully created we reset the sequence
	chart.on('created', function() {
	  seq = 0;
	});

	// On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
	chart.on('draw', function(data) {
	  seq++;

	  if(data.type === 'line') {
		// If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
		data.element.animate({
		  opacity: {
			// The delay when we like to start the animation
			begin: seq * delays + 1000,
			// Duration of the animation
			dur: durations,
			// The value where the animation should start
			from: 0,
			// The value where it should end
			to: 1
		  }
		});
	  } else if(data.type === 'label' && data.axis === 'x') {
		data.element.animate({
		  y: {
			begin: seq * delays,
			dur: durations,
			from: data.y + 100,
			to: data.y,
			// We can specify an easing function from Chartist.Svg.Easing
			easing: 'easeOutQuart'
		  }
		});
	  } else if(data.type === 'label' && data.axis === 'y') {
		data.element.animate({
		  x: {
			begin: seq * delays,
			dur: durations,
			from: data.x - 100,
			to: data.x,
			easing: 'easeOutQuart'
		  }
		});
	  } else if(data.type === 'point') {
		data.element.animate({
		  x1: {
			begin: seq * delays,
			dur: durations,
			from: data.x - 10,
			to: data.x,
			easing: 'easeOutQuart'
		  },
		  x2: {
			begin: seq * delays,
			dur: durations,
			from: data.x - 10,
			to: data.x,
			easing: 'easeOutQuart'
		  },
		  opacity: {
			begin: seq * delays,
			dur: durations,
			from: 0,
			to: 1,
			easing: 'easeOutQuart'
		  }
		});
	  } else if(data.type === 'grid') {
		// Using data.axis we get x or y which we can use to construct our animation definition objects
		var pos1Animation = {
		  begin: seq * delays,
		  dur: durations,
		  from: data[data.axis.units.pos + '1'] - 30,
		  to: data[data.axis.units.pos + '1'],
		  easing: 'easeOutQuart'
		};

		var pos2Animation = {
		  begin: seq * delays,
		  dur: durations,
		  from: data[data.axis.units.pos + '2'] - 100,
		  to: data[data.axis.units.pos + '2'],
		  easing: 'easeOutQuart'
		};

		var animations = {};
		animations[data.axis.units.pos + '1'] = pos1Animation;
		animations[data.axis.units.pos + '2'] = pos2Animation;
		animations['opacity'] = {
		  begin: seq * delays,
		  dur: durations,
		  from: 0,
		  to: 1,
		  easing: 'easeOutQuart'
		};

		data.element.animate(animations);
	  }
	});

	// For the sake of the example we update the chart every time it's created with a delay of 10 seconds
	chart.on('created', function() {
	  if(window.__exampleAnimateTimeout) {
		clearTimeout(window.__exampleAnimateTimeout);
		window.__exampleAnimateTimeout = null;
	  }
	  window.__exampleAnimateTimeout = setTimeout(chart.update.bind(chart), 12000);
	});
	
	//-----demo-7
	var chart = new Chartist.Line('.ct-chart-7', {
	  labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
	  series: [
		[1, 5, 2, 5, 4, 3],
		[2, 3, 4, 8, 1, 2],
		[5, 4, 3, 2, 1, 0.5]
	  ]
	}, {
	  low: 0,
	  showArea: true,
	  showPoint: false,
	  fullWidth: true
	});

	chart.on('draw', function(data) {
	  if(data.type === 'line' || data.type === 'area') {
		data.element.animate({
		  d: {
			begin: 2000 * data.index,
			dur: 2000,
			from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
			to: data.path.clone().stringify(),
			easing: Chartist.Svg.Easing.easeOutQuint
		  }
		});
	  }
	});
	
	
	
	// ------------------------------
    // Basic bar chart
    // ------------------------------
    // based on prepared DOM, initialize echarts instance
        var myChart = echarts.init(document.getElementById('basic-bar'));

        // specify chart configuration item and data
        var option = {
                // Setup grid
                grid: {
                    left: '1%',
                    right: '2%',
                    bottom: '3%',
                    containLabel: true
                },

                // Add Tooltip
                tooltip : {
                    trigger: 'axis'
                },

                legend: {
                    data:['Site A','Site B']
                },
                toolbox: {
                    show : true,
                    feature : {

                        magicType : {show: true, type: ['line', 'bar']},
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                color: ["#689f38", "#389f99"],
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        data : ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec']
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'Site A',
                        type:'bar',
                        data:[7.2, 5.3, 6.1, 32.1, 23.1, 89.2, 158.4, 178.1, 36.4, 22.7, 7.1, 9.4],
                        markPoint : {
                            data : [
                                {type : 'max', name: 'Max'},
                                {type : 'min', name: 'Min'}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name: 'Average'}
                            ]
                        }
                    },
                    {
                        name:'Site B',
                        type:'bar',
                        data:[19.4, 7.9, 8.9, 27.9, 24.8, 88.1, 167.8, 197.5, 47.1, 16.7, 7.1, 1.5],
                        markPoint : {
                            data : [
                                {name : 'The highest year', value : 182.2, xAxis: 7, yAxis: 183, symbolSize:18},
                                {name : 'Year minimum', value : 2.3, xAxis: 11, yAxis: 3}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name : 'Average'}
                            ]
                        }
                    }
                ]
            };
        // use configuration item and data specified to show chart
        myChart.setOption(option);
	
	var a = c3.generate({
        bindto: "#stacked-bar",
        size: { height: 380 },
        color: { pattern: ["#689f38", "#38649f", "#389f99", "#ee1044"] },
        data: {
            columns: [
                ['data1', -30, 200, 200, 400, -150, 250],
				['data2', 130, 100, -100, 200, -150, 50],
				['data3', -230, 200, 200, -300, 250, 250]
            ],
            type: "bar",
            groups: [
                ["data1", "data2"]
            ]
        },
        grid: { y: { show: !0 } },
        axis: { rotated: !0 }
    });
    setTimeout(function() {
        a.groups([
            ["data1", "data2", "data3"]
        ])
    }, 1e3), setTimeout(function() {
        a.load({
            columns: [
                ['data4', 100, -50, 150, 200, -300, -100]
            ]
        })
    }, 1500), setTimeout(function() {
        a.groups([
            ["data1", "data2", "data3", "data4"]
        ])
    }, 2e3);
	
  
	
}); // End of use strict


$(function () {

  'use strict';

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