<?php

declare(strict_types=1);

namespace Src;

class HourlyCalculator extends SalaryCalculator
{
    public function calculateSalary(array $employee, float $totalHours): float
    {
        return (int) $totalHours * $employee['wage'];
    }
}
