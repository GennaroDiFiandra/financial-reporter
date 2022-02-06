<?php defined('WPINC') || die; ?>

<table class="balance_table">
  <thead>
    <tr>
      <td><?php _e('Account', 'financialreporter'); ?></td>
      <td><?php _e('Amount', 'financialreporter'); ?></td>
    </tr>
  </thead>

  <tbody>
    <?php $tot = 0; ?>

    <?php foreach($balance as $key=>$value) : ?>
      <tr>
        <td><?php echo esc_html($key); ?></td>
        <td><?php echo esc_html(number_format($value, 2, ',', '.')); ?></td>
      </tr>

      <?php $tot += $value; ?>
    <?php endforeach; ?>
  </tbody>

  <tfoot>
    <tr>
      <td><?php _e('TOT', 'financialreporter'); ?></td>
      <td><?php echo esc_html(number_format($tot, 2, ',', '.')); ?></td>
    </tr>
  </tfoot>
</table>
