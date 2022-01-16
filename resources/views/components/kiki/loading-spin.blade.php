{{-- <svg 
{!! $attributes->merge([
    "class"=>"animate-spin -ml-1 mr-3 h-5 w-5",
    "xmlns"=>"http://www.w3.org/2000/svg",
    "fill"=>"none",
    "viewBox"=>"0 0 24 24",
    ]) !!}
    >
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
</svg> --}}


<!-- component -->
<div wire:loading.delay class="w-full h-full fixed block top-0 left-0 bg-gray-100 opacity-70 z-50">
    <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0" style="top: 50%;">
      <svg 
          {!! $attributes->merge([
              "class"=>"animate-spin -ml-1 mr-3 h-8 w-8",
              "xmlns"=>"http://www.w3.org/2000/svg",
              "fill"=>"none",
              "viewBox"=>"0 0 24 24",
              ]) !!}
              >
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        {{-- <span class="text-xs f-robotomon font-light text-black">Tunggu..</span> --}}
    </span>
</div>