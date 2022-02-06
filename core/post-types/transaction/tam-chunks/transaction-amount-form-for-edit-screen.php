<?php defined('WPINC') || die; ?>

<?php $amount = esc_attr(get_post_meta($post->ID, 'transaction_amount', true)); ?>

<p><?php _e('Format: 1234,56 or -1234,56', 'financialreporter') ?></p>
<input type="text" name="transaction_amount" id="transaction_amount" value="<?php echo $amount ?>">
