@props([
    'lvroute'=>null,
    'icon'=>'home',
    ])

<a href="{{ route($lvroute) }}" class="py-2.5 px-4 hover:bg-blue-300 transition duration-200 items-center flex justify-between @if(request()->routeIs($lvroute)) text-blue-500 bg-gradient-to-r from-blue-100 font-bold @else mx-1 rounded @endif">
    <div class="items-center flex space-x-2">
        <span class="material-icons-outlined ">{{$icon}}</span>
        <span>{{$slot}}</span>
    </div>
    <span class="material-icons-outlined text-md @if(request()->routeIs($lvroute)) text-blue-500 @else text-gray-300  @endif">navigate_next</span>
</a>