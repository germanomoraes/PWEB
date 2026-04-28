// Configurações
const API_URL = 'http://localhost/api';
let cart = [];
let currentProduct = null;

// Dados de produtos (simulado - em produção viria do backend)
const products = {
    pizzas: [
        { id: 1, name: 'Pizza Margherita P', price: 35.00, desc: 'Tomate, mozzarela, manjericão', category: 'pizzas', emoji: '🍕' },
        { id: 2, name: 'Pizza Pepperoni P', price: 38.00, desc: 'Tomate, mozzarela, pepperoni', category: 'pizzas', emoji: '🍕' },
        { id: 3, name: 'Pizza Calabresa P', price: 37.00, desc: 'Molho de tomate, mozzarela, calabresa', category: 'pizzas', emoji: '🍕' },
        { id: 4, name: 'Pizza Frango com Catupiry P', price: 40.00, desc: 'Frango desfiado, catupiry, cebola', category: 'pizzas', emoji: '🍕' },
    ],
    combos: [
        { id: 5, name: 'Combo Classic Burguer', price: 40.00, desc: 'Hambúrguer artesanal, batata frita, refrigerante', category: 'combos', emoji: '🍔' },
        { id: 6, name: 'Combo Big Cheddar', price: 45.00, desc: 'Duplo hambúrguer, cheddar, batata frita, refrigerante', category: 'combos', emoji: '🍔' },
        { id: 7, name: 'Combo Frango Crocante', price: 38.00, desc: 'Frango crocante, batata frita, refrigerante', category: 'combos', emoji: '🍗' },
    ],
    sanduiches: [
        { id: 8, name: 'X-Burguer', price: 22.00, desc: 'Pão, carne, queijo, alface, tomate', category: 'sanduiches', emoji: '🥪' },
        { id: 9, name: 'X-Tudo', price: 28.00, desc: 'Pão, carne, queijo, bacon, ovo, alface, tomate', category: 'sanduiches', emoji: '🥪' },
        { id: 10, name: 'Sanduíche de Frango', price: 20.00, desc: 'Frango desfiado, queijo, alface, tomate', category: 'sanduiches', emoji: '🥪' },
    ],
    bebidas: [
        { id: 11, name: 'Refrigerante 2L', price: 12.00, desc: 'Várias opções', category: 'bebidas', emoji: '🥤' },
        { id: 12, name: 'Suco Natural 500ml', price: 10.00, desc: 'Laranja, morango ou maracujá', category: 'bebidas', emoji: '🥤' },
        { id: 13, name: 'Cerveja 350ml', price: 8.00, desc: 'Várias marcas', category: 'bebidas', emoji: '🍺' },
    ]
};

// Inicializar página
document.addEventListener('DOMContentLoaded', () => {
    loadCartFromStorage();
    renderCategories();
    renderProducts('pizzas');
    setupEventListeners();
    checkAPIHealth();
    console.log('Aplicação iniciada!');
});

// Verificar saúde da API
async function checkAPIHealth() {
    try {
        console.log('Verificando API em:', `${API_URL}/health`);
        const response = await fetch(`${API_URL}/health`);
        if (response.ok) {
            const data = await response.json();
            console.log('✅ API respondendo:', data);
        } else {
            console.warn('⚠️ API retornou status:', response.status);
        }
    } catch (error) {
        console.error('❌ API não está acessível:', error);
        console.error('URL tentada:', `${API_URL}/health`);
    }
}

// Renderizar categorias
function renderCategories() {
    const categories = document.getElementById('categories');
    const categoryList = [
        { id: 'pizzas', name: '🍕 Pizzas' },
        { id: 'combos', name: '🍔 Combos' },
        { id: 'sanduiches', name: '🥪 Sanduíches' },
        { id: 'bebidas', name: '🥤 Bebidas' }
    ];

    categories.innerHTML = categoryList.map(cat => 
        `<button class="category-btn ${cat.id === 'pizzas' ? 'active' : ''}" onclick="changeCategory('${cat.id}')">${cat.name}</button>`
    ).join('');
}

