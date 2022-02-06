<?php defined('WPINC') || die; ?>

<div class="wrap">
  <h1><?php _e('Cashflow', 'financialreporter') ?></h1>

  <?php
  require_once plugin_dir_path(__FILE__) . 'get-transactions.php';
  if (count(get_transactions_financialreporter()) > 1) {
    list($transactions, $filtered_source, $filtered_account, $filtered_from, $filtered_to) = get_transactions_financialreporter();
  }
  else {list($transactions) = get_transactions_financialreporter();}

  if (!empty($transactions)) {
    ob_start();
    require_once plugin_dir_path(__FILE__) . 'cashflow-table.php';
    $table = ob_get_clean();
    echo $table;

    echo '<a id="transactions_report_print" href="javascript:window.print()">' . __('Print the report', 'financialreporter') . '</a>';
  }
  else {
    echo '<p>' . __('There are no transactions.', 'financialreporter') . '</p>';
  }

  ob_start();
  require_once plugin_dir_path(__FILE__) . 'cashflow-filter.php';
  $filter = ob_get_clean();
  echo $filter;
  ?>
</div>
