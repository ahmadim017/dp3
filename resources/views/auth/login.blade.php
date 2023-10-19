@extends('layouts.login')
@section('header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.2/dist/css/splide.min.css">
@endsection
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.2/dist/js/splide.min.js"></script>
<script>
  var splide = new Splide('.splide', {
    type: 'loop',
    autoplay: true,
  });

  splide.mount();
</script>
@endsection
@section('content')

<section class="vh-100"  style="font-family: 'Quicksand', sans-serif;">
  <div class="max-w-screen-xl mx-auto h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="{{asset('image/dkp.png')}}">

        
          <div class="splide">
            <div class="splide__arrows">
              <button class="bg-gray-900 shadow splide__arrow splide__arrow--prev">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-4 h-4 text-white"> <!-- Mengubah ukuran ikon panah -->
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                </svg>
              </button>
              <button class="bg-gray-900 shadow splide__arrow splide__arrow--next">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-4 h-4 text-white"> <!-- Mengubah ukuran ikon panah -->
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                </svg>
              </button>
            </div>
           	    @php
                        $menus = \App\Models\menu::where('status','ACTIVE')->get();
                   @endphp

            <div class="splide__track">
              <div class="splide__list gap-x-2"> <!-- Mengurangi jarak antara elemen-elemen -->

          	@foreach ($menus as $m)
                <div class="flex-shrink-0 m-2 relative splide__slide overflow-hidden bg-gray-300 rounded-lg max-w-xs">
		 <a href="{{ route($m['route']) }}">
                  <svg class="absolute bottom-0 left-0 mb-4" viewBox="0 0 375 283" fill="none"
                    style="transform: scale(1.2); opacity: 0.2;"> <!-- Mengubah ukuran dan transformasi gambar SVG -->
                    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                      fill="white" />
                    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white" />
                  </svg>
                  <div class="relative pt-8 px-6 flex items-center justify-center">
                    <div class="block absolute w-16 h-16 bottom-0 left-0 -mb-16 ml-2"></div>
                    <img class="relative w-16" src="{{asset('storage/'.$m->image)}}" alt=""> <!-- Mengubah ukuran gambar -->
                  </div>
                  <div class="text-center text-gray-800 px-4 pb-4 mt-4">
                    <span class="block font-semibold mb-1 text-lg">{{$m->name}}</span> <!-- Mengubah ukuran teks -->
                  </div>
		</a>
                </div>
		@endforeach

                </div>
            </div>
          </div>
          

      </div>
    
      
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 mt-5">
        <div class="card" >
          <div class="card-body px-4 py-5 px-md-5">
            <h2 class="fw-bold mb-5">LOGIN</h2>
            @if (session('status'))
            <div class="alert alert-warning">
                {{session('status')}}
            </div>
            @endif
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
              @csrf
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" id="form1Example13" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus />
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <label class="form-label" for="form1Example13">Email address</label>
              </div>
    
              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="form1Example23" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <label class="form-label" for="form1Example23">Password</label>
              </div>
    
              <div class="d-flex justify-content-around align-items-center mb-4">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                  <label class="form-check-label" for="form1Example3"> Remember me </label>
                </div>
                <a href="#!">Forgot password?</a>
              </div>
    
              <!-- Submit button -->
              <button type="submit" class="bg-gray-400 hover:bg-gray-300 text-white text-lg py-2 px-4 w-full rounded-xl">Sign in</button>
    
            </form>

          </div>
        </div>
       
      </div>
    </div>
  </div>
</section>



@endsection
