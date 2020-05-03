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
    var sparklineData = [15,18,12,19,23,25,18,27,50,12,40,41,21,11,14,8,14,17,32,45,42,21,39,18];

    var spark1 = {
      chart: {
        type: 'line',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        curve: 'smooth',
      },
      fill: {
        opacity: 1,
        gradient: {
          enabled: false
        }
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
      colors: ['#ee1044'],
      subtitle: {
        offsetX: 0,
        style: {
          fontSize: '14px',
          cssClass: 'apexcharts-yaxis-title'
        }
      }
    }

    var spark2 = {
      chart: {
        type: 'line',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        curve: 'smooth'
      },
      fill: {
        opacity: 1,
        gradient: {
          enabled: false
        }
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
      colors: ['#ff8f00'],
      subtitle: {
        offsetX: 0,
        style: {
          fontSize: '14px',
          cssClass: 'apexcharts-yaxis-title'
        }
      }
    }

    var spark3 = {
      chart: {
        type: 'line',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        curve: 'smooth'
      },
      fill: {
        opacity: 1,
        gradient: {
          enabled: false
        }
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
      colors: ['#689f38'],
      subtitle: {
        offsetX: 0,
        style: {
          fontSize: '14px',
          cssClass: 'apexcharts-yaxis-title'
        }
      }
    }

    var spark1 = new ApexCharts(document.querySelector("#spark1"), spark1);
    spark1.render();
    var spark2 = new ApexCharts(document.querySelector("#spark2"), spark2);
    spark2.render();
    var spark3 = new ApexCharts(document.querySelector("#spark3"), spark3);
    spark3.render();
	
	

	var options = {
      chart: {
        height: 310,
        type: 'line',
      },
      colors: ['#38649f', '#ee1044'],
      series: [{
        name: 'Genaral',
        type: 'column',
        data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
      }, {
        name: 'Emergency',
        type: 'line',
        data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
      }],
      stroke: {
        width: [0, 4]
      },
      // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      labels: ['01 Jan 2001', '02 Jan 2001', '03 Jan 2001', '04 Jan 2001', '05 Jan 2001', '06 Jan 2001', '07 Jan 2001', '08 Jan 2001', '09 Jan 2001', '10 Jan 2001', '11 Jan 2001', '12 Jan 2001'],
      xaxis: {
        type: 'datetime'
      },
      yaxis: [{
        title: {
          text: 'Genaral',
        },

      }, {
        opposite: true,
        title: {
          text: 'Emergency'
        }
      }]

    }

    var chart = new ApexCharts(
      document.querySelector("#chart-lca"),
      options
    );

    chart.render();
	
	
	
	var options = {
      chart: {
        height: 310,
        type: 'area',
        stacked: true,
		  zoom: {
            enabled: false
          },
        events: {
          selection: function(chart, e) {
            console.log(new Date(e.xaxis.min) )
          }
        },

      },
      colors: ['#389f99', '#ee1044', '#ff8f00'],
      dataLabels: {
          enabled: false
      },
      stroke: {
        curve: 'smooth'
      },

      series: [{
          name: 'Gen.',
          data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
            min: 10,
            max: 60
          })
        },
        {
          name: 'Emerg.',
          data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
            min: 10,
            max: 20
          })
        },
        
        {
          name: 'OT',
          data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
            min: 10,
            max: 15
          })
        }
      ],
      fill: {
        gradient: {
          enabled: true,
          opacityFrom: 0.5,
          opacityTo: 0,
        }
      },
      legend: {
        position: 'top',
        horizontalAlign: 'left'
      },
      xaxis: {
        type: 'datetime'
      },
    }

    var chart = new ApexCharts(
      document.querySelector("#chart-sa"),
      options
    );

    chart.render();

    /*
      // this function will generate output in this format
      // data = [
          [timestamp, 23],
          [timestamp, 33],
          [timestamp, 12]
          ...
      ]
      */
    function generateDayWiseTimeSeries(baseval, count, yrange) {
      var i = 0;
      var series = [];
      while (i < count) {
        var x = baseval;
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        series.push([x, y]);
        baseval += 86400000;
        i++;
      }
      return series;
    }
	
	
		// ------------------------------
    // Nested chart
    // ------------------------------
    // based on prepared DOM, initialize echarts instance
        var nestedChart = echarts.init(document.getElementById('nested-pie'));
        var option = {
            
           tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: ['OPD','ICU','OT','Heart']
                },

                // Add custom colors
                color: ['#38649f', '#389f99', '#ee1044', '#ff8f00'],

                // Display toolbox
                toolbox: {
                    show: true,
                    orient: 'vertical',
                    feature: {
                        mark: {
                            show: true,
                            title: {
                                mark: 'Markline switch',
                                markUndo: 'Undo markline',
                                markClear: 'Clear markline'
                            }
                        },
                        dataView: {
                            show: true,
                            readOnly: false,
                            title: 'View data',
                            lang: ['View chart data', 'Close', 'Update']
                        },
                        magicType: {
                            show: true,
                            title: {
                                pie: 'Switch to pies',
                                funnel: 'Switch to funnel',
                            },
                            type: ['pie', 'funnel']
                        },
                        restore: {
                            show: true,
                            title: 'Restore'
                        },
                        saveAsImage: {
                            show: true,
                            title: 'Same as image',
                            lang: ['Save']
                        }
                    }
                },

                // Enable drag recalculate
                calculable: false,

                // Add series
                series: [

                    // Inner
                    {
                        name: 'Countries',
                        type: 'pie',
                        selectedMode: 'single',
                        radius: [0, '40%'],

                        // for funnel
                        x: '15%',
                        y: '7.5%',
                        width: '40%',
                        height: '85%',
                        funnelAlign: 'right',
                        max: 1548,

                        itemStyle: {
                            normal: {
                                label: {
                                    position: 'inner'
                                },
                                labelLine: {
                                    show: false
                                }
                            },
                            emphasis: {
                                label: {
                                    show: true
                                }
                            }
                        },

                        data: [
                            {value: 535, name: 'General'},
                            {value: 679, name: 'Emergency'}
                        ]
                    },

                    // Outer
                    {
                        name: 'Countries',
                        type: 'pie',
                        radius: ['60%', '85%'],

                        // for funnel
                        x: '55%',
                        y: '7.5%',
                        width: '35%',
                        height: '85%',
                        funnelAlign: 'left',
                        max: 1048,

                        data: [
                            {value:335, name: 'OPD'},
							{value:310, name: 'ICU'},
							{value:234, name: 'OT'},
							{value:135, name: 'Heart'}
                        ]
                    }
                ]
        };    
       
    
        nestedChart.setOption(option);
	
	
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




                


