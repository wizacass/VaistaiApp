@extends('../layouts/main')

@section('content')

  <section class="hero is-light is-bold">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">Pharmacy Performance Report</h1>
        <h2 class="subtitle"><a href="/networks/{{ $network }}">{{ $network }}</a></h2>
      </div>
    </div>
  </section>

  <br/>

  <div class="container" style="margin: 1em">
    <table class="table is-fullwidth">
      <thead>
        <th>Name</th>
        <th>Position</th>
        <th>Register</th>
        <th><abbr title="Seniority">S</abbr></th>
      </thead>
      <tbody>
        @foreach ($pharmacies as $pharmacy)
          <tr>
            <td colspan="4" class="has-text-centered is-selected">
              <a href="/pharmacies/{{$pharmacy->ID}}">Pharmacy no. {{$pharmacy->ID}} (Rev. {{ $pharmacy->Revenue }})</a>
            </td>
          </tr>
          @foreach ($employees as $employee)
          @if ($employee->PharmacyID == $pharmacy->ID)
            <tr>
              <td>{{ $employee->Name }} {{ $employee->Surname }}</td>
              <td>{{ $employee->Position }}</td>
              <td>{{ $employee->Register }}</td>
              <td>
                @if ($employee->Seniority > 0)
                  {{ $employee->Seniority }}y
                @else
                  <p>{{"<1y"}}</p>
                @endif
              </td>
            </tr>
          @endif
          @endforeach
          @if ($pharmacy->EmployeeCount > 1)
            <tr>
              <td colspan="4" class="is-bold">
                <p style="text-align: right">
                  <i>Employees in Pharmacy: <b>{{ $pharmacy->EmployeeCount }}</b></i>
                </p>
              </td>
            </tr>
            <tr>
              <td colspan="4" class="is-bold">
                  <p style="text-align: right">
                    <i>Average Seniority: <b>{{ $pharmacy->AvgSeniority }}y</b></i>
                  </p>
              </td>
            </tr>
          @endif
          <tr>
            <td colspan="4" class="is-bold">
              <p style="text-align: right">
                <i>Cash in Pharmacy: <b>{{ $pharmacy->Cash }}$</b></i>
              </p>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
            <th colspan="4" class="is-bold is-selected">
              <p style="text-align: right">
                <i>Total Employees: <b>{{ $totalEmployees }}</b></i>
              </p>
            </th>
          </tr>
      </tfoot>
    </table>
  </div>

@endsection
