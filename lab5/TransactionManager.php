<?php

declare(strict_types=1);

require_once 'TransactionStorageInterface.php';

class TransactionManager
{
    public function __construct(
        private TransactionStorageInterface $repository
    ) {}

    public function calculateTotalAmount(): float
    {
        return array_reduce(
            $this->repository->getAllTransactions(),
            fn($sum, $t) => $sum + $t->getAmount(),
            0
        );
    }

    public function calculateTotalAmountByDateRange(string $startDate, string $endDate): float
    {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);

        $sum = 0;

        foreach ($this->repository->getAllTransactions() as $t) {
            $date = $t->getDate();

            if ($date >= $start && $date <= $end) {
                $sum += $t->getAmount();
            }
        }

        return $sum;
    }

    public function countTransactionsByMerchant(string $merchant): int
    {
        return count(array_filter(
            $this->repository->getAllTransactions(),
            fn($t) => $t->getMerchant() === $merchant
        ));
    }

    public function sortTransactionsByDate(): array
    {
        $transactions = $this->repository->getAllTransactions();

        usort($transactions, fn($a, $b) =>
            $a->getDate() <=> $b->getDate()
        );

        return $transactions;
    }

    public function sortTransactionsByAmountDesc(): array
    {
        $transactions = $this->repository->getAllTransactions();

        usort($transactions, fn($a, $b) =>
            $b->getAmount() <=> $a->getAmount()
        );

        return $transactions;
    }
}