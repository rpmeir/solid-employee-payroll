<?php

declare(strict_types=1);

use GuzzleHttp\Client;

describe('MainTest', function () {
    test('Deve calcular a folha de pagamento para um funcionário que ganha por hora', function () {
        $input = [
            'employeeId' => 1,
            'month' => 12,
            'year' => 2023,
        ];
        $httpClient = new Client(['base_uri' => 'http://localhost:8080']);
        $response = $httpClient->request('POST', '/calculate_payroll', ['json' => $input]);
        expect($response->getStatusCode())->toBe(200);
        $data = json_decode((string) $response->getBody());
        expect($data->employeeName)->toBe('Pedro Silva');
        expect($data->salary)->toBe(2000);
    });

    test('Deve calcular a folha de pagamento para um funcionário que ganha salário fixo', function () {
        $input = [
            'employeeId' => 2,
            'month' => 12,
            'year' => 2023,
        ];
        $httpClient = new Client(['base_uri' => 'http://localhost:8080']);
        $response = $httpClient->request('POST', '/calculate_payroll', ['json' => $input]);
        expect($response->getStatusCode())->toBe(200);
        $data = json_decode((string) $response->getBody());
        expect($data->employeeName)->toBe('Ana Costa');
        expect($data->salary)->toBe(4750);
    });
});
