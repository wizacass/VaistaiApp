@extends('../layouts/main')

@section('content')

<section class="hero is-success is-bold">
  <div class="hero-body">
    <div class="container has-text-centered">
      <h1 class="title">
        Pharmacy no. {{$pharmacy->filialo_id}}
      </h1>
      @if ($pharmacy->fk_TINKLASpavadinimas != NULL)
      <h2 class="subtitle">
        Belongs to <a href="/networks/{{$pharmacy->fk_TINKLASpavadinimas}}">{{$pharmacy->fk_TINKLASpavadinimas}}</a>
      </h2>
      @endif
    </div>
  </div>
</section>

<br/>

<div class="container">
  <div class="columns">
    <div class="column is-one-third">
      <h3 class="subtitle has-text-centered">Pharmacy information</h3>
      <table class="table is-striped is-fullwidth">
          <tbody>
              <tr>
                  <th>Address</th>
                  <td>{{$pharmacy->adresas}}</td>
              </tr>
              <tr>
                  <th>Revenue</th>
                  <td>{{$pharmacy->apyvarta}}</td>
              </tr>
              <tr>
                  <th>Phone number</th>
                  <td>{{$pharmacy->telefonas ?? "unavailable"}}</td>
              </tr>
          </tbody>
      </table>
      <div class="level">
          <div class="level-item">
            <a class="button is-link is-outlined" href="/pharmacies/{{$pharmacy->filialo_id}}/edit">Edit</a>
          </div>
          <div class="level-item">
            <form method="POST" action="/pharmacies/{{$pharmacy->filialo_id}}">
                @method('DELETE')
                @csrf
                <button type="submit" class="button is-danger">Delete</button>
            </form>
          </div>
      </div>
      <h3 class="subtitle has-text-centered">Registers</h3>
      <table class="table is-striped is-fullwidth">
        <thead class="has-text-centered">
          <th>Model</th>
          <th>Cash</th>
          <th></th>
        </thead>
        <tbody>
        @foreach ($registers as $register)
          <tr>
            <td>{{$register->modelis}}</td>
            <td>{{$register->pinigu_skaicius}}</td>
            <td style="text-align: center"><a href="#" class="button is-danger is-small is-outlined">Remove</a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="column">
      <h3 class="subtitle has-text-centered">Employees</h3>
      <table class="table is-striped is-fullwidth">
        <thead class="has-text-centered">
          <th>Name</th>
          <th><abbr title="Seniority">S</abbr></th>
          <th>Position</th>
          <th></th>
        </thead>
        <tbody>
        @foreach ($employees as $employee)
          <tr>
            <td>{{$employee->vardas}} {{$employee->pavarde}}</td>
            <td>{{$employee->darbo_stazas}}y.</td>
            <td>{{$employee->name}}</td>
            <td style="text-align: center"><a href="#" class="button is-danger is-small is-outlined">Unassign</a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <h3 class="subtitle has-text-centered">Available Drugs</h3>
      <table class="table is-striped is-fullwidth">
        <thead class="has-text-centered">
          <th>Name</th>
          <th>BAR Code</th>
          <th>Price</th>
          <th></th>
        </thead>
        <tbody>
        @foreach ($drugs as $drug)
          <tr>
            <td>{{$drug->veiklioji_medziaga}}</td>
            <td>{{$drug->bar_kodas}}</td>
            <td>{{number_format($drug->kaina, 2, '.', '')}}</td>
            <td style="text-align: center"><a href="#" class="button is-link is-outlined is-small">Details</a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
