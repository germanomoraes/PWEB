# Tropykaly - Sistema de Pizzaria Funcional

Um sistema completo de e-commerce para pizzaria com frontend responsivo e backend em PHP, rodando em Docker.

## 🚀 Características

- **Frontend Responsivo**: Interface moderna e intuitiva
- **Cardápio Dinâmico**: Categorias de produtos (Pizzas, Combos, Sanduíches, Bebidas)
- **Carrinho de Compras**: Sistema de carrinho com armazenamento local
- **Checkout**: Formulário completo para pedidos
- **Backend RESTful**: API em PHP para gerenciar pedidos e produtos
- **Banco de Dados JSON**: Armazenamento simples e portável
- **Docker**: Aplicação containerizada pronta para produção

## 📋 Pré-requisitos

- Docker instalado
- Docker Compose instalado

# Atividade 3 - Evolução Arquitetural, Backend em PHP e Deploy

**Aluno:** Germano de Oliveira Moraes  
**Curso:** Análise e Desenvolvimento de Sistemas (ADS) - IFCE Campus Boa Viagem  
**Professor:** Prof. Dr. Renato William Rodrigues de Souza  
**Disciplina:** Programação Web I  

---

## 🎯 Objetivo do Projeto
Este repositório contém a evolução do sistema de pedidos da pizzaria Tropykaly. O projeto passou por uma refatoração completa, saindo de um modelo estrutural simples para uma aplicação com **Arquitetura em Camadas**, **Orientada a Objetos**, **Backend em PHP**, **Integração via API**, uso de **Padrões de Projeto** e conteinerização com **Docker**.

---

## 🛠️ Tecnologias e Padrões Utilizados
- **Frontend:** HTML5, CSS3, Vanilla JavaScript (Fetch API).
- **Backend:** PHP 8.2 (API REST).
- **Persistência:** Banco de Dados em arquivo JSON (`db.json`).
- **Infraestrutura:** Docker e Docker Compose (Apache + PHP).
- **Padrões de Projeto Aplicados:** Strategy, Observer, Singleton e Repository.

---

## 📄 Justificativa Técnica

### 1. Quais problemas foram resolvidos?
O sistema anterior possuía um alto nível de acoplamento, onde as regras de negócio (como cálculo de preços e totais) estavam misturadas diretamente na interface web (JavaScript e manipulação do DOM). Foram eliminadas as variáveis globais que causavam vazamento de estado, as funções com múltiplas responsabilidades e a dependência direta da interface para processar dados sensíveis.

### 2. Como a arquitetura melhorou o sistema?
A adoção da **Arquitetura em Camadas** (separando `/frontend` e `/backend`) e do modelo **API-First** isolou completamente as responsabilidades. O frontend agora atua apenas como uma *View* (apresentação de dados e captação de cliques), enquanto o backend (estruturado em *Models*, *Services* e *Repositories*) detém o monopólio das regras de negócio e validações. Isso torna o sistema muito mais seguro e escalável.

### 3. Onde os padrões de projeto foram aplicados?
- **Strategy:** Aplicado no serviço `EstrategiaEntrega`, permitindo alternar dinamicamente as regras de cálculo do total do pedido entre `EntregaDelivery` (adiciona taxa) e `RetiradaLocal` (aplica desconto), sem a necessidade de múltiplos `if/else` na classe Pedido.
- **Observer:** Utilizado na finalização do pedido. A classe `Pedido` notifica os observadores anexados (como a classe `NotificacaoWhatsApp`) de que o fluxo foi concluído, executando ações pós-venda de forma desacoplada.
- **Singleton:** Aplicado na classe `JsonDatabase` para garantir que toda a aplicação utilize uma única instância de conexão e manipulação do arquivo `db.json`, evitando conflitos de leitura/escrita.
- **Repository:** Utilizado na classe `PedidoRepository`, que abstrai a lógica de persistência, isolando como e onde o pedido é salvo (neste caso, no JSON).

### 4. Como foi feita a integração frontend/backend?
A integração foi realizada através de requisições HTTP assíncronas utilizando a **Fetch API** do JavaScript. O frontend capta as informações do carrinho de compras, formata os dados em um objeto JSON e envia uma requisição `POST` para o *endpoint* principal do backend em PHP (`/api/orders`). O PHP recebe o payload, decodifica, processa as regras de domínio e retorna um status de sucesso com o total validado para o frontend, que por sua vez gera o link de redirecionamento para o WhatsApp.

