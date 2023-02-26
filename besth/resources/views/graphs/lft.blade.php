<div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
        <h5 class="font-bold uppercase text-gray-600">LFT</h5>
    </div>
    <div class="p-5">
      <div class="bg-indigo-100 box-content rounded-lg font-bold shadow h-70 w-74 p-4  ">
        Observed {{ date('d-m-Y', strtotime($date_observed)) }} (Total {{ count(json_decode($lftscat))  }})
        </br>
        Mean = {{ number_format($mlft, 1) }}
        </br>
        <canvas id="canvas13" height="220" width="280"></canvas>
      </div>
    </div>
</div>