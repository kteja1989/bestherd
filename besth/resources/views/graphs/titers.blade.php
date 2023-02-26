<div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
        <h5 class="font-bold uppercase text-gray-600">Scatter Plot - Titer</h5>
    </div>
    <div class="p-5">
      <div class="bg-indigo-100 box-content rounded-lg font-bold shadow h-70 w-74 p-4  ">
          <?php $date_observed = "2022-07-01"; $titerscat = []; $titerv = 256; ?>
        Observed {{ date('d-m-Y', strtotime($date_observed)) }} (Total + 1)
        </br>
        Mean = {{ number_format($titerv, 1) }}
        </br>
        <canvas id="canvas34" height="220" width="280"></canvas>
      </div>
    </div>
</div>