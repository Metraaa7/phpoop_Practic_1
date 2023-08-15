<?php 
    require_once APP_PATH . 'TransactionsFunc.php';

    $files = getTransactionsFile(FILES_PATH);
    $transactions = [];

    foreach ($files as $file) {
        $transactions = array_merge($transactions, getTransactions($file));
    }

    $totals = calculateTotals($transactions);
?>