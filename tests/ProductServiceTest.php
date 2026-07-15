<?php

require __DIR__ . '/../vendor/autoload.php';

use app\service\ProductService;

$service = new ProductService();

$validated = $service->validateProduct([
    'nome' => 'Leite Integral',
    'cod_produto' => 'L-001',
    'quantidade' => '12',
    'un_medida' => 'CX',
    'data_valid' => '2026-12-31',
]);

if (!is_array($validated) || $validated['nome'] !== 'Leite Integral' || $validated['quantidade'] !== 12.0) {
    fwrite(STDERR, "Expected validateProduct() to return a sanitized array\n");
    exit(1);
}

$dashboard = $service->buildDashboardData([], []);
if (!is_array($dashboard) || !isset($dashboard['outflowByMonth']) || !isset($dashboard['lowStock']) || !isset($dashboard['expiringSoon'])) {
    fwrite(STDERR, "Expected buildDashboardData() to return dashboard sections\n");
    exit(1);
}

echo "Product service tests passed\n";
