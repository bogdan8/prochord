$(document).ready(function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    var info = $('.info');
    var infoSuccess = $('.infoSuccess');
    $('#form').submit(function (e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('body', $('#body').val());
        $.ajax({
            url: '',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            data: formData,
            success: function (data) {
                info.hide().find('ul').empty();
                if (!data.success) {
                    $.each(data.errors, function (index, error) {
                        info.find('ul').append('<li>' + error + '</li>');
                    });
                    info.slideDown();
                } else {
                    infoSuccess.find('ul').append('<li>' + data.success + '</li>');
                    infoSuccess.slideDown();
                }
            },
            error: function () {
            }
        });
    });
    $('#formSong').submit(function (e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('songId', $('#songId').val());
        formData.append('body', $('#body').val());
        $.ajax({
            url: '',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            data: formData,
            success: function (data) {
                info.hide().find('ul').empty();
                if (!data.success) {
                    $.each(data.errors, function (index, error) {
                        info.find('ul').append('<li>' + error + '</li>');
                    });
                    info.slideDown();
                } else {
                    infoSuccess.find('ul').append('<li>' + data.success + '</li>');
                    infoSuccess.slideDown();
                }
            },
            error: function () {
            }
        });
    });
    $('#formAddSong').submit(function (e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('description', $('#description').val());
        formData.append('active', $('#active').val());
        formData.append('category', $('#category').val());
        formData.append('performer', $('#performer').val());
        formData.append('tabulature', $('#tabulature').val());
        formData.append('body', $('#body').val());
        $.ajax({
            url: '',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            data: formData,
            success: function (data) {
                info.hide().find('ul').empty();
                if (!data.success) {
                    $.each(data.errors, function (index, error) {
                        info.find('ul').append('<li>' + error + '</li>');
                    });
                    info.slideDown();
                } else {
                    infoSuccess.find('ul').append('<li>' + data.success + '</li>');
                    infoSuccess.slideDown();
                }
            },
            error: function () {
            }
        });
    });
    window.onload = function () {
        var scrollUp = document.getElementById('scrollUp');
        scrollUp.onmouseover = function () {
            scrollUp.style.opacity = 0.3;
            scrollUp.style.filter = 'alpha(opacity=30)';
        };
        scrollUp.onmouseout = function () {
            scrollUp.style.opacity = 0.5;
            scrollUp.style.filter = 'alpha(opacity=50)';
        };
        scrollUp.onclick = function () {
            window.scrollTo(0, 0);
        };
        window.onscroll = function () {
            if (window.pageYOffset > 0) {
                scrollUp.style.display = 'block';
            } else {
                scrollUp.style.display = 'none';
            }
        };
    };
    if ($(window).width() < 500) {
        $(".computer-title").css('display', 'none');
        $(".phone-title").css('display', 'block');
        $(".songIconCount").removeClass("songIconCount").addClass("songIconCountRight");
    }
    if ($(window).width() > 1300) {
        $(".alphabet-block").css('display', 'block');
    }
    $(document).on('click', '.ajaxPaginatesIndex .pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var route = location.href;
        $.ajax({
            url: route,
            data: {page: page},
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $(".ajaxPaginateIndex").html(data);
                if ($(window).width() < 500) {
                    console.log('bob');
                    $(".computer-title").css('display', 'none');
                    $(".phone-title").css('display', 'block');
                    $(".songIconCount").removeClass("songIconCount").addClass("songIconCountRight");
                }
            }
        });
        s
    });
    var infoSuccessVoting = $('.infoSuccessVoting');
    var infoErrorVoting = $('.infoErrorVoting');
    var inp = document.getElementsByName('voting');
    for (var i = 0; i < 5; i++) {
        $('#formVoting' + i).submit(function (e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('voting_id', $('#voting_id').val());
            for (var i = 0; i < inp.length; i++) {
                if (inp[i].type === "radio" && inp[i].checked) {
                    formData.append('voting_value', inp[i].value);
                }
            }
            $.ajax({
                url: '',
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: formData,
                success: function (data) {
                    infoErrorVoting.hide().find('ul').empty();
                    if (!data.success) {
                        console.log('aa');
                        infoErrorVoting.find('ul').append('<li>' + data.errors + '</li>');
                        infoErrorVoting.slideDown();
                    } else {
                        console.log('bb');
                        infoSuccessVoting.find('ul').append('<li>Ви успішно проголосували</li>');
                        infoSuccessVoting.slideDown();
                    }
                },
                error: function () {
                }
            });
        })
    }
    /**------------------------ Change font-size in cartSong -------------------------- */
    $('#value').text('14');
    var value_font = '14';
    $("#magnification").click(function () {
        value_font++;
        $('#value').text(value_font);
        $('#song-body-fonts').css('font-size', value_font);
    });
    $("#decrease").click(function () {
        value_font--;
        $('#value').text(value_font);
        $('#song-body-fonts').css('font-size', value_font);
    });
    $("#font-family").change(function () {
        var value_family = $("#font-family").val();
        $('#song-body-fonts').css('font-family', value_family);
    });
    /**------------------------ End change font-size in cartSong -------------------------- */
    /**------------------------ Fancybox -------------------------- */
    $(".img-thumbnail").each(function () {
        $(this).fancybox({openEffect: 'elastic', minWidth: '250', minHeight: '300', closeEffect: 'elastic', href: $(this).attr('src')});
    });
    /**------------------------ End Fancybox -------------------------- */
});