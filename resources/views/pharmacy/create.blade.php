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

        <div class="field">
          <label class="label" for="employee">Add an employee</label>
          <div class="level">
            <div class="level-item">
              <div class="control">
                <input type="text" class="input {{ $errors->has('e_name') ? 'is-danger' : '' }}" name="e_name" placeholder="Name" value="{{ old('e_name') }}">
              </div>
            </div>
            <div class="level-item">
              <div class="control">
                <input type="text" class="input {{ $errors->has('e_surname') ? 'is-danger' : '' }}" name="e_surname" placeholder="Surname" value="{{ old('e_surname') }}">
              </div>
            </div>
            <div class="level-item">
              <div class="control">
                <input type="text" class="input {{ $errors->has('e_exp') ? 'is-danger' : '' }}" name="e_exp" placeholder="Experience" value="{{ old('e_exp') }}">
              </div>
            </div>
            <div class="level-item">
              <div class="control">
                <div class="select is-fullwidth">
                  <select name="e_position">
                    @foreach ($positions as $position)
                      <option value="{{ $position->id_Vaistininko_Pareigos }}">{{ $position->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

      <button type="submit" class="button is-info">Register</button>
    </form>
  </div>

@endsection
