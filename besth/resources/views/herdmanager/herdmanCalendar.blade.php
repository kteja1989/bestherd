<div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
      <h5 class="font-bold uppercase text-gray-600">Events</h5>
    </div>
    <div class="p-5">
        <div class='overflow-x-auto w-full'>
            <table class="w-full md:full mx-3 text-gray-700">
                <thead>
                    <tr>
                        <th class="text-center text-gray-900">Events Calender: {{ date('d-m-Y H:i:s')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-sm text-gray-900" align="left">
                            <div id="cht1">
                                <livewire:herd-calendar
                                    before-calendar-view="livewire.calendar.header"
                                />
                            </div>
                            </br></br></br></br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>