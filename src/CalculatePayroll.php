<?php

declare(strict_types=1);

namespace Src;

class CalculatePayroll
{
    public function __construct(public readonly EmployeeDataCalculatePayroll $employeeData)
    {
    }

    /**
     * @param object{employeeId: int, month: int, year: int} $input
     *
     * @return object{employeeName: string, salary: float} $output
     */
    public function execute(object $input): object
    {
        $employee = $this->employeeData->getEmployee($input->employeeId);
        $timeRecords = $this->employeeData->getEmployeeTimeRecordsByMonthAndYear($input->employeeId, $input->month, $input->year);
        $salary = (int) (SalaryCalculatorFactory::create($employee['type']))->calculate($employee, $timeRecords);
        return (object) ['employeeName' => $employee['name'], 'salary' => $salary];
    }
}
