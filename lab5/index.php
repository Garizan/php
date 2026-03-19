<?php

declare(strict_types=1);

require_once 'Transaction.php';
require_once 'TransactionRepository.php';
require_once 'TransactionManager.php';
require_once 'TransactionTableRenderer.php';

$repo = new TransactionRepository();

// 🔥 создаём 10 транзакций
for ($i = 1; $i <= 10; $i++) {
    $repo->addTransaction(
        new Transaction(
            $i,
            new DateTime("-$i days"),
            rand(10, 500),
            "Payment $i",
            $i % 2 === 0 ? 'Amazon' : 'McDonalds'
        )
    );
}

$manager = new TransactionManager($repo);
$renderer = new TransactionTableRenderer();

// пример использования
$sorted = $manager->sortTransactionsByAmountDesc();

echo $renderer->render($sorted);