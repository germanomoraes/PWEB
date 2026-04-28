<?php

// Configurar headers CORS e JSON
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

// Tratar requisições OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Definir caminho para dados
$dataPath = __DIR__ . '/data';
if (!is_dir($dataPath)) {
    mkdir($dataPath, 0755, true);
}

// Roteamento básico
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remover /backend se existir no caminho
$requestUri = str_replace('/backend', '', $requestUri);

// Extrair rota
if (preg_match('/\/api\/(.+?)(?:\/(\d+))?$/', $requestUri, $matches)) {
    $resource = $matches[1];
    $id = $matches[2] ?? null;
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Rota não encontrada', 'uri' => $requestUri]);
    exit();
}

// Router
switch ($resource) {
    case 'products':
        handleProducts($requestMethod, $id, $dataPath);
        break;
    case 'orders':
        handleOrders($requestMethod, $id, $dataPath);
        break;
    case 'categories':
        handleCategories($requestMethod);
        break;
    case 'health':
        echo json_encode(['status' => 'ok', 'message' => 'API está funcionando']);
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Recurso não encontrado', 'resource' => $resource]);
}

// Handlers de Produtos
function handleProducts($method, $id, $dataPath) {
    $productsFile = $dataPath . '/products.json';
    
    switch ($method) {
        case 'GET':
            if ($id) {
                if (!file_exists($productsFile)) {
                    echo json_encode(['error' => 'Arquivo não encontrado']);
                    return;
                }
                $products = json_decode(file_get_contents($productsFile), true) ?? [];
                $product = array_filter($products, fn($p) => $p['id'] == $id);
                echo json_encode(array_shift($product) ?? ['error' => 'Produto não encontrado']);
            } else {
                if (!file_exists($productsFile)) {
                    echo json_encode([]);
                    return;
                }
                $products = json_decode(file_get_contents($productsFile), true) ?? [];
                echo json_encode($products);
            }
            break;
            
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $products = (file_exists($productsFile)) ? json_decode(file_get_contents($productsFile), true) ?? [] : [];
            
            $maxId = 0;
            if (!empty($products)) {
                $maxId = max(array_column($products, 'id'));
            }
            
            $newProduct = array_merge($data, [
                'id' => $maxId + 1,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            $products[] = $newProduct;
            file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT));
            
            http_response_code(201);
            echo json_encode($newProduct);
            break;
    }
}

// Handlers de Pedidos
function handleOrders($method, $id, $dataPath) {
    $ordersFile = $dataPath . '/orders.json';
    
    switch ($method) {
        case 'GET':
            if ($id) {
                if (!file_exists($ordersFile)) {
                    echo json_encode(['error' => 'Arquivo não encontrado']);
                    return;
                }
                $orders = json_decode(file_get_contents($ordersFile), true) ?? [];
                $order = array_filter($orders, fn($o) => $o['id'] == $id);
                echo json_encode(array_shift($order) ?? ['error' => 'Pedido não encontrado']);
            } else {
                if (!file_exists($ordersFile)) {
                    echo json_encode([]);
                    return;
                }
                $orders = json_decode(file_get_contents($ordersFile), true) ?? [];
                echo json_encode($orders);
            }
            break;
            
        case 'POST':
            $inputData = file_get_contents('php://input');
            $data = json_decode($inputData, true);
            
            if (!$data) {
                http_response_code(400);
                echo json_encode(['error' => 'JSON inválido']);
                return;
            }
            
            $orders = (file_exists($ordersFile)) ? json_decode(file_get_contents($ordersFile), true) ?? [] : [];
            
            // Calcular novo ID
            $maxId = 0;
            if (!empty($orders) && is_array($orders)) {
                $ids = array_column($orders, 'id');
                $ids = array_filter($ids, fn($x) => is_numeric($x));
                if (!empty($ids)) {
                    $maxId = max($ids);
                }
            }
            
            $newOrder = [
                'id' => (int)($maxId + 1),
                'customer' => $data['customer'] ?? [],
                'items' => $data['items'] ?? [],
                'total' => (float)($data['total'] ?? 0),
                'status' => 'pendente',
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $orders[] = $newOrder;
            
            if (!file_put_contents($ordersFile, json_encode($orders, JSON_PRETTY_PRINT))) {
                http_response_code(500);
                echo json_encode(['error' => 'Falha ao salvar pedido']);
                return;
            }
            
            http_response_code(201);
            echo json_encode($newOrder);
            break;
            
        case 'PUT':
            if (!$id) {
                http_response_code(400);
                echo json_encode(['error' => 'ID do pedido obrigatório']);
                break;
            }
            
            $data = json_decode(file_get_contents('php://input'), true);
            $orders = (file_exists($ordersFile)) ? json_decode(file_get_contents($ordersFile), true) ?? [] : [];
            
            $found = false;
            foreach ($orders as &$order) {
                if ($order['id'] == $id) {
                    $order = array_merge($order, $data, ['updated_at' => date('Y-m-d H:i:s')]);
                    $found = true;
                    break;
                }
            }
            
            if (!$found) {
                http_response_code(404);
                echo json_encode(['error' => 'Pedido não encontrado']);
                return;
            }
            
            file_put_contents($ordersFile, json_encode($orders, JSON_PRETTY_PRINT));
            echo json_encode($order);
            break;
    }
}

// Handlers de Categorias
function handleCategories($method) {
    $categories = [
        ['id' => 1, 'name' => 'Pizzas', 'emoji' => '🍕'],
        ['id' => 2, 'name' => 'Combos', 'emoji' => '🍔'],
        ['id' => 3, 'name' => 'Sanduíches', 'emoji' => '🥪'],
        ['id' => 4, 'name' => 'Bebidas', 'emoji' => '🥤']
    ];
    
    echo json_encode($categories);
}
?>