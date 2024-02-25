if (route().current("categories.index")) {
    var save_method; //for save method string
    $(function () {
        $("#categoriesModal form").on("submit", function (e) {
            if (!e.isDefaultPrevented()) {
                let url;
                if (save_method == "add") {
                    url = route("categories.store");
                } else {
                    url = route("categories.update", $("#id").val());
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    cache: true,
                    contentType: false,
                    processData: false,
                    data: new FormData($("#categoriesModal form")[0]),
                    success: function (data) {
                        helper.hideModal("categoriesModal");
                        $("#categories-table").DataTable().ajax.reload();

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
        $("#categories-table").on("click", "#editButton", function () {
            save_method = "edit";
            $("input[name=_method]").val("PATCH");
            $("#categoriesModal form")[0].reset();

            $("#categoriesModalLabel").text("Edit Category");
            // set id on form hidden input
            $("#id").val($(this).data("id"));
            $("#name").val($(this).data("name"));
            // description text area
            $("#description").text($(this).data("description"));
            // show image
            $("#showImage")
                .removeClass("d-none")
                .attr("src", $(this).data("image"));

            helper.showModal("categoriesModal");
        });

        // event listener for the add button
        $("#addButton").on("click", function () {
            save_method = "add";
            $("input[name=_method]").val("POST");
            $("#categoriesModal form")[0].reset();

            $("#showImage").addClass("d-none");
            $("#categoriesModalLabel").text("Add Category");

            helper.showModal("categoriesModal");
        });
    });
}
