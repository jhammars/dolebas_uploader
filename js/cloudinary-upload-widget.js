(function ($, Drupal) {
    Drupal.behaviors.cloudinaryUploadBehavior = {
        attach: function (context, settings) {
            $('#cloudinary_uploader').cloudinary_upload_widget({
                cloud_name: settings.cloud_name,
                upload_preset: settings.upload_preset,
                public_id: settings.nid
            },
            function(error, result) { console.log(error, result) });
        }
    };
})(jQuery, Drupal);
