<?php defined('WPINC') || die;

add_action('admin_menu', 'setup_cashflow_screen_financialreporter');

function setup_cashflow_screen_financialreporter() {
  add_submenu_page(
    'financial_reporter_screens',
    __('Financial Reporter Cashflow', 'financialreporter'),
    __('Cashflow', 'financialreporter'),
    'administrator',
    'financial_reporter_screens_cashflow',
    'setup_cashflow_screen_callback_financialreporter'
  );

  return null;
}

function setup_cashflow_screen_callback_financialreporter() {
  ob_start();
  require_once plugin_dir_path(__FILE__) . 'cashflow-screen.php';
  $screen_data = ob_get_clean();
  echo $screen_data;

  return null;
}
