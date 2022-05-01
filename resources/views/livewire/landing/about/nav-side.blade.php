
<div class="sticky left-4 top-52 w-40 text-sm font-medium text-gray-900 divide-y-2 hidden xl:block">
    
    @foreach ([
        ['route'=>'landing.intro','title'=>'Intro'],
        ['route'=>'landing.timeline','title'=>'Timeline'],
        ['route'=>'landing.home','title'=>'FAQ'],
    ] as $item)
        <a href="{{ route($item['route']) }}" class=" @if(request()->routeIs($item['route'])) text-blue-500 font-bold @else @endif block w-full px-4 py-2 border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700">
        {{$item['title']}}
        </a>
    @endforeach

</div>