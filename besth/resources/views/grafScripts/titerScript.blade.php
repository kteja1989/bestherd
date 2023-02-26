<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>

  window.onload = function() {

    //graph - 31 Canvas - 31
    Chart.Legend.prototype.afterFit = function() {
      this.height = this.height + 20;
    };

    ////////////// Hemoglobin Plot /////////////////////
    var titerscat = <?php echo $titerscat ?>;
    var ctx = document.getElementById("canvas31").getContext("2d");
    new Chart(ctx, {
      type: "scatter",
      data: {
        datasets: [{
            label: 'Titer',
          pointRadius: 4,
          backgroundColor: "rgba(255,0,0,0.5)",
          pointBackgroundColor: "rgba(255,0,0,0.5)",
          barThickness: 10,
          maxBarThickness:18,
          data: titerscat
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
                    text: 'Titer'
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
////////////////
};
</script>