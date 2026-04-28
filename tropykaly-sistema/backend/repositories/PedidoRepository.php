<?php

class PedidoRepository {
    public function salvar(Pedido $pedido) {
        $db = JsonDatabase::getInstancia();
        $db->salvar([
            'id' => $pedido->id,
            'cliente' => $pedido->cliente->nome,
            'total' => $pedido->calcularTotal(),
            'status' => $pedido->status,
            'data' => $pedido->dataHora
        ]);
    }
}