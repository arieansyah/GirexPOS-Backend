@extends('layouts.app')

@section('title')
    User Create
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Create
        </li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid"> <!-- Info boxes -->
        <div class="row">
            <!--begin::Quick Example-->
            <form action="{{ route('user.store') }}" method="POST" role="form">
                @csrf
                <div class="card card-primary card-outline mb-4">
                    <!--begin::Form-->
                    <form>
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="role" class="form-label">{{ __('form.role') }}</label>
                                <select id="role" name="role"
                                    class="form-select @error('roles')is-invalid @enderror"
                                    data-placeholder="{{ __('form.placeholder_role') }}.." style="width: 100%;" required>
                                    @foreach ($roles as $role)
                                        @if ($role->name == $roleSelected)
                                            <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('form.name') }}</label>
                                <input id="name" type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="{{ __('form.placeholder_name') }}" value="{{ old('name') }}" required
                                    autofocus>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('form.email') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    placeholder="{{ __('form.placeholder_email') }}" value="{{ old('email') }}" required
                                    autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('form.password') }}</label>
                                <div class="input-group">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="{{ __('form.placeholder_password') }}" required
                                        autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <small id="passwordlHelp"
                                    class="form-text text-muted">{{ __('form.help_password') }}</small>
                            </div>
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('form.confirm_password') }}</label>
                                <div class="input-group">
                                    <input id="password-confirm" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation"
                                        placeholder="{{ __('form.placeholder_confirm_password') }}" required
                                        autocomplete="new-password">
                                </div>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-end">{{ __('button.save') }}</button>
                        </div>
                        <!--end::Footer-->
                    </form>
                    <!--end::Form-->
                </div>
            </form>
            <!--end::Quick Example-->
        </div>
    </div>
@endsection
