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
    $calculatePayroll = new \Src\CalculatePayroll();
    $input = json_decode((string) $request->getBody());
    $output = $calculatePayroll->execute($input);
    $payload = json_encode($output, JSON_PRETTY_PRINT);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
