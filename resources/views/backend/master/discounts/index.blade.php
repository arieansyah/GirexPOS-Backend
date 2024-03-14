@extends('layouts.app')

@section('title')
    Discount
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Discount
        </li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid"> <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {{-- card header --}}
                    <div class="card-header">
                        {{-- button add --}}
                        <button type="button" class="btn btn-success" id="addButton">
                            <i class="bi bi-plus-circle-dotted"></i> Add Discount
                        </button>
                    </div>
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
    @include('backend.master.discounts._modal')
@endsection

@section('scripts')
    @include('layouts.partials._datatables')
@endsection
