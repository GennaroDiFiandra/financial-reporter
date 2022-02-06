<?php defined('WPINC') || die; ?>

<table class="cashflow_table">
  <thead>
    <tr>
      <td><?php _e('Transaction', 'financialreporter'); ?></td>
      <td><?php _e('Date', 'financialreporter'); ?></td>
      <td><?php _e('Amount', 'financialreporter'); ?></td>
    </tr>
  </thead>

  <tbody>
    <?php $tot = 0; ?>

    <?php foreach($transactions as $transaction) : ?>
      <tr>
        <td><?php echo esc_html($transaction->post_title); ?></td>
        <td><?php echo esc_html(mysql2date('d/m/Y', $transaction->post_date)); ?></td>
        <td><?php echo esc_html(get_post_meta($transaction->ID, 'transaction_amount', true)); ?></td>
      </tr>

      <?php $tot += floatval(str_replace(',', '.', get_post_meta($transaction->ID, 'transaction_amount', true))); ?>
    <?php endforeach; ?>
  </tbody>

  <tfoot>
    <tr>
      <td colspan="2"><?php _e('TOT', 'financialreporter'); ?></td>
      <td><?php echo esc_html(number_format($tot, 2, ',', '.')); ?></td>
    </tr>
  </tfoot>
</table>
