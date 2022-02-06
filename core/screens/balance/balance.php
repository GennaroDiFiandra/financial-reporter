<?php defined('WPINC') || die;

add_action('admin_menu', 'setup_balance_screen_financialreporter');

function setup_balance_screen_financialreporter() {
  add_submenu_page(
    'financial_reporter_screens',
    __('Financial Reporter Balance', 'financialreporter'),
    __('Balance', 'financialreporter'),
    'administrator',
    'financial_reporter_screens',
    'setup_balance_screen_callback_financialreporter'
  );

  return null;
}

function setup_balance_screen_callback_financialreporter() {
  ob_start();
  require_once plugin_dir_path(__FILE__) . 'balance-screen.php';
  $screen_data = ob_get_clean();
  echo $screen_data;

  return null;
}
