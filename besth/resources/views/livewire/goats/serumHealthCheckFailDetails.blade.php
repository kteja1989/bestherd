<!--Table Card-->
<div class="w-full md:w-1/2 p-3">
  <div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
        <h5 class="font-bold uppercase text-gray-900">Serum Collection of Herd Id: {{ $herd_id }}</h5>
    </div>
    <div class="p-5">

        <table class="w-full p-5 text-gray-700">
          <thead>
            <tr>
              <th align="center"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
            	<td colspan="3">
            		<label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Serum Disallowed - Reasons</label>
            	</td>
            </tr>
            <tr>
              <td colspan="3" class="text-sm text-gray-900">
                </br>
              </td>
            </tr>
            <tr>
              <td colspan="3" class="text-sm text-gray-900">
                 @if( ($failMsg) )
                    1. Empty Herd
                @else 
                    1. Health Check Not Performed
                @endif
              </td>
            </tr>
            <tr>
              <td colspan="3" class="text-sm text-gray-900">
                2.
              </td>
            </tr>
            <tr>
              <td colspan="3" class="text-sm text-gray-900">
                3.
              </td>
            </tr>
          </tbody>
      	</table>

        <table class="w-full p-5 text-gray-700">
            <thead>
                <tr>
                    <th align="center"></th>
                </tr>
            </thead>
            <tbody>
                @hasanyrole('herdmanager')
                    <tr>
                        <td colspan="3">
                            <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Record Exception & Give Green Light</label>
                        </td>
                    </tr>
                    @if($failMsg)
                        <tr>
                            <td colspan="3" class="text-sm text-gray-900">
                                <button wire:click="clearForPlaspheresis({{$herd_id}})" class="bg-green-600 w-22 hover:bg-cyan-800 text-white font-normal py-2 px-4 mx-3  rounded">Give Green</button>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="3" class="text-sm text-gray-900">
                            {{ $plasmaGreenLightMessage }}
                        </td>
                    </tr>
                @endhasanyrole
            </tbody>
        </table>
    </div>
  </div>
</div>
<!--/table Card-->
