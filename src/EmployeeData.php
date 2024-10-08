<?php

declare(strict_types=1);

namespace Src;

interface EmployeeData extends EmployeeDataGetEmployee, EmployeeDataCalculatePayroll
{
    public function getEmployee(int $employeeId);
    public function getEmployeeTimeRecordsByMonthAndYear(int $employeeId, int $month, int $year);
}
