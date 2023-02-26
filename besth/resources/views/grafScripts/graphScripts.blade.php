<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>

  window.onload = function() {
      
    //graph - 1 Canvas - 1
    var hstat = <?php echo $hstat; ?>;
    
    //graph - 1 Canvas - 1
    Chart.Legend.prototype.afterFit = function() {
      this.height = this.height + 20;
    };
    
    var barChartData3 = {
        labels: hstat,
        datasets: [{
            label: 'Herd 1',
            barThickness: 10,
            maxBarThickness:28,
            backgroundColor: ["green", "blue", "violet"],
            data: [<?php echo $htotal_size ?>, <?php echo $htotal_count ?>, <?php echo ($htotal_size - $htotal_count) ?>]
        }]
    };

    var ctx3 = document.getElementById("canvas18").getContext("2d");
    window.myBar = new Chart(ctx3, {
        type: 'pie',
        data: barChartData3,
        options: {
            legend: {
            display: true,
            position: 'top',
            labels: {
              boxWidth: 28,
              fontColor: 'black'
            }},
            elements: {
                rectangle: {
                    borderWidth: 1,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            maintainAspectRatio: true,
            title: {
                display: true,
                text: 'Status'
            },
            scales: {
              xAxes: [{
                //barThickness: 10,  // number (pixels) or 'flex'
                //maxBarThickness: 28 // number (pixels)
              }],
              yAxes: [{
                display: true,
                ticks: {
                  stepSize:5,
                  steps:6,
                    //suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                    // OR //
                    beginAtZero: true   // minimum value will be 0.
                }
                }]
            }
        }
    });
    ////////////////////////////////////////////////
    //graph - 2 Canvas - 2
    var goatStat = <?php echo $goatStatus; ?>;
    var goatStatData = <?php echo $goatsStatData; ?>;
    var barChartData2 = {
        labels: goatStat,
        datasets: [{
            label: 'Stock',
            barThickness: 20,
            maxBarThickness:28,
            backgroundColor: "green",
            data: goatStatData
        }]
    };
    var ctx2 = document.getElementById("canvas2").getContext("2d");
    window.myBar = new Chart(ctx2, {
        type: 'bar',
        data: barChartData2,
        options: {
            elements: {
                rectangle: {
                    borderWidth: 1,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            maintainAspectRatio: true,
            title: {
                display: true,
                text: 'Stock Status'
            },
            scales: {
              xAxes: [{
                //barThickness: 20,  // number (pixels) or 'flex'
                //maxBarThickness: 28 // number (pixels)
              }]
            }
        }
    });
    ////////////////////////////////////////////////////
    //graph - 3 Canvas - 3
    var ageBand = <?php echo $ageBand; ?>;
    var numGoats = <?php echo $goatNum; ?>;
    var barChartData = {
        labels: ageBand,
        datasets: [{
            label: 'Profile',
            barThickness: 20,
            maxBarThickness:28,
            backgroundColor: "blue",
            data: numGoats
        }]
    };

    var ctx = document.getElementById("canvas3").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            elements: {
                rectangle: {
                    borderWidth: 1,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            maintainAspectRatio: true,
            title: {
                display: true,
                text: 'Age (Years)'
            },
            scales: {
              xAxes: [{
                //barThickness: 20,  // number (pixels) or 'flex'
                //maxBarThickness: 28 // number (pixels)
              }]
            }
        }
    });
    ///////////////// scatter plots ////////////////////
    
    ////////////// Hemoglobin Plot /////////////////////
    var hbscat = <?php echo $hbscat ?>;
    var ctx = document.getElementById("canvas4").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
            label: 'Hemoglobin',
          pointRadius: 4,
          backgroundColor: "rgba(255,0,0,0.5)",
          pointBackgroundColor: "rgba(255,0,0,0.5)",
          barThickness: 10,
          maxBarThickness:18,
          data: hbscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Hemoglobin'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18 // number (pixels)
                  }],
                  yAxes: [{
                    ticks: {
                      min: 3,
                      max: 90,
                    }
                  }]
                }
            }
    });
    ////////////// Weight Plot /////////////////////
    var wtscat = <?php echo $wtscat ?>;
    var ctx = document.getElementById("canvas5").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
          label: 'Weight',
          pointRadius: 4,
          backgroundColor: "rgba(0,0,255,0.5)",
          pointBackgroundColor: "rgba(0,0,255,0.5)",
          barThickness: 10,
          maxBarThickness:18,
          data: wtscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Weight'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18,
                    ticks: {
                      min: 1,
                      max: 3,
                    }// number (pixels)
                  }],
                  yAxes: [{
                    ticks: {
                      min: 30,
                      max: 110,
                    }
                  }]
                }
            }
    });
    ////////////// Temperature Plot /////////////////////
    var tpscat = <?php echo $tpscat ?>;
    var ctx = document.getElementById("canvas6").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
          label: 'Temperature',
          pointRadius: 4,
          backgroundColor: "rgba(60, 179, 113, 0.5)",
          pointBackgroundColor: "rgba(60, 179, 113, 0.5)",
          barThickness: 10,
          maxBarThickness:18,
          data: tpscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Temperature'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18,
                    ticks: {
                      min: 2,
                      max: 4,
                    }// number (pixels)
                  }],
                  yAxes: [{
                    ticks: {
                      min: 32,
                      max: 48,
                    }
                  }]
                }
            }
    });
    ////////////// Respiration Rate Plot /////////////////////
    var rrscat = <?php echo $rrscat ?>;
    var ctx = document.getElementById("canvas7").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
          label: 'Respiration Rate',
          pointRadius: 4,
          backgroundColor: "rgba(238, 130, 238, 1.0)",
          pointBackgroundColor: "rgba(238, 130, 238, 1.0)",
          barThickness: 10,
          maxBarThickness:18,
          data: rrscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Respiration Rate'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18,
                    ticks: {
                      min: 3,
                      max: 5,
                    }// number (pixels)
                  }],
                  yAxes: [{
                    ticks: {
                      min: 30,
                      max: 50,
                    }
                  }]
                }
            }
    });
    ////////////// Mucosal-Membrane Plot /////////////////////
    var mmscat = <?php echo $mmscat ?>;
    var ctx = document.getElementById("canvas8").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
          label: 'Mucosal-Membrane',
          pointRadius: 4,
          backgroundColor: "rgba(255, 165, 0, 1.0)",
          pointBackgroundColor: "rgba(255, 165, 0, 1.0)",
          barThickness: 10,
          maxBarThickness:18,
          data: mmscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Mucosal Membrane'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18,
                    ticks: {
                      min: 4,
                      max: 6,
                    }// number (pixels)
                  }],
                  yAxes: [{
                    ticks: {
                      min: 25,
                      max: 45,
                    }
                  }]
                }
            }
    });  
    ////////////// Rumen Contraction Plot /////////////////////
    var rcscat = <?php echo $rcscat ?>;
    var ctx = document.getElementById("canvas9").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
          label: 'Rumen Contractions',
          pointRadius: 4,
          backgroundColor: "rgba(106, 90, 205, 1.0)",
          pointBackgroundColor: "rgba(106, 90, 205, 1.0)",
          barThickness: 10,
          maxBarThickness:18,
          data: rcscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Rumen Contractions'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18,
                    ticks: {
                      min: 5,
                      max: 7,
                    }// number (pixels)
                  }],
                  yAxes: [{
                    ticks: {
                      min: 0,
                      max: 6,
                    }
                  }]
                }
            }
    });  
    ////////////// RBC Plot /////////////////////
    var rbcscat = <?php echo $rbcscat ?>;
    var ctx = document.getElementById("canvas10").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
          label: 'RBC',
          pointRadius: 4,
          backgroundColor: "rgba(255, 99, 71, 1.0)",
          pointBackgroundColor: "rgba(255, 99, 71, 1.0)",
          barThickness: 10,
          maxBarThickness:18,
          data: rbcscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'RBC'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18,
                    ticks: {
                      min: 6,
                      max: 8,
                    }// number (pixels)// number (pixels)
                  }],
                  yAxes: [{
                    ticks: {
                      min: 10,
                      max: 50,
                    }
                  }]
                }
            }
    });  
    ////////////// Platelet Plot /////////////////////
    var pltscat = <?php echo $pltscat ?>;
    var ctx = document.getElementById("canvas11").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
          label: 'Platelets ( x 10^5 )',
          pointRadius: 4,
          backgroundColor: "rgba(174, 55, 160, 1)",
          pointBackgroundColor: "rgba(174, 55, 160, 1)",
          barThickness: 10,
          maxBarThickness:18,
          data: pltscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Platelets'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18,
                    ticks: {
                      min: 7,
                      max: 9,
                    }// number (pixels)
                  }],
                  yAxes: [{
                    ticks: {
                      min: 0,
                      max: 8,
                    }
                  }]
                }
            }
    });  
    ////////////// PCV Plot /////////////////////
    var pcvscat = <?php echo $pcvscat ?>;
    var ctx = document.getElementById("canvas12").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
          label: 'PCV',
          pointRadius: 4,
          backgroundColor: "rgba(222, 29, 252, 1)",
          pointBackgroundColor: "rgba(222, 29, 252, 1)",
          barThickness: 10,
          maxBarThickness:18,
          data: pcvscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'PCV'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18,
                    ticks: {
                      min: 8,
                      max: 10,
                    }// number (pixels)// number (pixels)
                  }],
                  yAxes: [{
                    ticks: {
                      min: 10,
                      max: 40,
                    }
                  }]
                }
            }
    });  
    ////////////// LFT Plot /////////////////////
    var lftscat = <?php echo $lftscat ?>;
    var ctx = document.getElementById("canvas13").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
          label: 'LFT',
          pointRadius: 4,
          backgroundColor: "rgba(73, 252, 29, 1)",
          pointBackgroundColor: "rgba(73, 252, 29, 1)",
          barThickness: 10,
          maxBarThickness:18,
          data: lftscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'LFT'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18,
                    ticks: {
                      min: 9,
                      max: 11,
                    }// number (pixels)
                  }],
                  yAxes: [{
                    ticks: {
                      min: 1,
                      max: 15,
                    }
                  }]
                }
            }
    });  
    ////////////// KFT Plot /////////////////////
    var kftscat = <?php echo $kftscat ?>;
    var ctx = document.getElementById("canvas14").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
          label: 'KFT',
          pointRadius: 4,
          backgroundColor: "rgba(22, 105, 2, 1)",
          pointBackgroundColor: "rgba(22, 105, 2, 1)",
          barThickness: 10,
          maxBarThickness:18,
          data: kftscat
        }]
      },
      options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'KFT'
                },
                scales: {
                  xAxes: [{
                    //barThickness: 10,  // number (pixels) or 'flex'
                    //maxBarThickness: 18, // number (pixels)
                    ticks: {
                      min: 10,
                      max: 12,
                    }
                  }],
                  yAxes: [{
                    ticks: {
                      min: 1,
                      max: 15,
                    }
                  }]
                }
            }
    });  
    
    ////////////// Temperature and Humidity /////////////////////
    var xaxis = <?php echo $tandh['xth']; ?>;
    var temp = document.getElementById("canvas15").getContext("2d");

    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 14;
    Chart.Legend.prototype.afterFit = function() {
      this.height = this.height + 10;
    };
    
    var dataTandH = [{
        label: "Temp [C]",
        data: <?php echo $tandh['temp']; ?>,
        lineTension: 0,
        fill: false,
        borderColor: 'red'
      },
      {
        label: "Humidity [%]",
        data: <?php echo $tandh['humid']; ?>,
        lineTension: 0,
        fill: false,
        borderColor: 'blue'
      }];

    var dates = {
      labels: xaxis,
      datasets: dataTandH
    };

    var chartOptions = {
      legend: {
        display: true,
        position: 'top',
        labels: {
          boxWidth: 30,
          fontColor: 'black'
        }
      }
    };

    var lineChart = new Chart(temp, {
      type: 'line',
      data: dates,
      options: chartOptions
    });
////////////////
};
</script>