@extends('layouts.admin.admin')

@section('title', 'Categories')
@section('action')
<button class="create btn btn-dark float-right" id="createButton">New Category</button>
@endsection

@section('content')
<div>
    <livewire:categories-table/>
</div>
@endsection


