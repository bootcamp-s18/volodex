@extends('layouts.app')

@section('content')
<form method="post" action="/vcards/{{ $vcards->id }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name_first">First Name</label>
        <input type="text" class="form-control" name="name_first" id="name_first" value="{{ $vcards->name_first }}">
    </div>

    <div class="form-group">
        <label for="name_middle">Middle Name</label>
        <input type="text" class="form-control" id="name_middle" name="name_middle" value="{{ $vcards->name_midlle }}">
    </div>

    <div class="form-group">
        <label for="name_last">Last Name</label>
        <input type="text" class="form-control" id="name_last" name="name_last" value="{{ $vcards->name_last }}">
    </div>

    <div class="form-group">
        <label for="organiztion_name">Organization</label>
        <input type="text" class="form-control" id="organization_name" name="organization_name" value="{{ $vcards->organization_name }}">
    </div>

    <div class="form-group">
        <label for="organization_title">organization Title</label>
        <input type="text" class="form-control" id="organization_title" name="organization_title" value="{{ $vcards->organization_title }}">
    </div>

    <div class="form-group">
        <label for="phone_home">Home Phone</label>
        <input type="number" class="form-control" id="phone_home" name="phone_home" value="{{ $vcards->phone_number }}">
    </div>

    <div class="form-group">
        <label for="phone_work">Work Phone</label>
        <input type="number" class="form-control" id="phone_work" name="phone_work" value="{{ $vcards->phone_work }}">
    </div>

    <div class="form-group">
        <label for="phone_cell">Cell Phone</label>
        <input type="number" class="form-control" id="phone_cell" name="phone_cell" value="{{ $vcards->phone_cell }}">
    </div>

    <div class="form-group">
        <label for="address_work">Work Address</label>
        <input type="text" class="form-control" id="address_work" name="address_work" value="{{ $vcards->address_work }}">
    </div>

    <div class="form-group">
        <label for="address_home">Home Address</label>
        <input type="text" class="form-control" id="address_home" name="address_home" value="{{ $vcards->address_home }}"> 
    </div>

    <div class="form-group">
        <label for="email_personal">Personal Email</label>
        <input type="text" class="form-control" id="email_personal" name="email_personal" value="{{ $vcards->email_personal }}">
    </div>

    <div class="form-group">
        <label for="email_work">Work Email</label>
        <input type="text" class="form-control" id="email_work" name="email_work" value="{{ $vcards->email_work }}">
    </div>

    <button class="btn btn-primary" type="submit">Save</button>

</form>
@endsection