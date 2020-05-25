@extends('../layouts/main')

@section('content')

  <section class="hero is-light is-bold">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">Pharmacy profits report</h1>
        <h2 class="subtitle">{{ $network }}</h2>
      </div>
    </div>
  </section>

  <br/>

  <div class="container">
    <table class="table">

    </table>
  </div>

@endsection
