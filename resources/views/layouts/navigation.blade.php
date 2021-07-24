<nav class="flex justify-between px-4 py-1 {{$warna}} shadow items-center">
    <div class="inline-flex items-center ">
        @isset($kata)
            <span class="f-robotocon capitalize text-lg ">{{$kata}}</span>
            {{-- text-blue-500 --}}
        @else
        <img src="{{ asset('assets_kiki/genbi_logo.svg') }}" class="transform w-28">
        @endisset
    </div>
    <div class="inline-flex items-center justify-center space-x-2">
        

        <button type="button" class="
        ini-tombol-sidebar select-none
        p-2 rounded-md
        text-blue-600  hover:bg-gray-100 
        focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white
        " aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!-- Hamburger -->
            <span class="material-icons-outlined block text-3xl">
                menu
            </span>
            <!-- x -->
            <span class="material-icons-outlined hidden text-3xl">
                close
            </span>            
        </button>
    </div>
</nav>



<!-- sidebar -->
<div class="ini-sidebar min-h-screen w-64  py-7 bg-gradient-to-br from-white to-blue-100 mb-24
absolute inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out z-20
">
<!-- md:relative md:translate-x-0  -->
    <div class="grid grid-cols-3 items-center space-x-2 px-2">
        <span class="bg-white my-2">
            <img src="{{Auth::user()->avatar}}" class="object-cover w-16 h-16 shadow rounded-full">
        </span>
        <span class="py-2 text-sm f-roboto col-span-2">
            {{Auth::user()->nama}} <br>
            <span class="f-robotomon text-xs">{{Auth::user()->username}}</span><br>
            <span class="bg-blue-400 f-roboto text-xs text-gray-50 p-0.5 rounded">
                {{Auth::user()->getRoleNames()[0]}}
            </span>
        </span>
    </div>
    
    <hr>
    <br>
    

    

    <a href="{{ route('dashboard') }}" class="py-2.5 px-4 mx-1 hover:bg-blue-300 transition duration-200 rounded items-center flex space-x-1">
        <span class="material-icons-outlined ">home</span>
        <span>Utama</span>
    </a>

    <a href="{{ route('setting') }}" class="py-2.5 px-4 mx-1 hover:bg-blue-300 transition duration-200 rounded items-center flex space-x-1">
        <span class="material-icons-outlined ">manage_accounts</span>
        <span>Edit Bio</span>
    </a>

    <div class="hidden md:block">
        <hr class="my-1">
        <x-kiki.sublabel class="px-4">
            Tim Penilai
        </x-kiki.sublabel>
        <a href="{{ route('manual.absen') }}" 
            class="py-2.5 px-4 mx-1 hover:bg-blue-300 transition duration-200 rounded items-center flex space-x-1">
            <span class="material-icons-outlined ">edit</span>
            <span>Penilaian Manual</span>
        </a>
    </div>

    <hr class="my-1">

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="#" class="py-2.5 px-4 mx-1 hover:bg-blue-300 transition duration-200 rounded items-center flex space-x-1"
        :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
            <span class="material-icons-outlined ">logout</span>
            {{ __('Log Out') }}
        </a>
    </form>

    

</div>


<script>
    // ambil semua
    const btn = document.querySelector('.ini-tombol-sidebar');
    const sidebar = document.querySelector('.ini-sidebar');

    // toggle
    toggle_burger();

    function toggle_burger()
    {
        btn.addEventListener('click', ()=>{
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('shadow');
        })
    }
</script>