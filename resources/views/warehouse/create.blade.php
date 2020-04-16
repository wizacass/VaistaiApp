@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Register a new Wholesale Warehouse</h1>
    </div>

    <form method="POST" action="/warehouses">
      @csrf

      @if ($errors->any())
        <article class="message is-danger">
          <div class="message-header"><p>Danger</p></div>
          <div class="message-body">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </article>
      @endif

      <div class="field">
        <label class="label" for="name">Name</label>
        <div class="control">
          <input type="text" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" placeholder="Company Name" value="{{ old('name') }}" required>
        </div>
      </div>

      <div class="field">
        <label class="label" for="country">Country</label>
        <div class="control">
          <input type="text" class="input {{ $errors->has('country') ? 'is-danger' : '' }}" name="country" placeholder="Country" value="{{ old('country') }}" required>
        </div>
      </div>

      <div class="field">
        <label class="label" for="address">Address</label>
        <div class="control">
          <input type="text" class="input {{ $errors->has('address') ? 'is-danger' : '' }}" name=address placeholder="Warehouse Address" value="{{ old('address') }}" required>
        </div>
      </div>

      <br/>

      <div class="field">
        <div class="control">
          <button type="submit" class="button is-link">Register</button>
        </div>
      </div>

    </form>

  </div>

@endsection
