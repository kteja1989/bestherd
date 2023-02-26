<div>
    {{-- The whole world belongs to you. --}}
    {{-- Stop trying to control. --}}
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    {{-- Do your work, then step back. --}}
    <!--End of Console content-->

    @hasanyrole('manager|herdmanager')
      @include('livewire.goats.flexwrapTermsBase')
    @endhasanyrole

    <div class="container w-full mx-auto pb-80">
      <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
        <!--Divider-->
        <hr class="border-b-2 border-gray-600 my-2 mx-4">
        <!--Divider-->
        <div class="flex flex-row flex-wrap flex-grow mt-2">
        <!-- Left Panel Graph Card-->
          <div class="w-full md:w-full p-3">
            <div class="bg-orange-100 border border-gray-800 rounded shadow">
              <div class="border-b border-gray-800 p-3">
                <h5 class="font-bold uppercase text-gray-900">Terms Base</h5>
              </div>
              <div class="errors">
                @if (session()->has('formmessage'))
                  <div class="alert alert-success">
                    {{ session('message') }}
                  </div>
                @endif
              </div>
              <!--Divider-->
      
              <!--Divider-->
              <!-- insert table -->
        		<div class="p-5">
        			<h5> <strong>Terms Base</strong>: This is about the definition of reagents, terms you use in the system that rare change</h5>
        			<h5> <strong>Immunizations</strong>: Click to see the list of immunizations done by herd wise.</h5>
        			<h5> <strong>Adjuvants</strong>: Click to see the list of immunizations done by herd wise.</h5>
        			<h5> <strong>Serum</strong>: Click to see the serum collected details by herd wise. </h5>
        			<h5> <strong>Health</strong>: Click to see the health records of each herd and its members. </h5>
        			<h5> <strong>Sick/Quarantine</strong>: Individual herd members having health issues are separated from the rest to provide
        			intensive care for quick recovery. </h5>
        			<h5> <strong>Roles</strong>: Herd Manager is the highest in hierarchy. He can access all information, unrestricted under him. Other roles such as Herd-Assistant for Immunization, Herd-Assistant for Serum collection, Herd-Veternarian etc
        			carry out the same function shown for Herd-Manager. </h5>
        			</br>
        			<h5> <strong>Note</strong>: Goat Ids, Herd Ids, Serum Ids are unique and the current system is designed to handle 9.99 million entries. 
        			Whatever time it takes to reach this number, a given goat/immunization/serum Id cannot be duplicated, giving an utmost 
        			care in entering and editing data. No need to use bar-codes or RF-Id tags, however, if desired, you can upload the same using excel sheet also.</h5>
        			<h5> The random code used in serum collection is another way to maintain unique coding to avoid mix-up with others. It is desired 
        			to use non-erasable printed codes for labeling.</h5>
        			</h5>
                			
                </div>
              <!-- insert table -->
              </br></br>
            </div>
          </div>
          <!--/table Card-->
          <!-- panel opening/closing -->
          <!-- panel opening/closing -->
        </div>
        <!--/ Console Content-->
      </div>
    </div>
</div>
