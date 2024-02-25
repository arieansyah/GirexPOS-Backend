@extends('layouts.app')

@section('title')
    Category
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Category
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
                            <i class="bi bi-plus-circle-dotted"></i> Add Category
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
    @include('backend.master.categories._modal')
@endsection

@section('scripts')
    @include('layouts.partials._datatables')
@endsection

{{-- @push('scripts')
    <script type="module">
        var save_method; //for save method string
        const el = $("#liveToast");
        $(function() {
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })

            $('#categoriesModal form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    let url;
                    if (save_method == "add") {
                        url = route('categories.store');
                    } else {
                        url = route('categories.update', $('#id').val());
                    }

                    $.ajax({
                        url: url,
                        type: "POST",
                        cache: true,
                        contentType: false,
                        processData: false,
                        data: new FormData($('#categoriesModal form')[0]),
                        success: function(data) {
                            var myModal = bootstrap.Modal.getOrCreateInstance(document
                                .getElementById('categoriesModal'));
                            myModal.hide();
                            $("#categories-table").DataTable().ajax.reload();

                            success(data);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            error(jqXHR);
                        }
                    });
                    return false;
                }
            });


            // event listener for the edit button
            $('#categories-table').on('click', '#editButton', function() {
                save_method = 'edit';
                $('input[name=_method]').val('PATCH');
                $('#categoriesModal form')[0].reset()
                var myModal = bootstrap.Modal.getOrCreateInstance(document
                    .getElementById('categoriesModal'));

                $("#categoriesModalLabel").text("Edit Category");
                // set id on form hidden input
                $('#id').val($(this).data('id'));
                $('#name').val($(this).data('name'));
                // description text area
                $('#description').text($(this).data('description'));
                // show image
                $('#showImage').removeClass('d-none').attr('src', $(this).data('image'));

                myModal.show();
            });

            // event listener for the add button
            $('#categories-table_wrapper').on('click', '#addButton', function() {
                save_method = "add";
                $('input[name=_method]').val('POST');
                $('#categoriesModal form')[0].reset()

                $('#showImage').addClass('d-none');
                var myModal = bootstrap.Modal.getOrCreateInstance(document
                    .getElementById('categoriesModal'));

                $("#categoriesModalLabel").text("Add Category");
                myModal.show();
            });
        });

        function success(message) {
            el.removeClass("bg-danger");
            el.addClass("bg-success");
            $("#liveToast .toast-body").text(message);
            bootstrap.Toast.getOrCreateInstance(el).show();
        }

        function error(message) {
            let convert = message.responseText.replace(
                /[`~!@#$%^&*()_|+\-=?;'",<>\{\}\[\]\\\/]/gi, "")
            const el = $("#liveToast");
            el.addClass("bg-danger");
            $("#liveToast .toast-body").text(convert.replace('.', '\n\n'));
            bootstrap.Toast.getOrCreateInstance(el).show()
        }
    </script>
@endpush --}}
