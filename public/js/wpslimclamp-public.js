(function( $ ) {
    'use strict';

    $( window ).load(function() {

        var clamps = [];

        $.each( currentClumps.clamps, function(index, clamp) {

            if ( index.match('selector') ) {

                let clampNo = index.replace(/\D/g,'');

                if ( typeof clamps[clampNo] == "undefined" ) {
                    clamps[clampNo] = [];
                }

                clamps[clampNo]['selector'] = clamp;

            } else if ( index.match('row') ) {

                let clampNo = index.replace(/\D/g,'');

                if ( typeof clamps[clampNo] == "undefined" ) {
                    clamps[clampNo] = [];
                }

                clamps[clampNo]['rows'] = clamp;

            }
        });

        $.each(clamps, function(index, clamp){
            // console.log( $(clamp['selector'])[0] );
            // $clamp($(clamp['selector'])[0], { clamp: 2, useNativeClamp: false });
            // var $cl = document.getElementsByClassName('entry-title');
            // console.log($cl);
            // $clamp( $cl[0], 2);
            $(clamp['selector']).each( function( clampSelectorIndex, element ){
                $clamp(element, clamp['rows']);
            });
        });

    });

})( jQuery, $clamp, currentClumps );