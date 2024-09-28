<?php

declare(strict_types=1);

use Src\CalculatePayroll;
use Src\EmployeeDataDatabase;

test('Deve calcular a folha de pagamento para um funcionário que ganha por hora', function () {
    $input = [
        'employeeId' => 1,
        'month' => 12,
        'year' => 2023,
    ];
    $employeeData = new EmployeeDataDatabase();
    $calculatePayroll = new CalculatePayroll($employeeData);
    $output = $calculatePayroll->execute((object) $input);
    expect($output->employeeName)->toBe('Pedro Silva');
    expect($output->salary)->toBe(2000);
});
