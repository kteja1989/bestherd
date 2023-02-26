<table class="w-full p-5 text-gray-700">
    <thead>
        <tr>
          <th class="text-left text-gray-900">
          </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="3">
                <label class="block text-gray-900 text-sm font-normal font-bold pt-3 mb-2" for="species">Location*</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="location_herd" wire:model="herd_location" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                    @error('herd_location') <span class="error">{{ $message }}</span> @enderror
                </label>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="nsc">Description*</label>
                <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="desc_herd" wire:model="herd_desc" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                    @error('herd_desc') <span class="error">{{ $message }}</span> @enderror
                </label>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <label class="block text-gray-900 text-sm font-normal font-bold pt-3 mb-2" for="type">Size*</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="size_herd" wire:model="herd_size" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                    @error('herd_size') <span class="error">{{ $message }}</span> @enderror
                </label>
            </td>
        </tr>

        <tr>
            <td>
              <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Category*</label>
              <div class="flex justify-left">
                <div class="mb-1 w-full xl:w-96">
                  <select class="form-select appearance-none
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="cat_herd" wire:model="herd_category" aria-label="Default select example">
                      <option selected>Select Category</option>
                      <option value="normal">Normal-Production</option>
                      <option value="quarantine">Quarantine</option>
                      <option value="sick">Sick</option>
                  </select>
                </div>
              </div>
              <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                @error('herd_category') <span class="error">{{ $message }}</span> @enderror
              </label>
            </td>

            <td>
              <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Gender*</label>
              <div class="flex justify-left">
                <div class="mb-1 w-full xl:w-96">
                  <select class="form-select appearance-none
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="gender_herd" wire:model="herd_gender" aria-label="Default select example">
                      <option selected>Select Gender</option>
                      <option value="Female">Female</option>
                      <option value="Male">Male</option>
                      <option value="Mixed">Mixed</option>
                  </select>
                </div>
              </div>
              <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                @error('herd_gender') <span class="error">{{ $message }}</span> @enderror
              </label>
            </td>

            <td>
              <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Color Assigned*</label>
              <div class="flex justify-left">
                <div class="mb-1 w-full xl:w-96">
                  <select class="form-select appearance-none
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="color_herd" wire:model="herdColor" aria-label="Default select example">
                      <option selected>Select Color</option>
                      <option value="green">Green</option>
                      <option value="red">Red</option>
                      <option value="orange">Orange</option>
                      <option value="blue">Blue</option>
                      <option value="pink">Pink</option>
                      <option value="indigo">Indigo</option>
                      <option value="purple">Violet</option>
                  </select>

                </div>
              </div>
              <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                @error('herdColor') <span class="error">{{ $message }}</span> @enderror
              </label>
            </td>
        </tr>

        <tr>
          <td colspan="3">
            <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Feed Description*</label>
            <div class="flex justify-left">
              <div class="mb-3 w-full xl:w-96">
                <select class="form-select appearance-none
                  block w-full px-3 py-1.5 text-base font-normal text-gray-700
                  bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300
                  rounded transition ease-in-out m-0
                  focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="feed_herd" wire:model="feed_id" aria-label="Default select example">
                  <option selected>Select Feed</option>
                  @foreach($herdFeeds as $row)
                    <option value="{{ $row->feed_id }}">{{ $row->description }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
              @error('feed_id') <span class="error">{{ $message }}</span> @enderror
            </label>
          </td>
        </tr>

        <tr>
            <td colspan="3">
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Incharge*</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="incharge_herd" wire:model="herd_incharge" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                @error('herd_incharge') <span class="error">{{ $message }}</span> @enderror
                </label>
            </td>
        </tr>

        <tr>
          <td class="text-left text-gray-900">
          </br></br>
            <button wire:click="saveNewHerdInfo()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Save</button>
          </td>
        </tr>
    </tbody>
</table>
