@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
        <h1 class="title center-text">Pharmaceutical Networks</h1>
    </div>
    <table class="table is-striped is-fullwidth">
      <thead>
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Country</th>
        <th style="text-align: center">Address</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($networks as $network)
        <tr>
          <td>{{$network->pavadinimas}}</td>
          <td>{{$network->salis}}</td>
          <td>{{$network->adresas}}</td>
          <td><a href="/networks/{{$network->pavadinimas}}/edit">Edit</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a role="button" class="button is-primary" href="/networks/create">Create new Entry</a>
  </div>

@endsection
