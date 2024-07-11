<x-slot name="stylehalaman">
    @livewireStyles
    <style>
        /* Browser mockup code
            * Contribute: https://gist.github.com/jarthod/8719db9fef8deb937f4f
            * Live example: https://updown.io
        */

        .browser-mockup {
            border-top: 2em solid rgba(230, 230, 230, 0.7);
            position: relative;
            /* height: 60vh; */
        }

        .browser-mockup:before {
            display: block;
            position: absolute;
            content: "";
            top: -1.25em;
            left: 1em;
            width: 0.5em;
            height: 0.5em;
            border-radius: 50%;
            background-color: #f44;
            box-shadow: 0 0 0 2px #f44, 1.5em 0 0 2px #9b3, 3em 0 0 2px #fb5;
        }

        .browser-mockup>* {
            display: block;
        }

    </style>
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    {{-- @include('layouts.scriptsweetalert') --}}
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    {{-- untuk counter --}}
    <script>
        const counters = document.querySelectorAll('.value');
        const speed = 200;

        counters.forEach( counter => {
        const animate = () => {
            const value = +counter.getAttribute('akhi');
            const data = +counter.innerText;
            
            const time = value / speed;
            if(data < value) {
                counter.innerText = Math.ceil(data + time);
                setTimeout(animate, 1);
                }else{
                counter.innerText = value;
                }
            
        }
        
        animate();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            window.livewire.emit('terkonfirmasiInisiasiNilai')
        });
    </script>
</x-slot>






<div class="container w-full md:max-w-4xl mx-auto pt-20">

    <section class="bg-gray-100 dark:bg-black dark:rounded-4xl border-b py-8" wire:ignore>
        {{-- counter --}}
        <div class="items-center w-full mx-auto content-end px-12 my-14 flex space-x-2 justify-center">
            <div class="container  mx-auto grid">
            
            
                <!-- Cards -->
                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <!-- Card -->
                    @foreach ([
                        ['icon'=>'fas fa-users','title'=>'Penerima Aktif','counter'=>($anggotaPenerima),'warna'=>'blue'],
                        ['icon'=>'fas fa-users','title'=>'Non Penerima Aktif','counter'=>($anggotaAktif-$anggotaPenerima),'warna'=>'sky'],
                        ['icon'=>'fas fa-users','title'=>'Alumni (Kisaran)','counter'=>$anggotaNonAktif+200,'warna'=>'amber'],
                        ['icon'=>'fas fa-shoe-prints','title'=>'Aktivitas','counter'=>$absensiCount,'warna'=>'orange'],
                    ] as $item)
                    <div class="flex items-center p-2 rounded-lg justify-center">
                        <div class="p-3 mr-4 text-{{$item['warna']}}-500 bg-{{$item['warna']}}-100 rounded-full dark:text-{{$item['warna']}}-100 dark:bg-{{$item['warna']}}-500">
                            <i class="{{$item['icon']}}"></i>
                        </div>
                        <div>
                            <p class="mb-2 if @if ($item['title']=='Non Penerima Aktif') text-xs @else text-sm @endif font-medium text-gray-600 dark:text-gray-400">
                                {{$item['title']}}
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 value" akhi='{{$item['counter']}}'>
                                0
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
    
            </div>
            
        </div>

    </section>

    <section class="bg-gray-100 border-b py-8">
        <h2 class="w-full my-2 text-4xl font-black leading-tight text-center text-gray-800">
            Ringkasan
        </h2>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-gradient-to-r from-cyan-500 to-blue-500 w-64 opacity-25 my-0 py-0 rounded-t">
            </div>
        </div>

        <div class="items-center w-full content-end grid grid-flow-col gap-4 px-12">
            <div class="p-4 max-w-md bg-white rounded-lg border shadow-xl sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                        <i class="fas fa-arrow-up text-green-600"></i> 3 Teratas
                    </h5>
                    <span class="text-sm font-medium">
                        <span class="ml-1 text-xs text-gray-400">Nilai</span>
                    </span>
               </div>
               <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        
                        @if ($nilaiAkhir)
                        @foreach ($teratas as $idAnggota=>$nilai)
                        @php
                            $ang=$this->getModel($idAnggota);
                        @endphp
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{$ang->user->avatar}}">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{$ang->nama}}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{$ang->universitas->singkatan}}
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{round($nilai,2)}}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @else
                        <div class="animate-pulse flex space-x-4">
                            <div class="rounded-full bg-slate-200 h-10 w-10"></div>
                            <div class="flex-1 space-y-6 py-1">
                              <div class="h-2 bg-slate-200 rounded"></div>
                              <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                  <div class="h-2 bg-slate-200 rounded col-span-2"></div>
                                  <div class="h-2 bg-slate-200 rounded col-span-1"></div>
                                </div>
                                <div class="h-2 bg-slate-200 rounded"></div>
                              </div>
                            </div>
                          </div>
                        @endif

                    </ul>
               </div>
            </div>
            <div class="p-4 max-w-md bg-white rounded-lg border shadow-xl sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                        <i class="fas fa-arrow-down text-red-600"></i> 3 Terbawah
                    </h5>
                    <span class="text-sm font-medium">
                        <span class="ml-1 text-xs text-gray-400">Nilai</span>
                    </span>
               </div>
               <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        
                        @if ($nilaiAkhir)
                        @foreach ($terbawah as $idAnggota=>$nilai)
                        @php
                            $ang=$this->getModel($idAnggota);
                        @endphp
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{$ang->user->avatar}}">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{$ang->nama}}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{$ang->universitas->singkatan}}
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{round($nilai,2)}}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @else
                        <div class="animate-pulse flex space-x-4">
                            <div class="rounded-full bg-slate-200 h-10 w-10"></div>
                            <div class="flex-1 space-y-6 py-1">
                              <div class="h-2 bg-slate-200 rounded"></div>
                              <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                  <div class="h-2 bg-slate-200 rounded col-span-2"></div>
                                  <div class="h-2 bg-slate-200 rounded col-span-1"></div>
                                </div>
                                <div class="h-2 bg-slate-200 rounded"></div>
                              </div>
                            </div>
                          </div>
                        @endif
                    </ul>
               </div>
            </div>
        </div>


        <div class="text-center py-6">
            <span wire:click="InisiasiNilai" class="cursor-pointer bg-gradient-to-r from-orange-300 to-amber-300 hover:underline text-gray-800 font-extrabold rounded py-2 px-4 shadow-lg">
                <x-kiki.loading-spin-inline wire:loading/>
                <span>Refresh Nilai</span>
            </span>
        </div>


        <div class="items-center w-full mx-auto content-end px-12 mt-8 ">
            <div class="browser-mockup flex-1 bg-white rounded shadow-xl md:col-span-2">
                @include('layouts.landing.layar-absen',['isiTabel'=>$absensi,'sekarang'=>$sekarang])
            </div>
        </div>

    </section>

</div>
