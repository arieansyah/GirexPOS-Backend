@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Profile
        </li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid"> <!-- Info boxes -->
        <div class="row">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bi bi-person"></span>
                                </div>
                            </div>
                            @error('name')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bi bi-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{ __('New password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bi bi-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="{{ __('New password confirmation') }}" autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bi bi-lock"></span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-end">{{ __('Submit') }}</button>
                    </div>
                </div> <!-- /.card -->
            </form>
        </div>
    </div>
@endsection
