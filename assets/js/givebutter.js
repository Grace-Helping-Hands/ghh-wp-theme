/**
 * Givebutter pop-up links.
 *
 * Any link whose address ends in #givebutter-CAMPAIGNID (for example a Button
 * block linked to "#givebutter-5XT0XG") opens that Givebutter campaign's
 * donation form in a pop-up instead of following the link.
 *
 * How: for each campaign ID on the page, a hidden <givebutter-button> is added
 * (Givebutter's own element, from the script loaded in inc/enqueue.php). A click
 * on the link clicks that element's button, which opens the form. If the
 * Givebutter script hasn't loaded, the visitor goes to the Donate page instead.
 */
( function () {
	'use strict';

	var PATTERN = /#givebutter-([A-Za-z0-9]+)$/;
	var WAIT_MS = 4000;
	var settings = window.ghhGivebutter || {};
	var fallbackUrl = settings.fallbackUrl || '/donate/';
	var hosts = {};

	function campaignFor( link ) {
		var match = ( link.getAttribute( 'href' ) || '' ).match( PATTERN );
		return match ? match[ 1 ] : null;
	}

	// The real Givebutter button inside the element's shadow DOM, or null until it renders.
	function innerButton( host ) {
		return host.shadowRoot ? host.shadowRoot.querySelector( 'button[slot="invoker"], button' ) : null;
	}

	function hostFor( campaign ) {
		if ( hosts[ campaign ] ) {
			return hosts[ campaign ];
		}

		var host = document.createElement( 'givebutter-button' );
		host.setAttribute( 'campaign', campaign );
		host.setAttribute( 'aria-hidden', 'true' );
		host.className = 'ghh-givebutter-host';
		document.body.appendChild( host );
		hosts[ campaign ] = host;

		// Keep the hidden button out of the keyboard tab order once it renders.
		var tries = 0;
		var timer = setInterval( function () {
			var button = innerButton( host );
			if ( button ) {
				button.setAttribute( 'tabindex', '-1' );
			}
			if ( button || ++tries > 40 ) {
				clearInterval( timer );
			}
		}, 100 );

		return host;
	}

	function open( campaign ) {
		var host = hostFor( campaign );
		var started = Date.now();

		( function attempt() {
			var button = innerButton( host );
			if ( button ) {
				button.click();
			} else if ( Date.now() - started < WAIT_MS ) {
				setTimeout( attempt, 100 );
			} else {
				window.location.href = fallbackUrl;
			}
		} )();
	}

	document.addEventListener( 'click', function ( event ) {
		var link = event.target.closest ? event.target.closest( 'a[href*="#givebutter-"]' ) : null;
		var campaign = link && campaignFor( link );
		if ( ! campaign ) {
			return;
		}
		event.preventDefault();
		open( campaign );
	} );

	// Prepare the forms used on this page so the pop-up opens without a delay.
	function prepare() {
		var links = document.querySelectorAll( 'a[href*="#givebutter-"]' );
		for ( var i = 0; i < links.length; i++ ) {
			var campaign = campaignFor( links[ i ] );
			if ( campaign ) {
				hostFor( campaign );
			}
		}
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', prepare );
	} else {
		prepare();
	}
} )();
