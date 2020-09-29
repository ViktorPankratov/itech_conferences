@extends('layouts.app')


@section('content')
    @php
        /** @var \App\Models\Conference $conferenceDetail */
    @endphp
    <div id="sidebar" class="position-absolute">
        @include('conference.includes.conference_list')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-light navbar-laravel">
                    <a class="btn btn-primary"
                       href="{{ route('conference.participants.index', $conferenceDetail->id) }}">
                        {{ __('All participants') }}
                    </a>
                    @php
                        $today = \Illuminate\Support\Carbon::now()->toDateString();
                    @endphp
                    @if ($today <= $conferenceDetail->start_time)
                    <a class="btn btn-warning float-right"
                       href="{{ route('conference.participants.create', $conferenceDetail->id) }}">
                        {{ __('Register for conference') }}
                    </a>
                    @endif
                </nav>
                <div class="card">
                    <div class="card-header">
                        <span class="font-weight-bold">{{ $conferenceDetail->name }}</span>
                    </div>
                    <table id="example" class="table table-striped table-bordered mb-0" style="width:100%">
                        <thead>
                        <tr>
                            <th>{{ __('Lecture title') }}</th>
                            <th>{{ __('Participant name') }}</th>
                            <th>{{ __('Department name') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($conferenceLecturesPaginator as $item)
                            @php /** @var \App\Models\Lecture $item **/  @endphp
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->participant_full_name }}</td>
                                <td>{{ $item->department_name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if($conferenceLecturesPaginator->total() > @$conferenceLecturesPaginator->count())
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            {{ $conferenceLecturesPaginator->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
