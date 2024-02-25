if (route().current("products.index")) {
    var save_method; //for save method string
    $(function () {
        $("#productsModal form").on("submit", function (e) {
            if (!e.isDefaultPrevented()) {
                let url;
                if (save_method == "add") {
                    url = route("products.store");
                } else {
                    url = route("products.update", $("#id").val());
                }
                $.ajax({
                    url: url,
                    type: "POST",
                    cache: true,
                    contentType: false,
                    processData: false,
                    data: new FormData($("#productsModal form")[0]),
                    success: function (data) {
                        helper.hideModal("productsModal");
                        $("#products-table").DataTable().ajax.reload();
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
        $("#products-table").on("click", "#editButton", function () {
            save_method = "edit";
            $("input[name=_method]").val("PATCH");
            $("#productsModal form")[0].reset();

            $("#productsModalLabel").text("Edit Product");
            // set id on form hidden input
            $("#id").val($(this).data("id"));
            $("#name").val($(this).data("name"));
            $("#description").text($(this).data("description"));
            $("#price").val(helper.formatNumber($(this).data("price")));
            $("#stock").val($(this).data("stock"));

            // selected category
            $("#category_id").val($(this).data("category_id"));

            // checked status
            if ($(this).data("status") == 1) {
                $("#status1").prop("checked", true);
                $("#status2").prop("checked", false);
            } else {
                $("#status1").prop("checked", false);
                $("#status2").prop("checked", true);
            }

            // favorite
            if ($(this).data("is_favorite") == 1) {
                $("#is_favorite1").prop("checked", true);
                $("#is_favorite2").prop("checked", false);
            } else {
                $("#is_favorite1").prop("checked", false);
                $("#is_favorite2").prop("checked", true);
            }

            // show image
            $("#showImage")
                .removeClass("d-none")
                .attr("src", $(this).data("image"));

            helper.showModal("productsModal");
        });

        // event listener for the add button
        $("#addButton").on("click", function () {
            save_method = "add";
            $("input[name=_method]").val("POST");
            $("#productsModal form")[0].reset();
            $("#productsModalLabel").text("Add Product");
            $("#showImage").addClass("d-none");

            helper.showModal("productsModal");
        });

        // event listener for the price with format number
        $("#price").on("input", function () {
            var value = $(this).val();
            value = value.replace(/\D/g, ""); // Remove non-digit characters
            value = helper.formatNumber(value); // Format number with commas
            $(this).val(value);
        });
    });
}
