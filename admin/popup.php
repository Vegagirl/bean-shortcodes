<?php
//LOADS THE SHORTCODES CLASS, WP IS LOADED WITH IT
require_once( 'shortcodes.class.php' );

//GET POPUP TYPE
$popup = trim( $_GET['popup'] );
$shortcode = new bean_shortcodes( $popup );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head></head>
	<body>
		<div id="bean-popup">
			<div id="bean-shortcode-wrap">
				<div id="bean-sc-form-wrap">
					<form method="post" id="bean-sc-form">
						<table id="bean-sc-form-table">				
							<?php echo $shortcode->output; ?>
							<tbody>
								<tr class="form-row">
									<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
	<!--								<td class="field"><a href="#" class="button button-primary button-large bean-insert">Insert</a></td>-->
								</tr>
							</tbody>
						</table><!-- END #bean-sc-form-table -->
						
						<div class="insert-field">
							<a href="#" class="button button-primary button-large bean-insert"><?php _e('Insert Shortcode', 'stag'); ?></a>
						</div>
						
					</form><!-- END #bean-sc-form -->
				</div><!-- END #bean-sc-form-wrap -->
			</div><!-- END #bean-shortcode-wrap -->
		</div><!-- END #bean-popup -->
		<div class="clear"></div>
	</body>
</html>