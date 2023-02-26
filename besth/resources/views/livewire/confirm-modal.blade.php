<div>
  <div class="container w-full mx-auto pt-1">
    <div class="w-full px-4 md:px-0 md:mt-1 mb-1 text-gray-800 leading-normal">
      <div class="border-b border-gray-800 p-1">
        <h5 class="font-bold px-5 uppercase text-gray-900">Attention Needed</h5>
      </div>
      <div class="p-1 bg-white w-full max-w-md m-auto flex-col flex">
      </div>
      <div class="w-full md:w-full p-3">
        <div class="bg-orange-100 border border-gray-800 rounded shadow">
        	<div class="border-b border-gray-800 p-3">
        		<h5 class="font-bold uppercase text-gray-900">Confirm Action</h5>
        	</div>
        	<div class="p-2 content-center">
        	</div>
        	@if( !empty($message) )
            <div class="p-5 content-center">
              <table class="w-full p-5 text-gray-700">
                <thead>
                    <tr>
                      <th class="text-center text-gray-900">{{ $message }}</th>
                    </tr>
                </thead>
              	<tbody>
              	<tr class=" mt-10 ">
              		<td colspan="2" class="text-sm p-5 mt-10 text-gray-900">
              		  <button wire:click="confirmed()" class="bg-red-700 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Confirmed</button>
              		</td>
                  <td colspan="2" class="text-sm p-5 mt-10 text-gray-900">
              		  <button wire:click="cancelled()" class="bg-red-700 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Cancel</button>
              		</td>
              	</tr>
              	</tbody>
              </table>
            </div>
        	@endif
        </div>
      </div>
    </div>
  </div>
</div>
