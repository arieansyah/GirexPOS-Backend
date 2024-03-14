if (route().current("discounts.index")) {
    var save_method; //for save method string
    $(function () {
        $("#discountsModal form").on("submit", function (e) {
            if (!e.isDefaultPrevented()) {
                let url;
                if (save_method == "add") {
                    url = route("discounts.store");
                } else {
                    url = route("discounts.update", $("#id").val());
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    cache: true,
                    contentType: false,
                    processData: false,
                    data: new FormData($("#discountsModal form")[0]),
                    success: function (data) {
                        helper.hideModal("discountsModal");
                        $("#discounts-table").DataTable().ajax.reload();

                        notif.success(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        notif.error(jqXHR);
                    },
                });
                return false;
            }
        });

        // event listener for the edit button
        $("#discounts-table").on("click", "#editButton", function () {
            save_method = "edit";
            $("input[name=_method]").val("PATCH");
            $("#discountsModal form")[0].reset();

            $("#discountsModalLabel").text("Edit Discount");
            // set id on form hidden input
            $("#id").val($(this).data("id"));
            $("#name").val($(this).data("name"));
            // description text area
            $("#description").text($(this).data("description"));
            console.log($(this).data("value"));
            $("#value").val($(this).data("value"));
            $("#expire_date").val($(this).data("expire_date"));
            $("#type").val($(this).data("type"));
            // selected dropdown

            // checked status
            console.log($(this).data("status"));
            if ($(this).data("status") == "active") {
                $("#status1").prop("checked", true);
                $("#status2").prop("checked", false);
            } else {
                $("#status1").prop("checked", false);
                $("#status2").prop("checked", true);
            }

            helper.showModal("discountsModal");
        });

        // event listener for the add button
        $("#addButton").on("click", function () {
            save_method = "add";
            $("input[name=_method]").val("POST");
            $("#discountsModal form")[0].reset();

            $("#showImage").addClass("d-none");
            $("#discountsModalLabel").text("Add Discount");

            helper.showModal("discountsModal");
        });

        $("#expire_date").datepicker();
    });
}
