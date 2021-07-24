<nav class="flex justify-between {{$warna}} border-b sticky top-0 shadow-sm z-10">
    <a href="
    @isset($link_balik)
    {{ route($link_balik) }}
    @else
    javascript:history.back()
    @endisset
    " class="inline-flex items-center p-3 hover:bg-green-300">
        {{-- {{URL::previous()}} --}}
        <span class="material-icons-outlined">
            arrow_back
        </span>
    </a>
    <span class="font-semibold inline-flex items-center p-3 mr-auto">
        {{$kata}}
    </span>
    <div class=" space-x-3">
    </div>
    <div class="inline-flex items-center p-3 ">

    </div>
</nav>