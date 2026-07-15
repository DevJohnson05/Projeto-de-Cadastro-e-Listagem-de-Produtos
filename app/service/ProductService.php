<?php

namespace app\service;

class ProductService
{
    public function validateProduct(array $data): bool|array
    {
        if (empty($data['nome']) || empty($data['cod_produto'])) {
            return false;
        }

        $nome = trim((string) filter_var($data['nome'], FILTER_SANITIZE_SPECIAL_CHARS));
        $cod = trim((string) filter_var($data['cod_produto'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $quantidade = $data['quantidade'] ?? null;
        if (!is_numeric($quantidade) || (float) $quantidade < 0) {
            return false;
        }
        $quantidade = (float) $quantidade;

        $un_medida = trim((string) ($data['un_medida'] ?? ''));
        if ($un_medida === '') {
            return false;
        }

        $data_valid = $data['data_valid'] ?? null;
        if ($data_valid) {
            $d = date_create($data_valid);
            if (!$d) {
                return false;
            }
            $data_valid = $d->format('Y-m-d');
        }

        return [
            'nome' => $nome,
            'cod_produto' => $cod,
            'quantidade' => $quantidade,
            'un_medida' => $un_medida,
            'data_valid' => $data_valid,
        ];
    }

    public function validateOutflow(array $data): bool|array
    {
        $productId = $data['product_id'] ?? null;
        if (!is_numeric($productId) || (int) $productId <= 0) {
            return false;
        }

        $quantidade = $data['quantidade'] ?? null;
        if (!is_numeric($quantidade) || (float) $quantidade <= 0) {
            return false;
        }

        return [
            'product_id' => (int) $productId,
            'quantidade' => (float) $quantidade,
            'observacao' => trim((string) ($data['observacao'] ?? '')),
        ];
    }

    public function buildDashboardData(array $products, array $outflows = []): array
    {
        $outflowByMonth = [];
        foreach ($outflows as $entry) {
            $date = $entry['date'] ?? null;
            if (!$date) {
                continue;
            }

            $month = date('Y-m', strtotime($date));
            $outflowByMonth[$month] = ($outflowByMonth[$month] ?? 0) + (float) ($entry['quantidade'] ?? 0);
        }

        $lowStock = array_values(array_filter($products, function ($product) {
            return (float) ($product['quantidade'] ?? 0) <= 5;
        }));

        $expiringSoon = array_values(array_filter($products, function ($product) {
            $data_valid = $product['data_valid'] ?? null;
            if (!$data_valid) {
                return false;
            }

            $date = date_create($data_valid);
            if (!$date) {
                return false;
            }

            $today = new \DateTime('today');
            $limit = (clone $today)->modify('+30 days');
            return $date >= $today && $date <= $limit;
        }));

        usort($lowStock, fn ($a, $b) => (float) ($a['quantidade'] ?? 0) <=> (float) ($b['quantidade'] ?? 0));
        usort($expiringSoon, fn ($a, $b) => strcmp($a['data_valid'] ?? '', $b['data_valid'] ?? ''));

        return [
            'outflowByMonth' => $outflowByMonth,
            'lowStock' => $lowStock,
            'expiringSoon' => $expiringSoon,
        ];
    }
}
