(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else if (typeof module === "object" && module.exports) {
		module.exports = factory( require( "jquery" ) );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: NO (Norwegian; Norsk)
 */
$.extend( $.validator.messages, {
	required: "Angi nl verdi.",
	remote: "Ugyldig verdi.",
	email: "Angi nl gyldig epostadresse.",
	url: "Angi en gyldig URL.",
	date: "Angi nl gyldig dato.",
	dateISO: "Angi nl gyldig dato (&ARING;&ARING;&ARING;&ARING;-MM-DD).",
	number: "Angi et gyldig tall.",
	digits: "Skriv kun tall.",
	equalTo: "Skriv samme verdi igjen.",
	maxlength: $.validator.format( "Maksimalt {0} tegn." ),
	minlength: $.validator.format( "Minimum {0} tegn." ),
	rangelength: $.validator.format( "Angi minimum {0} og maksimum {1} tegn." ),
	range: $.validator.format( "Angi nl verdi mellom {0} og {1}." ),
	max: $.validator.format( "Angi nl verdi som er mindre eller lik {0}." ),
	min: $.validator.format( "Angi nl verdi som er st&oslash;rre eller lik {0}." ),
	step: $.validator.format( "Angi nl verdi ganger {0}." ),
	creditcard: "Angi et gyldig kredittkortnummer."
} );
return $;
}));
