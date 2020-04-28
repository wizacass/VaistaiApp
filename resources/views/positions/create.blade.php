@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Register new Position</h1>
    </div>

    <form method="POST" action="/positions">
      @csrf

      @component('components.formerror')
      @endcomponent

      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label" for="title">Title</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <input type="text" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" name="title" value="{{ old('title') }}" required>
            </div>
          </div>
        </div>
      </div>

      <br/>

      <div class="field has-text-centered">
        <button type="submit" class="button is-info is-large">Register</button>
      </div>
    </form>
</div>

@endsection
