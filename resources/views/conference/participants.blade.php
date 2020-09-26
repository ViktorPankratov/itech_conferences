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
                        {{ __('Back to conference') }}
                    </a>
                </nav>
                <div class="card">
                    <div class="card-header">
                        <span class="font-weight-bold">{{ __('Conference participants') }}</span>
                    </div>
                    <table id="example" class="table table-striped table-bordered mb-0" style="width:100%">
                        <thead>
                        <tr>
                            <th>{{ __('Participant name') }}</th>
                            <th>{{ __('Department name') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($participantPaginator as $item)
                            @php /** @var \App\Models\Participant $item **/  @endphp
                            <tr>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->department_name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if($participantPaginator->total() > @$participantPaginator->count())
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            {{ $participantPaginator->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
