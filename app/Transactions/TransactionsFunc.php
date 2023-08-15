<?php


declare(strict_types = 1);

function getTransactionsFile(string $dirPath): array {
        
    $files = [];

    foreach (scandir($dirPath) as $file) {
        
        if (is_dir($file)) {
            continue;
        }

        $files[] = $dirPath . $file;
    }

    return $files;
}

function getTransactions(string $fileName): array {

    if (!file_exists($fileName)) {
        trigger_error('File' . $fileName . 'does not exist', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');

    $transactions = [];

    fgetcsv($file);

    while (($transaction = fgetcsv($file)) !== false) {
        $transactions[] = parseTransaction($transaction);
    }

    return $transactions;
}


function parseTransaction(array $transactionRow): array {

    [$date, $checkNumber, $description, $amount] = $transactionRow;

    $amount = (float) str_replace(['$', ','], '', $amount);

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'desc'=> $description,
        'amount' => $amount
    ];
}

function calculateTotals(array $transactions): array {
    $totals = [
        'netTotal' => 0,
        'incomeTotal' => 0,
        'expenceTotal' => 0
    ];

    foreach ($transactions as $transaction) {
        
        $totals['netTotal'] += $transaction['amount'];

        if ($transaction['amount'] >= 0) {
            $totals['incomeTotal'] += $transaction['amount'];
        } else {
            $totals['expenceTotal'] += $transaction['amount'];
        }
    }

    return $totals;
}

function formatDollarAmount(float $amount): string {
    $isNegative = $amount < 0;

    return ($isNegative ? '-' : '') . '$' . number_format(abs($amount),2);
}

function formatDate(string $date): string {
    return date('M j, Y', strtotime($date));
}

?>