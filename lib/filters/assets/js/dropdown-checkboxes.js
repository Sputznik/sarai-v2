jQuery.fn.sarai_dropdown_checkboxes = function(){

	return this.each(function(){

    var $el 			= jQuery(this),
			$reset_btn 	= $el.find( '[data-btn=reset]' );

    // IF CLICK IS MADE OUTSIDE THE ELEMENT THEN CLOSE THE DROPDOWN
		jQuery( document ).on("click", function( event ){
    	if( $el !== event.target && !$el.has( event.target ).length ){
        $el.removeClass('open');
      }
    });

		// IF SOME OTHER DROPDOWNS ARE OPEN THEN CLOSE THEM
		$el.find('button').click( function(){
      if( !$el.hasClass('open') ){
				// CLOSE OTHER DROPDOWNS THAT ARE OPEN
				jQuery('[data-behaviour~=sarai-bt-dropdown-checkboxes].open').removeClass('open');
			}
      $el.toggleClass('open');
    });

    $el.on( 'change', function(){ updateLabel(); } );


		function reset(){
			$el.find('input[type=checkbox]:checked').prop( "checked", false );

			updateLabel();
		}

		$reset_btn.click( function( ev ){
			ev.preventDefault();

			reset();
		});

		$el.closest( 'form' ).on( 'reset', function(){
			setTimeout( function(){
				reset();
			}, 1);
		} );


		// ON LOAD - DEFAULT
    updateLabel();

		function decodeEntities( encodedString ) {
		  var textArea = document.createElement('textarea');
		  textArea.innerHTML = encodedString;
		  return textArea.value;
		}

    function updateLabel(){
      var $checkboxes = $el.find('input[type=checkbox]:checked'),
        values        = [];

      if( !$el.data('btn-label') ){ $el.data('btn-label', $el.find('span.btn-label').html() ); }

      $checkboxes.each( function(){
        var $checkbox     = jQuery( this ),
          checkbox_label  = decodeEntities( $checkbox.parent().find('span').html() ),
					limit						= 10,
					space_index 		= checkbox_label.indexOf(' ');

				if( $checkboxes.length > 1 ){
					// IF SPACE COMES BEFORE THEN BREAK RIGHT FROM THERE
					if( space_index > 1 && space_index < 9 ){ limit = space_index; }

					if( checkbox_label.length > limit ){ checkbox_label =  checkbox_label.substring( 0, limit ) + "..";}
				}

        values.push( checkbox_label );
      });

      if( values.length ){
        $el.find('span.btn-label').html( values.join( ', ') );
      }
      else{
        $el.find('span.btn-label').html( $el.data('btn-label') );
      }
    }

  });
};

jQuery(document).ready(function(){

	jQuery('[data-behaviour~="sarai-nested-dropdown-checkboxes"]').each(function(){

		var $el 					= jQuery(this),
		$form 					= $el.closest( 'form' ),
		$cats_dropdown  = $el.find( '.cats select' ),
		$subcats 				= $el.find( '.subcats' ),
		$subcats_menu		= $el.find( '.subcats .sarai-dropdown-menu' );

		function updateSubDropdown(){
			var currentCategoryValue = $cats_dropdown.val();

			if( currentCategoryValue > 0 ){
				$subcats_menu.find('li.checkbox').hide();
				$subcats_menu.find('li.checkbox[data-parent~="' + currentCategoryValue + '"]').show();
				$subcats.show();
			}
			else{
				$subcats.hide();
			}
		}

		$cats_dropdown.change( function( ev ){
			updateSubDropdown();
			var currentCategoryValue = $cats_dropdown.val();

			if( currentCategoryValue > 0 ){
				// UNCHECK ALL CHECKBOXES WHEN PARENT CATEGORY CHANGES TO PREVENT SENDING UNWANTED CHILD TERMS
				$subcats_menu.find('li.checkbox input[type=checkbox]:checked').prop( "checked", false );
				$subcats.find('.btn-label').html('Select');
			}
		});

		updateSubDropdown();

	});

	jQuery('[data-behaviour~=sarai-bt-dropdown-checkboxes]').sarai_dropdown_checkboxes();

});
