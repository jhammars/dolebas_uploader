(function ($, Drupal) {
    Drupal.behaviors.wistiaUploadBehavior = {
        attach: function (context, settings) {
            window._wapiq = window._wapiq || [];
            _wapiq.push(function(W) {
                window.wistiaUploader = new W.Uploader({
                    accessToken: settings.token,
                    dropIn: "wistia_uploader",
                    projectId: settings.project_id,
                    beforeUpload: function() {
                        wistiaUploader.setFileName(settings.nid);
                        //wistiaUploader.setFileDescription('the description');
                    }
                });
                wistiaUploader.bind("uploadsuccess", function(file, media) {
                    console.log("The upload succeeded. Here is the media object!", media);
                    getCsrfToken(function (csrfToken) {
                        patchNode(csrfToken, settings.uuid);
                    });
                });
            });
        }
    };
})(jQuery, Drupal);

function getCsrfToken(callback) {
    jQuery
    .get(Drupal.url('/session/token'))
    .done(function (data) {
        var csrfToken = data;
        callback(csrfToken);
    });
}

function patchNode(csrfToken, node) {
    var body = {
        "data": {
            "id": node,
            "attributes": {
                "title": "video uploaded"
            }
        }
    };
    jQuery.ajax({
        url: 'http://localhost/videofilter/jsonapi/node/video/'+node+'?_format=json&token=' + csrfToken,
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/vnd.api+json',
            'Accept': 'application/vnd.api+json'
        },
        data: JSON.stringify(body),
        success: function (body) {
            console.log(body);
        }
    });
}
