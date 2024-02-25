function success(message) {
    const el = $("#liveToast");
    el.removeClass("bg-danger");
    el.addClass("bg-success");
    $("#liveToast .toast-body").text(message);
    bootstrap.Toast.getOrCreateInstance(el).show();
}

function error(message) {
    let convert = message.responseText.replace(
        /[`~!@#$%^&*()_|+\-=?;'",<>\{\}\[\]\\\/]/gi,
        ""
    );
    const el = $("#liveToast");
    el.addClass("bg-danger");
    $("#liveToast .toast-body").text(convert.replace(".", "\n\n"));
    bootstrap.Toast.getOrCreateInstance(el).show();
}

export { success, error };
