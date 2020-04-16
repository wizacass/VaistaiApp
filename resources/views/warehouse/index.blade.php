@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
        <h1 class="title center-text">Wholesale Warehouses</h1>
    </div>
    <table class="table is-striped is-fullwidth">
      <thead>
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Country</th>
        <th style="text-align: center">Address</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($warehouses as $warehouse)
        <tr>
          <td>{{$warehouse->pavadinimas}}</td>
          <td>{{$warehouse->salis}}</td>
          <td>{{$warehouse->adresas}}</td>
          <td>
            <div class="level">
              <div class="level-item">
                <a class="button is-link is-small is-outlined" href="/warehouses/{{$warehouse->pavadinimas}}/edit">Edit</a>
              </div>
              <div class="level-item">
                <form method="POST" action="/warehouses/{{$warehouse->pavadinimas}}">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="button is-danger is-small is-outlined">Delete</button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a role="button" class="button is-info is-bold" href="/warehouses/create">Register a new wholesale</a>
  </div>

@endsection
