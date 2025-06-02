<x-app-layout>
    <div class="py-12" x-data="cartComponent()" x-init="initCart()">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
            <template x-if="loading">
                <div class="text-center py-8">Loading cart...</div>
            </template>
            <template x-if="!loading">
                <div>
                    <h2 class="text-xl font-bold mb-4">Your Cart</h2>
                    <template x-if="cart && cart.items && cart.items.length">
                        <table class="w-full mb-4">
                            <thead>
                                <tr>
                                    <th class="text-left">Product</th>
                                    <th class="text-left">Qty</th>
                                    <th class="text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="item in cart.items" :key="item.id">
                                    <tr>
                                        <td x-text="item.name"></td>
                                        <td x-text="item.quantity"></td>
                                        <td>
                                            <span x-show="item.gone" class="text-red-500">Removed</span>
                                            <span x-show="item.low_quantity && !item.gone" class="text-yellow-500">Low Stock</span>
                                            <span x-show="!item.gone && !item.low_quantity" class="text-green-500">OK</span>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </template>
                    <template x-if="!cart || !cart.items || !cart.items.length">
                        <div class="text-gray-500">Your cart is empty.</div>
                    </template>
                    <div class="mt-6">
                        <label class="block mb-2 font-semibold">Add Product</label>
                        <input type="text" class="border rounded px-3 py-2 w-full" placeholder="Search product..." x-model="searchQuery" @input.debounce.500="searchProducts">
                        <div class="bg-white border rounded mt-2" x-show="searchResults.length">
                            <template x-for="product in searchResults" :key="product.id">
                                <div class="p-2 hover:bg-gray-100 cursor-pointer flex justify-between items-center" @click="addToCart(product)">
                                    <span x-text="product.name"></span>
                                    <span class="text-xs text-gray-400">Add</span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <script>
    function cartComponent() {
        return {
            cart: null,
            cartId: null,
            loading: true,
            searchQuery: '',
            searchResults: [],
            initCart() {
                this.cartId = localStorage.getItem('cartId');
                if (!this.cartId || this.cartId === 'undefined' ) {
                    fetch('/api/cart/init')
                        .then(r => r.json())
                        .then(reponse => {
                            const data = reponse.data || reponse;
                            console.log('Cart initialized:', data);
                            this.cartId = data.id;
                            localStorage.setItem('cartId', this.cartId);
                            // Only call fetchCart after cartId is set
                            if (this.cartId) this.fetchCart();
                        });
                } else {
                    // Only call fetchCart if cartId is set
                    if (this.cartId) this.fetchCart();
                }
            },
            fetchCart() {
                if (!this.cartId) return; // Guard: don't call API if cartId is not set
                this.loading = true;
                fetch(`/api/cart/${this.cartId}`)
                    .then(r => r.json())
                    .then(reponse => {
                        const data = reponse.data || reponse;
                        this.cart = data;
                        this.loading = false;
                    });
            },
            searchProducts() {
                if (!this.searchQuery.trim()) {
                    this.searchResults = [];
                    return;
                }
                fetch(`/api/cart/${this.cartId}/items/search?q=` + encodeURIComponent(this.searchQuery))
                    .then(r => r.json())
                    .then(reponse => {
                        const data = reponse.data || reponse;
                        this.searchResults = data.items || data;
                    });
            },
            addToCart(product) {
                fetch(`/api/cart/${this.cartId}/add`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content
                    },
                    body: JSON.stringify({ product_id: product.id, quantity: 1 })
                })
                .then(r => r.json())
                .then(() => {
                    this.searchQuery = '';
                    this.searchResults = [];
                    this.fetchCart();
                });
            }
        }
    }
    </script>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
