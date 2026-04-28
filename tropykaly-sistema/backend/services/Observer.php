<?php
interface Observer {
    public function atualizar(Pedido $pedido);
}

class NotificacaoWhatsApp implements Observer {
    public function atualizar(Pedido $pedido) {
        // Simulação no backend
        error_log("Notificação gerada para o pedido: " . $pedido->id);
    }
}