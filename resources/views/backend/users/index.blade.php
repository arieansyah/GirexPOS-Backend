@extends('layouts.app')

@section('title')
    User
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            User
        </li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid"> <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            {{ $dataTable->table([], true) }}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
@endsection

@section('scripts')
    @include('layouts.partials._datatables')
@endsection
