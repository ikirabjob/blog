// Floating label headings for the contact form
$(function() {
    $("body").on("input propertychange", ".floating-label-form-group", function(e) {
        $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
    }).on("focus", ".floating-label-form-group", function() {
        $(this).addClass("floating-label-form-group-with-focus");
    }).on("blur", ".floating-label-form-group", function() {
        $(this).removeClass("floating-label-form-group-with-focus");
    });
});

// Navigation Scripts to Show Header on Scroll-Up
jQuery(document).ready(function($) {
    var MQL = 1170;

    //primary navigation slide-in effect
    if ($(window).width() > MQL) {
        var headerHeight = $('.navbar-custom').height();
        $(window).on('scroll', {
                previousTop: 0
            },
            function() {
                var currentTop = $(window).scrollTop();
                //check if user is scrolling up
                if (currentTop < this.previousTop) {
                    //if scrolling up...
                    if (currentTop > 0 && $('.navbar-custom').hasClass('is-fixed')) {
                        $('.navbar-custom').addClass('is-visible');
                    } else {
                        $('.navbar-custom').removeClass('is-visible is-fixed');
                    }
                } else if (currentTop > this.previousTop) {
                    //if scrolling down...
                    $('.navbar-custom').removeClass('is-visible');
                    if (currentTop > headerHeight && !$('.navbar-custom').hasClass('is-fixed')) $('.navbar-custom').addClass('is-fixed');
                }
                this.previousTop = currentTop;
            });
    }
});

function create(obj){

    $(obj).text('Загрузка...');
    var $that = $('#create');
    formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    $.ajax({
        type : 'POST',
        url : $($that).attr('action'),
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false, // важно - убираем преобразование строк по умолчанию
        data: formData,
        success: function(json){
            $(obj).text('Добавить');
            $($that).parent().find('.alert').show();
        }
    });

    
    return false;
}

function update(obj){

    $(obj).text('Загрузка...');
    var $that = $('#update');
    formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    $.ajax({
        type : 'POST',
        url : $($that).attr('action'),
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false, // важно - убираем преобразование строк по умолчанию
        data: formData,
        success: function(json){
            $(obj).text('Сохранить');
            $($that).parent().find('.alert').show();
        }
    });


    return false;
}

function deletePost(id){

    var cmf = confirm('Вы действительно хотите удалить этот пост?');

    if(cmf){
        $.ajax({
            type : 'POST',
            url : '/post/delete',
            data: {id: id},
            success: function(json){
                alert('Пост успешно удален');
                location.href = '/';
            }
        });
    } else {
        return;
    }

}
