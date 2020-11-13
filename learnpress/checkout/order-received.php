<?php
/**
 * Template for displaying order detail.
 *
 * This template can be overridden by copying it to edali/learnpress/checkout/order-received.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.1.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<?php
if ( isset( $order ) ) {

	if ( is_int( $order ) ) {
		$order = learn_press_get_order( $order );
	}
	?>
    <p><?php echo apply_filters( 'learn-press/order/received-order-message', __( 'Thank you. Your order has been received.', 'edali' ), $order ); ?></p>

    <div class="table-responsive">
		<table class="order_details">
			<tr class="order">
				<th><?php _e( 'Order Number', 'edali' ); ?></th>
				<td>
					<?php echo $order->get_order_number(); ?>
				</td>
			</tr>
			<tr class="item">
				<th><?php _e( 'Item', 'edali' ); ?></th>
				<td>
					<?php
					$links = array();
					$items = $order->get_items();
					$count = sizeof( $items );
					foreach ( $items as $item ) {
						if ( empty( $item['course_id'] ) || get_post_type( $item['course_id'] ) !== LP_COURSE_CPT ) {
							$links[] = __( 'Course does not exist', 'edali' );
						} else {
							$link = '<a href="' . get_the_permalink( $item['course_id'] ) . '">' . get_the_title( $item['course_id'] ) . ' (#' . $item['course_id'] . ')' . '</a>';
							if ( $count > 1 ) {
								$link = sprintf( '<li>%s</li>', $link );
							}
							$links[] = $link;
						}
					}
					if ( $count > 1 ) {
						echo sprintf( '<ol>%s</ol>', join( "", $links ) );
					} elseif ( 1 == $count ) {
						echo join( "", $links );
					} else {
						echo __( '(No item)', 'edali' );
					} ?>
				</td>
			</tr>
			<tr class="date">
				<th><?php _e( 'Date', 'edali' ); ?></th>
				<td>
					<?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->get_order_date() ) ); ?>
				</td>
			</tr>
			<tr class="total">
				<th><?php _e( 'Total', 'edali' ); ?></th>
				<td>
					<?php echo $order->get_formatted_order_total(); ?>
				</td>
			</tr>
			<?php if ( $method_title = $order->get_payment_method_title() ) : ?>
				<tr class="method">
					<th><?php _e( 'Payment Method', 'edali' ); ?></th>
					<td>
						<?php echo $method_title; ?>
					</td>
				</tr>
			<?php endif; ?>
		</table>
	</div>

	<?php do_action( 'learn-press/order/received/' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'learn-press/order/received', $order ); ?>

<?php } else { ?>

    <p><?php echo apply_filters( 'learn-press/order/received-invalid-order-message', __( 'Invalid order.', 'edali' ) ); ?></p>

<?php } ?>