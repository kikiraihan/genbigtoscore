<select 

    {!! $attributes->merge([
        'class'=>"block shadow bg-white border-none text-sm p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-300 ",
        'aria-label'=>"Default select example"
        ]) !!} >

    {{$slot}}
</select>