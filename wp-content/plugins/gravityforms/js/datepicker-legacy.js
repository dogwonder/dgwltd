/**
 * Apply legacy options to DatePickers within Legacy Forms.
 */
gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, inputId, $element ) {
	var gf_legacy = window.gf_legacy_multi;

	if ( ! gf_legacy ) {
		return optionsObj;
	}
	if ( !gf_legacy[ formId ] || gf_legacy[ formId ] !== '1' ) {
		return optionsObj;
	}

	var $ = window.jQuery;
	var isPreview = $( '#preview_form_container' ).length > 0;
	var isRTL = window.getComputedStyle( $element[ 0 ], null ).getPropertyValue( 'direction' ) === 'rtl';

	return {
		yearRange: '-100:+20',
		showOn: 'focus',
		dateFormat: 'mm/dd/yy',
		changeMonth: true,
		changeYear: true,
		showOtherMonths: false,
		suppressDatePicker: false,
		onClose: function() {
			$element.focus();
			var self = this;
			this.suppressDatePicker = true;
			setTimeout( function() {
				self.suppressDatePicker = false;
			}, 200 );
		},
		beforeShow: function( input, inst ) {
			inst.dpDiv[0].classList.remove( 'gform-theme-datepicker' );
			inst.dpDiv[0].classList.add( 'gform-legacy-datepicker' );

			if ( isRTL && isPreview ) {
				var $inputContainer = $( input ).closest( '.gfield' );
				var rightOffset = $( document ).outerWidth() - ( $inputContainer.offset().left + $inputContainer.outerWidth() );
				inst.dpDiv[ 0 ].style.right = rightOffset + 'px';
			}
			return ! this.suppressDatePicker;
		}
	}
} );
