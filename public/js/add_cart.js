$(document).ready(function(){
    var button = $('#send_order').click(function(){
        var guestData = $('#form-guest').serialize();
        $.ajax({
            url: '/cart/confirm_order',
            type: 'POST',
            data: guestData,

            success: (function(msg){
                $('.result-messages').empty();
                $('.result-messages').append('<p class="alert alert-success">'+ msg +'</p>');
                $('#modal_guest').on('hide.bs.modal', function () {
                    location.href='/cart';
                })

            }),
            error: function(err){
                if (err.status === 422)
                {
                    $('.result-messages').empty();
                    arr =  err.responseJSON.errors
                    for(key in arr)
                    {
                        $('.result-messages').append('<p class="alert alert-danger">'+ arr[key][0]+'</p>');
                    }
                }
            }
        })
    })
});
