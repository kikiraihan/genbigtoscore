<nav class="flex justify-between px-4 py-1 {{$warna}} shadow items-center">
    <div class="inline-flex items-center">
        @isset($kata)
            <span class="f-robotocon capitalize text-lg ">{{$kata}}</span>
            {{-- text-blue-500 --}}
        @else
        <img src="{{ asset('assets_kiki/genbi_logo.svg') }}" class="transform w-28">
        @endisset
    </div>
    <div class="hidden md:flex space-x-2 items-center text-gray-400 order-last">
        <span class="material-icons-outlined text-sm lg:inline hidden">
            computer
        </span>
        <span class="f-robotomon text-xs lg:inline hidden">
            Desktop Mode
        </span>
        <span class="material-icons-outlined text-sm md:inline lg:hidden">
            tablet_mac
        </span>
        <span class="f-robotomon text-xs md:inline lg:hidden">
            Tab Mode
        </span>
    </div>
    <div class="inline-flex items-center justify-center space-x-2 md:order-first">
        <button type="button" class="
        ini-tombol-sidebar select-none
        p-2 rounded-md
        text-blue-600  hover:bg-gray-100 
        focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white
        " aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!-- Hamburger -->
            <span class="material-icons-outlined block text-3xl select-none">
                menu {{-- keyboard_double_arrow_right --}}
            </span>
            <!-- x -->
            <span class="material-icons-outlined hidden text-3xl">
                close
            </span>            
        </button>
    </div>
</nav>



<!-- sidebar -->
<div class="ini-sidebar min-h-screen w-64 md:pb-7 md:pt-0 py-7 bg-gradient-to-br from-white to-blue-100 mb-24 absolute inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out z-20 overflow-auto">
    <!-- md:relative md:translate-x-0  -->
    <div class="hidden mb-0 text-left md:block">
        <span class="ini-tombol-tutup material-icons-outlined py-2 px-6 hover:bg-gray-200 hover:bg-transparent text-blue-500 rounded-br-md cursor-pointer select-none">
            keyboard_double_arrow_left
        </span>
    </div>
    <div class="grid grid-cols-3 items-center space-x-2 px-2">
        <span class="my-2">
            <img src="{{Auth::user()->avatar}}" class="object-cover w-16 h-16 shadow rounded-full">
        </span>
        <span class="py-2 text-sm f-roboto col-span-2">
            {{Auth::user()->nama}} <br>
            <span class="f-robotomon text-xs">{{Auth::user()->username}}</span><br>
            <span class="space-x-1">
                @foreach (Auth::user()->getRoleNames() as $item)
                <span class="bg-blue-400 f-roboto text-xs text-gray-50 py-0.5 px-1 rounded">
                    {{$item}}
                </span>
                @endforeach
            </span>
        </span>
    </div>
    
    <hr>
    <br>
    

    

    <x-kiki.sidebar-link :lvroute="'dashboard'" :icon="'home'">
        Utama
    </x-kiki.sidebar-link>

    <x-kiki.sidebar-link :lvroute="'setting'" :icon="'manage_accounts'">
        Edit Bio
    </x-kiki.sidebar-link>

    @hasanyrole('Tim Penilai|Korwil')
        <div class="hidden md:block">
            
            <hr class="mt-1 mb-4">
            <x-kiki.sublabel class="px-4">
                Tim Penilai
            </x-kiki.sublabel>

            <x-kiki.sidebar-link :lvroute="'manual.absen'" :icon="'edit'">
                Penilaian Manual
            </x-kiki.sidebar-link>

        </div>
    @endhasanyrole

    
    @hasanyrole('Korwil|Kekom|Kepala Unit')
    <x-kiki.sidebar-link :lvroute="'kepala.evaluasi'" :icon="'supervised_user_circle'">
        Evaluasi Bulanan
    </x-kiki.sidebar-link>
    @endhasanyrole

    @hasanyrole('Kepala Unit')
    <x-kiki.sidebar-link :lvroute="'kaunit.absen'" :icon="'edit_calendar'">
        Absen Unit
    </x-kiki.sidebar-link>
    @endhasanyrole

    @hasanyrole('Korwil|Benwil|Benkom')
    <hr class="mt-1 mb-4">
    <x-kiki.sublabel class="px-4">
        Bendahara
    </x-kiki.sublabel>
    <x-kiki.sidebar-link :lvroute="'beasiswa.uangkas'" :icon="'edit_calendar'">
        Uang Kas
    </x-kiki.sidebar-link>
    @endhasanyrole



    @hasanyrole('Admin|Korwil|Kekom')
    <div class="hidden md:block">
        
        <hr class="mt-1 mb-4">
        <x-kiki.sublabel class="px-4">
            Master
        </x-kiki.sublabel>

        @hasanyrole('Admin|Korwil')
        <x-kiki.sidebar-link :lvroute="'master.badan'" :icon="'account_tree'">
            Struktur Badan
        </x-kiki.sidebar-link>
        @endhasanyrole
        
        <x-kiki.sidebar-link :lvroute="'master.unit'" :icon="'account_tree'">
            Struktur Unit
        </x-kiki.sidebar-link>

        @hasanyrole('Admin|Korwil')
        <x-kiki.sidebar-link :lvroute="'desktop.anggota'" :icon="'group'">
            Anggota
        </x-kiki.sidebar-link>
        @endhasanyrole
        
        @hasanyrole('Admin')
        {{-- <x-kiki.sidebar-link :lvroute="'beasiswa'" :icon="'school'">
            Beasiswa
        </x-kiki.sidebar-link> --}}
        @endhasanyrole

        @hasanyrole('Admin|Korwil')
        <x-kiki.sidebar-link :lvroute="'hasilnilai'" :icon="'article'">
            Hasil Penilaian
        </x-kiki.sidebar-link>
        @endhasanyrole

        @hasanyrole('Admin|Korwil')
        {{-- <x-kiki.sidebar-link :lvroute="'master.manajemen-role'" :icon="'account_tree'">
            Manajemen Role
        </x-kiki.sidebar-link> --}}
        @endhasanyrole

    </div>
    @endhasanyrole


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
    const btnTutup = document.querySelector('.ini-tombol-tutup');
    const sidebar = document.querySelector('.ini-sidebar');
    // let buka=false

    // toggle
    toggle_burger();

    function toggle_burger()
    {
        btn.addEventListener('click', ()=>{
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('shadow');
            // buka=true;

            // if (buka==true) {
                // document.addEventListener('click', function(e) {
                //     if (e.target != sidebar && e.target.parentNode != sidebar && e.target != btn && e.target.parentNode != btn) {
                //         sidebar.classList.toggle('-translate-x-full');
                //         sidebar.classList.toggle('shadow');
                //         buka=false;
                //     }
                // })
            // }
        })

        btnTutup.addEventListener('click', ()=>{
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('shadow');
            // buka=false;
            // console.log(buka)
        })

    }



    //I'm using "click" but it works with any event
    // document.addEventListener('click', function(event) {
    // var isClickInside = sidebar.contains(event.target);

    // if (!isClickInside && buka!=false) {
    //     sidebar.classList.toggle('-translate-x-full');
    //     sidebar.classList.toggle('shadow');
    //     buka=!buka;
    // }
    // });
</script>