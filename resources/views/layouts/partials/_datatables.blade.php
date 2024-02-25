@isset($dataTable)
    {{ $dataTable->scripts() }}
@endisset

<script>
    // alert delete
    function deleteData(table, url) {
        Swal.fire({
            width: "25rem",
            title: "{{ __('title.are_you_sure') }}",
            text: "{!! __('message.you_wont_be_able_to_revert_this') !!}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{ __('button.yes_delete_it') }}",
            cancelButtonText: "{{ __('button.cancel') }}",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: "DELETE",
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#" + table).DataTable().ajax.reload();
                            Swal.fire({
                                width: "22rem",
                                title: "{{ __('message.deleted') }}",
                                text: response.success,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else if (response.info) {
                            Swal.fire({
                                width: "22rem",
                                title: "INFO",
                                text: response.info,
                                icon: "info",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else if (response.error) {
                            Swal.fire({
                                width: "22rem",
                                title: "{{ __('message.authorize') }}",
                                text: response.error,
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else if (response === "Delete Successfully") {
                            $("#" + table).DataTable().ajax.reload();
                            Swal.fire({
                                width: "22rem",
                                title: "{{ __('message.deleted') }}",
                                text: response,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else {
                            console.log(response.authorize);
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            width: "22rem",
                            title: "ERROR",
                            text: (typeof response.responseJSON == "string") ? response
                                .responseJSON : response.responseJSON.message,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });
            }
        })
    }

    // multi delete row table
    function multiDelCheckbox(table, url, selectClass) {
        Swal.fire({
            width: "25rem",
            title: "{{ __('title.are_you_sure') }}",
            text: "{!! __('message.you_wont_be_able_to_revert_this') !!}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{ __('button.yes_delete_it') }}",
            cancelButtonText: "{{ __('button.cancel') }}",
        }).then((result) => {
            if (result.value) {
                let id = [];
                $("." + selectClass + ":checked").each(function() {
                    id.push($(this).val());
                });
                if (id.length > 0) {
                    $.ajax({
                        url: url,
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response.success) {
                                $("#" + table).DataTable().ajax.reload();
                                Swal.fire({
                                    width: "22rem",
                                    title: "{{ __('message.deleted') }}",
                                    text: response.success,
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else if (response.info) {
                                Swal.fire({
                                    width: "22rem",
                                    title: "INFO",
                                    text: response.info,
                                    icon: "info",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else if (response.error) {
                                Swal.fire({
                                    width: "22rem",
                                    title: "{{ __('message.authorize') }}",
                                    text: response.error,
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                console.log(response.authorize);
                            }
                            $("#selectAll").prop("checked", false);
                            $("input[type=checkbox]").prop("checked", false);
                        }
                    });
                } else {
                    Swal.fire({
                        width: "22rem",
                        title: "{{ __('title.error') }}",
                        text: "{{ __('message.please_select_atleast_one_checkbox') }}",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        })
    }

    // function delete button
    function delBtn() {
        $(".confirm").html(
            "<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">{{ __('Loading') }}...</span></div> {{ __('Deleting') }}..."
        );
        $.ajax({
            url: url,
            method: "DELETE",
            success: function(response) {
                console.log(response)
                $("#delete").modal("hide")
                alert_sweet_success(response.success);
                $("#" + table).DataTable().ajax.reload();
                $(".confirm").html("Delete");
            }
        });
    }
</script>
