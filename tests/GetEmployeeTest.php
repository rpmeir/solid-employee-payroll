<?php

declare(strict_types=1);

use Src\EmployeeDataDatabase;
use Src\GetEmployee;

test('Deve obter um funcionário', function () {
    $employeeData = new EmployeeDataDatabase();
    $getEmployee = new GetEmployee($employeeData);
    $output = $getEmployee->execute(1);
    expect($output->employeeName)->toBe('Pedro Silva');
    expect($output->wage)->toBe(50);
    expect($output->type)->toBe('hourly');
});
