<?php

interface EstrategiaEntrega {
    public function calcularTotalComTaxa(float $valorPedido): float;
}

class EntregaDelivery implements EstrategiaEntrega {
    public function calcularTotalComTaxa(float $valorPedido): float { return $valorPedido + 5.00; }
}

class RetiradaLocal implements EstrategiaEntrega {
    public function calcularTotalComTaxa(float $valorPedido): float { return $valorPedido * 0.90; }
}