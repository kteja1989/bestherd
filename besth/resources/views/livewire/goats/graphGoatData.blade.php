<div>
  <?php
      $date_observed = $singleGoatHealthParams['date_observed'];
      $hbscat = json_encode($singleGoatHealthParams['hbscat']);
      $wtscat = json_encode($singleGoatHealthParams['wtscat']);
      $tpscat = json_encode($singleGoatHealthParams['tpscat']);
      $rrscat = json_encode($singleGoatHealthParams['rrscat']);
      $mmscat = json_encode($singleGoatHealthParams['mmscat']);
      $rcscat = json_encode($singleGoatHealthParams['rcscat']);

      $rbcscat = json_encode($singleGoatHealthParams['rbcscat']);
      $pltscat = json_encode($singleGoatHealthParams['pltscat']);
      $pcvscat = json_encode($singleGoatHealthParams['pcvscat']);
      $lftscat = json_encode($singleGoatHealthParams['lftscat']);
      $kftscat = json_encode($singleGoatHealthParams['kftscat']);
      $rtpcrscat = json_encode($singleGoatHealthParams['rtpcrscat']);

      $mhb = $singleGoatHealthParams['mhb'];
      $mwt = $singleGoatHealthParams['mwt'];
      $mtp = $singleGoatHealthParams['mtp'];
      $mrr = $singleGoatHealthParams['mrr'];
      $mrc = $singleGoatHealthParams['mrc'];
      $mmm = $singleGoatHealthParams['mmm'];
      $mrbc = $singleGoatHealthParams['mrbc'];
      $mplt = $singleGoatHealthParams['mplt'];
      $mpcv = $singleGoatHealthParams['mpcv'];
      $mlft = $singleGoatHealthParams['mlft'];
      $mkft = $singleGoatHealthParams['mkft'];
  ?>

  <table class="w-auto p-5 text-gray-700">
    <thead>
        <tr>
            <th class="px-10" align="left">Item</th>
            <th class="px-4" align="left">Mean</th>
            <th class="px-4" align="left">Unit</th>
        </tr>
    </thead>
    <tbody>
      <tr>
          <td class="px-10">
              Hemoglobin
          </td>
          <td class="px-4">
              {{ number_format($mhb, 1) }}
          </td>
          <td class="px-4">
          </td>
      </tr>

      <tr>
          <td class="px-10">
              Weight
          </td>
          <td class="px-4">
              {{ number_format($mwt, 1) }}
          </td>
          <td class="px-4">
            Kg
          </td>
      </tr>

      <tr>
          <td class="px-10">
              Temperature
          </td>
          <td class="px-4">
              {{ number_format($mtp, 1) }}
          </td>
          <td class="px-4">
            C
          </td>
      </tr>

      <tr>
          <td class="px-10">
              Respiration Rate
          </td>
          <td class="px-4">
              {{ number_format($mrr, 1) }}
          </td>
          <td class="px-4">
            BPM
          </td>
      </tr>

      <tr>
          <td class="px-10">
              Rumen Contractions
          </td>
          <td class="px-4">
              {{ number_format($mrc, 1) }}
          </td>
          <td class="px-4">
            BPM
          </td>
      </tr>

      <tr>
          <td class="px-10">
              Mucosal Membrane
          </td>
          <td class="px-4">
              {{ number_format($mmm, 1) }}
          </td>
          <td class="px-4">
            BPM
          </td>
      </tr>

      <tr>
          <td class="px-10">
              RBC
          </td>
          <td class="px-4">
              {{ number_format($mrbc, 1) }}
          </td>
          <td class="px-4">

          </td>
      </tr>

      <tr>
          <td class="px-10">
              Platelets
          </td>
          <td class="px-4">
              {{ number_format($mplt, 1) }} x 10^5
          </td>
          <td class="px-4">

          </td>
      </tr>

      <tr>
          <td class="px-10">
              PCV
          </td>
          <td class="px-4">
              {{ number_format($mpcv, 1) }}
          </td>
          <td class="px-4">

          </td>
      </tr>

      <tr>
          <td class="px-10">
              LFT
          </td>
          <td class="px-4">
              {{ number_format($mlft, 1) }}
          </td>
          <td class="px-4">

          </td>
      </tr>

      <tr>
          <td class="px-10">
              KFT
          </td>
          <td class="px-4">
              {{ number_format($mkft, 1) }}
          </td>
          <td class="px-4">

          </td>
      </tr>
    </tbody>
  </table>

  <div class="w-full md:w-full sm:w-full p-3">
      <div class="bg-orange-100 border border-gray-800 rounded shadow">
          <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-600">All Parameters</h5>
          </div>
          <div class="p-5">
            <div class="container w-full mx-auto">
            <div class="bg-indigo-100 box-content rounded-lg font-bold shadow h-70 w-74 p-4  ">
              <canvas id="canvas1" height="320" width="430"></canvas>
              </br>
            </div>
          </div>
          </div>
      </div>
  </div>
  @push('scripts')
