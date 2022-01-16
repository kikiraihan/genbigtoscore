<nav id="tabTask" class="{{$warna}} shadow rounded-b">{{-- border-t --}}
    <div class="flex items-center md:w-1/2 mr-auto">
        <a href="{{ route('manual.absen') }}" class="space-x-2 flex-1 flex justify-center py-2 border-b-2 focus:border-blue-400 focus:outline-none hover:text-blue-500 f-roboto">
            {{-- <span class="material-icons-outlined text-base">how_to_reg</span> --}}
            <span>Absen</span>
        </a>
        <a href="{{ route('manual.timkhu') }}" class="space-x-2 flex-1 flex justify-center py-2 border-b-2 focus:border-blue-400 focus:outline-none hover:text-blue-500 f-roboto">
            {{-- <span class="material-icons-outlined text-base">group</span> --}}
            <span class="xl:hidden inline">Tim Khus</span>
            <span class="hidden xl:inline">Tim Khusus</span>
        </a>
        <a href="{{ route('manual.piket') }}" class="space-x-2 flex-1 flex justify-center py-2 border-b-2 focus:border-blue-400 focus:outline-none hover:text-blue-500 f-roboto">
            {{-- <span class="material-icons-outlined text-base">playlist_add_check_circle</span> --}}
            <span>Piket</span>
        </a>
        <a href="{{ route('manual.tambahan') }}" class="space-x-2 flex-1 flex justify-center py-2 border-b-2 focus:border-blue-400 focus:outline-none hover:text-blue-500 f-roboto">
            {{-- <span class="material-icons-outlined text-base">playlist_add_check_circle</span> --}}
            <span>Tambahan</span>
        </a>
        <a href="{{ route('manual.evaluasi') }}" class="space-x-2 flex-1 flex justify-center py-2 border-b-2 focus:border-blue-400 focus:outline-none hover:text-blue-500 f-roboto">
            {{-- <span class="material-icons-outlined text-base">playlist_add_check_circle</span> --}}
            <span class="xl:hidden inline">Eval Bul</span>
            <span class="hidden xl:inline">Evaluasi Bulanan</span>
        </a>
    </div>

</nav>





<script>
    
</script>