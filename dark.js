/**
 * ReviveToday v2 theme, based upon the Sparkling theme.
 *
 * @package revivetoday-child
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

rt_is_dark = localStorage.getItem( 'rt-dark-mode' );
if ( rt_is_dark !== null && rt_is_dark === 'yes' ) {
	document.body.classList.add( 'dark-mode' );
}

document.getElementsByClassName( 'rt-toggle-bright' )[0].getElementsByTagName( 'A' )[0].onclick = function() {
	event.preventDefault();
	darkmode_toggle();
}

/**
 * Enable and disable the dark mode modifications.
 */
function darkmode_toggle() {
	thebody = document.body.classList;
	if ( thebody.contains( 'dark-mode' ) ) {
		thebody.remove( 'dark-mode' );
		localStorage.setItem( 'rt-dark-mode', 'no' );
	} else {
		thebody.add( 'dark-mode' );
		localStorage.setItem( 'rt-dark-mode', 'yes' );
	}
}
