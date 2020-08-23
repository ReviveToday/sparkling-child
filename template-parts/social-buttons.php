<?php
/**
 * ReviveToday v2 theme, based upon the Sparkling theme.
 *
 * @package revivetoday-child
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

$rt_title = rawurlencode( get_the_title() );
$rt_url   = rawurlencode( get_permalink() );

$rt_twitter_url  = "https://twitter.com/intent/tweet?via=revive_today&text={$rt_title}&url={$rt_url}";
$rt_facebook_url = "https://www.facebook.com/sharer.php?u={$rt_url}";
$rt_whatsapp_url = "https://api.whatsapp.com/send?text={$rt_url}";
$rt_reddit_url   = "https://www.reddit.com/submit?url={$rt_url}";
?>

<div class="rt-shareblock">
	<hr>
	<h3>Share this on...</h3>
	<ul>
		<li><a class="rts facebook" target="_blank" href="<?php echo esc_url( $rt_facebook_url ); ?>"><i class="fab fa-facebook-f" aria-hidden="true" title="Share this on Facebook"></i></a></li>
		<li><a class="rts twitter" target="_blank" href="<?php echo esc_url( $rt_twitter_url ); ?>"><i class="fab fa-twitter" aria-hidden="true" title="Share this on Twitter"></i></a></li>
		<li><a class="rts reddit" target="_blank" href="<?php echo esc_url( $rt_reddit_url ); ?>"><i class="fab fa-reddit-alien" aria-hidden="true" title="Share this on Reddit"></i></a></li>
		<li><a class="rts whatsapp" target="_blank" href="<?php echo esc_url( $rt_whatsapp_url ); ?>"><i class="fab fa-whatsapp" aria-hidden="true" title="Share this on WhatsApp"></i></a></li>
	</ul>
</div>
