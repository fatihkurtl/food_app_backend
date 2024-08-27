@extends('layouts.admin.admin')

@section('content')
   @livewire('edit-category-form', ['id' => $categoryId]) 
@endsection
