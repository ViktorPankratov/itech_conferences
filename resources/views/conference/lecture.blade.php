@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\Lecture $lectureItem */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                    <a class="btn btn-primary" href="#">
                        {{ __('Back to list') }}
                    </a>
                </nav>
                <div class="card">
                    <div class="card-header">
                        <span class="font-weight-bold">{{ $lectureItem->title }}</span>
                    </div>
                    <div class="card-body">
                        <span class="font-weight-normal">
                            {{ $lectureItem->participant->first_name }} {{ $lectureItem->participant->last_name }}
                        </span>
                        <span class="font-weight-light font-italic">
                            {{ $lectureItem->participant->department->name }}
                        </span>
                        <p class="text-justify">{{ $lectureItem->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
