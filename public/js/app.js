$( document ).ready(function() {
    $("#btnlike").click(function (e) {
        e.preventDefault();
        var pid = $("post_id").val();
        var uid = $("user_id").val();
        var base_url = window.location.origin;

        $.ajax({
            type: 'POST',
            url: base_url + 'social-media/pages/updatelike.php',
            dataType: 'json',
            data: {post_id:pid, uid:uid},
            beforeSend: function () {
                $(".loader").css("display", "block");

            },
            success: function (response) {
                console.log("success");
            },
            error: function (response) {
                console.log("error");
            },
            complete: function (data) {
                $(".loader").css("display", "none");
            }
        });
    });
});