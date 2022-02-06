<?php defined('WPINC') || die; ?>

<?php
function get_transactions_financialreporter() {
  if (
    !empty($_GET['submit']) &&
    isset($_GET['transactions_filter_nonce']) &&
    wp_verify_nonce($_GET['transactions_filter_nonce'], 'transactions_filter_nonce')
  ) {
    $filtered_source = sanitize_text_field($_GET['sources']);
    $filtered_source = ($filtered_source === '0' ? null : $filtered_source);
    if(isset($filtered_source)) {
      $tax_query_source = ['taxonomy'=>'source', 'terms'=>$filtered_source, 'field'=>'term_id'];
    }
    else {
      $tax_query_source = null;
    }

    $filtered_account = sanitize_text_field($_GET['accounts']);
    $filtered_account = ($filtered_account === '0' ? null : $filtered_account);
    if(isset($filtered_account)) {
      $tax_query_account = ['taxonomy'=>'account', 'terms'=>$filtered_account, 'field'=>'term_id'];
    }
    else {
      $tax_query_account = null;
    }

    $filtered_from = sanitize_text_field($_GET['from']);
    if ($filtered_from) {
      $date_query_from = [
        'year'=>intval(substr($filtered_from, 0, 4)),
        'month'=>intval(substr($filtered_from, 5, 2))
      ];
    }
    else {
      $date_query_from = '';
    }

    $filtered_to = sanitize_text_field($_GET['to']);
    if ($filtered_to) {
      $date_query_to = [
        'year'=>intval(substr($filtered_to, 0, 4)),
        'month'=>intval(substr($filtered_to, 5, 2))
      ];
    }
    else {
      $date_query_to = '';
    }

    $transactions = get_posts([
      'post_type'=>'transaction',
      'posts_per_page'=>-1,
      'order'=>'ASC',
      'tax_query'=>[
        'relation'=>'AND',
        $tax_query_source,
        $tax_query_account
      ],
      'date_query'=>[
        'inclusive'=>true,
        'after'=>$date_query_from,
        'before'=>$date_query_to
      ]
    ]);

    return [$transactions, $filtered_source, $filtered_account, $filtered_from, $filtered_to];
  }
  else {
    $transactions = get_posts([
      'post_type' => 'transaction',
      'posts_per_page' => -1,
      'order' => 'ASC'
    ]);

    return [$transactions];
  }
}
