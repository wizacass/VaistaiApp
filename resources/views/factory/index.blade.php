@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Factories</h1>
    </div>

    <table class="table is-striped is-fullwidth">
      <thead>
        <th>Name</th>
        <th>Country</th>
        <th>Mail</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($factories as $factory)
          <tr>
            <td>{{ $factory->pavadinimas }}</td>
            <td>{{ $factory->salis }}</td>
            <td>{{ $factory->el_pastas ?? "GDPR_Protected" }}</td>
            <td><a href="#" class="button is-info is-outlined is-small">Show</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <br/>

    <div class="field has-text-centered">
      <a href="#" class="button is-info is-large">Register new Factory</a>
    </div>

    <br/>
  </div>

@endsection
