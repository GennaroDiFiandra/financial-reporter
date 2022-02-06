<?php defined('WPINC') || die;
/*
Plugin Name: Financial Reporter
Plugin URI:  https://github.com/GennaroDiFiandra/financial-reporter
Description: Handle the personal budget. It allows to take track of all self incomes and outcomes and to display the transactions log and the current amount of each account. Plus, it is possible to filter the transactions by source, account and date range and print the report.
Version:     1.0.0
Author:      Gennaro Di Fiandra
Author URI:  https://espertowp.it
License:     GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
Text Domain: financialreporter
Domain Path: /languages
*/

/*
** Load plugin core files
*/
add_action('plugins_loaded', function() {
  require_once plugin_dir_path(__FILE__) . 'core/post-types/transaction/transaction.php';
  require_once plugin_dir_path(__FILE__) . 'core/post-types/transaction/transaction-amount-metabox.php';

  require_once plugin_dir_path(__FILE__) . 'core/taxonomies/account/account.php';
  require_once plugin_dir_path(__FILE__) . 'core/taxonomies/account/account-start-amount-metabox.php';

  require_once plugin_dir_path(__FILE__) . 'core/taxonomies/source/source.php';

  require_once plugin_dir_path(__FILE__) . 'core/screens/main-screen.php';
  require_once plugin_dir_path(__FILE__) . 'core/screens/balance/balance.php';
  require_once plugin_dir_path(__FILE__) . 'core/screens/cashflow/cashflow.php';
});

/*
** Load plugin assets files
*/
add_action('admin_enqueue_scripts', function() {
  wp_enqueue_style(
    'financial-reporter-styles',
    plugin_dir_url(__FILE__) . 'interface/styles.css',
    [],
    null,
    'all'
  );
});
