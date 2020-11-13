<?php
/**
 * Template for displaying list orders in orders tab of user profile page.
 *
 * This template can be overridden by copying it to edali/learnpress/orders/list.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Profile::instance();

$query_orders = $profile->query_orders( array( 'fields' => 'ids' ) );
if ( ! $query_orders['items'] ) {
	learn_press_display_message( __( 'No orders!', 'edali' ) );

	return;
} ?>

<div class="table-responsive">
	<table class="lp-list-table profile-list-orders profile-list-table">
		<thead>
			<tr class="order-row">
				<th class="column-order-number"><?php _e( 'Order', 'edali' ); ?></th>
				<th class="column-order-date"><?php _e( 'Date', 'edali' ); ?></th>
				<th class="column-order-status"><?php _e( 'Status', 'edali' ); ?></th>
				<th class="column-order-total"><?php _e( 'Total', 'edali' ); ?></th>
				<th class="column-order-action"><?php _e( 'Action', 'edali' ); ?></th>
			</tr>
		</thead>

		<tbody>
		<?php foreach ( $query_orders['items'] as $order_id ) {
			$order = learn_press_get_order( $order_id ); ?>
			<tr class="order-row">
				<td class="column-order-number"><?php echo $order->get_order_number(); ?></td>
				<td class="column-order-date"><?php echo $order->get_order_date(); ?></td>
				<td class="column-order-status">
					<span class="lp-label label-<?php echo esc_attr( $order->get_status() ); ?>"><?php echo $order->get_order_status_html(); ?></span>
				</td>
				<td class="column-order-total"><?php echo $order->get_formatted_order_total(); ?></td>
				<td class="column-order-action">
					<?php
					if ( $actions = $order->get_profile_order_actions() ) {
						foreach ( $actions as $action ) {
							printf( '<a href="%s">%s</a>', $action['url'], $action['text'] );
						}
					}
					?>
				</td>
			</tr>
		<?php } ?>
		</tbody>

		<tfoot>
		<tr class="list-table-nav">
			<td colspan="2" class="nav-text"><?php echo $query_orders->get_offset_text(); ?></td>
			<td colspan="3" class="nav-pages"><?php $query_orders->get_nav_numbers( true ); ?></td>
		</tr>
		</tfoot>

	</table>
</div>