### 5. Quais dificuldades no deploy?
O principal desafio no deploy é a natureza híbrida da aplicação. Plataformas modernas focadas em integração contínua com o GitHub (como Vercel e Netlify) são *serverless* e excelentes para o frontend, mas não rodam PHP nativamente nem permitem persistência de arquivos locais (`db.json`). A solução arquitetural foi realizar o deploy do frontend em um serviço de arquivos estáticos (Netlify) e apontar as requisições da API para um servidor Apache tradicional que suporte o processamento do PHP.

### 6. Qual o papel do Docker no projeto?
O Docker foi fundamental para padronizar o ambiente de desenvolvimento e testes. Através dos arquivos `Dockerfile` e `docker-compose.yml`, o projeto roda dentro de um container isolado que já possui o servidor Apache, o PHP 8.2 e o módulo `mod_rewrite` devidamente configurados. Isso elimina o clássico problema de "na minha máquina funciona", garantindo que a API e o roteamento das URLs funcionem perfeitamente em qualquer sistema operacional sem a necessidade de instalar pacotes locais.

## 🛠️ Instalação e Execução

### 1. Build da imagem Docker

```bash
cd tropykaly-sistema
docker-compose build
```

### 2. Iniciar os containers

```bash
docker-compose up -d
```

### 3. Acessar a aplicação

Abra seu navegador e acesse:
```
http://localhost
```

## 📁 Estrutura do Projeto

```
tropykaly-sistema/
├── docker-compose.yml           # Configuração Docker Compose
├── Dockerfile                   # Imagem Docker
├── /frontend/
│   ├── index.html              # Interface da loja
│   └── app.js                  # Lógica do frontend
├── /backend/
│   ├── index.php               # API principal
│   ├── /models/                # Classes de modelo
│   ├── /services/              # Serviços e padrões
│   ├── /repositories/          # Acesso a dados
│   └── /data/
│       ├── products.json       # Catálogo de produtos
│       └── orders.json         # Pedidos realizados
└── README.md
```

## 🔧 Endpoints da API

### Produtos
- `GET /api/products` - Listar todos os produtos
- `GET /api/products/{id}` - Obter produto específico
- `POST /api/products` - Criar novo produto

### Pedidos
- `GET /api/orders` - Listar todos os pedidos
- `GET /api/orders/{id}` - Obter pedido específico
- `POST /api/orders` - Criar novo pedido
- `PUT /api/orders/{id}` - Atualizar status do pedido

### Categorias
- `GET /api/categories` - Listar categorias

## 📦 Exemplo de Pedido

```json
{
  "customer": {
    "name": "João Silva",
    "email": "joao@email.com",
    "phone": "88999999999",
    "address": "Rua Principal, 123",
    "notes": "Sem cebola"
  },
  "items": [
    {
      "id": 1,
      "name": "Pizza Margherita P",
      "price": 35.00,
      "quantity": 1
    }
  ],
  "total": 35.00
}
```

## 🛑 Parar a aplicação

```bash
docker-compose down
```

## 🧪 Testar

1. Abra http://localhost
2. Navegue pelas categorias
3. Adicione produtos ao carrinho
4. Clique no carrinho (🛒) para revisar
5. Clique em "Finalizar Pedido"
6. Preencha os dados e confirme

## 🔄 Reiniciar

```bash
docker-compose restart
```

## 📝 Customização

### Adicionar novos produtos

Edite `/backend/data/products.json` e adicione novos itens com o seguinte formato:

```json
{
  "id": 14,
  "name": "Nome do Produto",
  "price": 29.90,
  "desc": "Descrição",
  "category": "categoria",
  "emoji": ""
}
```

### Modificar categorias

Edite a função `handleCategories()` em `/backend/index.php`

## ⚙️ Portas

- **80**: Aplicação principal (Frontend + API)

## 🐛 Troubleshooting

### Erro de porta em uso
```bash
docker ps
docker stop <container_id>
```

### Limpar dados
```bash
rm backend/data/orders.json
echo "[]" > backend/data/orders.json
```



Projeto aberto para uso livre.
