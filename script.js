// Responsive navigation
const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');
if (bar && nav) bar.addEventListener('click', () => nav.classList.add('active'));
if (close && nav) close.addEventListener('click', () => nav.classList.remove('active'));

// Shopping cart data is stored in localStorage, so it remains available between pages.
const CART_STORAGE_KEY = 'caraFashionCart';
function getCart() {
  try { return JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || []; }
  catch (error) { return []; }
}
function saveCart(cart) {
  localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
  updateCartBadges();
}
function updateCartBadges() {
  const count = getCart().reduce((sum, item) => sum + Number(item.quantity || 0), 0);
  document.querySelectorAll('#navbar a[href="cart.html"]').forEach(link => {
    link.classList.add('cart-nav-link');
    let badge = link.querySelector('.cart-count');
    if (!badge) { badge = document.createElement('span'); badge.className = 'cart-count'; link.appendChild(badge); }
    badge.textContent = count;
    badge.style.display = count ? 'inline-flex' : 'none';
    link.setAttribute('aria-label', `Shopping cart, ${count} items`);
  });
}
function productFromCard(card) {
  if (!card) return null;
  const image = card.querySelector('.product-image img');
  const title = card.querySelector('.product-title');
  const brand = card.querySelector('.product-brand');
  const priceElement = card.querySelector('.product-price');
  if (!image || !title || !priceElement) return null;
  const price = Number(priceElement.textContent.replace(/[^0-9.]/g, ''));
  if (!Number.isFinite(price)) return null;
  return { id: image.getAttribute('src') + '|' + title.textContent.trim(), name: title.textContent.trim(), brand: brand ? brand.textContent.trim() : '', image: image.getAttribute('src'), price, quantity: 1 };
}
function addToCart(product, quantity = 1) {
  if (!product) return;
  const cart = getCart();
  const existing = cart.find(item => item.id === product.id);
  if (existing) existing.quantity = Number(existing.quantity) + Number(quantity);
  else cart.push({ ...product, quantity: Math.min(99, Math.max(1, Number(quantity) || 1)) });
  saveCart(cart);
  alert(`${product.name} added to your cart!`);
}

// Product-card cart buttons on Home and Shop pages.
document.querySelectorAll('.product-card .cart-button').forEach(button => {
  button.addEventListener('click', event => {
    event.preventDefault();
    event.stopPropagation(); // prevents shop cards from opening the product page
    addToCart(productFromCard(button.closest('.product-card')));
  });
});

// Add the product displayed on the single-product page.
const detailSection = document.querySelector('#prodetails .single-pro-details');
if (detailSection) {
  const detailButton = detailSection.querySelector('button.normal');
  if (detailButton) detailButton.addEventListener('click', () => {
    const image = document.getElementById('MainImg');
    const headings = detailSection.querySelectorAll('h4');
    const title = headings.length ? headings[0] : null;
    const priceElement = detailSection.querySelector('h2');
    const quantityInput = document.getElementById('detail-quantity');
    const price = Number((priceElement?.textContent || '').replace(/[^0-9.]/g, ''));
    const quantity = Math.min(99, Math.max(1, parseInt(quantityInput?.value, 10) || 1));
    if (image && title && price > 0) addToCart({ id: image.getAttribute('src') + '|' + title.textContent.trim(), name: title.textContent.trim(), brand: 'Fashion', image: image.getAttribute('src'), price, quantity: 1 }, quantity);
  });
}

