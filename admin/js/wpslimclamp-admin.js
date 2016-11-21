(function( $ ) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

     //get initial selector
    var $initialClampSelector = $('.clamp-selector');

    var $formTable = $('.form-table');

    var $initRow = $formTable.find('tr:first-child').clone();
    var clampRowsField = $.parseHTML('<input type="text" name="wpslimclamp_selector[rows]" id="wpslimclamp_rows" class="clamp-rows">');
    var deleteElement = $.parseHTML('<span class="dashicons dashicons-no delete-clamp js-delete-row"></span>');

    $initRow.append( '<th class="clamp-value-label"><label for="wpslimclamp_rows">Rows limit:</label></th>' );
    $initRow.append( '<td class="clamp-value"></td>' );
    $initRow.append( '<td class="delete-row"></td>' );

    $(clampRowsField[0]).appendTo( $initRow.find('.clamp-value') );
    $(deleteElement[0]).appendTo( $initRow.find('.delete-row') );

    $formTable.find('tr:first-child').remove();

    var clampCounter = 0;

    var $clampSelector = $initialClampSelector;

    $.each( clamps, function( index, clamp ){

        if ( index.match('selector') ) {

            let clampNo = index.replace(/\D/g,'');

            if ( typeof clamp != 'undefined' ) {


                let $dbRow = $initRow.clone();

                let $dbSelector = $dbRow.find('.clamp-selector');
                let $dbRowCount = $dbRow.find('.clamp-rows');

                $dbSelector.attr( 'name', $initRow.find('.clamp-selector').attr('name').slice(0, -1) + "_" + clampCounter + "]");
                $dbSelector.val(clamp);

                $dbRowCount.attr( 'name', $initRow.find('.clamp-rows').attr('name').slice(0, -1) + "_" + clampCounter + "]");
                $dbRowCount.attr( 'data-clamp-id', clampNo );

                $dbRow.appendTo( $formTable.find('tbody') );
            }

            clampCounter = clampCounter + 1;

        } else if ( index.match('row') ) {
            let clampNo = index.replace(/\D/g,'');            
            let $dbRowCount = $('[data-clamp-id="' + clampNo + '"]');
            $dbRowCount.val(clamp);

        }


    } );

    var $submitP = $('.submit');
    var $newSelector = $submitP.clone();
    $newSelector.removeClass().addClass('new-selector');
    $newSelector.html('<button id="new-clamp" class="button button-primary" role="button">Add rule</button>');

    $newSelector.prependTo($submitP);

    var $newClampButton = $('#new-clamp');

    $newClampButton.on('click', function(e) {
        e.preventDefault();
        let $newClampRule = $initRow.clone();
        let $newClampSelector = $newClampRule.find('.clamp-selector');
        let $newClampRows = $newClampRule.find('.clamp-rows');

        $newClampSelector.attr( 'name', $initRow.find('.clamp-selector').attr('name').slice(0, -1) + "_" + clampCounter + "]");
        $newClampRows.attr( 'name', $initRow.find('.clamp-rows').attr('name').slice(0, -1) + "_" + clampCounter + "]");
        
        $newClampRule.appendTo( $formTable.find('tbody') );

        setDeleteEvents();

        clampCounter = clampCounter + 1;

    });

    setDeleteEvents();

    function setDeleteEvents() {
        var $deleteSelectors = $('.js-delete-row');

        $.each( $deleteSelectors, function(){

            var $deleteSelector = $(this);

            $deleteSelector.click( function(){
                $deleteSelector.parents('tr').remove();
            });

        });
    }

})( jQuery, clamps );