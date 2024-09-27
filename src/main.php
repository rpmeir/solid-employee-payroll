<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('Hello World!');
    return $response;
});

$app->post('/calculate_payroll', function (Request $request, Response $response) {
    $input = json_decode((string) $request->getBody());
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
    $payload = json_encode(['name' => $employee['name'], 'salary' => $salary], JSON_PRETTY_PRINT);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
