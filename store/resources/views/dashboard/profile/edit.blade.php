@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profile</li>
    <li class="breadcrumb-item active">Edit profile</li>
@endsection

<x-alert type="success"/>

@section('content')
    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="first_name" label='First Name' :value="$user->profile->first_name"/>
            </div>
            <div class="col-md-6">
                <x-form.input name="last_name" label='Last Name' :value="$user->profile->last_name"/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input type='date' name="birthday" label='Birthday' :value="$user->profile->birthday"/>
            </div>
            <div class="col-md-6">
                <x-form.label for="Gender">Gender</x-form.label>
                <x-form.radio name="gender" label='Gender' :options="['male'=>'Male','female'=>'Female']"
                              :checked="$user->profile->gender"/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="street_address" label='Street Address' :value="$user->profile->street_address"/>
            </div>
            <div class="col-md-6">
                <x-form.input name="city" label='City' :value="$user->profile->city"/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="state" label='State' :value="$user->profile->state"/>
            </div>
            <div class="col-md-6">
                <x-form.input name="postal_code" label='Postal Code' :value="$user->profile->postal_code"/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.select name="country" label='Country' :options="$countries"
                               :selected="$user->profile->country"/>
            </div>
            <div class="col-md-6">
                <x-form.select name="locale" label='Locale' :options="$locales" :selected="$user->profile->locale"/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">{{ 'update' }}</button>
            </div>
        </div>
    </form>
@endsection
