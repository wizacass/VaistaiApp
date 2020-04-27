@extends('../layouts/main')

@section('content')

  <section class="hero is-warning is-bold">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">"{{ $warehouse->pavadinimas }}"</h1>
      </div>
    </div>
  </section>

  <br/>

   <div class="container">
    <div class=columns>
      <div class="column is-one-third">
        <h3 class="subtitle has-text-centered">Warehouse information</h3>
        <table class="table is-striped is-fullwidth is-bordered">
          <tr>
            <th>Name</th>
            <td>{{ $warehouse->pavadinimas }}</td>
          </tr>
          <tr>
            <th>Country</th>
            <td>{{ $warehouse->salis }}</td>
          </tr>
          <tr>
            <th>Address</th>
            <td>{{ $warehouse->adresas }}</td>
          </tr>
        </table>
        <div class="level">
          <div class="level-item">
            <a class="button is-link is-outlined" href="/warehouses/{{$warehouse->pavadinimas}}/edit">Edit</a>
          </div>
          <div class="level-item">
            <form method="POST" action="/warehouses/{{$warehouse->pavadinimas}}">
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
            <a href="/factories/{{ $supplier }}" class="list-item">{{ $supplier }}</a>
          @endforeach
        </div>
        <h3 class="subtitle has-text-centered">Customers</h3>
        <div class="list is-hoverable has-text-centered">
          @foreach ($customers as $customer)
            <a href="/networks/{{ $customer }}" class="list-item">{{ $customer }}</a>
          @endforeach
        </div>
      </div>
    </div>
  </div>

@endsection
