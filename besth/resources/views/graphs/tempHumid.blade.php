<div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
        <h5 class="font-bold uppercase text-gray-600">Temperature & Humidity</h5>
    </div>
    <div class="p-5">
      <div class="bg-indigo-100 box-content rounded-lg font-bold shadow h-70 w-74 p-4  ">
        Observed {{ date('d-m-Y') }} (Last {{ count(json_decode($tandh['xth'])) }} days) 
        </br>
        
        </br>
        <canvas id="canvas15" height="220" width="280"></canvas>
        </br>
        </br>
      </div>
    </div>
</div>