@extends('layouts.app')

@section('title')
    Role Create
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Role</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Edit
        </li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid"> <!-- Info boxes -->
        <div class="row">
            @can('read-permissions')
                <form action="{{ route('role.update', [$role->id]) }}" method="POST" role="form">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="{{ $role->id }}" name="role_id" value="{{ $role->id }}">
                    <div class="card mb-4">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Bordered Table</h3> --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="{{ __('role.placeholder_name') }}" value="{{ $role->name }}"
                                    @if (!$status) disabled @endif required autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary float-end"
                                @if (!$status) disabled @endif>{{ __('button.update') }}</button>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row" id="checkAllBox">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('table.modules') }}</th>
                                            <th>
                                                {{ __('table.actions') }}
                                                <button type="button" class="btn btn-outline-info btn-sm float-end"
                                                    id="checkAll"
                                                    @if (!$status) disabled @endif>{{ __('form.check_all') }}
                                                    <i class="bi bi-check2-all"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($modules as $module)
                                            <tr class="align-middle">
                                                <td>{{ $module }}</td>
                                                <td>
                                                    @foreach ($permissions as $key => $row)
                                                        @if (PermissionHelper::getModule($row) == $module)
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input checkbox clickcheckbox"
                                                                    type="checkbox" id="checkbox-{{ $key }}"
                                                                    data-id="{{ $key }}" name="permissions[]"
                                                                    value="{{ $key }}"
                                                                    {{ in_array($key, $rolePermissions) ? 'checked' : '' }}>
                                                                <label for="checkbox-{{ $key }}"
                                                                    class="custom-control-label font-weight-normal">{{ $row }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </form>
            @endcan
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        "use strict";
        document.getElementById("checkAll").addEventListener("click", (e) => {
            var checkboxes = document.querySelectorAll("input[type='checkbox']");
            var isChecked = checkboxes[0].checked;

            // Iterate over checkboxes and set checked property to true
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !isChecked;
            });
        });
    </script>
@endpush
