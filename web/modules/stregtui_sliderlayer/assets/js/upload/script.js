(function($) {
    $(function(){
        // Initialize the jQuery File Upload plugin
        $('.upload').each(function(){
            var $this = $(this);
            var $_id = $(this).attr('data-id');
            $(this).fileupload({
                add: function (e, data) {
                    var $_id = data.form[0].id;
                    $('#gva-' + $_id + ' .loading').each(function(){
                            $(this).css('display', 'inline-block');
                    });
                    var jqXHR = data.submit().done(function(data){
                        data = JSON.parse(data);
                        $('#gva-' + $_id + ' .loading').each(function(){
                            $(this).css('display', 'none');
                        });
                        $('#gva-' + $_id + ' input.file-input').each(function(){
                            $(this).val(data['file_url']);
                        });

                        $('#stregtui_slider_single').css('background-image', 'url(\'' + data['file_url_full'] + '\')');

                        $('#gva-' + $_id + ' .stregtui-field-upload-remove').each(function(){
                            $(this).css('display', 'inline-block');
                        });

                    });
                },

                progress: function(e, data){

                },
                fail: function(e, data){
                    // Something has gone wrong!
                    data.context.addClass('error');
                }
            });
        });

        $('.upload-image-layer').each(function(){
            var $this = $(this);
            var $_id = $(this).attr('data-id');
            $(this).fileupload({
                add: function (e, data) {

                    var $_id = data.form[0].id;

                    $('#gva-' + $_id + ' .loading').each(function(){
                            $(this).css('display', 'inline-block');
                    });
                    var jqXHR = data.submit().done(function(data){
                        data = JSON.parse(data);
                        $('#gva-' + $_id + ' .loading').each(function(){
                            $(this).css('display', 'none');
                        });
                        $('#gva-' + $_id + ' input.file-input').each(function(){
                            $(this).val(data['file_url']);
                            $('#g-image-layer').trigger('onchange');
                        });
                    });
                },

                progress: function(e, data){

                },
                fail: function(e, data){
                    // Something has gone wrong!
                    data.context.addClass('error');
                }
            });
        });

        // Helper function that formats the file sizes
        function formatFileSize(bytes) {
            if (typeof bytes !== 'number') {
                return '';
            }

            if (bytes >= 1000000000) {
                return (bytes / 1000000000).toFixed(2) + ' GB';
            }

            if (bytes >= 1000000) {
                return (bytes / 1000000).toFixed(2) + ' MB';
            }

            return (bytes / 1000).toFixed(2) + ' KB';
        }

    });

    $(document).ready(function () {
        //stregtui Load Images
        function stregtui_sliderlayer_load_images($btn, $btn_choose_image){
            $($btn).click(function(){
                $this = $(this);
                $.ajax({
                 url: drupalSettings.stregtui_sliderlayer.get_images_upload_url,
                 type: 'POST',
                 success: function (data) {

                    var html = '';
                    $.each(data['data'], function( index, value ) {
                        if(value['file_url_full'] != 'undefined' || value['file_url_full']){
                            html += '<a data-image="'+value['file_url']+'" data-image-demo="'+value['file_url_full']+'" class="'+$btn_choose_image+'" ><img src="'+value['file_url_full']+'"/></a>';
                        }
                    });
                   $this.parents('.gva-upload-image').find('.stregtui-box-images .stregtui-box-images-inner .list-images').each(function(){
                        $(this).html(html);
                        $(this).parents('.stregtui-box-images').addClass('open-popup');
                    })
                },
                 error: function (jqXHR, textStatus, errorThrown) {
                   alert(textStatus + ":" + jqXHR.responseText);
                 }
              });
            });
        }

        //stregtui Choose Image Slider
        function stregtui_sliderlayer_choose_image_slider(){

            $( ".gva-upload-image" ).delegate( ".btn-choose-image-upload", "click", function() {
                var file_url = $(this).attr('data-image');
                var file_url_full = $(this).attr('data-image-demo');
                $(this).parents('.gva-upload-image').find('input.file-input').each(function(){
                    $(this).val(file_url);
                });

                $('#stregtui_slider_single').css('background-image', 'url(\'' + file_url_full + '\')');

                $(this).parents('.stregtui-box-images').removeClass('open-popup');
            });


            $('.gva-upload-image .close').click(function(){
                $(this).parents('.stregtui-box-images').removeClass('open-popup');
            });
        }

        //stregtui Choose Image Layer
        function stregtui_sliderlayer_choose_image_layer(){

            $( ".gva-upload-image-layer" ).delegate( ".btn-choose-image-upload-layer", "click", function() {
                var file_url = $(this).attr('data-image');
                var file_url_full = $(this).attr('data-image-demo');
                $(this).parents('.gva-upload-image').find('input.file-input').each(function(){
                    $(this).val(file_url);
                });

                $('#g-image-layer').trigger('onchange');

                $(this).parents('.stregtui-box-images').removeClass('open-popup');
            });


            $('.gva-upload-image .close').click(function(){
                $(this).parents('.stregtui-box-images').removeClass('open-popup');
            });
        }



        stregtui_sliderlayer_load_images('.btn-get-images-upload', 'btn-choose-image-upload');
        stregtui_sliderlayer_load_images('.btn-get-images-upload-layer', 'btn-choose-image-upload-layer');
        stregtui_sliderlayer_choose_image_slider();
        stregtui_sliderlayer_choose_image_layer();
    });

    $(document).ready(function(){
        $('.stregtui-field-upload-remove').click(function(){
          $(this).parent().find('.stregtui-image-demo').attr('src', $(this).attr("data-src"));
          $(this).parent().find('input.file-input').val('');
        })
    });

})(jQuery);
