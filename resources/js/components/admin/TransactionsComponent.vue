<template>
    <div class="transactions-container">
        <!-- Header -->
        <div class="trans-header">
            <div class="header-content">
                <h1><i class="bx bx-money"></i> Sales Dashboard</h1>
                <a href="/export-sales" target="_blank" class="btn-export">
                    <i class="bx bx-download"></i> Export Report
                </a>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="summary-card">
                <div class="card-icon total-sales">
                    <i class="bx bx-trending-up"></i>
                </div>
                <div class="card-content">
                    <h4>Total Sales</h4>
                    <div class="dual-value">
                        <p class="card-value">₦{{ format(thisMonthSales) }}</p>
                        <span class="card-ytd">₦{{ format(ytdSales) }} YTD</span>
                    </div>
                    <span class="card-subtitle">This month & Year to date</span>
                </div>
            </div>

            <div class="summary-card">
                <div class="card-icon total-orders">
                    <i class="bx bx-receipt"></i>
                </div>
                <div class="card-content">
                    <h4>Total Transactions</h4>
                    <div class="dual-value">
                        <p class="card-value">{{ thisMonthReceipts }}</p>
                        <span class="card-ytd">{{ ytdReceipts }} YTD</span>
                    </div>
                    <span class="card-subtitle">This month & Year to date</span>
                </div>
            </div>

            <div class="summary-card">
                <div class="card-icon total-customers">
                    <i class="bx bx-user-check"></i>
                </div>
                <div class="card-content">
                    <h4>Total Customers</h4>
                    <p class="card-value">{{ uniqueCustomers }}</p>
                    <span class="card-subtitle">Active customers</span>
                </div>
            </div>

            <div class="summary-card">
                <div class="card-icon avg-order">
                    <i class="bx bx-calculator"></i>
                </div>
                <div class="card-content">
                    <h4>Avg Order Value</h4>
                    <p class="card-value">₦{{ format(averageOrderValue) }}</p>
                    <span class="card-subtitle">Per transaction</span>
                </div>
            </div>
        </div>

        <!-- Top Products & Top Customers Row -->
        <div class="analytics-row">
            <!-- Best Performing Products -->
            <div class="analytics-card products-card">
                <h3 class="section-title"><i class="bx bx-star"></i> Best Performing Products</h3>
                <div class="products-list">
                    <div v-if="bestProducts.length === 0" class="empty-state">
                        <p>No products found</p>
                    </div>
                    <div v-for="(product, index) in bestProducts" :key="index" class="product-item">
                        <div class="product-rank">
                            <span class="rank-badge">{{ index + 1 }}</span>
                        </div>
                        <div class="product-info">
                            <h5>{{ product.name }}</h5>
                            <p>{{ product.count }} sales</p>
                        </div>
                        <div class="product-revenue">
                            <span class="revenue-value">₦{{ format(product.revenue) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Customers -->
            <div class="analytics-card customers-card">
                <h3 class="section-title"><i class="bx bx-crown"></i> Top Customers</h3>
                <div class="customers-list">
                    <div v-if="topCustomers.length === 0" class="empty-state">
                        <p>No customers found</p>
                    </div>
                    <div v-for="(customer, index) in topCustomers" :key="index" class="customer-item">
                        <div class="customer-rank">
                            <span class="rank-badge">{{ index + 1 }}</span>
                        </div>
                        <div class="customer-info">
                            <h5>{{ customer.name }}</h5>
                            <p>{{ customer.orders }} orders</p>
                        </div>
                        <div class="customer-total">
                            <span class="total-value">₦{{ format(customer.total) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & Tabs Section -->
        <div class="transactions-section">
            <div class="section-header">
                <h3><i class="bx bx-list-check"></i> Transaction Records</h3>
                <div class="filter-controls">
                    <select v-model="filterMonth" class="filter-select">
                        <option value="">All Months</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select v-model="filterYear" class="filter-select">
                        <option value="">All Years</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                    </select>
                </div>
            </div>

            <!-- Transaction Tabs -->
            <div class="transaction-tabs">
                <button class="tab-btn" :class="{active: activeTab === 'invoices'}" @click="activeTab = 'invoices'">
                    <i class="bx bx-file"></i> Invoices
                </button>
                <button class="tab-btn" :class="{active: activeTab === 'receipts'}" @click="activeTab = 'receipts'">
                    <i class="bx bx-receipt"></i> Receipts
                </button>
            </div>

            <!-- Search & Date Filter -->
            <div class="search-section">
                <div class="search-input">
                    <i class="bx bx-search"></i>
                    <input v-model="searchKey" type="text" placeholder="Search customer, product...">
                </div>
                <input v-model="filterDate" type="date" class="date-input">
                <button @click="applyFilters()" class="btn-filter">
                    <i class="bx bx-filter-alt"></i> Filter
                </button>
            </div>

            <!-- Invoices Table -->
            <div v-if="activeTab === 'invoices'" class="table-wrapper">
                <table class="transactions-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Products</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sale in filteredInvoices" :key="sale.id" class="table-row">
                            <td class="customer-name">
                                <a :href="'/invoice/' + sale.id">
                                    {{ sale.customer ? sale.customer.company_name : 'Unknown' }}
                                </a>
                            </td>
                            <td class="products-col">
                                <span v-for="line in sale.invoice_line.slice(0, 2)" :key="line.id" class="product-tag">
                                    {{ line.product.name }}
                                </span>
                                <span v-if="sale.invoice_line.length > 2" class="more-count">
                                    +{{ sale.invoice_line.length - 2 }}
                                </span>
                            </td>
                            <td class="items-count">{{ sale.invoice_line.length }}</td>
                            <td class="amount">₦{{ format(sale.total_amount) }}</td>
                            <td class="date">{{ formatDate(sale.created_at) }}</td>
                            <td>
                                <span class="badge badge-invoice">{{ sale.invoice_type }}</span>
                            </td>
                            <td class="action">
                                <a :href="'/invoice/' + sale.id" class="link-btn">View</a>
                            </td>
                        </tr>
                        <tr v-if="filteredInvoices.length === 0" class="empty-row">
                            <td colspan="7" style="text-align: center; padding: 40px; color: #a0aec0;">
                                <p>No invoices found</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Receipts Table -->
            <div v-if="activeTab === 'receipts'" class="table-wrapper">
                <table class="transactions-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Invoice Code</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sale in filteredReceipts" :key="sale.id" class="table-row">
                            <td class="customer-name">
                                <a :href="'/invoice/' + sale.id">
                                    {{ sale.customer ? sale.customer.company_name : 'Unknown' }}
                                </a>
                            </td>
                            <td class="invoice-code">{{ sale.invoice_code }}</td>
                            <td class="amount">₦{{ format(sale.total_amount) }}</td>
                            <td class="date">{{ formatDate(sale.created_at) }}</td>
                            <td>
                                <span class="badge badge-receipt">{{ sale.invoice_type }}</span>
                            </td>
                            <td class="action">
                                <a :href="'/invoice/' + sale.id" class="link-btn">View</a>
                            </td>
                        </tr>
                        <tr v-if="filteredReceipts.length === 0" class="empty-row">
                            <td colspan="6" style="text-align: center; padding: 40px; color: #a0aec0;">
                                <p>No receipts found</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            invoices: [],
            receipts: [],
            customers: [],
            activeTab: 'invoices',
            searchKey: '',
            filterDate: '',
            filterMonth: '',
            filterYear: '',
            bestProducts: [],
            topCustomers: [],
        }
    },

    props: ['appurl', 'userid'],

    computed: {
        allTransactions() {
            return [...this.invoices, ...this.receipts];
        },

        totalSales() {
            return this.receipts.reduce((sum, receipt) => sum + (receipt.total_amount || 0), 0);
        },

        thisMonthSales() {
            const now = new Date();
            const currentMonth = now.getMonth();
            const currentYear = now.getFullYear();

            return this.receipts.filter(receipt => {
                const date = new Date(receipt.created_at);
                return date.getMonth() === currentMonth && date.getFullYear() === currentYear;
            }).reduce((sum, receipt) => sum + (receipt.total_amount || 0), 0);
        },

        ytdSales() {
            const now = new Date();
            const currentYear = now.getFullYear();

            return this.receipts.filter(receipt => {
                const date = new Date(receipt.created_at);
                return date.getFullYear() === currentYear;
            }).reduce((sum, receipt) => sum + (receipt.total_amount || 0), 0);
        },

        totalOrders() {
            return this.receipts.length;
        },

        thisMonthReceipts() {
            const now = new Date();
            const currentMonth = now.getMonth();
            const currentYear = now.getFullYear();

            return this.receipts.filter(receipt => {
                const date = new Date(receipt.created_at);
                return date.getMonth() === currentMonth && date.getFullYear() === currentYear;
            }).length;
        },

        ytdReceipts() {
            const now = new Date();
            const currentYear = now.getFullYear();

            return this.receipts.filter(receipt => {
                const date = new Date(receipt.created_at);
                return date.getFullYear() === currentYear;
            }).length;
        },

        uniqueCustomers() {
            const customers = new Set();
            this.allTransactions.forEach(trans => {
                if (trans.customer && trans.customer.id) {
                    customers.add(trans.customer.id);
                }
            });
            return customers.size;
        },

        averageOrderValue() {
            if (this.totalOrders === 0) return 0;
            return this.totalSales / this.totalOrders;
        },

        filteredInvoices() {
            return this.filterTransactions(this.invoices);
        },

        filteredReceipts() {
            return this.filterTransactions(this.receipts);
        }
    },

    methods: {
        format(value) {
            if (value >= 1000000000) {
                return (value / 1000000000).toFixed(1) + 'B';
            } else if (value >= 1000000) {
                return (value / 1000000).toFixed(1) + 'M';
            } else if (value >= 1000) {
                return (value / 1000).toFixed(1) + 'k';
            }
            return value.toFixed(0);
        },

        formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-NG', {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            });
        },

        filterTransactions(transactions) {
            return transactions.filter(trans => {
                // Filter by month and year
                if (this.filterMonth || this.filterYear) {
                    const date = new Date(trans.created_at);
                    const month = (date.getMonth() + 1).toString();
                    const year = date.getFullYear().toString();

                    if (this.filterMonth && month !== this.filterMonth) return false;
                    if (this.filterYear && year !== this.filterYear) return false;
                }

                // Filter by date
                if (this.filterDate) {
                    const date = new Date(trans.created_at).toISOString().split('T')[0];
                    if (date !== this.filterDate) return false;
                }

                // Filter by search key
                if (this.searchKey) {
                    const key = this.searchKey.toLowerCase();
                    const customerMatch = trans.customer && trans.customer.company_name.toLowerCase().includes(key);
                    const productMatch = trans.invoice_line && trans.invoice_line.some(line =>
                        line.product.name.toLowerCase().includes(key)
                    );
                    if (!customerMatch && !productMatch) return false;
                }

                return true;
            });
        },

        applyFilters() {
            // Filters are applied via computed properties
            this.$forceUpdate();
        },

        calculateBestProducts() {
            const productMap = {};

            this.receipts.forEach(receipt => {
                receipt.invoice_line.forEach(line => {
                    const productId = line.product.id;
                    if (!productMap[productId]) {
                        productMap[productId] = {
                            name: line.product.name,
                            count: 0,
                            revenue: 0
                        };
                    }
                    productMap[productId].count += line.quantity;
                    productMap[productId].revenue += line.quantity * line.amount;
                });
            });

            this.bestProducts = Object.values(productMap)
                .sort((a, b) => b.revenue - a.revenue)
                .slice(0, 5);
        },

        calculateTopCustomers() {
            const customerMap = {};

            this.allTransactions.forEach(trans => {
                if (trans.customer && trans.customer.id) {
                    const customerId = trans.customer.id;
                    if (!customerMap[customerId]) {
                        customerMap[customerId] = {
                            name: trans.customer.company_name,
                            orders: 0,
                            total: 0
                        };
                    }
                    customerMap[customerId].orders += 1;
                    customerMap[customerId].total += trans.total_amount;
                }
            });

            this.topCustomers = Object.values(customerMap)
                .sort((a, b) => b.orders - a.orders)
                .slice(0, 5);
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
                this.invoices = response.data.filter(item => item.invoice_type !== 'receipt');
                this.receipts = response.data.filter(item => item.invoice_type === 'receipt');
                this.calculateBestProducts();
                this.calculateTopCustomers();
                console.log('Invoices loaded:', this.invoices);
            }).catch((error) => {
                console.log(error);
            });
        },

        getCustomers() {
            axios({
                method: "get",
                url: this.appurl + 'api/customers',
            }).then((response) => {
                this.customers = response.data;
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
        }
    },

    mounted() {
        console.log('Transactions Component mounted.');
        this.getInvoices();
        this.getCustomers();
    }
}
</script>

