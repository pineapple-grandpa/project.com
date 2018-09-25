function input_text_visibility(id) {
    var e = document.getElementById(id);
    var edit_form = document.getElementById('edit_article_id_' + id);

    if (e.style.display == 'block') {
        e.style.display = 'none';
        edit_form.style.display = 'none';
    }
    else {
        e.style.display = 'block';
        edit_form.style.display = 'none';
    }
}


function edit_text_visibility(id) {
    var e = document.getElementById('edit_article_id_' + id);
    var input_form = document.getElementById(id);

    if (e.style.display == 'block') {
        e.style.display = 'none';
        input_form.style.display = 'none';
    }
    else {
        e.style.display = 'block';
        input_form.style.display = 'none';
    }
}


function edit_comment_text_visibility(id) {
    var e = document.getElementById('edit_comment_id_' + id);

    if (e.style.display == 'block') {
        e.style.display = 'none';
    }
    else {
        e.style.display = 'block';
    }
}

function on_click_save_button_edit_form(id) {
    $('#edit_article_form_' + id).on('beforeSubmit', function () {
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

function on_click_save_button_edit_comment_form(id) {
    $('#edit_comment_form_' + id).on('beforeSubmit', function () {
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

(function () {
    $(window).scroll(function () {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            $('#scroll').trigger('click');
        }
    });
}());

function remove_articles_comments(id,type) {

    if (type == 'article') {
        if (confirm('do you really want to remove this article?')) {
            $.ajax({
                type: 'GET',
                url: '/user/article/delete?id=' + id,
                complete: function () {
                    location.reload();
                }
            })
        }

    } else if (type == 'comment') {
        if (confirm('do you really want to remove this comment?')) {
            $.ajax({
                type: 'GET',
                url: '/user/comment/delete?id=' + id,
                complete: function () {
                    location.reload();
                }
            })
        }
    }
}



