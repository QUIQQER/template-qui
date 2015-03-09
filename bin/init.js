
require.config({

    baseUrl : URL_BIN_DIR +'QUI',

    paths : {
        "qui"      : URL_OPT_DIR +'bin/qui/qui',
        "locale"   : URL_VAR_DIR +'locale/bin',
        "controls" : URL_BIN_DIR +'QUI/controls'
    },

    waitSeconds : 0,
    catchError  : true,

    map : {
        '*': {
            'css': URL_OPT_DIR +'bin/qui/qui/lib/css.js'
        }
    }
});


window.addEvent('domready', function()
{
    "use strict";

    // load QUI
    require([

        'qui/QUI',
        'package/quiqqer/template-qui/bin/js/Ellipsify'

    ], function(QUI, Ellipsify)
    {
        QUI.addEvent("onError", function(msg, url, linenumber)
        {
            console.error( msg );
            console.error( url );
            console.error( 'LineNo: '+ linenumber );
        });

        Ellipsify.parse();
    });
});