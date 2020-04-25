@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Employees</h1>
    </div>
    <table class="table is-striped is-fullwidth">
      <thead>
        <th>No.</th>
        <th>Name</th>
        <th><abbr title="Seniority">S</abbr></th>
        <th>Position</th>
        <th>Works for</th>
        <th>Works in</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($employees as $employee)
          <tr>
            <th>{{ $employee->id }}</th>
            <td>{{ $employee->vardas }} {{ $employee->pavarde }}</td>
            <td>
              @if ($employee->darbo_stazas > 0)
                {{ $employee->darbo_stazas }}y
              @else
                <p>{{"<1y"}}</p>
              @endif
            </td>
            <td>{{ $employee->name }}</td>
            <td>
              @if ($employee->fk_TINKLASpavadinimas != NULL)
                <a href="/networks/{{ $employee->fk_TINKLASpavadinimas }}">
                  {{ $employee->fk_TINKLASpavadinimas }}
                </a>
              @else
                <i>Independent</i>
              @endif
            </td>
            <td>
              @if ($employee->fk_VAISTINEfilialo_id != NULL)
                <a href="/pharmacies/{{ $employee->fk_VAISTINEfilialo_id }}">
                  No. {{ $employee->fk_VAISTINEfilialo_id }}
                </a>
              @endif
            </td>
            <td>
              <div class="level">
                <div class="level-item">
                  <a class="button is-link is-small is-outlined" href="/employees/{{$employee->id}}/edit">Edit</a>
                </div>
                <div class="level-item">
                  <form method="POST" action="/employees/{{$employee->id}}">
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
    <a role="button" class="button is-info is-bold" href="/employees/create">Register a new employee</a>
  </div>

@endsection