<script>
    //alert('loaded');
    //@this.emit('displayGoatGraph');
</script>
<script type="text/javascript">
    window.addEventListener('drawGraph', e => {
        document.addEventListener('livewire:update', function () {

          var assetsx = JSON.parse(e.detail.assets);
          for(var key in assetsx){
            var goatId = assetsx['goat_id'];
            var hbscat = assetsx['hbscat'];
            var wtscat = assetsx['wtscat'];
            var tpscat = assetsx['tpscat'];
            var rrscat = assetsx['rrscat'];
            var mmscat = assetsx['mmscat'];
            var rcscat = assetsx['rcscat'];

            var rbcscat = assetsx['rbcscat'];
            var pltscat = assetsx['pltscat'];
            var pcvscat = assetsx['pcvscat'];
            var lftscat = assetsx['lftscat'];
            var kftscat = assetsx['kftscat'];
          };

            //alert("inside this " + e.details);
              ////////////// Hemoglobin Plot /////////////////////
              var ctx = document.getElementById("canvas1").getContext("2d");
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
                    data: hbscat,
                  },
                  {
                    label: 'Weight',
                    pointRadius: 4,
                    backgroundColor: "rgba(0,0,255,0.5)",
                    pointBackgroundColor: "rgba(0,0,255,0.5)",
                    barThickness: 10,
                    maxBarThickness:18,
                    data: wtscat,
                  },
                  {
                    label: 'Temperature',
                    pointRadius: 4,
                    backgroundColor: "rgba(60, 179, 113, 0.5)",
                    pointBackgroundColor: "rgba(60, 179, 113, 0.5)",
                    barThickness: 10,
                    maxBarThickness:18,
                    data: tpscat,
                  },
                  {
                    label: 'Resp-Rate',
                    pointRadius: 4,
                    backgroundColor: "rgba(238, 130, 238, 1.0)",
                    pointBackgroundColor: "rgba(238, 130, 238, 1.0)",
                    barThickness: 10,
                    maxBarThickness:18,
                    data: rrscat,
                  },
                  {
                    label: 'Muc-Memb',
                    pointRadius: 4,
                    backgroundColor: "rgba(255, 165, 0, 1.0)",
                    pointBackgroundColor: "rgba(255, 165, 0, 1.0)",
                    barThickness: 10,
                    maxBarThickness:18,
                    data: mmscat,
                  },
                  {
                    label: 'Rum-Cont',
                    pointRadius: 4,
                    backgroundColor: "rgba(106, 90, 205, 1.0)",
                    pointBackgroundColor: "rgba(106, 90, 205, 1.0)",
                    barThickness: 10,
                    maxBarThickness:18,
                    data: rcscat,
                  },
                  {
                    label: 'RBC',
                    pointRadius: 4,
                    backgroundColor: "rgba(255, 99, 71, 1.0)",
                    pointBackgroundColor: "rgba(255, 99, 71, 1.0)",
                    barThickness: 10,
                    maxBarThickness:18,
                    data: rbcscat,
                  },
                  {
                    label: 'Platelets',
                    pointRadius: 4,
                    backgroundColor: "rgba(174, 55, 160, 1)",
                    pointBackgroundColor: "rgba(174, 55, 160, 1)",
                    barThickness: 10,
                    maxBarThickness:18,
                    data: pltscat,
                  },
                  {
                    label: 'PCV',
                    pointRadius: 4,
                    backgroundColor: "rgba(222, 29, 252, 1)",
                    pointBackgroundColor: "rgba(222, 29, 252, 1)",
                    barThickness: 10,
                    maxBarThickness:18,
                    data: pcvscat,
                  },
                  {
                    label: 'LFT',
                    pointRadius: 4,
                    backgroundColor: "rgba(73, 252, 29, 1)",
                    pointBackgroundColor: "rgba(73, 252, 29, 1)",
                    barThickness: 10,
                    maxBarThickness:18,
                    data: lftscat,
                  },
                  {
                    label: 'KFT',
                    pointRadius: 4,
                    backgroundColor: "rgba(22, 105, 2, 1)",
                    pointBackgroundColor: "rgba(22, 105, 2, 1)",
                    barThickness: 10,
                    maxBarThickness:18,
                    data: kftscat,
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
                  maintainAspectRatio: true,
                  title: {
                    display: true,
                    text: 'Health Parameters for Id: ' + goatId
                  },
                  scales: {
                    xAxes: [{
                      ticks:{
                        min:0,
                        max:12
                      }
                      //barThickness: 10,  // number (pixels) or 'flex'
                      //maxBarThickness: 18 // number (pixels)
                    }],
                    yAxes: [{
                      ticks: {
                        min: 0,
                        max: 100,
                        maxTicksLimit: 10,
                      }
                    }]
                  }
                }
              });
          ////////////////
      });
    });
 </script>
 
  @endpush
  @stack('scripts')
</div>
