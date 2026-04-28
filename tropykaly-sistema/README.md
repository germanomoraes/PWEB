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

## 📄 Licença

Projeto aberto para uso livre.
