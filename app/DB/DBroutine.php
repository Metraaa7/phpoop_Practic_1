<?php
require_once APP_PATH . 'TransactionsRun.php';

try {
    
    $db = new PDO('mysql:host=' .$_ENV['DB_HOST'].';dbname=' . $_ENV['DB_DATABASE'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS']
    ); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    for($i = 0; $i < count($transactions); $i++) {
        $date = $transactions[$i]['date'];
        $newD = date('Y-m-d', strtotime($date));
        $checked = ($transactions[$i]['checkNumber'] === null)? 0 : $transactions[$i]['checkNumber'];
        $descTr = $transactions[$i]['desc'];
        $a = $transactions[$i]['amount'];

        
        $sttm = $db->prepare("INSERT INTO transactions (date, checked, descTr, a) VALUES ('$newD', '$checked', '$descTr', $a)");
        
        $sttm->execute();
    }
}
catch(\PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}