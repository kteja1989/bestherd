	<!--Table Card-->
	<div class="w-full md:w-1/2 p-3">
        <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
                <h5 class="font-bold uppercase text-gray-900">Details of Herd Id: {{ $herd_id }}</h5>
            </div>
            <div class="p-5">
                <!-- insert table -->
                <table class="w-full p-5 text-gray-700">
                    <thead>
                        <tr>
                            <th class="content-center">
                                Select
                            </th>
                        </tr>
                    </thead>
                    <tbody>        
                        <tr>
                            <td colspan="3">
                            <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="seram">
                                Serum
                                <input id="serum-titer-2" type="radio" id="serRadioTiter" wire:model="serumTiterRadio" value="serum" name="serum-titer" 
                                class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-500 focus:ring-blue-500 dark:focus:ring-blue-600 
                                                dark:ring-offset-gray-800 focus:ring-2 
                                            dark:bg-gray-700 dark:border-gray-600">
                            </label>
                            </td>
                            <td colspan="3">
                            <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="titerx">
                                Titer
                                <input id="serum-titer-2" type="radio" wire:model="serumTiterRadio" value="titer" name="serum-titer" class="w-5 h-5 
                                        text-blue-600 bg-gray-100 border-gray-500 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 
                                        dark:bg-gray-700 dark:border-gray-600">
                            </label>
                            </td>
                        </tr>
                        
                    </tbody>    
                </table> 
                <!-- end of table -->
                <hr class="border-b-2 border-gray-600 my-2 mx-1">
                <!-- serum panel -->
                @if($viewSerumPanel)    
                    <!-- List of samples found as table -->
                    @if($viewGoatList)
                        <table class="w-full p-5 text-gray-700">
                            <thead>
                                <tr>
                                    <!-- th align="left">Select</th -->
                                    <th align="left">ID</th>
                                    <th align="left">Enter Volume</th>
                                    <th align="left">Last Titer</th>
	                                <th align="left">Date</th>
                                </tr>
                            </thead>
                            <tbody> 
                            @foreach($curGoatList as $row)
                                <tr>
                                    <td> 
                                        {{ $row->goat_id }}
                                    </td>
                                    
                                    <td>
                                        <input  class="shadow appearance-none border border-red-500 rounded w-1/8 py-1 text-gray-700 mb-1 
                                        leading-tight focus:outline-none focus:shadow-outline" id="servol" wire:model="serumvolume.{{ $row->goat_id }}" type="text">
                                    </td>

                                    <td>
                                        @if($row->goatTiter != null)
                    					    {{ $row->goatTiter->titer_value }}
                    					@else
                    					    ND
                    					@endif
                    				</td>
                    				
                    				<td>
                    				    @if($row->goatTiter != null)
                    					    {{ date('d-m-Y', strtotime($row->goatTiter->created_at)) }}
                    					@else
                    					    ND
                    					@endif
                    				</td>
                    				
                                </tr>
                            @endforeach
                            </tbody>    
                        </table>
                        <!--  -->
                        <hr class="border-b-2 border-gray-600 my-2 mx-1">
                        <!--  -->
                        <table class="w-full p-5 text-gray-700">
                            <thead>
                                <tr>
                                    <th align="left">
                                    </th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td class="py-3" colspan="2"> 
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="sersopid">Serum SOP Id</label>
                                        <select class="form-select appearance-none
            								block	w-full px-3 py-1.5 text-base
            								font-normal text-gray-700	bg-white bg-clip-padding
            								bg-no-repeat border border-solid border-gray-300
            								rounded transition ease-in-out m-0
            								focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 
            								focus:outline-none" id="idserproc" wire:model="serproc_id" aria-label="Default select example">
            								<option selected>Select Serum SOP</option>
        										@foreach($sopids as $sop)
        											<option value="{{ $sop->sop_id }}">{{ $sop->title }}</option>
        										@endforeach
                    						</select>
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                            @error('serproc_id') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3">
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="idbatch">Batch Id</label>
                                        <input size="15" class="w-full shadow appearance-none border border-red-500 rounded 
                                                                py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" 
                                                                id="idserbatch" wire:model="serbatch_id" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                            @error('serbatch_id') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                
                                    <td class="py-3">
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="byauth">Authorized By</label>
                                        <input readonly size="15" class="cursor-not-allowed w-full shadow appearance-none border border-red-500 rounded py-1.5 text-gray-700 mb-1 
                                        leading-tight focus:outline-none focus:shadow-outline" id="nameseruser" wire:model="seruser_name" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                            @error('seruser_name') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="py-3" colspan="2"> 
                                        <label class="block text-gray-900 text-sm font-bold font-normal mb-2" for="noteserum">Serum Notes</label>
                                        <input  class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none 
                                        focus:shadow-outline" id="noteser" wire:model="sernotes" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errnoteserum">
                                            @error('sernotes') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <hr class="border-b-2 border-gray-600 my-2 mx-1">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="py-3" colspan="2">
                                        <label class="block text-orange-900 text-sm font-bold font-normal mb-2" for="nscerr">
                                        {{ $serumErrorMessage }}
                                        </label> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3" colspan="2"> 
                                        <button wire:click="serumDataUpdate({{ $herd_id }})" class="bg-pink-800 w-22 hover:bg-blue-800 text-white font-normal py-1 px-2   rounded">Save Data</button>
                                    </td>
                                </tr>
                            </tbody>    
                        </table>
                    @else 
                        <table class="w-full p-5 text-gray-700">
                            <thead>
                                <tr>
                                    <th align="left">Goat(s) Not Found</th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>    
                        </table>
                    @endif
                    <!--  -->
                @endif  
                <!-- end of serum panel -->
    
    
                <!-- titer panel -->
                @if($viewTiterPanel)
                    <!-- List of samples found as table -->
                    @if($viewGoatList)
                        <table class="w-full p-5 text-gray-700">
                            <thead>
                                <tr>
                                    <!-- th align="left">Select</th -->
                                    <th align="left">ID</th>
                                    <th align="left">Titer Value</th>
                                </tr>
                            </thead>
                            <tbody> 
                            @foreach($curGoatList as $row)
                                <tr>
                                    <td> 
                                        {{ $row->goat_id }}
                                    </td>
                                    <td>
                                        <input  class="shadow appearance-none border border-red-500 rounded w-auto py-1 
                                                        text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" 
                                                        id="valtiter" wire:model="titervalue.{{ $row->goat_id }}" type="text">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>    
                        </table>
                        <!--  -->
                        <hr class="border-b-2 border-gray-600 my-2 mx-1">
                        <!--  -->
                        <table class="w-full p-5 text-gray-700">
                            <thead>
                                <tr>
                                    <th align="left">
                                        
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td class="py-3" colspan="2"> 
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="soptiter">Titer SOP</label>
                                        <select class="form-select appearance-none
                    								block	w-full px-3 py-1.5 text-base
                    								font-normal text-gray-700	bg-white bg-clip-padding
                    								bg-no-repeat border border-solid border-gray-300
                    								rounded transition ease-in-out m-0
                    								focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="idsoptiter" wire:model="titersop_id" aria-label="Default select example">
                    								<option selected>Select Titer SOP</option>
                										@foreach($sopids as $sop)
                											<option value="{{ $sop->sop_id }}">{{ $sop->title }}</option>
                										@endforeach
                    							    </select>
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="erridsoptiter">
                                            @error('titersop_id') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="py-3" colspan="2"> 
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="idserum">Serum ID</label>
                                        <select class="form-select appearance-none
            								block	w-full px-3 py-1.5 text-base
            								font-normal text-gray-700	bg-white bg-clip-padding
            								bg-no-repeat border border-solid border-gray-300
            								rounded transition ease-in-out m-0
            								focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="idsertiterx" wire:model="titerserum_id" aria-label="Default select example">
            								<option selected>Select Serum ID</option>
        										@foreach($sopids as $sop)
        											<option value="{{ $sop->sop_id }}">{{ $sop->title }}</option>
        										@endforeach
        							    </select>
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="erridsertiterx">
                                            @error('titerserum_id') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="py-3">
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="reftiter">Titer Reference (Department)</label>
                                        <input size="15" class="w-full shadow appearance-none border border-red-500 rounded py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="reftiter" wire:model="titer_ref" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errtiteref">
                                            @error('titer_ref') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                
                                    <td class="py-3">
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="perfby">Performed By</label>
                                        <input size="15" class="w-full shadow appearance-none border border-red-500 rounded py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="donetiterby" wire:model="titerdone_by" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errperfby">
                                            @error('titerdone_by') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="py-3">
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="species">Date Performed</label>
                                        <input size="15" class="w-full shadow appearance-none border border-red-500 rounded py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="datetiter" wire:model="titer_date" type="date">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                            @error('titer_date') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                
                                    <td class="py-3">
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="type">Authorized By</label>
                                        <input size="15" class="w-full shadow appearance-none border border-red-500 rounded py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="authtiterby" wire:model="titerauth_by" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                            @error('titerauth_by') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="py-3" colspan="2"> 
                                        <label class="block text-gray-900 text-sm font-bold font-normal mb-2" for="nsc">Titer Notes</label>
                                        <input  class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" name="titernotes" id="titernotes" wire:model="titer_notes" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                            @error('titer_notes') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <hr class="border-b-2 border-gray-600 my-2 mx-1">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="py-3" colspan="2">
                                        <label class="block text-orange-900 text-sm font-bold font-normal mb-2" for="nsc">
                                        {{ $titerErrorMessage }}
                                        </label> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3" colspan="2"> 
                                        <button wire:click="titerDataUpdate({{ $herd_id }})" class="bg-pink-800 w-22 hover:bg-blue-800 text-white font-normal py-1 px-2   rounded">Save Data</button>
                                    </td>
                                </tr>
                            </tbody>    
                        </table>
                    @else 
                        <table class="w-full p-5 text-gray-700">
                            <thead>
                                <tr>
                                    <th align="left">Goat(s) Not Found</th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>    
                        </table>
                    @endif
                    <!--  -->
                @endif
            </div>
		</div>
	</div>
	<!--/table Card-->