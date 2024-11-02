@extends('frontend.master')

@section('title', 'Meherab Hasan')

@section('content')

    <!-- Include the Hero Section -->
    @include('frontend.partials.hero')

    <!-- Include the About Section -->
    @include('frontend.partials.about')

    <!-- Include the Resume Section -->
    @include('frontend.partials.resume')

    <!-- Include the Skills Section -->
    @include('frontend.partials.skills')

    <!-- Include the Projects Section -->
    @include('frontend.partials.projects')

    <!-- Include the Services Section -->
    @include('frontend.partials.services')

    <!-- Include the Blogs Section -->
    @include('frontend.partials.blogs')

    <!-- Include the Summary Section -->
    @include('frontend.partials.summery')

    <!-- Include the Contact Section -->
    @include('frontend.partials.contact')

@endsection

@push('styles')
    <!-- Custom styles for portfolio page -->
@endpush

@push('scripts')
    <!-- Custom scripts for portfolio page -->
@endpush
