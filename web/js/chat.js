setInterval(function () {
    $('#refresh').trigger('click');
    }, 10000);

function show_edit_message_form(id, message) {
    $('#editMessageInput').val(message);
    $('#editMessageIdInput').val(id);

    var e = document.getElementById('editMessageForm');
    var i = document.getElementById('inputMessageForm');

    e.style.display = 'block';
    i.style.display = 'none';

}

function cancel_edit() {
    var e = document.getElementById('editMessageForm');
    var i = document.getElementById('inputMessageForm');

    e.style.display = 'none';
    i.style.display = 'block';
}

function save_changes() {
    $('#edit_message_form').on('beforeSubmit', function () {
        var $yiiform = $(this);
        $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: $yiiform.serializeArray(),
            complete: function (){
                $('#refresh').trigger('click');
                cancel_edit();
            }
        });

        return false;
    });
}
