@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Edit information for "{{ $warehouse->pavadinimas }}"</h1>
    </div>

    <form method="POST" action="/warehouses/{{ $warehouse->pavadinimas }}">
      @method('PATCH')
      @csrf

      @component('components.formerror')
      @endcomponent

      <div class=columns>
        <div class="column">
          <h3 class="subtitle center-text">Edit General information</h3>

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="country">Country</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input type="text" class="input {{ $errors->has('country') ? 'is-danger' : '' }}" name="country" placeholder="Country" value="{{ $warehouse->salis }}" required>
                </div>
              </div>
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="address">Warehouse address</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input type="text" class="input {{ $errors->has('address') ? 'is-danger' : '' }}" name="address" placeholder="Address" value="{{ $warehouse->adresas }}" required>
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

          <h3 class="subtitle center-text">Edit Customers</h3>
          <table class="table is-striped is-fullwidth">
            @foreach($customers as $customer)
              <tr><td>
                <label class="checkbox">
                  <input type="checkbox" name="customers[]" value="{{ $customer }}" {{ in_array($customer, $activeCustomers) ? "checked" : ""}}> {{ $customer }}
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
