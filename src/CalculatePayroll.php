<?php

declare(strict_types=1);

namespace Src;

class CalculatePayroll
{
    /**
     * @param object{employeeId: int, month: int, year: int} $input
     *
     * @return object{employeeName: string, salary: float} $output
     */
    public function execute(object $input): object
    {
        $connection = new \PDO('pgsql:host=127.0.0.1;port=5432;dbname=postgres', 'postgres', '123456');
        $sth = $connection->prepare('SELECT * FROM emp.employee WHERE employee_id = ?');
        $sth->execute([$input->employeeId]);
        $employee = $sth->fetchAll(\PDO::FETCH_ASSOC)[0];
        $sth = $connection->prepare('SELECT * FROM emp.time_record WHERE employee_id = ? AND extract(month from checkin_date) = ? AND extract(year from checkin_date) = ?');
        $sth->execute([$input->employeeId, $input->month, $input->year]);
        $totalHours = 0;
        $timeRecords = $sth->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($timeRecords as $timeRecord) {
            $totalHours += (strtotime($timeRecord['checkout_date']) - strtotime($timeRecord['checkin_date'])) / 3600;
        }
        $salary = 0;
        if($employee['type'] === 'hourly') {
            $salary = $totalHours * $employee['wage'];
        }
        if($employee['type'] === 'salaried') {
            $hourlyRate = $employee['salary'] / 160;
            $diff = ($totalHours - 160) * $hourlyRate;
            $salary = $employee['salary'] + $diff;
        }
        return (object) ['employeeName' => $employee['name'], 'salary' => $salary];
    }
}