function formatMoney(amount) { return '$' + Number(amount).toFixed(2); }
function renderCart() {
  const cartBody = document.getElementById('cart-items');
  if (!cartBody) return;
  const cart = getCart();
  const emptyMessage = document.getElementById('cart-empty');
  const tableWrap = document.getElementById('cart-table-wrap');
  const invoice = document.getElementById('invoice-summary');
  cartBody.innerHTML = '';
  if (!cart.length) {
    if (emptyMessage) emptyMessage.hidden = false;
    if (tableWrap) tableWrap.hidden = true;
    if (invoice) invoice.hidden = true;
    updateCartBadges();
    return;
  }
  if (emptyMessage) emptyMessage.hidden = true;
  if (tableWrap) tableWrap.hidden = false;
  if (invoice) invoice.hidden = false;
  cart.forEach(item => {
    const row = document.createElement('tr');
    const removeCell = document.createElement('td');
    const removeButton = document.createElement('button');
    removeButton.className = 'remove-cart-item'; removeButton.type = 'button';
    removeButton.title = 'Remove product'; removeButton.setAttribute('aria-label', `Remove ${item.name}`);
    removeButton.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
    removeButton.addEventListener('click', () => { saveCart(getCart().filter(product => product.id !== item.id)); renderCart(); });
    removeCell.appendChild(removeButton);
    const imageCell = document.createElement('td');
    const image = document.createElement('img'); image.src = item.image; image.alt = item.name; image.className = 'cart-product-image'; imageCell.appendChild(image);
    const nameCell = document.createElement('td'); nameCell.className = 'cart-product-name'; nameCell.textContent = item.name;
    const priceCell = document.createElement('td'); priceCell.textContent = formatMoney(item.price);
    const quantityCell = document.createElement('td');
    const quantityInput = document.createElement('input'); quantityInput.className = 'cart-quantity'; quantityInput.type = 'number'; quantityInput.min = '1'; quantityInput.max = '99'; quantityInput.value = item.quantity; quantityInput.setAttribute('aria-label', `Quantity for ${item.name}`);
    quantityInput.addEventListener('change', () => {
      const newQuantity = Math.min(99, Math.max(1, parseInt(quantityInput.value, 10) || 1));
      saveCart(getCart().map(product => product.id === item.id ? { ...product, quantity: newQuantity } : product)); renderCart();
    });
    quantityCell.appendChild(quantityInput);
    const totalCell = document.createElement('td'); totalCell.className = 'line-total'; totalCell.textContent = formatMoney(item.price * item.quantity);
    row.append(removeCell, imageCell, nameCell, priceCell, quantityCell, totalCell); cartBody.appendChild(row);
  });
  const subtotal = cart.reduce((sum, item) => sum + Number(item.price) * Number(item.quantity), 0);
  const shipping = subtotal === 0 || subtotal >= 100 ? 0 : 5;
  document.getElementById('invoice-date').textContent = new Date().toLocaleDateString();
  document.getElementById('invoice-subtotal').textContent = formatMoney(subtotal);
  document.getElementById('invoice-shipping').textContent = shipping === 0 ? 'FREE' : formatMoney(shipping);
  document.getElementById('invoice-total').textContent = formatMoney(subtotal + shipping);
  document.getElementById('invoice-number').textContent = 'ESTORE-' + Date.now().toString().slice(-8);
  updateCartBadges();
}
const printButton = document.getElementById('print-invoice');
if (printButton) printButton.addEventListener('click', () => window.print());
const clearCartButton = document.getElementById('clear-cart');
if (clearCartButton) clearCartButton.addEventListener('click', () => {
  if (getCart().length && confirm('Remove all products from your cart?')) { saveCart([]); renderCart(); }
});
const checkoutButton = document.getElementById('checkout-button');
if (checkoutButton) checkoutButton.addEventListener('click', () => {
  if (!getCart().length) alert('Your cart is empty.');
  else alert('Your invoice is ready. This demo does not process real payments.');
});
updateCartBadges();
renderCart();


/* API Section */

async function loadApiProducts() {
    const container = document.getElementById("api-products");
    const errorMessage = document.getElementById("api-error");

    // Run only on pages containing the API section
    if (!container) return;

    try {
        const response = await fetch(
            "https://fakestoreapi.com/products"
        );

        if (!response.ok) {
            throw new Error("Unable to fetch products");
        }

        // Convert the response into JavaScript data
        const products = await response.json();

        // Clear the loading message
        container.replaceChildren();

        // Display each product
        products.forEach(function (product) {
            const card = document.createElement("div");
            card.className = "pro";

            const image = document.createElement("img");
            image.src = product.image;
            image.alt = product.title;
            image.loading = "lazy";

            const description = document.createElement("div");
            description.className = "des";

            const category = document.createElement("span");
            category.textContent = product.category;

            const name = document.createElement("h5");
            name.textContent = product.title;

            const price = document.createElement("h4");
            price.textContent = "$" + Number(product.price).toFixed(2);

            description.append(category, name, price);
            card.append(image, description);
            container.appendChild(card);
        });

    } catch (error) {
        console.error("API Error:", error);

        container.replaceChildren();

        if (errorMessage) {
            errorMessage.textContent =
                "Products could not be loaded. Please try again later.";
        }
    }
}

// Load products when the page is ready
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", loadApiProducts);
} else {
    loadApiProducts();
}
