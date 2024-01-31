@extends('layouts.app')

@section('title')
    Página principal
@endsection

@section('content')
    <x-PostList :posts="$posts"/>
@endsection