// Mudar categoria
function changeCategory(category) {
    renderProducts(category);
}

// Renderizar produtos
function renderProducts(category) {
    const grid = document.getElementById('productsGrid');
    const categoryProducts = products[category] || [];

    // Atualizar botão ativo
    document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`[onclick*="'${category}'"]`).classList.add('active');

    grid.innerHTML = categoryProducts.map(product => `
        <div class="product-card">
            <div class="product-image">${product.emoji}</div>
            <div class="product-info">
                <div class="product-name">${product.name}</div>
                <div class="product-desc">${product.desc}</div>
                <div class="product-footer">
                    <div class="price">R$ ${product.price.toFixed(2)}</div>
                    <button class="add-btn" onclick="openProductModal(${product.id}, '${product.name.replace(/'/g, "\\'")}', ${product.price}, '${product.desc.replace(/'/g, "\\'")}')">+</button>
                </div>
            </div>
        </div>
    `).join('');
}

// Abrir modal do produto
function openProductModal(id, name, price, desc) {
    currentProduct = { id, name, price, desc };
    document.getElementById('modalTitle').textContent = name;
    document.getElementById('modalPrice').textContent = `R$ ${price.toFixed(2)}`;
    document.getElementById('modalDesc').textContent = desc;
    document.getElementById('quantity').value = 1;
    document.getElementById('productModal').classList.add('active');
}

// Fechar modal de produto
function closeModal() {
    document.getElementById('productModal').classList.remove('active');
    currentProduct = null;
}

// Quantidade +/-
function increaseQuantity() {
    const input = document.getElementById('quantity');
    input.value = parseInt(input.value) + 1;
}

function decreaseQuantity() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
}

// Adicionar ao carrinho
function addToCart() {
    if (!currentProduct) return;

    const quantity = parseInt(document.getElementById('quantity').value);
    const existingItem = cart.find(item => item.id === currentProduct.id);

    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({ ...currentProduct, quantity });
    }

    saveCartToStorage();
    updateCartCount();
    closeModal();
    showNotification('✅ Produto adicionado ao carrinho!');
}

// Setup de listeners
function setupEventListeners() {
    const cartIcon = document.getElementById('cartIcon');
    if (cartIcon) {
        cartIcon.addEventListener('click', openCartModal);
    }
}

// Abrir carrinho
function openCartModal() {
    renderCartItems();
    document.getElementById('cartModal').classList.add('active');
}

// Fechar carrinho
function closeCartModal() {
    document.getElementById('cartModal').classList.remove('active');
}

// Renderizar itens do carrinho
function renderCartItems() {
    const cartItemsDiv = document.getElementById('cartItems');
    
    if (cart.length === 0) {
        cartItemsDiv.innerHTML = '<div class="empty-cart">Seu carrinho está vazio</div>';
        document.getElementById('totalPrice').textContent = '0,00';
        return;
    }

    let total = 0;
    cartItemsDiv.innerHTML = cart.map((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        return `
            <div class="cart-item">
                <div class="cart-item-info">
                    <div class="cart-item-name">${item.name}</div>
                    <div>Qtd: ${item.quantity}</div>
                    <div class="cart-item-price">R$ ${itemTotal.toFixed(2)}</div>
                </div>
                <button class="remove-btn" onclick="removeFromCart(${index})">Remover</button>
            </div>
        `;
    }).join('');

    document.getElementById('totalPrice').textContent = total.toFixed(2);
}

// Remover do carrinho
function removeFromCart(index) {
    cart.splice(index, 1);
    saveCartToStorage();
    updateCartCount();
    renderCartItems();
}

