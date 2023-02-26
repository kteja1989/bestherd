<div>
        {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="container w-full mx-auto pt-3">
      <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
        <div class="border-b border-gray-800 p-3">
          <div class="flow-root">
            <p class="float-right">
              <button wire:click='close()' class="bg-red-400 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 rounded">Close</button>
            </p>
            <p class="float-left">
              <h5 class="font-bold uppercase text-gray-900">Image Details:</h5>
            </p>
          </div>
        </div>
        <div class="p-2 bg-white w-full max-w-md m-auto flex-col flex">
        </div>
        <div class="w-full md:w-full p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-900">Details of Image ID </h5>
            </div>
            <div class="p-2 content-center">
              <div class="px-5 py-2 content-center">
                <table class="w-full p-5 text-gray-700">
                  <thead>
                      <tr>
                        <th class="text-left text-gray-900"></th>
                      </tr>
                  </thead>
                  <tbody>
                    
                      <tr>
                        <td class="text-sm text-gray-900">
                           <img class="w-880 h-880  mr-4" src="{{ asset($modalImage->path.$modalImage->image) }}" alt="User Avatar">
                        </td>
                      </tr>
                      <tr>
                        <td class="text-lg text-gray-900 font-semibold">
                           Legend: {{ ucfirst($modalImage->notes) }}
                        </td>
                      </tr>
                    
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>
