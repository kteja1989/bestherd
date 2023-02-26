<div class="container mx-auto">
  @if($goatUploadError)
  <div class="w-screen max-w-lg bg-red-200 mx-auto mt-6 p-2">
    <div class="flex space-x-2">
      <svg class="w-6 h-6 stroke-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <p class="text-red-900 font-semibold">Data File Upload Error</p>
    </div>
    <p class="ml-8 text-red-800">{{ $goatUploadErrorMessage }}</p>
  </div>
  @endif

  @if($goatUploadSuccess)
  <div class="w-screen max-w-lg bg-green-200 mx-auto mt-6 p-2">
    <div class="flex space-x-2">
      <svg class="w-6 h-6 stroke-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
      <p class="text-green-900 font-semibold">Bulk Upload Successful</p>
    </div>
    <p class="ml-8 text-green-800">{{ $goatUploadSuccessMessage }}</p>
  </div>
  @endif

  @if($ghUploadError)
  <div class="w-screen max-w-lg bg-red-200 mx-auto mt-6 p-2">
    <div class="flex space-x-2">
      <svg class="w-6 h-6 stroke-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      <p class="text-red-900 font-semibold">Health Data File Upload Error</p>
    </div>
    <p class="ml-8 text-red-800">{{ $ghUploadErrorMessage }}</p>
  </div>
  @endif

  @if($ghUploadSuccess)
  <div class="w-screen max-w-lg bg-green-200 mx-auto mt-6 p-2">
    <div class="flex space-x-2">
      <svg class="w-6 h-6 stroke-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
      <p class="text-green-900 font-semibold">Bulk Upload Successful</p>
    </div>
    <p class="ml-8 text-green-800">{{ $ghUploadSuccessMessage }}</p>
  </div>
  @endif
</div>
