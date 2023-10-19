@extends('layouts.detail')

@section('content')
<div class="mx-auto my-16">
    <div class="" style="height:200px;">
      <div class="flex flex-wrap justify-center text-center py-14">
        <div class="w-full px-4">
          <h1 class="text-4xl font-bold text-white" style="font-family: 'Quicksand', sans-serif;">BERITA</h1>
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
              <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">berita</a>
              </div>
          </li>
         
        </ol>
        </nav>
        <hr class="mt-3">
        <section>
            <div class="container mx-auto m-8">
                <h1 class="w-full my-2 text-4xl font-bold leading-tight text-center text-gray-800">
                 Berita Terkini
                </h1>
                <div class="w-full mb-4">
                  <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>
          
                  <div class="flex justify-center px-4 xl:px-0 py-4">
                      <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 pb-6 gap-8">
                        @foreach ($berita as $b)
                        <div class="max-w-sm bg-white  rounded-lg border border-gray-200 shadow-md transform transition hover:scale-105 duration-300 ease-in-out">
                          <a href="{{route('indexberita.detail',[$b->id])}}">
                              <img class="rounded-t-lg " src="{{asset('storage/'.$b->file)}}" alt="" />
                          </a>
                          <div class="p-5">
                              <a href="{{route('indexberita.detail',[$b->id])}}">
                                  <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{!!Str::limit($b->judul, 100)!!}&hellip;</h5>
                              </a>
                              <a href="{{route('indexberita.detail',[$b->id])}}">
                                <h1 class="text-lg text-gray-900">{!!Str::limit($b->isi, 150)!!}&hellip;</h1>
                              </a>
                              <div class="flex justify-between items-center my-3 border-t">
                                <div class="text-sm text-gray-500 my-3"><i class="fa-solid fa-calendar-days"></i> {{$b->created_at}}</div>
                                <div class="text-sm text-gray-500 my-3"><i class="fa-solid fa-eye"></i> {{$b->view}} kali</div>
                              </div>
                          </div>
                      </div>
                        @endforeach
                      </div>
                  </div>
                  <div class="flex justify-center">
                    {{$berita->links()}}
                  </div>
                  
        </section>
@endsection