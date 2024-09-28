<?php

declare(strict_types=1);

namespace Src;

abstract class SalaryCalculator
{
    public function calculate(array $employee, array $timeRecords)
    {
        $totalHours = 0;
        foreach ($timeRecords as $timeRecord) {
            $totalHours += (strtotime($timeRecord['checkout_date']) - strtotime($timeRecord['checkin_date'])) / 3600;
        }
        return $this->calculateSalary($employee, $totalHours);
    }

    abstract public function calculateSalary(array $employee, float $totalHours);
}
