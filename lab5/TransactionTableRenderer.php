<?php

declare(strict_types=1);

final class TransactionTableRenderer
{
    public function render(array $transactions): string
    {
        $html = "<table border='1' cellpadding='5'>";
        $html .= "<tr>
            <th>ID</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Merchant</th>
            <th>Category</th>
            <th>Days Ago</th>
        </tr>";

        foreach ($transactions as $t) {
            $html .= "<tr>
                <td>{$t->getId()}</td>
                <td>{$t->getDate()->format('Y-m-d')}</td>
                <td>{$t->getAmount()}</td>
                <td>{$t->getDescription()}</td>
                <td>{$t->getMerchant()}</td>
                <td>{$this->getCategory($t->getMerchant())}</td>
                <td>{$t->getDaysSinceTransaction()}</td>
            </tr>";
        }

        $html .= "</table>";

        return $html;
    }

    private function getCategory(string $merchant): string
    {
        return match ($merchant) {
            'Amazon' => 'Shopping',
            'McDonalds' => 'Food',
            default => 'Other',
        };
    }
}