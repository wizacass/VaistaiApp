@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Register a new Factory</h1>
    </div>

    <form method="POST" action="/factories">
      @csrf

      @component('components.formerror')
      @endcomponent

      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label" for="name">Factory Name</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <input type="text" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" value="{{ old('name') }}" required>
            </div>
          </div>
        </div>
      </div>

      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label" for="country">Country</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <input type="text" class="input {{ $errors->has('country') ? 'is-danger' : '' }}" name="country" value="{{ old('country') }}" required>
            </div>
          </div>
        </div>
      </div>

      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label" for="email">Email</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <input type="text" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" value="{{ old('email') }}">
            </div>
          </div>
        </div>
      </div>

      <div class="field has-text-centered">
        <button type="submit" class="button is-info is-large">Register</button>
      </div>

    </form>
  </div>

@endsection
