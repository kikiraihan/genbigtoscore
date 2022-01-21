<button 
    {!! $attributes->merge([
        'class'=>"shadow-sm p-2 w-full rounded cursor-pointer text-white bg-green-500 hover:bg-green-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-300"
    ]) !!} >
    {{$slot}}
</button>