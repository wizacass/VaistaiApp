@extends('../layouts/main')

@section('content')

  <div class="container">
    <div class="container" style="margin: 1.5em">
      <h1 class="title center-text">Edit information for Pharmacy no. {{ $pharmacy->filialo_id }}</h1>
    </div>

    <form method="POST" action="/pharmacies/{{ $pharmacy->filialo_id }}">
      @method('PATCH')
      @csrf

      @component('components.formerror')
      @endcomponent

      <div class="field">
        <label class="label" for="address">Address</label>
        <div class="control">
          <input type="text" class="input {{ $errors->has('address') ? 'is-danger' : '' }}" name="address" placeholder="Pharmacy Address" value="{{ $pharmacy->adresas }}" required>
        </div>
      </div>

      <div class="field">
        <label class="label" for="phone">Phone number</label>
        <div class="control">
          <input type="text" class="input {{ $errors->has('phone') ? 'is-danger' : '' }}" name="phone" placeholder="+370xxxxxxxx" value="{{ $pharmacy->telefonas }}">
        </div>
      </div>

      <button type="submit" class="button is-info">Update</button>
    </form>
  </div>

@endsection
