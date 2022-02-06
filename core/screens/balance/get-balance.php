<?php defined('WPINC') || die; ?>

<?php
function get_balance_financialreporter($accounts) {
  foreach ($accounts as $account) {
    $start_amount = floatval(str_replace(',', '.', get_term_meta($account->term_id, 'start_amount', true)));

    $transactions = get_posts(
      [
        'post_type'      => 'transaction',
        'tax_query'      =>
        [
          [
            'taxonomy'         => 'account',
            'terms'            => $account->name,
            'field'            => 'name',
            'include_children' => false,
          ]
        ],
        'posts_per_page' => -1,
      ]
    );

    if (!empty($transactions)) {
      $transactions_amount = 0;

      foreach ($transactions as $transaction) {
        $transaction_amount = floatval(str_replace(',', '.', get_post_meta($transaction->ID, 'transaction_amount', true)));

        $transactions_amount += $transaction_amount;
      }
    }
    else {
      $transactions_amount = 0;
    }

    $current_amount = $start_amount + $transactions_amount;

    $balance[$account->name] = $current_amount;
  }

  return $balance;
}
