@extends('layouts.admin.admin')

@section('title', 'Posts')
@section('action')
<button class="create btn btn-dark float-right" id="createButton">New Post</button>
@endsection

@section('content')
    <livewire:posts-table/>
@endsection


