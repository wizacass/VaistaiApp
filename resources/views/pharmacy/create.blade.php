@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Register a new Pharmaceutical Network</h1>
    </div>

    <form method="POST" action="/pharmacies">
      @csrf

        @component('components.formerror')
        @endcomponent

        <div class="field">
          <label class="label" for="address">Address</label>
          <div class="control">
            <input type="text" class="input {{ $errors->has('address') ? 'is-danger' : '' }}" name="address" placeholder="Pharmacy Address" value="{{ old('address') }}" required>
          </div>
        </div>

        <div class="field">
          <label class="label" for="network">Pharmacy network</label>
          <div class="select">
            <select name="network">
              <div class="dropdown-content">
                <option value="">
                  Independent
                </option>
                @foreach ($networks as $network)
                <option value="{{ $network->pavadinimas }}">
                  {{ $network->pavadinimas }}
                </option>
                @endforeach
              </div>
            </select>
          </div>
        </div>

        <div class="field">
          <label class="label" for="phone">Phone number</label>
          <div class="control">
            <input type="text" class="input {{ $errors->has('phone') ? 'is-danger' : '' }}" name="phone" placeholder="+370xxxxxxxx" value="{{ old('phone') }}">
          </div>
        </div>

        <div class="field">
          <label class="label" for="manufacturing">Additional parameters</label>
          <div class="control">
            <label class="checkbox">
              <input type="checkbox" name="manufacturing">Manufacturing Pharmacy
            </label>
          </div>
        </div>

      <button type="submit" class="button is-info">Register</button>
    </form>
  </div>

@endsection
