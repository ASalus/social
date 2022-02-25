@extends('layouts.admin.admin')

@section('title', 'Users')
@section('action')
<button class="create btn btn-dark float-right" id="createButton">New User</button>
@endsection

@section('content')
<div>
    <livewire:users-table/>
</div>
@endsection