// Abrir checkout
function openCheckout() {
    if (cart.length === 0) {
        showNotification('⚠️ Adicione itens ao carrinho!');
        return;
    }
    closeCartModal();
    setTimeout(() => {
        document.getElementById('checkoutModal').classList.add('active');
        // Focar no primeiro input
        document.getElementById('inputName').focus();
    }, 200);
}

// Fechar checkout
function closeCheckoutModal() {
    document.getElementById('checkoutModal').classList.remove('active');
}

// Integração com WhatsApp (Parte 6 da atividade)
function abrirWhatsApp(telefone, total, itens) {
    let texto = `*Novo Pedido Tropykaly*%0A`;
    itens.forEach(item => {
        texto += `- ${item.quantidade}x ${item.nome}%0A`;
    });
    texto += `%0A*Total a pagar: R$ ${total.toFixed(2)}*`;
    
    // Tenta usar o número do cliente, se não houver, usa o da loja
    const numeroDestino = telefone || "5588999999999"; 
    const url = `https://wa.me/${numeroDestino}?text=${texto}`;
    window.open(url, '_blank');
}

// Enviar pedido
async function submitOrder(event) {
    event.preventDefault();
    
    const submitBtn = event.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = '⏳ Processando...';
    
    const form = document.getElementById('checkoutForm');
    
    // TRADUÇÃO DOS DADOS PARA O PADRÃO DO PHP
    const itensFormatados = cart.map(item => ({
        id: item.id,
        nome: item.name,        // O PHP espera 'nome'
        preco: item.price,      // O PHP espera 'preco'
        quantidade: item.quantity // O PHP espera 'quantidade'
    }));

    // Montando o objeto exatamente como o PHP espera receber
    const orderData = {
        cliente: document.getElementById('inputName').value,
        telefone: document.getElementById('inputPhone').value,
        endereco: document.getElementById('inputAddress').value,
        tipo_entrega: 'delivery', // Adicionando o tipo de entrega para o Strategy do PHP
        itens: itensFormatados
    };

    // Validar dados
    if (!orderData.cliente || !orderData.telefone || !orderData.endereco) {
        showNotification('❌ Preencha todos os campos obrigatórios!');
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
        return;
    }

    try {
        console.log('Enviando pedido para:', `${API_URL}/orders`);
        console.log('Dados:', orderData);
        
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 10000); // 10 segundos de timeout
        
        const response = await fetch(`${API_URL}/orders`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(orderData),
            signal: controller.signal
        });
        
        clearTimeout(timeoutId);
        
        if (response.ok) {
            const result = await response.json();
            console.log('Pedido criado:', result);
            
            showNotification(`✅ Pedido realizado com sucesso!\n\nTotal processado pelo PHP: R$ ${result.total.toFixed(2)}\nObrigado pela compra!`);
            
            // Dispara o link do WhatsApp com os dados retornados do PHP
            abrirWhatsApp(result.telefone, result.total, result.itens);
            
            // Limpar carrinho
            cart = [];
            saveCartToStorage();
            updateCartCount();
            
            // Fechar formulário e limpar
            form.reset();
            closeCheckoutModal();
        } else {
            const errorData = await response.text();
            console.error('Erro na resposta:', response.status, errorData);
            showNotification(`❌ Erro ao processar pedido (${response.status}).\n\nTente novamente.`);
        }
    } catch (error) {
        console.error('Erro completo:', error);
        if (error.name === 'AbortError') {
            showNotification('❌ Timeout: O servidor demorou muito a responder.');
        } else {
            showNotification(`❌ Erro de conexão:\n\n${error.message}`);
        }
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
    }
}

// Utilitários
function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('cartCount').textContent = count;
}

function saveCartToStorage() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function loadCartFromStorage() {
    const saved = localStorage.getItem('cart');
    if (saved) {
        try {
            cart = JSON.parse(saved);
            updateCartCount();
        } catch (e) {
            console.error('Erro ao carregar carrinho:', e);
        }
    }
}

function showNotification(message) {
    alert(message);
}