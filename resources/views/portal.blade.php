<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"  rel="stylesheet" />
    @yield('header')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;622&family=Quicksand:wght@700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Dinas Pangan, Pertainian dan Perikanan</title>
    
</head>
<body style="font-family: 'Quicksand', sans-serif;">
   

                     <!-- component -->
  <section class="relative py-10 h-screen lg:overflow-hidden sm:overflow-scroll bg-gradient-to-t from-gray-300 via-stone-300 to-stone-500 ">
    <div class="w-64 md:w-96 h-96 md:h-full bg-gray-50 bg-opacity-30 absolute -top-64 md:-top-96 right-20 md:right-32 rounded-full pointer-events-none -rotate-45 transform"></div>
     
      <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.5;">
        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
      </svg>
                      <div class="container px-5 mx-auto">
                        <div class="flex flex-col items-center text-center w-full mb-5">
                          <div class="bg-white inline-flex items-center justify-center w-24 h-24 z-10 mb-3 shadow-lg rounded-full">
                            <img src="{{asset('image/bpp.png')}}" width="150px">
                          </div>
                          <h1 class="sm:text-3xl text-4xl font-semibold title-font mb-4 text-gray-100">Dashboard</h1>
                          <p class="lg:w-2/3 mx-auto leading-relaxed text-2xl text-stone-100">Sistem Informasi Ketahanan Pangan</p>
                        </div>
                      </div>
		    @php
                      $userId = Auth::user()->id; // ID pengguna yang sedang masuk
                      $userMenus = \App\Models\usermenu::where('id_user', $userId)->pluck('id_menu')->toArray();
                      $menus = \App\Models\menu::all();
                   @endphp

    <div class="container mx-auto">
      <div class="flex flex-wrap justify-center">

	  @foreach ($menus as $menu)
          @if (in_array($menu->id, $userMenus))
        <div class="p-2 md:w-1/4 sm:w-1/2 w-full flex-shrink-0 m-2 relative overflow-hidden bg-cyan-600 rounded-lg max-w-xs shadow-lg transform transition hover:scale-105 duration-300 ease-in-out">
          <a href="{{ route($menu['route']) }}">
          <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
            <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
            <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
          </svg>
          <div class="relative pt-5 px-5 flex items-center justify-center">
            <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
            <img class="relative w-12" src="{{ asset('storage/'. $menu['image']) }}">
          </div>
          <div class="relative text-white px-3 pb-3 mt-3">
            <span class="block font-semibold -mb-1 text-md text-center">{{ $menu['name'] }}</span>
          </div>
        </a>
        </div>

	 @endif
        @endforeach

       
	 @if (Auth::user()->role == "operator")
      <div class="p-4 md:w-1/4 sm:w-1/2 w-full flex-shrink-0 m-3 relative overflow-hidden bg-cyan-600 rounded-lg max-w-xs shadow-lg transform transition hover:scale-105 duration-300 ease-in-out">
        <a href="{{route('usulan.create')}}">
        <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
          <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
          <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
        </svg>
        <div class="relative pt-10 px-10 flex items-center justify-center">
          <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
          <img class="relative w-20" src="{{asset('image/usulan.png')}}">
        </div>
        <div class="relative text-white px-6 pb-6 mt-6">
          <span class="block font-semibold -mb-1 text-xl text-center">Usulan Penerima Bantuan</span>
        </div>
      </a>
      </div>
        @else
	 <div class="p-2 md:w-1/4 sm:w-1/2 w-full flex-shrink-0 m-2 relative overflow-hidden bg-cyan-600 rounded-lg max-w-xs shadow-lg transform transition hover:scale-105 duration-300 ease-in-out">
        <a href="{{route('usulan.dashboard')}}">
        <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
          <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
          <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
        </svg>
        <div class="relative pt-5 px-5 flex items-center justify-center">
          <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
          <img class="relative w-12" src="{{asset('image/usulan.png')}}">
        </div>
        <div class="relative text-white px-3 pb-3 mt-3">
          <span class="block font-semibold -mb-1 text-md text-center">Usulan Penerima Bantuan</span>
        </div>
      </a>
      </div>
	@endif

    </div>
  </div>
</section>
   

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
        @yield('footer')
       
</body>
</body>
</html>