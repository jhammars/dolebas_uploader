// (function ($, Drupal) {
//     Drupal.behaviors.wistiaUploadBehavior = {
//         attach: function (context, settings) {
//             window._wapiq = window._wapiq || [];
//             _wapiq.push(function(W) {
//                 window.wistiaUploader = new W.Uploader({
//                     accessToken: settings.token,
//                     dropIn: "wistia_uploader",
//                     projectId: settings.project_id,
//                     beforeUpload: function() {
//                         wistiaUploader.setFileName(settings.nid);
//                     }
//                 });
//                 wistiaUploader.bind("uploadsuccess", function(file, media) {
//                     console.log("The upload succeeded. Here is the media object!", media);
//                     $(".wistia-video-id").val(media.id);
//                 });
//             });
//         }
//     };
// })(jQuery, Drupal);

jQuery(function () {
    window._wapiq = window._wapiq || [];
    _wapiq.push(function(W) {
        window.wistiaUploader = new W.Uploader({
            accessToken: drupalSettings.token,
            dropIn: "wistia_uploader",
            projectId: drupalSettings.project_id,
            beforeUpload: function() {
                wistiaUploader.setFileName(drupalSettings.nid);
            }
        });
        wistiaUploader.bind("uploadsuccess", function(file, media) {
            console.log("The upload succeeded. Here is the media object!", media);
            jQuery(".wistia-video-id").val(media.id);
        });
    });
});