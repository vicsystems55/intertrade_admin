<template>

    <div>
        <!-- Record Sale Modal -->
        <div v-if="showRecordSaleModal" class="pos-modal-overlay" @click.self="closeRecordSaleModal">
            <div class="pos-modal">
                <div class="pos-modal-header">
                    <h3 class="pos-modal-title">
                        <i class="bx bx-receipt"></i> Record Sale
                    </h3>
                    <button type="button" class="pos-modal-close" @click="closeRecordSaleModal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <div class="pos-modal-body">
                    <!-- Customer Selection -->
                    <div class="form-section">
                        <label class="form-label">Select Customer <span class="text-danger">*</span></label>
                        <select v-model="selCustomer" @change="getCustomer" class="form-control">
                            <option :value="'Please select customer'">-Pick a customer-</option>
                            <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                {{ customer.company_name }} - {{ customer.conact_person_name }}
                            </option>
                        </select>
                    </div>

                    <!-- Invoice Items -->
                    <div class="invoice-items-section">
                        <h5 class="section-title">Items in Invoice</h5>
                        <div class="invoice-items-list">
                            <div v-if="invoice.invoice_line && invoice.invoice_line.length === 0" class="empty-state">
                                <p>No items added yet</p>
                            </div>
                            <div v-for="line, key in invoice.invoice_line" :key="line.id" class="invoice-item-card">
                                <div class="item-header">
                                    <div class="item-info">
                                        <span class="item-number">{{ key + 1 }}</span>
                                        <h6 class="item-name">{{ line.product.name }}</h6>
                                    </div>
                                    <button @click="removeInvoiceLine(line.id)" class="btn-remove">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                                <div class="item-details">
                                    <div class="detail-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control form-control-sm"
                                            v-model="linePrice[key]">
                                    </div>
                                    <div class="detail-group">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control form-control-sm"
                                            v-model="lineQuantity[key]">
                                    </div>
                                </div>
                                <div class="detail-group full-width">
                                    <label>Description</label>
                                    <textarea class="form-control form-control-sm" v-model="lineDescription[key]"
                                        rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Document Settings -->
                    <div class="settings-section">
                        <h5 class="section-title">Document Settings</h5>

                        <div class="form-section">
                            <label class="form-label">Select Type <span class="text-danger">*</span></label>
                            <select v-model="invoice_type" class="form-control">
                                <option :value="'Invoice'">Invoice</option>
                                <option :value="'Quotation'">Quotation</option>
                                <option :value="'Pro forma Invoice'">Pro forma Invoice</option>
                            </select>
                        </div>

                        <div class="form-section">
                            <label class="form-label">Payment Status</label>
                            <select v-model="payment_status" class="form-control">
                                <option>Paid</option>
                                <option>Unpaid</option>
                            </select>
                        </div>

                        <div class="checkbox-group">
                            <div class="form-check">
                                <input class="form-check-input" v-model="vat_included" type="checkbox" id="vatCheck">
                                <label class="form-check-label" for="vatCheck">
                                    VAT Included
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" v-model="generate_receipt" :value="'true'" type="checkbox" id="receiptCheck">
                                <label class="form-check-label" for="receiptCheck">
                                    Generate Receipt
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Details -->
                    <div class="bank-section">
                        <h5 class="section-title">Bank Details</h5>
                        <div class="form-section">
                            <label class="form-label">Bank Name</label>
                            <input type="text" v-model="bank_name" class="form-control">
                        </div>
                        <div class="form-section">
                            <label class="form-label">Account Name</label>
                            <input type="text" v-model="account_name" class="form-control">
                        </div>
                        <div class="form-section">
                            <label class="form-label">Account Number</label>
                            <input type="text" v-model="account_no" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="pos-modal-footer">
                    <button @click="resetInvoice()" class="btn btn-outline-secondary">
                        <i class="bx bx-reset"></i> Reset
                    </button>
                    <button @click="generateInvoice()" class="btn btn-primary" :disabled="generating">
                        <i class="bx bx-check" v-if="!generating"></i>
                        <span class="spinner-border spinner-border-sm me-2" v-if="generating"></span>
                        {{ generating ? 'Generating...' : 'Submit' }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Main POS Area -->
        <div class="pos-container">

        <div class="pos-container">
            <!-- Header Bar -->
            <div class="pos-header">
                <div class="header-content">
                    <h2 class="page-title"><i class="bx bx-shopping-bag"></i> Sales Manager</h2>
                    <button @click="openRecordSaleModal()" class="btn btn-primary btn-lg">
                        <i class="bx bx-plus"></i> Record Sale
                    </button>
                </div>
            </div>

            <!-- Search & Filter Section -->
            <div class="filter-section">
                <div class="search-bar">
                    <div class="search-input-wrapper">
                        <i class="bx bx-search"></i>
                        <input type="text" v-model="searchKey" placeholder="Search products..." class="search-input">
                    </div>
                    <button @click="searchProducts()" class="btn btn-search">
                        <i class="bx bx-search-alt-2"></i> Search
                    </button>
                </div>

                <!-- Category Filter -->
                <div class="category-section">
                    <h6 class="category-title">Categories</h6>
                    <div class="category-list">
                        <button @click="showAllProducts()" type="button" class="category-btn category-all">
                            <span class="category-name"><i class="bx bx-list-ul"></i> All Products</span>
                        </button>
                        <button v-for="productCategory in productCategories" :key="productCategory.id"
                            @click="sortProducts(productCategory.id)" type="button" class="category-btn">
                            <span class="category-name">{{ productCategory.name }}</span>
                            <span class="category-badge">{{ productCategory.products_count }}</span>
                        </button>
                    </div>
                </div>

                <div class="results-info">
                    <p>Showing <strong>{{ products.length }}</strong> products</p>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="products-section">
                <div v-if="loading" class="loader-container">
                    <div class="spinner"></div>
                    <p>Loading products...</p>
                </div>

                <div v-else class="products-grid">
                    <div v-if="products.length === 0" class="empty-products">
                        <i class="bx bx-inbox"></i>
                        <p>No products found</p>
                    </div>

                    <div v-for="product in products" :key="product.id" class="product-card">
                        <div class="product-image">
                            <img :src="product.featured_image" :alt="product.name">
                            <div v-if="product.stock_sum_quantity" class="stock-badge">
                                {{ product.stock_sum_quantity }} in stock
                            </div>
                            <div v-else class="stock-badge out-of-stock">
                                Out of Stock
                            </div>
                        </div>
                        <div class="product-content">
                            <h6 class="product-name">{{ product.name }}</h6>
                            <p class="product-description">{{ product.description }}</p>
                            <div class="product-footer">
                                <span class="product-price">₦{{ format(product.price) }}</span>
                                <button v-if="product.stock_sum_quantity" @click="addProduct(product.id)"
                                    class="btn-add">
                                    <i class="bx bx-plus"></i>
                                </button>
                                <button v-else class="btn-add disabled" disabled>
                                    <i class="bx bx-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>



<script>

export default {
    data() {
        return {
            searchKey: '',
            account_maps: [],
            key: '',
            my_maps: [],
            products: [],
            productCategories: [],
            invoice: '',
            invoices: [],
            current_invoice_code: null,
            lineIds: [],
            lineQuantity: [],
            lineDescription: [],
            linePrice: [],
            vat_included: false,
            generate_receipt: 'false',
            customers: [],
            selCustomer: 'Please select customer',
            invoice_type: 'Invoice',
            payment_status: 'Unpaid',
            bank_name: 'UBA',
            account_name: 'InterTrade Ltd.',
            account_no: '22002288220',
            generating: false,
            loading: false,
            showRecordSaleModal: false,
        }
    },

    props: ['appurl', 'userid'],

    methods: {
        openRecordSaleModal() {
            this.showRecordSaleModal = true;
        },

        closeRecordSaleModal() {
            this.showRecordSaleModal = false;
        },

        format(value) {
            var numeral = require('numeral');
            return numeral(value).format('N 0,0.00')
        },

        async generateInvoice() {
            if (this.selCustomer == null) {
                return alert('Please select a customer')
            }

            if (this.invoice_type == null) {
                return alert('Please select document type')
            }

            this.generating = true

            await axios({
                method: "post",
                url: this.appurl + 'api/invoice_lines',
                params: {
                    lineIds: this.lineIds,
                    lineDescription: this.lineDescription,
                    lineQuantity: this.lineQuantity,
                    linePrice: this.linePrice,
                    type: 'update-line',
                    invoice_id: this.invoice.id,
                    customer_id: this.selCustomer,
                    invoice_type: this.invoice_type,
                    vat_included: this.vat_included,
                    generate_receipt: this.generate_receipt,
                    bank_name: this.bank_name,
                    account_name: this.account_name,
                    account_no: this.account_no,
                    user_id: this.userid
                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },
            }).then((response) => {
                console.log(response)
                this.resetInvoice()
                this.generating = false
                this.closeRecordSaleModal()
                return window.open(this.appurl + 'invoice/' + this.invoice.id, '_blank')
            }).catch((err) => {
                console.log(err);
                this.generating = false
            });
        },

        addProduct(productId) {
            axios.post(this.appurl + 'api/invoices', {
                invoice_id: this.invoice.id,
                product_id: productId,
                type: 'add-product'
            }).then((response) => {
                this.invoice = response.data;
                console.log(response);
                this.getInvoice();
                alert('Product added to invoice.')
            }).catch(function (error) {
                console.log(error);
            });
        },

        createInvoice() {
            if (localStorage.getItem('current_invoice_code')) {
                this.getInvoice();
            } else {
                localStorage.setItem('current_invoice_code', Date.now());
                this.current_invoice_code = localStorage.getItem('current_invoice_code');

                axios.post(this.appurl + 'api/invoices', {
                    invoice_code: this.current_invoice_code,
                    userid: this.userid
                }).then((response) => {
                    this.invoice = response.data;
                    console.log(response);
                    this.getInvoice()
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },

        getInvoice() {
            axios({
                method: "get",
                url: this.appurl + 'api/invoices',
                params: {
                    invoice_code: localStorage.getItem('current_invoice_code'),
                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },
            }).then((response) => {
                this.invoice = response.data;
                this.lineQuantity = response.data.invoice_line.map(line => line.quantity);
                this.lineDescription = response.data.invoice_line.map(line => line.description);
                this.lineIds = response.data.invoice_line.map(line => line.id);
                this.linePrice = response.data.invoice_line.map(line => line.product.price);
                console.log(response)
            }).catch(function (error) {
                console.log(error);
            });
        },

        sortProducts(productCategory_id) {
            this.loading = true

            axios({
                method: "get",
                url: this.appurl + 'api/products-search',
                params: {
                    productCategoryId: productCategory_id,
                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },
            }).then((response) => {
                this.products = response.data;
                console.log('can sort');
                console.log(response);
                this.loadProductsWithStock();
                this.loading = false
            }).catch((error) => {
                console.log(error);
                this.loading = false
            });
        },

        searchProducts() {
            this.loading = true

            axios({
                method: "get",
                url: this.appurl + 'api/products-search-keyword',
                params: {
                    searchKey: this.searchKey,
                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },
            }).then((response) => {
                this.products = response.data;
                console.log('search results');
                console.log(response);
                this.loadProductsWithStock();
                this.loading = false
            }).catch((error) => {
                console.log(error);
                this.loading = false
            });
        },

        getProducts() {
            axios.get(this.appurl + 'api/products', {
                key: this.key,
            }).then((response) => {
                this.products = response.data;
                console.log(response)
            }).catch(function (error) {
                console.log(error);
            });
        },

        showAllProducts() {
            this.loading = true;
            this.searchKey = '';

            axios.get(this.appurl + 'api/products', {
                key: this.key,
            }).then((response) => {
                this.products = response.data;
                console.log('All products loaded:', response);
                this.loading = false;
            }).catch((error) => {
                console.log(error);
                this.loading = false;
            });
        },

        loadProductsWithStock() {
            // Get product IDs from current products
            const productIds = this.products.map(p => p.id);

            if (productIds.length === 0) return;

            // Fetch full product details with stock info
            axios({
                method: "post",
                url: this.appurl + 'api/products-stock',
                data: {
                    product_ids: productIds,
                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },
            }).then((response) => {
                // Merge stock data with existing products
                const stockMap = {};
                response.data.forEach(product => {
                    stockMap[product.id] = product.stock_sum_quantity || 0;
                });

                // Update products with correct stock values
                this.products = this.products.map(product => ({
                    ...product,
                    stock_sum_quantity: stockMap[product.id] !== undefined ? stockMap[product.id] : (product.stock_sum_quantity || 0)
                }));

                console.log('Products updated with stock info', this.products);
            }).catch((error) => {
                console.log('Could not load stock info:', error);
                // If the dedicated endpoint doesn't exist, try to get stock from main products endpoint
                this.loadProductsWithStockFallback();
            });
        },

        loadProductsWithStockFallback() {
            // Fallback: reload all products and filter them
            axios.get(this.appurl + 'api/products', {
                key: this.key,
            }).then((response) => {
                const allProducts = response.data;
                const currentIds = this.products.map(p => p.id);

                // Update current products with stock data from all products
                this.products = this.products.map(product => {
                    const fullProduct = allProducts.find(p => p.id === product.id);
                    return fullProduct ? { ...product, stock_sum_quantity: fullProduct.stock_sum_quantity || 0 } : product;
                });

                console.log('Products updated with fallback stock info', this.products);
            }).catch((error) => {
                console.log('Fallback also failed:', error);
            });
        },

        getProductCategories() {
            axios.get(this.appurl + 'api/product-category', {
                key: this.key,
            }).then((response) => {
                this.productCategories = response.data;
                console.log(response)
            }).catch(function (error) {
                console.log(error);
            });
        },

        getInvoices() {
            axios({
                method: "get",
                url: this.appurl + 'api/invoices',
                params: {
                    type: 'all',
                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },
            }).then((response) => {
                this.invoices = response.data;
                console.log(response)
            }).catch(function (error) {
                console.log(error);
            });
        },

        async resetInvoice() {
            localStorage.removeItem('current_invoice_code');
            await this.createInvoice()
            console.log('Invoice Refreshed!!')
        },

        removeInvoiceLine(invoiceLineId) {
            axios({
                method: "post",
                url: this.appurl + 'api/invoice_lines',
                params: {
                    invoice_line_id: invoiceLineId,
                    type: 'remove-item'
                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },
            }).then((response) => {
                console.log(response);
                this.getInvoice()
            }).catch(function (error) {
                console.log(error);
            });
        },

        getCustomers() {
            axios({
                method: "get",
                url: this.appurl + 'api/customers',
            }).then((response) => {
                this.customers = response.data;
                console.log(response)
            })
        },

        getCustomer() {
            return this.selCustomer;
        }
    },

    mounted() {
        console.log('Component mounted.');
        this.getProducts();
        this.getProductCategories();
        this.createInvoice();
        this.getInvoices();
        this.getCustomers();
    }
}
</script>

<style scoped>
* {
    box-sizing: border-box;
}

/* Modal Overlay */
.pos-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1050;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Modal */
.pos-modal {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: slideUp 0.4s ease-out;
}

@keyframes slideUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Modal Header */
.pos-modal-header {
    padding: 24px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.pos-modal-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.pos-modal-close {
    background: none;
    border: none;
    color: white;
    font-size: 28px;
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s;
}

.pos-modal-close:hover {
    transform: scale(1.1);
}

/* Modal Body */
.pos-modal-body {
    overflow-y: auto;
    flex: 1;
    padding: 24px;
}

.pos-modal-body::-webkit-scrollbar {
    width: 8px;
}

.pos-modal-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.pos-modal-body::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.pos-modal-body::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Form Sections */
.form-section {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-weight: 500;
    margin-bottom: 8px;
    color: #2d3748;
    font-size: 0.95rem;
}

.form-control {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
}

/* Section Titles */
.section-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 16px;
    margin-top: 20px;
    color: #2d3748;
    display: flex;
    align-items: center;
    padding-bottom: 10px;
    border-bottom: 2px solid #e2e8f0;
}

.section-title:first-child {
    margin-top: 0;
}

/* Invoice Items */
.invoice-items-section {
    margin-bottom: 24px;
}

.invoice-items-list {
    max-height: 300px;
    overflow-y: auto;
    padding-right: 8px;
}

.empty-state {
    text-align: center;
    padding: 30px 20px;
    color: #718096;
    background: #f7fafc;
    border-radius: 8px;
    border: 2px dashed #cbd5e0;
}

.invoice-item-card {
    background: #f7fafc;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 12px;
    transition: all 0.3s ease;
}

.invoice-item-card:hover {
    border-color: #667eea;
    background: #f0f4ff;
}

.item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.item-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.item-number {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: #667eea;
    color: white;
    border-radius: 50%;
    font-weight: 600;
    font-size: 0.9rem;
}

.item-name {
    margin: 0;
    color: #2d3748;
    font-size: 0.95rem;
    font-weight: 500;
}

.btn-remove {
    background: #fc8181;
    color: white;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    padding: 0;
}

.btn-remove:hover {
    background: #f56565;
    transform: scale(1.05);
}

.item-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 12px;
}

.detail-group {
    display: flex;
    flex-direction: column;
}

.detail-group.full-width {
    grid-column: 1 / -1;
}

.detail-group label {
    font-size: 0.85rem;
    font-weight: 500;
    color: #4a5568;
    margin-bottom: 6px;
}

/* Checkbox Groups */
.checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 16px;
    background: #f7fafc;
    border-radius: 8px;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-check-input {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #667eea;
}

.form-check-label {
    margin-bottom: 0;
    cursor: pointer;
    color: #2d3748;
    font-weight: 500;
}

/* Modal Footer */
.pos-modal-footer {
    padding: 16px 24px;
    border-top: 1px solid #e9ecef;
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    background: #f7fafc;
}

.btn {
    padding: 10px 16px;
    border-radius: 8px;
    border: none;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.95rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-outline-secondary {
    background: white;
    color: #4a5568;
    border: 2px solid #cbd5e0;
}

.btn-outline-secondary:hover {
    background: #edf2f7;
    border-color: #a0aec0;
}

/* Main Container */
.pos-container {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 20px;
}

/* Header */
.pos-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.page-title {
    color: white;
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
}

.btn-lg {
    padding: 12px 24px;
    font-size: 1rem;
}

/* Filter Section */
.filter-section {
    background: white;
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 30px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.search-bar {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
}

.search-input-wrapper {
    flex: 1;
    display: flex;
    align-items: center;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 0 12px;
    transition: all 0.3s ease;
    background: white;
}

.search-input-wrapper:focus-within {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.search-input-wrapper i {
    color: #a0aec0;
    font-size: 1.2rem;
}

.search-input {
    flex: 1;
    border: none;
    outline: none;
    padding: 12px;
    font-size: 0.95rem;
    background: transparent;
}

.search-input::placeholder {
    color: #cbd5e0;
}

.btn-search {
    padding: 12px 24px;
    background: #667eea;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}

.btn-search:hover {
    background: #764ba2;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
}

/* Category Section */
.category-section {
    margin-bottom: 20px;
}

.category-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 12px;
    margin-top: 0;
}

.category-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.category-btn {
    padding: 8px 16px;
    background: #f0f4ff;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    color: #2d3748;
    font-size: 0.9rem;
    white-space: nowrap;
}

.category-btn:hover {
    border-color: #667eea;
    background: #f0f4ff;
    color: #667eea;
}

.category-btn:active {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.category-name {
    display: flex;
    align-items: center;
    gap: 6px;
}

.category-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 20px;
    height: 20px;
    padding: 0 6px;
    background: #667eea;
    color: white;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.category-all {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-color: transparent;
}

.category-all:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    color: white;
    border-color: transparent;
}

.category-all .category-name {
    color: white;
    display: flex;
    align-items: center;
    gap: 6px;
}

.results-info {
    padding-top: 16px;
    border-top: 1px solid #e2e8f0;
    color: #4a5568;
    font-size: 0.9rem;
}

/* Products Section */
.products-section {
    margin-bottom: 30px;
}

.loader-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 400px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.spinner {
    width: 50px;
    height: 50px;
    border: 4px solid #e2e8f0;
    border-top-color: #667eea;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin-bottom: 16px;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 24px;
    animation: fadeIn 0.5s ease-in-out;
}

.empty-products {
    grid-column: 1 / -1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 300px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    color: #718096;
}

.empty-products i {
    font-size: 3rem;
    margin-bottom: 12px;
    opacity: 0.5;
}

/* Product Card */
.product-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

.product-image {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: #f0f4ff;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.stock-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 6px 12px;
    background: #48bb78;
    color: white;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
}

.stock-badge.out-of-stock {
    background: #f56565;
}

/* Product Content */
.product-content {
    padding: 16px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-name {
    font-size: 1rem;
    font-weight: 600;
    margin: 0 0 8px 0;
    color: #2d3748;
    line-height: 1.4;
}

.product-description {
    font-size: 0.85rem;
    color: #718096;
    margin: 0 0 12px 0;
    line-height: 1.4;
    flex: 1;
}

.product-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 12px;
    border-top: 1px solid #e2e8f0;
}

.product-price {
    font-size: 1.2rem;
    font-weight: 700;
    color: #667eea;
}

.btn-add {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: #667eea;
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: 1.2rem;
}

.btn-add:hover {
    background: #764ba2;
    transform: scale(1.1);
}

.btn-add:active {
    transform: scale(0.95);
}

.btn-add.disabled,
.btn-add:disabled {
    background: #cbd5e0;
    cursor: not-allowed;
    opacity: 0.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        gap: 16px;
    }

    .search-bar {
        flex-direction: column;
    }

    .btn-search {
        width: 100%;
        justify-content: center;
    }

    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
    }

    .pos-modal {
        width: 95%;
        max-width: none;
    }

    .page-title {
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {
    .pos-container {
        padding: 12px;
    }

    .pos-header {
        padding: 20px;
    }

    .filter-section {
        padding: 16px;
    }

    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }

    .pos-modal-footer {
        flex-direction: column;
    }

    .pos-modal-footer .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
