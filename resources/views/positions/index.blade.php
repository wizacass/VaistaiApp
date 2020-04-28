@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Positon types</h1>
    </div>

    <table class="table is-striped is-fullwidth">
      <thead>
        <th>Name</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($positions as $position)
          <tr>
            <td>{{ $position->name }}</td>
            <td>
              <div class="level">
                <div class="level-item">
                  <a class="button is-link is-small is-outlined" href="/positions/{{ $position->id_Vaistininko_Pareigos }}/edit">Edit</a>
                </div>
                <div class="level-item">
                  <form method="POST" action="/positions/{{ $position->id_Vaistininko_Pareigos }}">
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

    <br/>

    <div class="field has-text-centered">
      <a href="/positions/create" class="button is-info is-large">Register new Position type</a>
    </div>

    <br/>
  </div>

@endsection
