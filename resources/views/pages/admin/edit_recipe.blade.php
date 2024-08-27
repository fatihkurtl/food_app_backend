@extends('layouts.admin.admin')

@section('content')

    @livewire('edit-recipe-form', ['id' => $recipeId])

@endsection