// (function ($, Drupal) {
//     Drupal.behaviors.cloudinaryUploadBehavior = {
//         attach: function (context, settings) {
//              //$('#cloudinary_views_field', context).once('upload-widget', function () {
//                 $('#cloudinary_views_field', context).cloudinary_upload_widget({
//                     cloud_name: settings.cloud_name,
//                     upload_preset: settings.upload_preset,
//                     public_id: settings.nid
//                 },
//                 function(error, result) { console.log(error, result) });
//              //});
//         }
//     };
// })(jQuery, Drupal);

jQuery(function () {
    jQuery('#cloudinary_views_field').cloudinary_upload_widget({
        cloud_name: drupalSettings.cloud_name,
        upload_preset: drupalSettings.upload_preset,
        public_id: drupalSettings.nid
    },
        function(error, result) { console.log(error, result)
    });
});