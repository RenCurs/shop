
$(document).ready(function(){
    var but = $('.buttonShowProduct').click(function(){
        var code_product = $(this).attr("code");
        $.ajax({
            url: '/admin/products/' + code_product,
            success: function(data){
                $('#id').text(data.product.id);
                $('#code').text(data.product.code);
                $('#name').text(data.product.name);

                $('.image').empty();
                if(!(data.product.image === null) && !(data.product.image === ''))
                {
                    $('.image').html('<img width=200 src=/storage'+data.product.image.slice(6)+ '>');
                    $('#title-image').text('Изображение');
                }
                else
                {
                    $('#title-image').text('Изображение отсутствует')
                }

                $('#genre-modal').html('');
                data.genres.forEach(function(item){
                    $('#genre-modal').html($('#genre-modal').html() + '   ' + item.name);
                })
                $('#price').text(data.product.price + ' ₽');
                $('#year_public').text(data.product.published);
                $('#publisher').text(data.product.publisher);
            }
        })
    });
})