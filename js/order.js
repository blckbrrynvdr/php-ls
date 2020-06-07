$('#order-form').on('submit', function (e) {
    e.preventDefault();
    $data = $(this).serialize();

    $.fancybox($('#preloader'));

    $.ajax({
        url: 'order.php',
        method: 'post',
        data: $data,
        async: false,
        success: function (data) {
            $.fancybox.close();
            $('#order .status-popup__message').html(data);
            $.fancybox($('#order'));
        }
    });


});

$('.status-popup__close').on('click', function () {
    $.fancybox.close();
});