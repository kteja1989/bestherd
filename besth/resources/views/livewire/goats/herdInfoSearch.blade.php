<table class="w-full p-5 text-gray-700">
    <thead>
        <tr>
            <th align="left" colspan="3" class="w-full  text-pink-700">Herd Information</th>
        </tr>
        <tr>
          <th class="text-left text-gray-900">Herd Id</th>
          <th class="text-left text-gray-900">Location</th>
          <th class="text-left text-gray-900">Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($herdInfo as $row)
            <tr>
                <td class="text-sm text-gray-900" align="left">
                    {{ $row->herd_id }}, {{ $row->gender }}  
                </td>
                <td class="text-sm text-gray-900" align="left">
                    {{ $row->location }}
                </td>
                <td class="text-sm text-gray-900" align="left">
                    {{ $row->description }} 
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-sm text-gray-900" align="left">
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>