<?php defined('WPINC') || die; ?>

<div class="wrap">
  <h1><?php _e('Balance', 'financialreporter') ?></h1>

  <?php
  $accounts = get_terms(['taxonomy'=>'account', 'hide_empty'=>false]);

  if (!empty($accounts)) {
    require_once plugin_dir_path(__FILE__) . 'get-balance.php';
    $balance = get_balance_financialreporter($accounts);

    ob_start();
    require_once plugin_dir_path(__FILE__) . 'balance-table.php';
    $table = ob_get_clean();
    echo $table;
  }
  else {
    echo '<p>' . __('There are no accounts.', 'financialreporter') . '</p>';
  }
  ?>
</div>
