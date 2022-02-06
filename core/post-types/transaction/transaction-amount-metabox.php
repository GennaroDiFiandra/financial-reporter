<?php defined('WPINC') || die;

add_action('add_meta_boxes_transaction', 'setup_amount_metabox_financialreporter');
add_action('save_post', 'save_transaction_amount_data_financialreporter');
add_action('admin_notices', 'display_transaction_amount_data_validation_error_financialreporter');

function setup_amount_metabox_financialreporter($post) {
  add_meta_box(
    'transaction_amount',
    __('Amount', 'financialreporter'),
    'setup_transaction_amount_field_financialreporter',
    'transaction',
    'side'
  );

  return $post;
}

function setup_transaction_amount_field_financialreporter($post) {
  wp_nonce_field('transaction_amount_nonce', 'transaction_amount_nonce');

  ob_start();
  require_once plugin_dir_path(__FILE__) . 'tam-chunks/transaction-amount-form-for-edit-screen.php';
  $form = ob_get_clean();
  echo $form;

  return $post;
}

function save_transaction_amount_data_financialreporter($post_id) {
  if (
    !isset($_POST['transaction_amount_nonce']) ||
    !wp_verify_nonce($_POST['transaction_amount_nonce'], 'transaction_amount_nonce')
  ) {return $post_id;}

  if (
    !isset($_POST['post_type']) ||
    $_POST['post_type'] != 'transaction' ||
    !current_user_can('manage_options')
  ) {return $post_id;}

  if (
    defined('DOING_AUTOSAVE') &&
    DOING_AUTOSAVE
  ) {return $post_id;}

  if (
    empty($_POST['transaction_amount']) ||
    !preg_match('/^[-]?[0-9]+([,]?[0-9]{1,2})?$/', $_POST['transaction_amount'])
  ) {validate_amount_data_financialreporter();}

  $amount = sanitize_text_field($_POST['transaction_amount']);

  update_post_meta($post_id, 'transaction_amount', $amount);

  return $post_id;
}

function validate_amount_data_financialreporter() {
  add_settings_error(
    'incorrect_amount_value',
    'incorrect_amount_value',
    __('Please review the amount value: you have missed it or inserted in an incorrect format.', 'financialreporter'),
    'error'
  );

  set_transient('settings_errors', get_settings_errors(), 30);

  return null;
}

function display_transaction_amount_data_validation_error_financialreporter() {
  $errors = get_transient('settings_errors');

  if (!$errors) {return null;}

  $message  = '<div class="notice notice-error"><ul>';
  foreach($errors as $error) {
    $message .= '<li>' . $error['message'] . '</li>';
  }
  $message .= '</ul></div>';

  echo $message;

  delete_transient('settings_errors');

  remove_action('admin_notices', 'display_transaction_amount_data_validation_error_financialreporter');

  return null;
}
