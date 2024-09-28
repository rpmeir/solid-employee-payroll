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
        $response = (new Client(['base_uri' => 'http://localhost:8080']))->request('POST', '/calculate_payroll', ['json' => $input]);
        $output = json_decode((string) $response->getBody());
        expect($output->employeeName)->toBe('Pedro Silva');
        expect($output->salary)->toBe(2000);
    });

    test('Deve calcular a folha de pagamento para um funcionário que ganha salário fixo', function () {
        $input = [
            'employeeId' => 2,
            'month' => 12,
            'year' => 2023,
        ];
        $response = (new Client(['base_uri' => 'http://localhost:8080']))->request('POST', '/calculate_payroll', ['json' => $input]);
        $output = json_decode((string) $response->getBody());
        expect($output->employeeName)->toBe('Ana Costa');
        expect($output->salary)->toBe(4750);
    });

    test('Deve calcular a folha de pagamento para um funcionário que ganha salário voluntário', function () {
        $input = [
            'employeeId' => 3,
            'month' => 12,
            'year' => 2023,
        ];
        $response = (new Client(['base_uri' => 'http://localhost:8080']))->request('POST', '/calculate_payroll', ['json' => $input]);
        $output = json_decode((string) $response->getBody());
        expect($output->employeeName)->toBe('Sergio Oliveira');
        expect($output->salary)->toBe(0);
    });
});
