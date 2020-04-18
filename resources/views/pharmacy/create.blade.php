@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Register a new Pharmaceutical Network</h1>
    </div>

    <form method="POST" action="/pharmacies">
      @csrf

        <p>Address</p>
        <p>Dropdown: Network</p>
        <p>Phone</p>
        <p>Checkbox: Gamybine</p>

      <button type="submit" class="button is-info">Register</button>
    </form>
  </div>

@endsection
