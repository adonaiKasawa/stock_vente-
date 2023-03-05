

$(document).ready(function () {

    // TinyMCE

    tinyMCE.init({

        selector: 'textarea.advanced_textarea',

        height: 500,
        menubar: true,
        plugins: [
            'advlist anchor autoresize autosave bbcode charmap code codesample colorpicker contextmenu emoticons fullpage fullscreen image imagetools importcss lists media nonbreaking noneditable pagebreak table toc wordcount autolink link',
            'textcolor colorpicker searchreplace visualblocks',
            'insertdatetime template emoticons'
        ],

        toolbar: 'undo redo | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | link | blockquote table | removeformat | emoticons | copy paste cut | fontselect fontsizeselect | image '

    });

    //semantic's JS
    $(function () {

        $(document).on('click', 'a.item.tab_item', function () {
            $('.item.tab_item').removeClass('active');
            $(this).addClass('active');
        });

        $('.accordion').accordion();

        $('select.dropdown').dropdown();

        $('.menu .item').tab();

        $(document).on('click','#toggle',function() {
            $('.ui.sidebar').sidebar('toggle');
        });

    });

    


});