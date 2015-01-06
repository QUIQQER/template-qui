
/**
 * Elastic menu control
 *
 * @module project/ElasticMenu
 * @author www.pcsg.de (Henning Leutz)
 */

define('project/ElasticMenu', [

    'qui/QUI',
    'qui/controls/Control',

    URL_TEMPLATE_DIR +'bin/js/snap.svg-min.js',

    'css!project/ElasticMenu.css'

], function(QUI, QUIControl)
{
    "use strict";


    return new Class({

        Extends : QUIControl,
        Type    : 'ElasticMenu',

        Binds : [
            '$onImport',
            '$mouseenter',
            '$mouseleave',
            'toggle',
            'resize'
        ],

        options : {
            moveCointainer  : false,  // [optional] html element which move with the menu
            mouseenter      : true,   // use mouseenter and mouseleave
            mouseleave      : false,  // use mouseleave and mouseleave
            mouseOpenDelay  : 750,    // delay for the open event
            mouseCloseDelay : 250     // delay for the close event
        },

        initialize : function(options)
        {
            this.parent( options );

            this.$open       = false;
            this.$animate    = false;
            this.$mouseDelay = false;

            this.$NavElm    = false;
            this.$Shape     = false;
            this.$SVG       = false;
            this.$Path      = false;
            this.$pathReset = false;

            this.addEvents({
                onImport : this.$onImport
            });
        },

        /**
         * event : on import
         */
        $onImport : function()
        {
            var Elm = this.getElm();

            Elm.set({
                tabindex : -1,
                styles   : {
                    outline : 'none',
                    '-moz-outline': 'none'
                },
                events : {
                    blur : this.$mouseleave
                }
            });

            window.addEvent( 'resize', this.resize );

            this.$NavElm = Elm.getElement( '.page-navigation' );

            // menu button
            var Btn = new Element('button', {
                'class' : 'page-menu-opener',
                html    : '<span class="fa fa-list"></span>'+
                          '<span class="page-menu-opener-text">MENU</span>',
                styles : {
                    opacity : 0
                },
                events : {
                    click : this.toggle
                }
            }).inject( Elm, 'top' );

            // svg element
            this.$Shape = new Element('div', {
                'class'            : 'page-menu-morph',
                'data-morph-open'  : "M300-10c0,0,295,164,295,410c0,232-295,410-295,410",
                'data-morph-close' : "M300-10C300-10,5,154,5,400c0,232,295,410,295,410",
                html : '<svg width="100%" height="100%" viewBox="0 0 600 800" preserveAspectRatio="none">'+
                           '<path fill="none" d="M250-10c0,0,0,164,0,410c0,232,0,410,0,410" />'+
                       '</svg>'
            }).inject( Elm );

            this.$SVG       = Snap( this.$Shape.getElement( 'svg' ) );
            this.$Path      = this.$SVG.select( 'path');
            this.$pathReset = this.$Path.attr( 'd' );

            // mouseenter / leave
            if ( this.getAttribute( 'mouseenter' ) )
            {
                Elm.addEvents({
                    mouseenter : this.$mouseenter
                });
            }

            if ( this.getAttribute( 'mouseleave' ) )
            {
                Elm.addEvents({
                    mouseleave : this.$mouseleave
                });
            }

            this.resize();

            Elm.setStyle( 'display', null );

            moofx( Btn ).animate({
                opacity : 1
            });
        },

        /**
         * resize the menu -> mobile menu
         */
        resize : function()
        {
            if ( !this.$Elm ) {
                return;
            }

            var maxSize  = document.body.getSize(),
                maxWidth = maxSize.x;

            if ( maxWidth > 510 )
            {
                moofx( this.$Elm ).style({
                    transform : null
                });

                return;
            }

            moofx( this.$Elm ).style({
                transform : 'translate3d(-'+ (maxWidth - 80) +'px, 0, 0)',
                width     : maxWidth
            });

            this.$NavElm.setStyle( 'width', maxWidth - 80 );
        },

        /**
         * toggle the menu, open or close the menu
         */
        toggle : function()
        {
            if ( this.$animate ) {
                return;
            }

            if ( this.$open )
            {
                this.close();
                return;
            }

            this.open();
        },

        /**
         * Opens the menu
         */
        open : function()
        {
            if ( this.$animate ) {
                return;
            }

            if ( this.$open ) {
                return;
            }

            var self = this;

            this.$open    = true;
            this.$animate = true;


            (function()
            {
                moofx( self.getElm() ).style({
                    transform : 'translate3d(0, 0, 0)'
                });

                self.getElm().addClass( 'menu-open' );

            }).delay( 300 );


            this.$Path.stop().animate({
                path : this.$Shape.getAttribute( 'data-morph-open' )
            }, 350, mina.easeout, function()
            {
                self.$Path.stop().animate({
                    path : self.$pathReset
                }, 800, mina.elastic );

                self.$animate = false;

                self.getElm().focus();

                // move container
                if ( self.getAttribute( 'moveCointainer' ) )
                {
                    moofx( self.getAttribute( 'moveCointainer' ) ).animate({
                        width : document.body.getSize().x - self.getElm().getSize().x,
                        left  : self.getElm().getSize().x
                    });
                }
            });
        },

        /**
         * Close the menu
         */
        close : function()
        {
            if ( this.$open === false ) {
                return;
            }

            var self = this;

            if ( this.getAttribute( 'moveCointainer' ) )
            {
                moofx( this.getAttribute('moveCointainer') ).animate({
                    width : '100%',
                    left  : 0
                }, {
                    callback: function ()
                    {
                        self.getAttribute( 'moveCointainer' ).setStyles({
                            width : null,
                            left  : null
                        });
                    }
                });
            }


            (function()
            {
                self.getElm().removeClass( 'menu-open' );
                self.resize();
            }).delay( 300 );

            this.$Path.stop().animate({
                path : this.$Shape.getAttribute( 'data-morph-close' )
            }, 350, mina.easeout, function()
            {
                self.$Path.stop().animate({
                    path : self.$pathReset
                }, 800, mina.elastic, function()
                {
                    self.$animate = false;
                    self.$open    = false;
                });
            });
        },

        /**
         * event - mouseenter
         */
        $mouseenter : function()
        {
            if ( this.$mouseDelay ) {
                clearTimeout( this.$mouseDelay );
            }

            if ( this.$open ) {
                return;
            }

            this.$mouseDelay = (function() {
                this.open();
            }).delay( this.getAttribute('mouseOpenDelay'), this );

        },

        /**
         * event - mouseleave
         */
        $mouseleave : function()
        {
            if ( this.$mouseDelay ) {
                clearTimeout( this.$mouseDelay );
            }

            if ( this.$open === false ) {
                return;
            }

            this.$mouseDelay = (function() {
                this.close();
            }).delay( this.getAttribute('mouseCloseDelay'), this );
        }
    });
});