<style scoped>
:root {
    --brand-color: #159ECC;
    --brand-dark: #0d7a9c;
    --bg-light: #f8f9fa;
    --text-dark: #2d3748;
    --text-light: #718096;
    --border-color: #e2e8f0;
}

* {
    box-sizing: border-box;
}

.transactions-container {
    background: var(--bg-light);
    min-height: 100vh;
    padding: 24px;
}

/* Header */
.trans-header {
    background: linear-gradient(135deg, #159ECC 0%, #0d7a9c 50%, #159ECC 100%);
    padding: 32px;
    border-radius: 12px;
    margin-bottom: 32px;
    box-shadow: 0 10px 30px rgba(21, 158, 204, 0.3), 0 0 40px rgba(21, 158, 204, 0.15);
    position: relative;
    overflow: hidden;
}

.trans-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 1;
}

.trans-header h1 {
    color: white;
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
}

.btn-export {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: white;
    color: var(--brand-color);
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-export:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Summary Cards */
.summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 32px;
}

.summary-card {
    background: white;
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: all 0.3s ease;
    border-left: 5px solid var(--border-color);
}

.summary-card:nth-child(1) {
    border-left-color: #667eea;
}

.summary-card:nth-child(2) {
    border-left-color: #159ECC;
}

.summary-card:nth-child(3) {
    border-left-color: #f093fb;
}

