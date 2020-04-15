@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Edit information for "{{ $network->pavadinimas }}"</h1>
    </div>

    <form method="POST" action="/networks/{{ $network->pavadinimas }}">
      @method('PATCH')
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

      {{-- <div class="field">
        <label class="label" for="country">Country</label>
        <div class="control">
          <input type="text" class="input {{ $errors->has('country') ? 'is-danger' : '' }}" name="country" placeholder="Country" value="{{ $network->salis }}" required>
        </div>
      </div> --}}

      <div class="field">
        <label class="label" for="year">Year Founded</label>
        <div class="control">
          <input type="text" class="input {{ $errors->has('year') ? 'is-danger' : '' }}" name="year" placeholder="Year Founded" value="{{ $network->ikurimo_metai }}" required>
        </div>
      </div>

      <br/>

      <div class="field">
        <div class="control">
          <button type="submit" class="button is-info is-bold">Update</button>
        </div>
      </div>

    </form>

  </div>

@endsection
