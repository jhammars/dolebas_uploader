(function ($, Drupal) {
    Drupal.behaviors.cloudinaryUploadBehavior = {
        attach: function (context, settings) {
            $('#cloudinary_uploader').cloudinary_upload_widget({
                cloud_name: 'dolebas',
                upload_preset: 'apexn91s',
                public_id: '2'
            },
            function(error, result) { console.log(error, result) });
        }
    };
})(jQuery, Drupal);
