@extends('../layouts/main')

@section('content')

  <section class="hero is-danger is-bold">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">"{{ $network->pavadinimas }}"</h1>
      </div>
    </div>
  </section>

  <br/>

  <div class="container">
    <div class=columns>
      <div class="column is-one-third">
        <h3 class="subtitle has-text-centered">Factory information</h3>
        <table class="table is-striped is-fullwidth is-bordered">
          <tr>
            <th>Name</th>
            <td>{{ $network->pavadinimas }}</td>
          </tr>
          <tr>
            <th>Pharmacies</th>
            <td>{{ $network->vaistiniu_skaicius }}</td>
          </tr>
          <tr>
            <th>Year founded</th>
            <td>{{ $network->ikurimo_metai }}</td>
          </tr>
        </table>
        <div class="level">
          <div class="level-item">
            <a class="button is-link is-outlined" href="/networks/{{ $network->pavadinimas }}/edit">Edit</a>
          </div>
          <div class="level-item">
            <form method="POST" action="/networks/{{ $network->pavadinimas }}">
              @method('DELETE')
              @csrf
              <button type="submit" class="button is-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
      <div class="column">
        <h3 class="subtitle has-text-centered">Suppliers</h3>
        <div class="list is-hoverable has-text-centered">
          @foreach ($suppliers as $supplier)
            <a href="/warehouses/{{ $supplier }}" class="list-item">{{ $supplier }}</a>
          @endforeach
        </div>
        <h3 class="subtitle has-text-centered">Pharmacies</h3>
        <div class="list is-hoverable has-text-centered">
          @foreach ($pharmacies as $pharmacy)
            <a href="/pharmacies/{{ $pharmacy->filialo_id }}" class="list-item">{{ $pharmacy->adresas }}</a>
          @endforeach
        </div>
      </div>
    </div>
  </div>

@endsection
