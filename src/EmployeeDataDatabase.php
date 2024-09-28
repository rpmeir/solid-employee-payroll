<?php

declare(strict_types=1);

namespace Src;

class EmployeeDataDatabase implements EmployeeData
{
    public function getEmployee(int $employeeId)
    {
        $connection = new \PDO('pgsql:host=127.0.0.1;port=5432;dbname=postgres', 'postgres', '123456');
        $sth = $connection->prepare('SELECT * FROM emp.employee WHERE employee_id = ?');
        $sth->execute([$employeeId]);
        return $sth->fetchAll(\PDO::FETCH_ASSOC)[0];
    }

    public function getEmployeeTimeRecordsByMonthAndYear(int $employeeId, int $month, int $year)
    {
        $connection = new \PDO('pgsql:host=127.0.0.1;port=5432;dbname=postgres', 'postgres', '123456');
        $sth = $connection->prepare('SELECT * FROM emp.time_record WHERE employee_id = ? AND extract(month from checkin_date) = ? AND extract(year from checkin_date) = ?');
        $sth->execute([$employeeId, $month, $year]);
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
