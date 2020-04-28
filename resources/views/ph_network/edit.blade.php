@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Edit information for "{{ $network->pavadinimas }}"</h1>
    </div>

    <form method="POST" action="/networks/{{ $network->pavadinimas }}">
      @method('PATCH')
      @csrf

      @component('components.formerror')
      @endcomponent

      <div class=columns>
        <div class="column is-one-third">
          <h3 class="subtitle center-text">Edit General information</h3>

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="year">Year Founded</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input type="text" class="input {{ $errors->has('year') ? 'is-danger' : '' }}" name="year" placeholder="Year Founded" value="{{ $network->ikurimo_metai }}" required>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="column">
          <h3 class="subtitle center-text">Edit Suppliers</h3>
          <table class="table is-striped is-fullwidth">
            @foreach($suppliers as $supplier)
              <tr><td>
                <label class="checkbox">
                  <input type="checkbox" name="suppliers[]" value="{{ $supplier }}" {{ in_array($supplier, $activeSuppliers) ? "checked" : ""}}> {{ $supplier }}
                </label>
              </td></tr>
            @endforeach
          </table>
        </div>
      </div>

      <div class="field has-text-centered">
        <button type="submit" class="button is-info is-bold">Update</button>
      </div>

    </form>

  </div>

  <br/>

@endsection
