## Parte 1: Análise do Sistema Da Tropykaly 

**1. Qual é o objetivo do sistema?**

Automatizar a apresentação do cardápio e a captação de pedidos (delivery e retirada) da pizzaria, facilitando a escolha do cliente e padronizando a entrada de dados para o estabelecimento.

**2. Quais funcionalidades ele oferece?**

Navegação por categorias de alimentos, exibição de detalhes e preços, carrinho de compras virtual, cálculo de taxa de entrega e fechamento de pedido (checkout).

**3. Como o usuário interage com o sistema?**
Através de uma interface web responsiva (Mobile/Desktop). O usuário seleciona os itens com cliques, preenche formulários com dados de entrega e finaliza a compra.

**4. Como os produtos estão organizados?**
Estão organizados hierarquicamente em categorias principais (Pizzas, Lanches, Bebidas) para facilitar a navegação e melhorar a experiência do usuário (UX).

## Parte 2: Análise de Arquitetura

* **Tipo de arquitetura:** Cliente-Servidor (Client-Server), padrão em aplicações web.
* **Possível divisão em camadas:** Provavelmente estruturado em 3 camadas lógicas: *Presentation* (Frontend renderizado no navegador), *Business Logic* (Backend gerenciando o carrinho e regras de entrega) e *Data* (Banco de dados do cardápio e histórico).
* **Separação de responsabilidades:** Existe. O navegador (cliente) apenas exibe a interface e envia as ações, enquanto o servidor processa as regras de negócio, garantindo que o usuário não consiga alterar preços no front-end.

## Parte 3: Análise de Design

* **Coesão:** Alta. Os componentes visuais (como o modal de adicionar ao carrinho) parecem ter funções únicas e bem definidas.
* **Acoplamento:** Aparentemente baixo. A interface web atua de forma independente, consumindo dados do backend possivelmente via uma API REST.
* **Separação de responsabilidades:** O design da interface sugere que a equipe separou claramente o gerenciamento de estado do carrinho da listagem estática do catálogo de produtos.