(function($){
    $('.item-quantity').on('change', function(e){
        $.ajax({
            url: "/cart/" + $(this).data('id'), // data-id
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
            }
        });
    })
})(jQuery);



