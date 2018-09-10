<?php
    //header('Refresh: 3; URL=index.html');

    $amountWithdraw5000 = filter_input(INPUT_POST, 'amountWithdrawal') ? filter_input(INPUT_POST, 'amountWithdrawal') : 0;

    $noteStart5000 = filter_input(INPUT_POST, 'noteStart5000') ? filter_input(INPUT_POST, 'noteStart5000') : 0;
    $noteStart1000 = filter_input(INPUT_POST, 'noteStart1000') ? filter_input(INPUT_POST, 'noteStart1000') : 0;
    $noteStart500 = filter_input(INPUT_POST, 'noteStart500') ? filter_input(INPUT_POST, 'noteStart500') : 0;
    $noteStart100 = filter_input(INPUT_POST, 'noteStart100') ? filter_input(INPUT_POST, 'noteStart100') : 0;

    $bills = array (
        1 => $noteStart5000, //5000
        2 => $noteStart1000, //1000
        3 => $noteStart500, //500
        4 => $noteStart100  //100
    );

    $amountBillsTotal = $bills[1] * 5000 + $bills[2] * 1000 + $bills[3] * 500 + $bills[4] * 100;

    function b5000($amountWithdraw5000, $bills)
    {
        for ($i = 0; $i <= $bills[1]; $i++) {
            if ($i * 5000 > $amountWithdraw5000) {
                return $i - 1;
            }
        }
        return $i - 1;
    };

    function b1000($amountWithdraw1000, $bills)
    {
        for ($i = 0; $i <= $bills[2]; $i++) {
            if ($i * 1000 > $amountWithdraw1000) {
                return $i - 1;
            }
        }
        return $i - 1;
    };

    function b500($amountWithdraw500, $bills)
    {
        for ($i = 0; $i <= $bills[3]; $i++) {
            if ($i * 500 > $amountWithdraw500) {
                return $i - 1;
            }
        }
        return $i - 1;
    };

    function b100($amountWithdraw100, $bills)
    {
        for ($i = 0; $i <= $bills[4]; $i++) {
            if ($i * 100 > $amountWithdraw100) {
                return $i - 1;
            }
        }
        return $i - 1;
    };

    $amountBills5000 = b5000($amountWithdraw5000, $bills);

    $amountWithdraw1000 = $amountWithdraw5000 - $amountBills5000 * 5000;

    $amountBills1000 = b1000($amountWithdraw1000, $bills);

    $amountWithdraw500 = $amountWithdraw1000 - $amountBills1000 * 1000;

    $amountBills500 = b500($amountWithdraw500, $bills);

    $amountWithdraw100 = $amountWithdraw500 - $amountBills500 * 500;

    $amountBills100 = b100($amountWithdraw100, $bills);

    $amountBills = $amountWithdraw100 - $amountBills100 * 100;

    if ($amountBills != 0){
        $serviceMessage = "Impossible: no bills";
        if ($amountBillsTotal < $amountWithdraw5000){
            $serviceMessage = "Not enough at Cash machine";
            }
        $amountBills5000 = 0;
        $amountBills1000 = 0;
        $amountBills500 = 0;
        $amountBills100 = 0;
    }
    else{
        $serviceMessage = "Take your money";
    }

    require_once('index.html');
