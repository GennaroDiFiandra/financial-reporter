<?php defined('WPINC') || die;

add_action('admin_menu', 'setup_financial_reporter_screens_financialreporter');

function setup_financial_reporter_screens_financialreporter() {
  add_menu_page(
    __('Financial Reporter', 'financialreporter'),
    __('Financial Reporter', 'financialreporter'),
    'administrator',
    'financial_reporter_screens',
    'setup_financial_reporter_screens_callback_financialreporter',
    'dashicons-editor-table'
  );

  return null;
}

function setup_financial_reporter_screens_callback_financialreporter() {}
