<x-guest-layout>
    
    

    <div class="flex flex-col h-screen">

        <div class="flex justify-center p-5 bg-gray-100 shadow">
            <div class="inline-flex items-center ">
                <img src="{{ asset('assets_kiki/genbi_logo.svg') }}" class="transform w-28">
            </div>

        </div>



        <!-- welcome tron -->
        <div class="flex flex-col p-4 justify-start text-center h-64 bg-gray-100 bg-no-repeat bg-bottom space-y-2"
            style="background-image: url('{{asset("assets_kiki/vector/Newcampaign_TwoColor_rame.svg")}}');background-size: 22rem;">
        </div>


        <!-- login form -->
        <div class="container mx-auto p-4 bg-white flex-1 rounded-t-3xl">

            <span class="block f-playfair text-2xl font-bold text-center text-gray-600 mt-3">
                Halo!
            </span>
            <span class="block f-roboto text-sm text-center text-gray-600">
                Silahkan login untuk melanjutkan
            </span>

            
            

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="flex mt-6 flex-col space-y-4">
                    <div>
                        <input class="border-none shadow text-sm  p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                        id="username" placeholder="Username" type="text" name="username"
                        :value="old('username')" required autofocus autocomplete="off">
                        <x-kiki.error-input :kolom="'username'"/>
                    </div>

                    {{-- <div>
                        <input class="border-none shadow text-sm  p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                        id="email" placeholder="Email" type="email" name="email" 
                        :value="old('email')" required autofocus>
                        <x-kiki.error-input :kolom="'email'"/>
                    </div> --}}
    
                    <div>
                        <input class="border-none shadow text-sm  p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                        type="password" name="password" required autocomplete="current-password" 
                        placeholder="Password" id="password">
                        <x-kiki.error-input :kolom="'password'"/>
                    </div>
    
                    <input class="border-none shadow p-2 w-full rounded focus:outline-none focus:ring-2 
                    focus:ring-blue-300 bg-blue-500  text-white
                    " type="submit" name="login" id="login" value="Login">
                </div>
            </form>
            
            {{-- <div class="text-center flex w-full justify-center mt-8 space-x-3 text-gray-500">
                <a class="text-xs flex items-center space-x-1" href="https://drive.google.com/file/d/1sPdcq4sQ4sZIA9OfB4OKqkNl5z57zpR_/view?usp=sharing">
                    <span class="material-icons-outlined" style="font-size:16px">book</span>
                    <span>Panduan Aplikasi</span>
                </a>
                <a class="text-xs flex items-center space-x-1" href="https://drive.google.com/drive/folders/1o35PIqsq3D1-lr9gL4F8oZHc_Re1bkjM?usp=sharing">
                    <span class="material-icons-outlined" style="font-size:16px">smart_display</span>
                    <span>Screencast</span>
                </a>
            </div> --}}

            <div class="fixed bottom-0 inset-x-0 bg-white 
            flex justify-center text-xs text-gray-400
            space-x-4 p-2 f-roboto
            ">
                <span class="font-bold">Scoring System</span>
                <span class="material-icons self-center" style="font-size: 6px;">
                    fiber_manual_record
                </span>
                <span class="hidden lg:inline">Generasi Baru Indonesia Gorontalo</span>
                <span class="lg:hidden inline">GenBI GTO</span>
                <span class="material-icons self-center" style="font-size: 6px;">
                    fiber_manual_record
                </span>
                <span>Coded <a href="https://linktr.ee/kikiraihann" class="hover:text-blue-300 font-bold">©Katili.dev</a></span>
            </div>

        </div>


    </div>








    


    
</x-guest-layout>





