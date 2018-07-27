@extends('layouts.app')

@section('content')
    <contacts-component :contacts-data='{{ $contacts->toJSON() }}'></contacts-component>
@endsection
