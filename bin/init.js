
require.config({

    baseUrl : URL_BIN_DIR +'QUI',

    paths : {
        "package"  : URL_OPT_DIR +'bin',
        "qui"      : URL_OPT_DIR +'bin/qui/qui',
        "locale"   : URL_VAR_DIR +'locale/bin',
        "controls" : URL_BIN_DIR +'QUI/controls',
        "project"  : URL_TEMPLATE_DIR +'bin/js'
    },

    waitSeconds : 0,
    catchError  : true,

    map : {
        '*': {
            'css': URL_OPT_DIR +'bin/qui/qui/lib/css'
        }
    }
});


window.addEvent('domready', function()
{
    "use strict";

    // load QUI
    require(['qui/QUI']);

    // Ellipsify
    require(['project/Ellipsify'], function(Ellipsify) {
        Ellipsify.parse();
    });

});