@extends('layouts.app')

@section('content')
    @php
        /** @var \Illuminate\Support\ViewErrorBag $errors */
        /** @var \App\Models\Conference $conferenceDetail */
        /** @var \App\Models\Participant $participant */
        /** @var \Illuminate\Database\Eloquent\Collection $departmentList $ */
    @endphp
    <form method="POST" action="{{ route('conference.participants.store', $conferenceDetail->id) }}">
        @csrf
        <div class="container">
            @if ($errors->any())
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                            {{ $errors->first() }}
                        </div>
                    </div>
                </div>
            @endif
            @if (session('success'))
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                            {{ session()->get('success') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <nav class="navbar navbar-light navbar-laravel">
                        <a class="btn btn-primary" href="{{ route('conference.show', $conferenceDetail->id) }}">
                            {{ __('Return to conference') }}
                        </a>
                    </nav>
                    <div class="card">
                        <div class="card-header">
                                <span class="font-weight-bold">
                                    {{ __('Register for') }} "{{ $conferenceDetail->name }}"
                                </span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="participant[first_name]">{{ __('First name') }}</label>

                                <input name="participant[first_name]"
                                       id="participant[first_name]"
                                       type="text"
                                       class="form-control"
                                       minlength="2"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="participant[last_name]">{{ __('Last name') }}</label>

                                <input name="participant[last_name]"
                                       id="participant[last_name]"
                                       type="text"
                                       class="form-control"
                                       minlength="2">
                            </div>
                            <div class="form-group">
                                <label for="participant[email_address]">{{ __('E-mail address') }}</label>

                                <input name="participant[email_address]"
                                       id="participant[email_address]"
                                       type="email"
                                       class="form-control"
                                       minlength="2">
                            </div>
                            <div class="form-group">
                                <label for="participant[phone_number]">{{ __('Phone number') }}</label>

                                <input name="participant[phone_number]"
                                       id="participant[phone_number]"
                                       type="tel"
                                       class="form-control"
                                       minlength="2">
                            </div>
                            <div class="form-group">
                                <label for="participant[department_id]">{{ __('Department') }}</label>
                                <select name="participant[department_id]"
                                        id="participant[department_id]"
                                        class="form-control"
                                        required>
                                    @foreach($departmentList as $departmentOption)
                                        <option value="{{ $departmentOption->id }}">
                                            {{ $departmentOption->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox"
                                       class="form-check-input"
                                       id="with_lecture"
                                       name="with_lecture">
                                <label class="form-check-label" for="with_lecture">{{ __('I want to add lecture') }}</label>
                            </div>
                            <div class="card mb-3 lecture-form-data-card">
                                <div class="card-header">
                                <span class="font-weight-bold">
                                    {{ __('Lecture data') }}
                                </span>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="lecture[title]">{{ __('Lecture title') }}</label>
                                        <input name="lecture[title]"
                                               id="lecture[title]"
                                               type="text"
                                               class="form-control"
                                               minlength="2">
                                    </div>
                                    <div class="form-group">
                                        <label for="lecture[description]">{{ __('Lecture description') }}</label>
                                        <textarea name="lecture[description]"
                                                  id="lecture[description]"
                                                  class="form-control"
                                                  rows="3">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
