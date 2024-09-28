<?php

declare(strict_types=1);

namespace Src;

class SalaryCalculatorFactory
{
    public static function create(string $type): SalaryCalculator
    {
        if ($type === 'hourly') {
            return new HourlyCalculator();
        }
        if ($type === 'salaried') {
            return new SalariedCalculator();
        }
        if ($type === 'volunteer') {
            return new VolunteerCalculator();
        }
        throw new \Exception('Invalid salary calculator type');
    }
}
