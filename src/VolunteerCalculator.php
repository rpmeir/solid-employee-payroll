<?php

declare(strict_types=1);

namespace Src;

class VolunteerCalculator extends SalaryCalculator
{
    public function calculateSalary(array $employee, float $totalHours): float
    {
        throw new \Exception('Cannot calculate salary for a volunteer');
    }
}
