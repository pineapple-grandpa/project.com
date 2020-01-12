function send_invite(id) {
    $('#send_invite_form_' + id).on('beforeSubmit', function () {
        var $yiiform = $(this);
        $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: $yiiform.serializeArray(),
            complete: function () {
                location.reload();
            }
        });
        return false;
    });
}

function delete_invite(to_user, from_user) {
    $.ajax({
        type: 'GET',
        url: '/user/invite/remove?to_user=' + to_user + '&from_user=' + from_user,
        complete: function () {
            location.reload();
        }
    });
}

function delete_friend(user, friend) {
    $.ajax({
        type: 'GET',
        url: '/user/friends/delete?user=' + user + '&friend=' + friend,
        complete: function () {
            location.reload();
        }
    });
}
