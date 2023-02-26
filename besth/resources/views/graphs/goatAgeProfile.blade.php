<div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
      <h5 class="font-bold uppercase text-gray-600">Profile as on {{ date('d-m-Y')}}</h5>
    </div>
    <?php $totalCount = 0; ?>
    <div class="p-5">
        <div class='overflow-x-auto w-full'>
            <table class='mx-auto max-w-2xl min-w-full mt-1 whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-900">
                  <tr class="text-white text-left">
                    <th class="font-semibold text-sm uppercase px-3 py-2"> Age (Y) </th>
                    <th class="font-semibold text-sm uppercase px-3 py-2"> Total </th>
                    <th class="font-semibold text-sm uppercase px-3 py-2"> Age (Y) </th>
                    <th class="font-semibold text-sm uppercase px-3 py-2"> Total </th>
                  </tr>
                </thead>
                <tbody >
                    
                    <tr>
                        <td class="sm-w-4 px-6 py-2">
                            0 - 1
                        </td>
                        <td class="text-right font-bold text-orange-800 sm-w-4 px-6 py-2">
                            @if( $agedGoatCount['ot00y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot00y'] ?>{{ $agedGoatCount['ot00y']}}
                            @else
                            0
                            @endif   
                        </td>
                        <td class="sm-w-4 px-6 py-2">
                            1 - 2
                        </td>
                        <td class="text-right font-bold text-right sm-w-4 px-6 py-2">
                            @if( $agedGoatCount['ot01y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot01y'] ?>{{ $agedGoatCount['ot01y'] }}
                            @else
                            0
                            @endif
                        </td>
                    </tr>
                  
                    <tr>
                        <td class="px-6 py-2">
                            2 - 3
                        </td>
                        <td class="text-right font-bold text-right px-6 py-2">
                            @if( $agedGoatCount['ot02y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot02y'] ?>{{ $agedGoatCount['ot02y'] }}
                            @else
                            0
                            @endif
                        </td>
                        <td class="px-6 py-2">
                          3 - 4
                        </td>
                        <td class="text-right font-bold text-right px-6 py-2">
                            @if( $agedGoatCount['ot03y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot03y'] ?>{{ $agedGoatCount['ot03y'] }}
                            @else
                            0
                            @endif
                        </td>
                    </tr>
                  
                    <tr>
                        <td class="px-6 py-2">
                            4 - 5
                        </td>
                        <td class="text-right font-bold text-right px-6 py-2">
                            @if( $agedGoatCount['ot04y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot04y'] ?>{{ $agedGoatCount['ot04y'] }}
                            @else
                            0
                            @endif
                        </td>
                        <td class="px-6 py-2">
                          5 - 6
                        </td>
                        <td class="text-right font-bold text-right px-6 py-2">
                            @if( $agedGoatCount['ot05y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot05y'] ?>{{ $agedGoatCount['ot05y'] }}
                            @else
                            0
                            @endif
                        </td>
                    </tr>
                  
                    <tr>
                        <td class="px-6 py-2">
                            6 - 7
                        </td>
                        <td class="text-right font-bold text-right px-6 py-2">
                            @if( $agedGoatCount['ot06y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot06y'] ?>{{ $agedGoatCount['ot06y'] }}
                            @else
                            0
                            @endif
                        </td>
                        <td class="px-6 py-2">
                            7 - 8
                        </td>
                        <td class="text-right font-bold text-right px-6 py-2">
                            @if( $agedGoatCount['ot07y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot07y'] ?>{{ $agedGoatCount['ot07y'] }}
                            @else
                            0
                            @endif
                        </td>
                    </tr>
                  
                 
                    <tr>
                        <td class="px-6 py-2">
                            8 - 9
                        </td>
                        <td class="text-right font-bold text-right px-6 py-2">
                            @if( $agedGoatCount['ot08y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot08y'] ?>{{ $agedGoatCount['ot08y'] }}
                            @else
                            0
                            @endif
                        </td>
                        
                        <td class="px-6 py-2">
                            9 - 10
                        </td>
                        <td class="text-right font-bold text-right px-6 py-2">
                            @if( $agedGoatCount['ot09y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot09y'] ?>{{ $agedGoatCount['ot09y'] }}
                            @else
                            0
                            @endif
                        </td>
                    </tr>
                  
                  
                    <tr>
                        <td class="px-6 py-2">
                          > 10
                        </td>
                        <td class="text-right font-bold text-right px-6 py-1">
                            @if( $agedGoatCount['ot10y'] > 0 )
                            <?php $totalCount = $totalCount + $agedGoatCount['ot10y'] ?>    {{ $agedGoatCount['ot10y'] }}
                            @else
                            0
                            @endif
                        </td>
                        <td class="px-6 py-2">
                          Total
                        </td>
                        <td class="text-right font-bold text-right px-6 py-2">
                          {{ $totalCount }}
                        </td>
                    </tr>
                  
                    <tr>
                        <td colspan="4" class="text-sm text-gray-900" align="left">
                          <div id="cht2">
                            <canvas id="canvas3" height="220" width="300"></canvas>
                          </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>