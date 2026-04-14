# Proposta de Arquitetura e Padrões 

## Padrões de Projeto Identificados 

1. **O sistema aparenta utilizar padrões?** Sim, fundamentais para manter um e-commerce rodando.

2. **Onde poderiam existir e ser aplicados:**
   
   * **MVC (Model-View-Controller):** Na estrutura principal do backend. *Model* gerenciando dados de Pizzas/Pedidos; *View* entregando a interface (ou o JSON para o front); *Controller* recebendo o POST de finalização de pedido.
   * **Factory:** Na criação de produtos complexos. Uma `PizzaFactory` montaria o objeto base da pizza adicionando os complementos (bordas, adicionais).
   * **Singleton:** No gerenciamento do Banco de Dados (Database Connection) e na sessão do Carrinho, garantindo uma única instância por usuário ativo.

## Parte 8: Proposta de Arquitetura

* **Organização em camadas:** Propomos uma Arquitetura em Camadas (Layered) estrita: Camada de Apresentação (React/Vue), Camada de Aplicação (Controladores API REST), Camada de Domínio (Regras de negócio de delivery) e Camada de Infraestrutura (Banco de dados e gateways de pagamento/WhatsApp).
* **Separação de responsabilidades:** Garantir que o banco de dados nunca seja acessado diretamente pela camada de apresentação, sempre passando pela API.
* **Componentes principais:** Servidor Web Frontend, API Gateway (Backend), Serviço de Autenticação/Sessão, Banco de Dados Relacional (PostgreSQL/MySQL) para pedidos.

## Parte 9: Aplicação de Padrões (Explicação Prática)

* **Factory:** Utilizaríamos o padrão Factory Method para instanciar as diferentes formas de entrega (`EntregaDelivery` ou `RetiradaLocal`), pois cada uma tem regras de taxa e tempo de espera diferentes.
* **Singleton:** Aplicaríamos no `GerenciadorDeSessao`. Ao adicionar itens ao carrinho, o sistema chama a instância única do gerenciador para garantir que os itens não sejam perdidos ao recarregar a página.