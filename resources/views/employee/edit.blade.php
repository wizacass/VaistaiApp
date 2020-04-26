@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
    <h1 class="title center-text">Edit information of {{ $employee->vardas }} {{ $employee->pavarde }}</h1>
    </div>

    <form method="POST" action="/employees/{{ $employee->id }}">
      @method('PATCH')
      @csrf

      @component('components.formerror')
      @endcomponent

      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label" for="name">First Name</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <input type="text" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" value="{{ $employee->vardas }}" required>
            </div>
          </div>
        </div>
      </div>

      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label" for="surname">Last Name</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <input type="text" class="input {{ $errors->has('surname') ? 'is-danger' : '' }}" name="surname" value="{{ $employee->pavarde }}" required>
            </div>
          </div>
        </div>
      </div>

      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label" for="seniority">Work Experience</label>
        </div>
          <div class="field-body">
            <div class="field">
              <div class="control">
                <input type="number" min="0" class="input {{ $errors->has('seniority') ? 'is-danger' : '' }}" name="seniority" value="{{ $employee->darbo_stazas }}" required>
              </div>
            </div>
          </div>
        </div>

        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Position</label>
          </div>
          <div class="field-body">
            <div class="field">
              <div class="control">
                <div class="select is-fullwidth">
                  <select name="position">
                    @foreach ($positions as $position)
                      <option value="{{ $position->id_Vaistininko_Pareigos }}" {{ $position->id_Vaistininko_Pareigos == $employee->pareigos ? "selected" : ""}}>{{ $position->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Pharmacy Network</label>
          </div>
          <div class="field-body">
            <div class="field">
              <div class="control">
                <div class="select is-fullwidth">
                  <select name="network">
                    <option value="">Independent</option>
                    @foreach ($networks as $network)
                      <option value="{{ $network->pavadinimas }}" {{ $network->pavadinimas == $employee->fk_TINKLASpavadinimas ? "selected" : ""}}>{{ $network->pavadinimas }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

      <br/>

      <div class="field has-text-centered">
        <button type="submit" class="button is-info is-large">Update</button>
      </div>
    </form>
</div>

@endsection
