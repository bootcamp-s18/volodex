@extends('layouts.app')

@section('content')

    <form method="post" action="/vcards/{{ $vcard->id }}">
        @csrf
		@method('PUT')

        <div class="form-group">
			<label for="name_first">First Name:</label>
			<input type="text" class="form-control" name="name_first" id="name" value="{{ $vcard->name }}">
		</div>

        


    </form>
    <!-- <contacts-component :vcards-data="{{ $vcards->toJSON() }}"></contacts-component> -->


@endsection
