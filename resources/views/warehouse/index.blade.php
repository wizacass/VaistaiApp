@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
        <h1 class="title center-text">Wholesale Warehouses</h1>
    </div>
    <table class="table is-striped is-fullwidth">
      <thead>
        <th>Name</th>
        <th>Country</th>
        <th>Address</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($warehouses as $warehouse)
        <tr>
          <td>{{$warehouse->pavadinimas}}</td>
          <td>{{$warehouse->salis}}</td>
          <td>{{$warehouse->adresas}}</td>
          <td>
            <a class="button is-link is-small is-outlined" href="/warehouses/{{$warehouse->pavadinimas}}">Show</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="field has-text-centered">
        <a role="button" class="button is-info is-bold is-large" href="/warehouses/create">Register a new wholesale</a>
    </div>
  </div>

@endsection
