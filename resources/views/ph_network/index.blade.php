@extends('../layouts/main')

@section('content')

  <div class="container">
    <h1 class="title">Pharmaceutical Networks</h1>
    <table class="table is-striped">
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
          <td><a href="#">Edit</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection
