$(document).ready(function() {
    $("#save").on("click", function(e) {
        e.preventDefault();
        const data = $("#form").serialize();
        $.ajax({
            url: "/user/create",
            method: "POST",
            data,
            success: response => {
                const res = JSON.parse(response);
                displayMessage(res.success, res.message);
            }
        });
    });
    const displayMessage = (success, message) => {
        const divError = $(".error-message");
        const className = success === true ? "alert-success" : "alert-danger";
        divError
            .addClass(`alert ${className}`)
            .text(message)
            .fadeIn(400);
        setTimeout(() => divError.fadeOut(), 3000);
    };
});
