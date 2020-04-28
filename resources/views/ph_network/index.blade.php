@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
        <h1 class="title center-text">Pharmaceutical Networks</h1>
    </div>
    <table class="table is-striped is-fullwidth">
      <thead>
        <th>Name</th>
        <th><abbr title="Pharmacies Count">Ph. C</abbr></th>
        <th>Year founded</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($networks as $network)
        <tr>
          <td>{{ $network->pavadinimas }}</td>
          <td>{{ $network->vaistiniu_skaicius }}</td>
          <td>{{ $network->ikurimo_metai }}</td>
          <td>
            <a class="button is-link is-small is-outlined" href="/networks/{{ $network->pavadinimas }}">Show</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="field has-text-centered">
      <a role="button" class="button is-info is-bold is-large" href="/networks/create">Register a new network</a>
    </div>
  </div>

@endsection
