@extends('layouts.admin.admin')

@section('title', 'Users')
@section('action')
    @livewire('admin.components.button-modal', ['modal' => 'admin.new-user'])
@endsection

@section('content')
    <div>
        <livewire:users-table />
    </div>
@endsection
