<?php

require_once 'models/Produto.php';
require_once 'models/Cliente.php';
require_once 'models/ItemPedido.php';
require_once 'models/Pedido.php';
require_once 'services/EstrategiaEntrega.php';

echo "<h2>Testes do Sistema Tropykaly</h2>";

$cliente = new Cliente(1, "Germano", "88999999999", "Boa Viagem");
$pizza = new Produto(1, "Pizza de Calabresa", 40.00);

// Teste 1
$estrategiaDelivery = new EntregaDelivery();
$pedidoDelivery = new Pedido(100, $cliente, $estrategiaDelivery);
$pedidoDelivery->adicionarItem(new ItemPedido($pizza, 1)); // 40 + 5 de taxa
$totalDelivery = $pedidoDelivery->calcularTotal();
echo $totalDelivery === 45.00 ? "✅ Teste Delivery Passou (Total 45.00)<br>" : "❌ Falhou Delivery<br>";

// Teste 2
$estrategiaRetirada = new RetiradaLocal();
$pedidoRetirada = new Pedido(101, $cliente, $estrategiaRetirada);
$pedidoRetirada->adicionarItem(new ItemPedido($pizza, 1)); // 40 - 10% de desconto
$totalRetirada = $pedidoRetirada->calcularTotal();
echo $totalRetirada === 36.00 ? "✅ Teste Retirada Passou (Total 36.00)<br>" : "❌ Falhou Retirada<br>";