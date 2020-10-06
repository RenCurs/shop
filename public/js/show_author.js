$(document).ready(function(){
    var show = $('.buttonShowAuthor').click(function(){
        code_author = $(this).attr('code');
        $.ajax({
            url: '/admin/authors/' + code_author,
            success: function(data)
            {
                $('#id').text(data.id);
                $('#code').text(data.code);
                $('#name').text(data.name);
                !(data.description === null) ? $('#description').val(data.description)
                                            : $('#description').val('Описание отсутствует');
            }
        })
    })
})