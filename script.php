<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Controller\CommissionFeeController;
use App\Exception\CommissionFeeException;

$data = array_map('str_getcsv', file('input.csv'));
try {
    $commissionFee = new CommissionFeeController();
    $commissionFee->showCommissionFee($data);
} catch (CommissionFeeException $exception) {
    echo $exception->getMessage();
}

