$('#js-ajax-test').click(() => {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'test'
        },
        success: function (msg) {
            alert(msg.message);
        }
    })
});
$('.opinion-form').submit(function( event ) {
    const errors = validateForm();
    if (errors.length > 0) {
        alert(errors);
    } else {
        const formData = $('.opinion-form').serialize();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                data: formData,
                action: 'addOpinion'
            },
            success: function (msg) {
                if (msg.res === true) {
                    $('.opinion-form').trigger('reset');
                    let opinionItemHtml = '<div class="opinion-item">' +
                        '<span class="span-name">Имя: ' + msg.data.name + '</span><br>' +
                        '<span class="span-message">Отзыв: ' + msg.data.message + '</span><br>' +
                        '<span class="span-date">Дата: ' + msg.dateFormat + '</span><br><br>' +
                        '</div>';
                    $('#opinions-container').prepend(opinionItemHtml);
                    alert('Отзыв добавлен!');
                } else {
                    alert(msg.message);
                }
            }
        })
    }
    event.preventDefault();
});

function validateForm() {
    let errors = [];
    $('.error').removeClass('error');
    if ($('.opinion-form [name="name"]').val().length === 0) {
        $('.opinion-form [name="name"]').addClass('error');
        errors.push('\nЗаполните поле Имя');
    }
    if ($('.opinion-form [name="opinion"]').val().length === 0) {
        $('.opinion-form [name="opinion"]').addClass('error');
        errors.push('\nЗаполните поле Текст отзыва');
    }
    return errors;
}
