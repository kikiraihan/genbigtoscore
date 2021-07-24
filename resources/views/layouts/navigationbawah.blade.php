<nav id="navbarMobile" class="fixed bottom-0 inset-x-0 bg-white 
        flex justify-between text-xs text-gray-700 
        f-scp z-10 ">
    <a href="#" class="w-full text-center block p-3 hover:bg-blue-300">
        <span class="block material-icons-outlined text-3xl">
            edit_calendar
        </span>
        <span class="block">
            Kalender
        </span>
    </a>
    <a href="#" class="w-full text-center block p-3 hover:bg-blue-300">
        <span class="block material-icons-outlined text-3xl">
            people_alt
        </span>
        <span class="block">
            Pegawai
        </span>
    </a>
    
    
    {{-- <a href="#" class="w-full text-center block p-3 hover:bg-blue-300">
        <span class="block material-icons-outlined text-3xl">
            perm_contact_calendar
        </span>
        <span class="block">
            Task
        </span>
    </a>
    
    <a href="#" class="w-full text-center block p-3 hover:bg-blue-300">
        <span class="block material-icons-outlined text-3xl">
            psychology
        </span>
        <span class="block">
            Teamboard
        </span>
    </a> --}}
    

    <a href="{{ route('dashboard') }}" class="w-full text-center block p-3 hover:bg-blue-300">
        <span class="block material-icons-outlined text-3xl">
            space_dashboard
        </span>
        <span class="block">
            Board
        </span>
    </a>
</nav>
