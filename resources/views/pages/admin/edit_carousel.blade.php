@extends('layouts.admin.admin')

@section('content')

    @livewire('carousel-edit-form', ['id' => $carouselId])

@endSection