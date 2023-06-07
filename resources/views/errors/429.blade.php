@extends('back-layout.app')
@section('body')
<body>
    <div class="loader"></div>
    <div id="app">
      <section class="section">
        <div class="container mt-5">
          <div class="page-error">
            <div class="page-inner mt-5">
              <h1>429</h1>
              <div class="page-description">
                Whoopps, Too many requests. <br>
               </div>
              <div class="page-search">
                <form>
                  <div class="form-group floating-addon floating-addon-not-append">
                  </div>
                </form>
                <div class="mt-3">
                  {{-- <a class="btn btn-primary" href="{{url()->previous()}}">Back</a> --}}
                  <a class="btn btn-primary" href="{{ route('index')}}">Back to Home</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <script src="{{ asset('back/assets/js/app.min.js')}}"></script>
    <script src="{{ asset('back/assets/js/scripts.js')}}"></script>
    <script src="{{ asset('back/assets/js/custom.js')}}"></script>

  </body>
@endsection