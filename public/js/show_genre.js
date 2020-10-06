$(document).ready(function(){
    var show = $('.buttonShowGenre').click(function(){
        code_author = $(this).attr('code');
        $.ajax({
            url: '/admin/genres/' + code_author,
            success: function(data)
            {
                $('#id').text(data.id);
                $('#code').text(data.code);
                $('#name').text(data.name);
                !(data.description === null) ? $('#description').val(data.description)
                                            : $('#description').val('Описание отсутствует');
                
                                            
                if(data.image !== null)
                {
                    $('.title-image').text('Изображение');
                    $('.image').attr('src', '/storage' + data.image.slice(6));
                }
                else
                {
                    $('.image').attr('src', '');
                    $('.title-image').text('Изображение отсутствует');
                }
            }
        })
    })
})