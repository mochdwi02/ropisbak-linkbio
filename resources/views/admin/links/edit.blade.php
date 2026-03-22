@extends('layouts.admin')

@section('title', 'Edit Link')
@section('page_title', 'Edit Link')

@section('content')
    <form action="{{ route('admin.links.update', $link) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.links._form')
    </form>
@endsection
