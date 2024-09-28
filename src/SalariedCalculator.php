<?php

declare(strict_types=1);

namespace Src;

class SalariedCalculator extends SalaryCalculator
{
    public function calculateSalary(array $employee, float $totalHours): float
    {
        $hourlyRate = $employee['salary'] / 160;
        $diff = ($totalHours - 160) * $hourlyRate;
        return (int) $employee['salary'] + $diff;
    }
}
