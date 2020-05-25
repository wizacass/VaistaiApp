@extends('../layouts/main')

@section('content')

  <section class="hero is-primary is-bold">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">Generate a Pharmacy Report</h1>
      </div>
    </div>
  </section>

  <br/>

  <div class="container">
    <form method="POST" action="/report">
      @csrf

      @component('components.formerror')
      @endcomponent

      <div class="field">
        <label class="label" for="network">Pharmacy Network</label>
        <div class="control">
          <div class="select is-fullwidth {{ $errors->has('network') ? 'is-danger' : '' }}">
            <select name="network">
              <option value="">Select a Network</option>
              @foreach ($networks as $network)
                <option value="{{ $network->pavadinimas }}">{{ $network->pavadinimas }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label" for="revenue">Pharmacy Revenue Min</label>
        <div class="control">
          <input type="number" class="input {{ $errors->has('revenue') ? 'is-danger' : '' }}" name="revenue" placeholder="0" value="{{ old('revenue') }}">
        </div>
      </div>

      <div class="field">
        <label class="label" for="seniority">Employee Seniority Min</label>
        <div class="control">
          <input type="number" class="input {{ $errors->has('seniority') ? 'is-danger' : '' }}" name="seniority" placeholder="0" value="{{ old('seniority') }}">
        </div>
      </div>

      </br>

      <div class="field has-text-centered">
        <button type="submit" class="button is-primary is-large">Generate a report</button>
      </div>

    </form>
  </div>

@endsection
