<?php

declare(strict_types=1);

namespace Src;

class GetEmployee
{
    public function __construct(public readonly EmployeeDataGetEmployee $employeeData)
    {
    }

    /**
     * @param int $employeeId
     *
     * @return object{employeeName: string, wage: int, type: string} $output
     */
    public function execute(int $employeeId): object
    {
        $employee = $this->employeeData->getEmployee($employeeId);
        return (object) [
            'employeeName' => $employee['name'],
            'wage' => (int) $employee['wage'],
            'type' => $employee['type'],
        ];
    }
}