.summary-card:nth-child(4) {
    border-left-color: #4facfe;
}

.summary-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    border-left-width: 6px;
}

.card-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
}

.card-icon.total-sales {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card-icon.total-orders {
    background: linear-gradient(135deg, var(--brand-color) 0%, #0088cc 100%);
}

.card-icon.total-customers {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.card-icon.avg-order {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.card-content h4 {
    margin: 0 0 8px 0;
    color: var(--text-light);
    font-size: 0.9rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card-value {
    margin: 0;
    color: var(--text-dark);
    font-size: 1.8rem;
    font-weight: 700;
}

.card-subtitle {
    font-size: 0.85rem;
    color: var(--text-light);
}

.dual-value {
    display: flex;
    align-items: baseline;
    gap: 12px;
    margin: 0;
}

.card-ytd {
    font-size: 0.75rem;
    color: var(--text-light);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 4px 8px;
    background: rgba(21, 158, 204, 0.1);
    border-radius: 4px;
}

/* Analytics Row */
.analytics-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 20px;
    margin-bottom: 32px;
}

.analytics-card {
    background: white;
    padding: 28px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border-top: 4px solid var(--brand-color);
    transition: all 0.3s ease;
}

.analytics-card.products-card {
    border-top-color: #667eea;
}

.analytics-card.customers-card {
    border-top-color: #f093fb;
}

.analytics-card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.section-title {
    margin: 0 0 24px 0;
    color: var(--text-dark);
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 16px;
    border-bottom: 2px solid var(--border-color);
}

.section-title i {
    color: var(--brand-color);
    font-size: 1.3rem;
}

/* Products List */
.products-list,
.customers-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.product-item,
.customer-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 12px;
    background: var(--bg-light);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.product-item:hover,
.customer-item:hover {
    background: #eff4f9;
}

.product-rank,
.customer-rank {
    flex-shrink: 0;
}

.rank-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: var(--brand-color);
    color: white;
    border-radius: 50%;
    font-weight: 700;
    font-size: 0.9rem;
}

.product-info,
.customer-info {
    flex: 1;
}

.product-info h5,
.customer-info h5 {
    margin: 0 0 4px 0;
    color: var(--text-dark);
    font-weight: 600;
    font-size: 0.95rem;
}

.product-info p,
.customer-info p {
    margin: 0;
    color: var(--text-light);
    font-size: 0.85rem;
}

.product-revenue,
.customer-total {
    text-align: right;
}

.revenue-value,
.total-value {
    display: block;
    color: var(--brand-color);
    font-weight: 700;
    font-size: 0.95rem;
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: var(--text-light);
}

/* Transactions Section */
.transactions-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border-top: 4px solid #159ECC;
}

.section-header {
    padding: 24px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.section-header h3 {
    margin: 0;
    color: var(--text-dark);
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-header h3 i {
    color: var(--brand-color);
}

.filter-controls {
    display: flex;
    gap: 12px;
}

.filter-select {
    padding: 10px 12px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    background: white;
    color: var(--text-dark);
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-select:focus {
    outline: none;
    border-color: var(--brand-color);
    box-shadow: 0 0 0 3px rgba(21, 158, 204, 0.1);
}

/* Transaction Tabs */
.transaction-tabs {
    display: flex;
    padding: 0 24px;
    border-bottom: 1px solid var(--border-color);
    gap: 12px;
}

.tab-btn {
    padding: 16px 24px;
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    color: var(--text-light);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.tab-btn:hover {
    color: var(--text-dark);
}

.tab-btn.active {
    color: var(--brand-color);
    border-bottom-color: var(--brand-color);
}

/* Search Section */
.search-section {
    padding: 24px;
    display: flex;
    gap: 12px;
    align-items: flex-end;
}

.search-input {
    flex: 1;
    display: flex;
    align-items: center;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    padding: 0 12px;
    transition: all 0.3s ease;
    background: white;
}

.search-input:focus-within {
    border-color: var(--brand-color);
    box-shadow: 0 0 0 3px rgba(21, 158, 204, 0.1);
}

.search-input i {
    color: var(--text-light);
    font-size: 1.2rem;
    margin-right: 8px;
}

.search-input input {
    flex: 1;
    border: none;
    padding: 12px 0;
    outline: none;
    background: transparent;
    color: var(--text-dark);
}

.search-input input::placeholder {
    color: var(--text-light);
}

.date-input {
    padding: 12px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    background: white;
    color: var(--text-dark);
    cursor: pointer;
    transition: all 0.3s ease;
}

.date-input:focus {
    outline: none;
    border-color: var(--brand-color);
    box-shadow: 0 0 0 3px rgba(21, 158, 204, 0.1);
}

.btn-filter {
    padding: 12px 20px;
    background: var(--brand-color);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}

.btn-filter:hover {
    background: var(--brand-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(21, 158, 204, 0.3);
}

/* Table */
.table-wrapper {
    overflow-x: auto;
    padding: 24px;
}

.transactions-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
}

.transactions-table thead {
    background: var(--bg-light);
}

.transactions-table th {
    padding: 16px;
    text-align: left;
    font-weight: 600;
    color: var(--text-dark);
    border-bottom: 2px solid var(--border-color);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.85rem;
}

.transactions-table td {
    padding: 16px;
    border-bottom: 1px solid var(--border-color);
}

.table-row:hover {
    background: var(--bg-light);
}

.customer-name a,
.link-btn {
    color: var(--brand-color);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.customer-name a:hover,
.link-btn:hover {
    color: var(--brand-dark);
    text-decoration: underline;
}

.products-col {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.product-tag {
    display: inline-block;
    background: #e3f2fd;
    color: var(--brand-color);
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 500;
}

.more-count {
    display: inline-block;
    background: var(--border-color);
    color: var(--text-light);
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 600;
}

.badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-invoice {
    background: #e3f2fd;
    color: var(--brand-color);
}

.badge-receipt {
    background: #f3e5f5;
    color: #7b1fa2;
}

.amount {
    color: var(--brand-color);
    font-weight: 700;
}

.date {
    color: var(--text-light);
    font-weight: 500;
}

/* Responsive */
@media (max-width: 1024px) {
    .analytics-row {
        grid-template-columns: 1fr;
    }

    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }

    .filter-controls {
        width: 100%;
    }

    .filter-select {
        flex: 1;
    }
}

@media (max-width: 768px) {
    .transactions-container {
        padding: 12px;
    }

    .header-content {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }

    .trans-header h1 {
        font-size: 1.5rem;
    }

    .summary-cards {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .summary-card {
        padding: 16px;
        flex-direction: column;
        text-align: center;
    }

    .card-icon {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
    }

    .card-value {
        font-size: 1.4rem;
    }

    .search-section {
        flex-wrap: wrap;
    }

    .search-input {
        flex: 1 1 100%;
    }

    .transactions-table {
        font-size: 0.85rem;
    }

    .transactions-table th,
    .transactions-table td {
        padding: 12px 8px;
    }
}

@media (max-width: 480px) {
    .summary-cards {
        grid-template-columns: 1fr;
    }

    .transactions-table {
        font-size: 0.8rem;
    }

    .transactions-table th,
    .transactions-table td {
        padding: 8px 4px;
    }

    .btn-filter {
        width: 100%;
        justify-content: center;
    }

    .product-item,
    .customer-item {
        flex-direction: column;
        text-align: center;
    }

    .product-revenue,
    .customer-total {
        text-align: center;
    }
}
</style>
