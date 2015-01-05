
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

    require(['qui/QUI'], function(QUI) {

    });


    //
    //require([ URL_PROJECT_DIR +'bin/js/snap.svg-min.js'], function()
    //{
    //    var Menu       = document.getElement( '.page-menu'),
    //        BContainer = document.getElement( '.body-container'),
    //        Shape      = Menu.getElement( '.page-menu-morph'),
    //        SVG        = Snap( Menu.getElement( 'svg' ) );
    //
    //    var Path      = SVG.select( 'path'),
    //        pathReset = Path.attr( 'd' );
    //
    //    document.getElement( '.page-menu-opener').addEvent('click', function()
    //    {
    //        BContainer.setStyles({
    //            position : 'relative'
    //        });
    //
    //        if ( Menu.hasClass( 'menu-open' ) )
    //        {
    //            //moofx( BContainer ).animate({
    //            //    width : '100%',
    //            //    left  : 0
    //            //}, {
    //            //    callback : function()
    //            //    {
    //            //        BContainer.setStyles({
    //            //            width : null,
    //            //            left  : null
    //            //        });
    //            //    }
    //            //});
    //
    //            (function() {
    //                Menu.removeClass( 'menu-open' );
    //            }).delay( 300 );
    //
    //            Path.stop().animate({
    //                path : Shape.getAttribute( 'data-morph-close' )
    //            }, 350, mina.easeout, function()
    //            {
    //                Path.stop().animate({
    //                    path : pathReset
    //                }, 800, mina.elastic );
    //            });
    //
    //            return;
    //        }
    //
    //        (function() {
    //            Menu.addClass( 'menu-open' );
    //        }).delay( 300 );
    //
    //        Path.stop().animate({
    //            path : Shape.getAttribute( 'data-morph-open' )
    //        }, 350, mina.easeout, function()
    //        {
    //            Path.stop().animate({
    //                path : pathReset
    //            }, 800, mina.elastic );
    //
    //            //moofx( BContainer ).animate({
    //            //    width : document.body.getSize().x - Menu.getSize().x,
    //            //    left  : Menu.getSize().x
    //            //});
    //        });
    //    });
    //
    //    Menu.addEvent('mouseenter', function()
    //    {
    //        if ( Menu.hasClass( 'menu-open' ) ) {
    //            return;
    //        }
    //
    //        document.getElement( '.page-menu-opener').fireEvent('click' );
    //    });
    //
    //    Menu.addEvent('mouseleave', function()
    //    {
    //        if ( !Menu.hasClass( 'menu-open' ) ) {
    //            return;
    //        }
    //
    //        document.getElement( '.page-menu-opener').fireEvent('click' );
    //    });
    //});

});