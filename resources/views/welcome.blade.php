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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.2/dist/css/splide.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Dinas Pangan, Pertainian dan Perikanan</title>
</head>
<body>

    <nav class="bg-stone-100 dark:bg-gray-900 fixed w-full z-40 top-0 left-0 border-b border-gray-200 dark:border-gray-600" style="font-family: 'Quicksand', sans-serif;">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#home" class="flex items-center">
            <img src="{{asset('image/bpp.png')}}" class="h-10" alt="Flowbite Logo">
            <span class="self-center text-gray-700 text-2xl font-semibold whitespace-nowrap dark:text-white">DP3 Balikpapan</span>
        </a>
        <div class="flex md:order-2">
            <a href="{{route('login')}}" class="text-white bg-cyan-700 hover:bg-cyan-800 hover:underline focus:outline-none font-medium rounded-full transform transition hover:scale-105 duration-300 ease-in-out text-sm px-3 py-2 text-center mr-1 md:mr-0 ">Login</a>
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
          <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-stone-100 rounded-lg bg-stone-100 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-stone-100 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
              <a href="#home" class="block py-2 pl-3 pr-4 text-gray-700 bg-cyan-700 rounded md:bg-transparent md:hover:text-cyan-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
            </li>
            <li>
              <a href="#berita" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-cyan-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Berita</a>
            </li>
            <li>
              <a href="#hargapangan" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-cyan-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Harga Pangan</a>
            </li>
            <li>
              <a href="#komposit" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-cyan-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Komposit Ketahanan Pangan</a>
            </li>
          </ul>
        </div>
        </div>
      </nav>
      
  <section id="home" class="my-16">
    
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-auto overflow-hidden md:h-96">
             <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{asset('image/2.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                
              </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{asset('image/spanduk.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{asset('image/1.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 4 -->
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
  </section>

<section id="berita" class="bg-white">
    <div class="container mx-auto m-8 mt-16" style="font-family: 'Quicksand', sans-serif;">

        <h1 class="w-full my-2 text-4xl font-bold leading-tight text-center text-cyan-800" >
          Berita Terbaru
        </h1>

        <div class="w-full mb-16">
          <div class="h-1 mx-auto bg-gray-200 w-64 my-0 py-0 rounded-t"></div>
        </div>

        <div class="flex justify-center px-4 xl:px-0 py-4">
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 pb-6 gap-8"> 

              @foreach ($berita as $b)
              <div class="max-w-sm bg-stone-100 border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">

                <a href="#">
                    <img class="rounded-t-lg" src="{{asset('storage/'. $b->file)}}" alt="" />
                </a>
                <div class="flex justify-end mr-5 md:justify-end -mt-10">
                    <button class="w-16 h-16 object-cover bg-cyan-700 rounded-full border-2 border-white text-white text-md">{{$b->created_at}}</button>
                  </div>
             <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-cyan-800 dark:text-white">{!!Str::limit($b->judul, 100)!!}&hellip;</h5>
                </a>
                  
                </div>
            </div>
              @endforeach
        
        </div>
    </div>

    <div class="flex justify-center">
        <a href="#" class="mx-auto lg:mx-0 hover:underline bg-cyan-700 text-white font-semibold rounded-full my-4 py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
          Selengkapnya
        </a>
      </div>

</div>
</section>    

<section id="hargapangan" class="bg-stone-100" style="font-family: 'Quicksand', sans-serif;">
    <div class="container mx-auto m-8 mt-16">

        <h1 class="w-full my-2 text-4xl font-bold leading-tight text-center text-cyan-600 pt-20" style="font-family: 'Quicksand', sans-serif;">
          Harga Pangan
        </h1>
        <div class="w-full mb-16">
            <div class="h-1 mx-auto bg-gray-200 w-64 my-0 py-0 rounded-t"></div>
        </div>


        <div class="mb-6 ">
            <form class="container mx-auto px-8 max-w-screen-xl md:flex md:items-center md:justify-between">
                <div class="mb-6 w-full px-2">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Minggu</label>
                    <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option>Minggu Ke-1</option>
                      <option>Canada</option>
                      <option>France</option>
                      <option>Germany</option>
                    </select>
                </div>
                <div class="mb-6 w-full px-2">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bulan</label>
                    <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option>Januari</option>
                      <option>Canada</option>
                      <option>France</option>
                      <option>Germany</option>
                    </select>
                </div>
                <div class="mb-6 w-full px-2">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
                    <select id="countries" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option>2023</option>
                      <option>Canada</option>
                      <option>France</option>
                      <option>Germany</option>
                    </select>
                  </div>
                <button type="submit" class="text-white  font-bold bg-gray-500 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                  </svg></button>
              </form>
        </div>

  
       
    <div class="container mx-auto py-10">
        <div class="splide">
          <div class="splide__arrows">
            <button class="bg-gray-900 shadow splide__arrow splide__arrow--prev">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
              </svg>
            </button>
            <button class="bg-gray-900 shadow splide__arrow splide__arrow--next">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
              </svg>
            </button>
          </div>
          <div class="splide__track">
            <div class="splide__list gap-x-4">

              @foreach ($neracapangan as $n)
              <div class="flex-shrink-0 m-6 relative splide__slide overflow-hidden bg-cyan-600 rounded-lg max-w-xs shadow-lg">
                <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                  <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                  <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                </svg>
                <div class="relative pt-10 px-10 flex items-center justify-center">
                  <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                  <img class="relative w-40" src="{{asset('storage/'.$n->komoditasid->image)}}" alt="">
                </div>
                <div class="relative text-white px-6 pb-6 mt-6">
                    <span class="block font-semibold -mb-1 text-2xl">{{$n->komoditasid->komoditas}}</span>
                    <div class="flex justify-between">
                      <span class="block opacity-75 text-lg">Rp/Kg</span>
                      <span class="block bg-white rounded-full text-gray-500 text-xs font-bold px-3 py-2 leading-none flex items-center">Rp.{{number_format($n->harga)}}</span>
                    </div>
                  </div>
              </div>
              @endforeach
                
              
            </div>
          </div>
        </div>

        <div class="flex justify-center py-6">
            <a href="#" class="mx-auto lg:mx-0 hover:underline bg-cyan-600 text-white font-semibold rounded-full my-4 py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
              Selengkapnya
            </a>
          </div>
      </div>

          
    </div>
</section>


<section id="komposit" class="bg-white">
    <div class="container mx-auto m-8 mt-16">

        <h1 class="w-full my-2 text-4xl font-bold leading-tight text-center text-cyan-800 pt-20" style="font-family: 'Quicksand', sans-serif;">
            Indeks Komposit Ketahanan Pangan
        </h1>
        <div class="w-full mb-16">
            <div class="h-1 mx-auto bg-gray-200 w-64 my-0 py-0 rounded-t"></div>
        </div>
        <div class="flex justify-center px-4 xl:px-0 py-4 z-10">
        @include('map')
        </div>
    </div>

</section>
<section id="sosialisasi" class="bg-white flex-shrink-0 m-6 relative overflow-hidden">
  <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.3;">
    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
  </svg>
  <div class="container mx-auto m-8 mt-16">

      <h1 class="w-full my-2 text-4xl font-bold leading-tight text-center text-cyan-800 pt-20" style="font-family: 'Quicksand', sans-serif;">
          Penganekaragaman Pangan (sosialisasi dan UMKM)
      </h1>
      <div class="w-full mb-16">
          <div class="h-1 mx-auto bg-gray-200 w-64 my-0 py-0 rounded-t"></div>
      </div>
      <div class="flex justify-center px-4 xl:px-0 py-4">
      
      </div>
  </div>

</section>
<section id="footer" style="font-family: 'Quicksand', sans-serif;">  
<footer class="bg-cyan-800 dark:bg-gray-900">
    <div class="container mx-auto m-8 max-w-screen-xl">
      <div class="grid grid-cols-2 gap-8 px-4 py-6 lg:py-8 md:grid-cols-3">
        
        <div>
            <h2 class="mb-6 text-md font-bold text-white uppercase dark:text-white">Tautan Terkait</h2>
            <ul class="text-white dark:text-gray-400 font-medium">
                <li class="mb-4">
                    <a href="#" class=" hover:underline">LPSE Kota Balikpapan</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="hover:underline">Pemkot Balikpapan</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="hover:underline">Disdukcapil</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="hover:underline">Inspektorat</a>
                </li>
            </ul>
        </div>

        <div>
            <h2 class="mb-6 text-md font-semibold text-white uppercase dark:text-white">Kantor</h2>
            <ul class="text-white dark:text-gray-400 font-medium">
                <li class="mb-4">
                    <a href="#" class="hover:underline"><svg fill="none" stroke="currentColor" stroke-width="1.5" class="w-6 h-6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                      </svg>Jalan Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Gn. Bahagia, Balikpapan, Kota Balikpapan, Kalimantan Timur 76114</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="hover:underline"><svg fill="none" stroke="currentColor" class="w-6 h-6" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"></path>
                      </svg>(0542) 761530</a>
                </li>
                
            </ul>
        </div>

        <div>
            <h2 class="mb-6 text-md font-semibold text-white uppercase dark:text-white">Lokasi</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8408953196654!2d116.87411557579604!3d-1.2682698356084146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df14697aa2b72dd%3A0x329cbc2bd3172991!2sDinas%20Pangan%20Pertanian%20dan%20Perikanan!5e0!3m2!1sid!2sid!4v1686721782387!5m2!1sid!2sid" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        
    </div>
    </div>

</footer>
</section>
<section class="container mx-auto m-8 max-w-screen-xl">
    <div class="px-3 py-2 bg-white dark:bg-gray-700 md:flex md:items-center md:justify-between">
        <span class="text-md text-cyan-800 font-semibold dark:text-gray-300 sm:text-center">© 2023 <a href="#">Dinas Pangan, Pertanian dan Perikanan</a>.
        </span>
        <div class="flex mt-4 space-x-6 sm:justify-center md:mt-0">
            <a href="#" class="text-gray-400 hover:text-blue-700 dark:hover:text-white">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                <span class="sr-only">Facebook page</span>
            </a>
            <a href="#" class="text-gray-400 hover:text-red-600 dark:hover:text-white">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                <span class="sr-only">Instagram page</span>
            </a>
           
        </div>
      </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
@yield('footer')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.2/dist/js/splide.min.js"></script>
<script>
  var splide = new Splide('.splide', {
    type: 'loop',
    autoplay: true,
  });

  splide.mount();
</script>
<script>
import { Carousel } from "flowbite";
import type { CarouselItem, CarouselOptions, CarouselInterface } from "flowbite";

const items: CarouselItem[] = [
    {
        position: 0,
        el: document.getElementById('carousel-item-1')
    },
    {
        position: 1,
        el: document.getElementById('carousel-item-2')
    },
    {
        position: 2,
        el: document.getElementById('carousel-item-3')
    },
    {
        position: 3,
        el: document.getElementById('carousel-item-4')
    },
];

const options: CarouselOptions = {
    defaultPosition: 1,
    interval: 3000,
    
    indicators: {
        activeClasses: 'bg-white dark:bg-gray-800',
        inactiveClasses: 'bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800',
        items: [
            {
                position: 0,
                el: document.getElementById('carousel-indicator-1')
            },
            {
                position: 1,
                el: document.getElementById('carousel-indicator-2')
            },
            {
                position: 2,
                el: document.getElementById('carousel-indicator-3')
            },
            {
                position: 3,
                el: document.getElementById('carousel-indicator-4')
            },
        ]
    },
    
    // callback functions
    onNext: () => {
        console.log('next slider item is shown');
    },
    onPrev: ( ) => {
        console.log('previous slider item is shown');
    },
    onChange: ( ) => {
        console.log('new slider item has been shown');
    }
};

const carousel: CarouselInterface = new Carousel(items, options);

carousel.cycle()

// set event listeners for prev and next buttons
const $prevButton = document.getElementById('data-carousel-prev');
const $nextButton = document.getElementById('data-carousel-next');

$prevButton.addEventListener('click', () => {
    carousel.prev();
});

$nextButton.addEventListener('click', () => {
    carousel.next();
});


</script>
</body>
</html>