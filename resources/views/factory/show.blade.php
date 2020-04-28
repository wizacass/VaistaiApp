@extends('../layouts/main')

@section('content')

  <section class="hero is-link is-bold">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">"{{ $factory->pavadinimas }}"</h1>
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
            <td>{{ $factory->pavadinimas }}</td>
          </tr>
          <tr>
            <th>Country</th>
            <td>{{ $factory->salis }}</td>
          </tr>
          <tr>
            <th>Email</th>
            <td>{{ $factory->el_pastas }}</td>
          </tr>
        </table>
        <div class="level">
          <div class="level-item">
            <a class="button is-link is-outlined" href="/factories/{{$factory->pavadinimas}}/edit">Edit</a>
          </div>
          <div class="level-item">
            <form method="POST" action="/factories/{{$factory->pavadinimas}}">
              @method('DELETE')
              @csrf
              <button type="submit" class="button is-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
      <div class="column">
        <h3 class="subtitle has-text-centered">Customers</h3>
        <div class="list is-hoverable has-text-centered">
          @foreach ($customers as $customer)
            <a href="/warehouses/{{ $customer->fk_DIDMENApavadinimas }}" class="list-item">{{ $customer->fk_DIDMENApavadinimas }}</a>
          @endforeach
        </div>
      </div>
    </div>
  </div>

@endsection
