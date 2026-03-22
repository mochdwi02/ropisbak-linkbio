@extends('layouts.admin')

@section('title', 'Tambah Link')
@section('page_title', 'Tambah Link')

@section('content')
    <form action="{{ route('admin.links.store') }}" method="POST">
        @csrf
        @include('admin.links._form')
    </form>
@endsection
