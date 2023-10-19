@extends('layouts.detail')

@section('content')
<div class="mx-auto my-16">
    <div class="" style="height:200px;">
      <div class="flex flex-wrap justify-center text-center py-14">
        <div class="w-full px-4">
          <h1 class="xl:text-4xl sm:text-xl md:text-2xl font-bold text-white" style="font-family: 'Quicksand', sans-serif;">{{$berita->judul}}</h1>
        </div>
      </div>
    </div>
  </div>

  <div id="blog" class="bg-white px-4 xl:px-4 py-14">
    <div class="mx-auto container">
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="{{route('welcome')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
            <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
            Home
            </a>
          </li>
          <li>
              <div class="flex items-center">
              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <a href="{{route('indexberita')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Berita</a>
              </div>
          </li>
          <li>
            <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Detail</a>
            </div>
        </li>
        </ol>
        </nav>
        <hr class="mt-3">
        <div tabindex="0"  aria-label="Group of cards" class="focus:outline-none mt-12 lg:mt-24">
                <div  class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-8">
                
                  <div tabindex="0" class="focus:outline-none" aria-label="card 1">
                          <div class="flex flex-wrap justify-start mb-2 ">
                                <h1 class="w-full my-2 text-2xl font-bold leading-tight text-gray-800">
                                  Berita Daerah
                                </h1>
                                  <div class="h-1 gradient justify-start w-64 my-0 py-0 rounded-t"></div>
                            </div>
                              <div class="w-full bg-white  rounded-lg border border-gray-200 shadow-md">
                                  <img class="rounded-t-lg " src="{{asset('storage/'.$berita->file)}}" alt="" />
                                <div class="p-5">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{!!$berita->judul!!}</h5>
                                    <h1 class="text-lg text-gray-900">{!!$berita->isi!!}</h1>
                                  
                                    <div class="flex justify-between items-center my-3 border-t">
                                      <div class="text-sm text-gray-500 my-3"><i class="fa-solid fa-calendar-days"></i> {{$berita->created_at}}</div>
                                      <div class="text-sm text-gray-500 my-3"><i class="fa-solid fa-eye"></i> {{$berita->view}} kali</div>
                                    </div>
                                  </div>
                              </div>
                  </div>
                  <div tabindex="0" class="focus:outline-none " aria-label="card 1">
                      <div class="flex flex-wrap justify-start mb-2 ">
                        <h1 class="w-full my-2 text-2xl font-bold leading-tight text-gray-800">
                          Berita Terkait
                        </h1>
                          <div class="h-1 gradient justify-start w-64 my-0 py-0 rounded-t"></div>
                        </div>
                          @foreach ($terkait as $t)
                          <a href="{{route('indexberita.detail',[$t->slug])}}" class="flex flex-col items-center mb-4 bg-white rounded-lg border shadow-md md:flex-row w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                              <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{asset('storage/'.$t->file)}}" alt="">
                              <div class="flex flex-col justify-between p-4 leading-normal">
                                  <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{$t->judul}}</h5>
                                  <h1 class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!!Str::limit($t->isi, 60)!!}&hellip;</h1>
                              </div>
                          </a>
                          @endforeach

                        <div class="flex flex-wrap justify-start mb-2 ">
                          <h1 class="w-full my-2 text-2xl font-bold leading-tight text-gray-800">
                          Pengumuman
                          </h1>
                            <div class="h-1 gradient justify-start w-64 my-0 py-0 rounded-t"></div>
                          </div>
                          @foreach ($pengumuman as $p)
                              <div class='flex items-center my-4'>  
                                <div class="rounded-lg border p-6 w-full bg-white">
                                <div class="mt-3">
                                  <div class="mb-3 text-lg text-neutral-600 font-bold">{{$p->judul}}</div>
                                </div>
                            
                                <div>
                                  <div class="flex items-center ">
                                    <div class="flex space-x-4 md:space-x-8">
                                        <a href="{{route('pengumuman.download',[$p->id])}}" class="mx-auto lg:mx-0 hover:underline text-white font-semibold rounded-md my-3 py-2 px-4 shadow-lg focus:outline-none focus:shadow-outline bg-emerald-800 transform transition hover:scale-105 duration-300 ease-in-out">
                                            Download
                                        </a>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        @endforeach
                  </div>
                </div>


        </div>
    </div>
  </div>
    @endsection