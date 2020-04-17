@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
        <h1 class="title center-text">Pharmacies</h1>
    </div>
    <table class="table is-striped is-fullwidth is-bordered">
      <thead>
        <th style="text-align: center">No.</th>
        <th style="text-align: center">Address</th>
        <th style="text-align: center"><abbr title="Employess Count">EC</abbr></th>
        <th style="text-align: center">Phone</th>
        <th style="text-align: center">Revenue</th>
        <th style="text-align: center">Belongs to</th>
        <th style="text-align: center">Extra</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($pharmacies as $pharmacy)
        <tr>
          <td style="text-align: right">{{$pharmacy->filialo_id}}</td>
          <td>{{$pharmacy->adresas}}</td>
          <td style="text-align: right">{{$pharmacy->darbuotoju_skaicius}}</td>
          <td>{{$pharmacy->telefonas ?? "GDPR_Protected"}}</td>
          <td style="text-align: right">{{$pharmacy->apyvarta}}</td>
          <td><a href="/networks/{{$pharmacy->fk_TINKLASpavadinimas}}">{{$pharmacy->fk_TINKLASpavadinimas}}</a></td>
          <td></td>
          <td style="text-align: center"><a class="button is-link is-small is-outlined" href="/pharmacies/{{$pharmacy->filialo_id}}">Show</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a role="button" class="button is-info is-bold" href="/warehouses/create">Register a new pharmacy</a>
  </div>

@endsection
