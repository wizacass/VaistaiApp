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
          <td>
            <div class="level">
              <div class="level-item">
                <a class="button is-link is-small is-outlined" href="/networks/{{$network->pavadinimas}}/edit">Edit</a>
              </div>
              <div class="level-item">
                <form method="POST" action="/networks/{{$network->pavadinimas}}">
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
    <a role="button" class="button is-info is-bold" href="/networks/create">Create new Entry</a>
  </div>

@endsection
