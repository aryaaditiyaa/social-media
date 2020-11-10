$( document ).ready(function() {
    $("#btnlike").click(function (e) {
        e.preventDefault();
        var pid = $('#post_id').val();
        var uid = $('#user_id').val();
        var base_url = window.location.origin;

        $.ajax({
            type: 'POST',
            url: base_url + '/social-media/public/pages/updatelike.php',
            dataType: 'json',
            data: {post_id:pid, uid:uid},
            beforeSend: function () {
                $(".loader").css("display", "block");
            },
            success: function (response) {
                $('#btnlike').empty();
                $('#btnlike').append(response.hearticon);
                $('#totallike').empty();
                $('#totallike').append(response.total)
            },
            error: function (response) {
                console.log(response);
            },
            complete: function (data) {
                $(".loader").css("display", "none");
            }
        });
    });
});