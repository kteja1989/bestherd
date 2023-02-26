<!--Table Card-->
<div class="w-full md:w-1/2 p-3">
    <div class="bg-orange-100 border border-gray-800 rounded shadow">
        <div class="border-b border-gray-800 p-3">
            <h5 class="font-bold uppercase text-gray-900">Search Goat Id: </h5>
        </div>
        <div class="p-5">
            <!-- insert table -->
            <!-- insert table -->
            <table class="table-fixed w-full p-5 text-gray-700">
                <thead>
                    <tr>
                        <th colspan="3" class="content-left">Type or Scan </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-blue-100 border-b dark:bg-gray-200 dark:border-gray-700">
                		<td>
                			<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
                				Goat Id
                			</label>
                		</td>
                		<td colspan="2">
                			<input size="25" class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model.lazy="scanGoatId" type="text">
                		</td>
                	</tr>
                    <tr>
                        <td colspan="3">
                            <label class="block text-red-900 text-lg font-bold pt-3 mb-2" for="exptdesc">
                                {{ $scanError }}	@error('scanGoatId') <span class="error">{{ $message }}</span> @enderror
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- end of table -->
            <hr class="border-b-2 border-gray-600 my-2 mx-1">
            <!-- List of samples found as table -->
        </div>
	</div>
</div>
<!--/table Card-->
