<textarea 
    {!! $attributes->merge([
        'class'=>"block shadow text-sm  p-2 w-full h-36 rounded focus:outline-none focus:ring-2 focus:ring-blue-300 placeholder-gray-300 border-none",
        ]) !!}
    >{{$slot}}</textarea>