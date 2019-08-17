$(document).ready(function() {
    $("#save").on("click", function(e) {
        e.preventDefault();
        const data = $("#form").serialize();
        $.ajax({
            url: "/user/store",
            method: "POST",
            data,
            success: response => {
                const res = JSON.parse(response);
            }
        });
    });
});
