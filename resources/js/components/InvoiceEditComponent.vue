<template>
    <main class="invoice-editor">
        <div v-if="notice" class="notice" :class="`notice-${notice.type}`">
            <i :class="notice.type === 'success' ? 'bx bx-check-circle' : 'bx bx-info-circle'"></i>
            <span>{{ notice.message }}</span>
            <button type="button" aria-label="Dismiss notification" @click="notice = null">&times;</button>
        </div>

        <div v-if="validationMessages.length" class="notice notice-error validation-notice">
            <i class="bx bx-error-circle"></i>
            <div>
                <strong>Please check the invoice details.</strong>
                <ul>
                    <li v-for="message in validationMessages" :key="message">{{ message }}</li>
                </ul>
            </div>
            <button type="button" aria-label="Dismiss validation errors" @click="errors = {}">&times;</button>
        </div>

        <header class="editor-header">
            <div>
                <div class="eyebrow">Sales / Invoices</div>
                <h1><i class="bx bx-edit"></i> Edit Invoice</h1>
                <div class="header-meta">
                    <span>Invoice #{{ form.invoiceCode }}</span>
                    <span class="status-pill" :class="statusClass">{{ form.status || 'Draft' }}</span>
                    <span v-if="isDirty" class="unsaved"><i class="bx bxs-circle"></i> Unsaved changes</span>
                </div>
            </div>
            <div class="header-actions">
                <button type="button" class="btn btn-secondary" @click="goBack">
                    <i class="bx bx-arrow-back"></i> Back
                </button>
                <button type="button" class="btn btn-primary" :disabled="saving" @click="previewSave">
                    <i :class="saving ? 'bx bx-loader-alt bx-spin' : 'bx bx-save'"></i>
                    {{ saving ? 'Saving...' : 'Save Invoice' }}
                </button>
            </div>
        </header>

        <section class="editor-card">
            <div class="section-heading">
                <div class="section-icon"><i class="bx bx-user"></i></div>
                <div>
                    <h2>Customer information</h2>
                    <p>Review the customer and document details for this invoice.</p>
                </div>
            </div>

            <div class="form-grid">
                <label class="field">
                    <span>Company name</span>
                    <input v-model.trim="form.customer.companyName" type="text" placeholder="Customer company">
                </label>
                <label class="field">
                    <span>Contact person</span>
                    <input v-model.trim="form.customer.contactPerson" type="text" placeholder="Contact person">
                </label>
                <label class="field">
                    <span>Email address</span>
                    <input v-model.trim="form.customer.email" type="email" placeholder="customer@example.com">
                </label>
                <label class="field field-wide">
                    <span>Address</span>
                    <input v-model.trim="form.customer.address" type="text" placeholder="Customer address">
                </label>
                <label class="field">
                    <span>Phone number</span>
                    <input v-model.trim="form.customer.phone" type="tel" placeholder="Phone number">
                </label>
                <label class="field">
                    <span>Document type</span>
                    <select v-model="form.invoiceType">
                        <option value="Invoice">Invoice</option>
                        <option value="Quotation">Quotation</option>
                        <option value="Pro forma Invoice">Pro forma Invoice</option>
                    </select>
                </label>
            </div>
        </section>

        <section class="editor-card items-card">
            <div class="section-heading section-heading-actions">
                <div class="heading-copy">
                    <div class="section-icon"><i class="bx bx-list-ul"></i></div>
                    <div>
                        <h2>Invoice lines</h2>
                        <p>Add goods, services, or other charges to this invoice.</p>
                    </div>
                </div>
                <div class="line-actions">
                    <button type="button" class="btn btn-outline" @click="addLine('product')">
                        <i class="bx bx-package"></i> Add product
                    </button>
                    <button type="button" class="btn btn-outline" @click="addLine('service')">
                        <i class="bx bx-wrench"></i> Add service
                    </button>
                </div>
            </div>

            <div v-if="form.lines.length" class="table-wrap">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th class="number-column">#</th>
                            <th class="type-column">Type</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th class="money-column">Unit price</th>
                            <th class="quantity-column">Qty</th>
                            <th class="money-column">Total</th>
                            <th class="action-column"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(line, index) in form.lines" :key="line.id || line.clientKey">
                            <td class="line-number">{{ index + 1 }}</td>
                            <td>
                                <select v-model="line.lineType" class="table-input type-select">
                                    <option value="product">Product</option>
                                    <option value="service">Service</option>
                                    <option value="charge">Charge</option>
                                </select>
                            </td>
                            <td>
                                <input v-model.trim="line.itemName" class="table-input" type="text" placeholder="Item name">
                            </td>
                            <td>
                                <input v-model.trim="line.description" class="table-input" type="text" placeholder="Line description">
                            </td>
                            <td>
                                <div class="currency-input">
                                    <span>₦</span>
                                    <input v-model.number="line.unitPrice" type="number" min="0" step="0.01" placeholder="0.00">
                                </div>
                            </td>
                            <td>
                                <input v-model.number="line.quantity" class="table-input quantity-input" type="number" min="0.01" step="0.01">
                            </td>
                            <td class="line-total">{{ money(lineTotal(line)) }}</td>
                            <td>
                                <button type="button" class="icon-button remove-button" title="Remove line" @click="removeLine(index)">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="empty-lines">
                <div class="empty-icon"><i class="bx bx-receipt"></i></div>
                <h3>No invoice lines</h3>
                <p>Add a product or service to begin building this invoice.</p>
                <button type="button" class="btn btn-outline" @click="addLine('service')">
                    <i class="bx bx-plus"></i> Add first line
                </button>
            </div>
        </section>

        <div class="two-column-layout">
            <div>
                <section class="editor-card">
                    <div class="section-heading compact-heading">
                        <div class="section-icon"><i class="bx bx-purchase-tag"></i></div>
                        <div>
                            <h2>Discount</h2>
                            <p>Apply an invoice-wide discount.</p>
                        </div>
                    </div>

                    <div class="discount-options">
                        <label class="choice" :class="{ active: form.discountType === 'none' }">
                            <input v-model="form.discountType" type="radio" value="none">
                            <span>No discount</span>
                        </label>
                        <label class="choice" :class="{ active: form.discountType === 'percentage' }">
                            <input v-model="form.discountType" type="radio" value="percentage">
                            <span>Percentage</span>
                        </label>
                        <label class="choice" :class="{ active: form.discountType === 'amount' }">
                            <input v-model="form.discountType" type="radio" value="amount">
                            <span>Fixed amount</span>
                        </label>
                    </div>

                    <label v-if="form.discountType !== 'none'" class="field discount-value">
                        <span>{{ form.discountType === 'percentage' ? 'Discount percentage' : 'Discount amount' }}</span>
                        <div class="affixed-input">
                            <span v-if="form.discountType === 'amount'">₦</span>
                            <input v-model.number="form.discountValue" type="number" min="0" :max="form.discountType === 'percentage' ? 100 : null" step="0.01">
                            <span v-if="form.discountType === 'percentage'">%</span>
                        </div>
                    </label>
                </section>

                <section class="editor-card">
                    <div class="section-heading compact-heading">
                        <div class="section-icon"><i class="bx bx-building-house"></i></div>
                        <div>
                            <h2>Payment details</h2>
                            <p>Bank and payment information displayed on the invoice.</p>
                        </div>
                    </div>

                    <div class="form-grid bank-grid">
                        <label class="field">
                            <span>Payment status</span>
                            <select v-model="form.status">
                                <option value="Draft">Draft</option>
                                <option value="Unpaid">Unpaid</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </label>
                        <label class="field">
                            <span>Bank name</span>
                            <input v-model.trim="form.bankName" type="text" placeholder="Bank name">
                        </label>
                        <label class="field">
                            <span>Account name</span>
                            <input v-model.trim="form.accountName" type="text" placeholder="Account name">
                        </label>
                        <label class="field">
                            <span>Account number</span>
                            <input v-model.trim="form.accountNumber" type="text" inputmode="numeric" placeholder="Account number">
                        </label>
                    </div>
                </section>
            </div>

            <aside class="editor-card summary-card">
                <div class="section-heading compact-heading">
                    <div class="section-icon"><i class="bx bx-calculator"></i></div>
                    <div>
                        <h2>Invoice summary</h2>
                        <p>Totals update as invoice lines change.</p>
                    </div>
                </div>

                <label class="tax-toggle">
                    <span>
                        <strong>Apply VAT</strong>
                        <small>7.5% value-added tax</small>
                    </span>
                    <input v-model="form.vatIncluded" type="checkbox">
                    <span class="toggle-track"><span></span></span>
                </label>

                <div class="summary-lines">
                    <div><span>Subtotal</span><strong>{{ money(subtotal) }}</strong></div>
                    <div><span>Discount</span><strong class="negative">-{{ money(discountAmount) }}</strong></div>
                    <div><span>VAT (7.5%)</span><strong>{{ money(vatAmount) }}</strong></div>
                    <div class="grand-total"><span>Grand total</span><strong>{{ money(grandTotal) }}</strong></div>
                </div>

                <button type="button" class="btn btn-primary summary-save" :disabled="saving || !form.lines.length" @click="previewSave">
                    <i class="bx bx-save"></i> Save Invoice
                </button>
                <p class="preview-note"><i class="bx bx-shield-quarter"></i> Totals are verified again by the server when saved.</p>
            </aside>
        </div>
    </main>
</template>

<script>
export default {
    name: 'InvoiceEditComponent',

    props: {
        appurl: {
            type: String,
            default: '/'
        },
        initialInvoice: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            form: this.makeForm(this.initialInvoice),
            isDirty: false,
            saving: false,
            notice: null,
            errors: {},
            ready: false
        };
    },

    computed: {
        subtotal() {
            return this.form.lines.reduce((total, line) => total + this.lineTotal(line), 0);
        },

        discountAmount() {
            const value = Math.max(Number(this.form.discountValue) || 0, 0);

            if (this.form.discountType === 'percentage') {
                return this.subtotal * Math.min(value, 100) / 100;
            }

            if (this.form.discountType === 'amount') {
                return Math.min(value, this.subtotal);
            }

            return 0;
        },

        taxableAmount() {
            return Math.max(this.subtotal - this.discountAmount, 0);
        },

        vatAmount() {
            return this.form.vatIncluded ? this.taxableAmount * 0.075 : 0;
        },

        grandTotal() {
            return this.taxableAmount + this.vatAmount;
        },

        statusClass() {
            return `status-${String(this.form.status || 'draft').toLowerCase()}`;
        },

        validationMessages() {
            return Object.keys(this.errors).reduce((messages, key) => {
                return messages.concat(this.errors[key]);
            }, []);
        }
    },

    watch: {
        form: {
            deep: true,
            handler() {
                if (this.ready) this.isDirty = true;
            }
        }
    },

    mounted() {
        this.$nextTick(() => {
            this.ready = true;
        });
    },

    methods: {
        makeForm(invoice) {
            const customer = invoice.customer || {};
            const discountPercent = Number(invoice.discount_percent) || 0;
            const discountAmount = Number(invoice.discount_amount) || 0;

            return {
                id: invoice.id,
                invoiceCode: invoice.invoice_code || '',
                invoiceType: this.normaliseInvoiceType(invoice.invoice_type),
                status: this.normaliseStatus(invoice.status),
                vatIncluded: invoice.vat_included === true || invoice.vat_included === 1 || invoice.vat_included === 'true',
                discountType: discountPercent > 0 ? 'percentage' : (discountAmount > 0 ? 'amount' : 'none'),
                discountValue: discountPercent || discountAmount || 0,
                bankName: invoice.bank_name || '',
                accountName: invoice.account_name || '',
                accountNumber: invoice.account_no || '',
                customer: {
                    companyName: customer.company_name || '',
                    contactPerson: customer.contact_person_name || customer.conact_person_name || '',
                    email: customer.business_email || customer.email || '',
                    address: customer.address || '',
                    phone: customer.business_phone1 || customer.phone || ''
                },
                lines: (invoice.invoice_line || []).map((line, index) => ({
                    id: line.id,
                    clientKey: `existing-${line.id || index}`,
                    productId: line.product_id || null,
                    lineType: line.line_type || (line.product_id ? (line.product && line.product.type === 'service' ? 'service' : 'product') : 'service'),
                    itemName: line.item_name || (line.product && line.product.name ? line.product.name : ''),
                    description: line.description || '',
                    quantity: Number(line.quantity) || 1,
                    unitPrice: Number(line.amount) || 0
                }))
            };
        },

        normaliseInvoiceType(type) {
            const value = String(type || '').toLowerCase();
            if (value === 'quotation') return 'Quotation';
            if (value === 'pro forma invoice') return 'Pro forma Invoice';
            return 'Invoice';
        },

        normaliseStatus(status) {
            const value = String(status || '').toLowerCase();
            if (value === 'paid') return 'Paid';
            if (value === 'unpaid') return 'Unpaid';
            return 'Draft';
        },

        lineTotal(line) {
            return Math.max(Number(line.quantity) || 0, 0) * Math.max(Number(line.unitPrice) || 0, 0);
        },

        money(value) {
            return `₦${Number(value || 0).toLocaleString('en-NG', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;
        },

        addLine(type) {
            this.form.lines.push({
                id: null,
                clientKey: `new-${Date.now()}-${Math.random().toString(16).slice(2)}`,
                productId: null,
                lineType: type,
                itemName: '',
                description: '',
                quantity: 1,
                unitPrice: 0
            });

            this.$nextTick(() => {
                const rows = this.$el.querySelectorAll('.items-table tbody tr');
                const lastRow = rows[rows.length - 1];
                if (lastRow) {
                    const input = lastRow.querySelector('input');
                    if (input) input.focus();
                }
            });
        },

        removeLine(index) {
            this.form.lines.splice(index, 1);
        },

        goBack() {
            if (!this.isDirty || window.confirm('Leave this page and discard your unsaved changes?')) {
                window.history.back();
            }
        },

        async previewSave() {
            if (!this.form.lines.length) {
                this.notice = { type: 'info', message: 'Add at least one invoice line before saving.' };
                return;
            }

            this.saving = true;
            this.notice = null;
            this.errors = {};

            try {
                const response = await axios.put(
                    `${this.appurl.replace(/\/+$/, '')}/invoice/edit/${this.form.id}`,
                    this.updatePayload()
                );

                this.ready = false;
                this.form = this.makeForm(response.data.invoice);
                await this.$nextTick();
                this.isDirty = false;
                this.ready = true;
                this.notice = {
                    type: 'success',
                    message: response.data.message || 'Invoice updated successfully.'
                };
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    this.notice = null;
                } else if (error.response && error.response.status === 403) {
                    this.notice = { type: 'info', message: error.response.data.message || 'This invoice cannot be edited.' };
                } else {
                    this.notice = { type: 'info', message: 'The invoice could not be saved. Please try again.' };
                }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } finally {
                this.saving = false;
            }
        },

        updatePayload() {
            return {
                invoice_type: this.form.invoiceType,
                status: this.form.status,
                vat_included: this.form.vatIncluded,
                discount_type: this.form.discountType,
                discount_value: Number(this.form.discountValue) || 0,
                bank_name: this.form.bankName || null,
                account_name: this.form.accountName || null,
                account_number: this.form.accountNumber || null,
                customer: {
                    company_name: this.form.customer.companyName,
                    contact_person: this.form.customer.contactPerson || null,
                    email: this.form.customer.email,
                    address: this.form.customer.address,
                    phone: this.form.customer.phone
                },
                lines: this.form.lines.map(line => ({
                    id: line.id || null,
                    product_id: line.productId || null,
                    line_type: line.lineType,
                    item_name: line.itemName,
                    description: line.description || null,
                    quantity: Number(line.quantity) || 0,
                    unit_price: Number(line.unitPrice) || 0
                }))
            };
        }
    }
};
</script>

<style scoped>
* { box-sizing: border-box; }

.invoice-editor {
    min-height: 100vh;
    padding: 28px;
    color: #1f2937;
    background: #f4f7fb;
    font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

.editor-header, .editor-card, .notice { max-width: 1280px; margin-left: auto; margin-right: auto; }

.editor-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 24px;
    padding: 28px 30px;
    color: #fff;
    border-radius: 16px;
    background: linear-gradient(135deg, #4658d6 0%, #6f42c1 100%);
    box-shadow: 0 14px 34px rgba(70, 88, 214, .22);
}

.eyebrow { margin-bottom: 7px; font-size: 12px; font-weight: 700; letter-spacing: .09em; text-transform: uppercase; opacity: .72; }
.editor-header h1 { display: flex; align-items: center; gap: 10px; margin: 0; font-size: 30px; line-height: 1.2; }
.header-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; margin-top: 10px; font-size: 14px; }
.status-pill { padding: 4px 9px; border-radius: 999px; background: rgba(255,255,255,.18); font-size: 12px; font-weight: 700; }
.unsaved { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; color: #fff4b8; }
.unsaved i { font-size: 7px; }
.header-actions, .line-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 43px;
    padding: 10px 17px;
    border: 1px solid transparent;
    border-radius: 9px;
    font: inherit;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s ease;
}
.btn:hover:not(:disabled) { transform: translateY(-1px); }
.btn:disabled { opacity: .55; cursor: not-allowed; }
.btn-primary { color: #fff; background: #16a36a; box-shadow: 0 7px 16px rgba(7, 103, 68, .2); }
.btn-primary:hover:not(:disabled) { background: #11875a; }
.btn-secondary { color: #445; background: #fff; }
.btn-outline { color: #5364d8; border-color: #cfd5ff; background: #f8f9ff; }
.btn-outline:hover { border-color: #8390e9; background: #eff1ff; }

.editor-card {
    padding: 25px;
    margin-bottom: 20px;
    border: 1px solid #e8ebf2;
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 5px 18px rgba(34, 48, 73, .055);
}

.section-heading, .heading-copy { display: flex; align-items: center; gap: 13px; }
.section-heading { padding-bottom: 18px; margin-bottom: 22px; border-bottom: 1px solid #edf0f5; }
.section-heading-actions { justify-content: space-between; }
.compact-heading { align-items: flex-start; }
.section-icon { display: grid; place-items: center; flex: 0 0 42px; width: 42px; height: 42px; border-radius: 11px; color: #5867d8; background: #eef0ff; font-size: 21px; }
.section-heading h2 { margin: 0; color: #263044; font-size: 18px; }
.section-heading p { margin: 4px 0 0; color: #7b8497; font-size: 13px; }

.form-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
.field-wide { grid-column: span 2; }
.field { display: flex; flex-direction: column; gap: 7px; min-width: 0; }
.field > span { color: #495267; font-size: 13px; font-weight: 700; }
.field input, .field select, .table-input, .currency-input, .affixed-input {
    width: 100%;
    min-height: 43px;
    border: 1px solid #dce1ea;
    border-radius: 8px;
    color: #263044;
    background: #fff;
    font: inherit;
    font-size: 14px;
    transition: .2s ease;
}
.field input, .field select, .table-input { padding: 10px 11px; }
.field input:focus, .field select:focus, .table-input:focus, .currency-input:focus-within, .affixed-input:focus-within {
    outline: none;
    border-color: #6675dc;
    box-shadow: 0 0 0 3px rgba(102, 117, 220, .12);
}

.table-wrap { overflow-x: auto; border: 1px solid #e5e9f0; border-radius: 11px; }
.items-table { width: 100%; min-width: 1080px; border-collapse: collapse; }
.items-table th { padding: 12px 10px; color: #697286; background: #f7f8fb; border-bottom: 1px solid #e4e8ef; font-size: 11px; letter-spacing: .05em; text-align: left; text-transform: uppercase; }
.items-table td { padding: 10px; border-bottom: 1px solid #edf0f4; vertical-align: middle; }
.items-table tbody tr:last-child td { border-bottom: 0; }
.items-table tbody tr:hover { background: #fbfcff; }
.number-column { width: 44px; }
.type-column { width: 115px; }
.money-column { width: 145px; }
.quantity-column { width: 90px; }
.action-column { width: 52px; }
.line-number { color: #8a92a3; font-size: 13px; font-weight: 700; text-align: center; }
.table-input { min-height: 39px; }
.type-select { padding-left: 8px; }
.quantity-input { text-align: center; }
.currency-input, .affixed-input { display: flex; align-items: center; overflow: hidden; }
.currency-input span, .affixed-input span { padding-left: 10px; color: #7b8495; font-size: 13px; font-weight: 700; }
.currency-input input, .affixed-input input { width: 100%; min-width: 0; height: 39px; padding: 8px; border: 0; outline: 0; font: inherit; }
.affixed-input span:last-child { padding: 0 10px 0 0; }
.line-total { color: #33415c; font-size: 13px; font-weight: 800; white-space: nowrap; }
.icon-button { display: grid; place-items: center; width: 36px; height: 36px; border: 0; border-radius: 8px; cursor: pointer; font-size: 18px; transition: .2s ease; }
.remove-button { color: #d94958; background: #fff0f1; }
.remove-button:hover { color: #fff; background: #df4c5a; }

.empty-lines { padding: 45px 20px; text-align: center; border: 1px dashed #ccd3df; border-radius: 11px; background: #fafbfc; }
.empty-icon { display: grid; place-items: center; width: 54px; height: 54px; margin: 0 auto 12px; border-radius: 50%; color: #6877da; background: #ecefff; font-size: 28px; }
.empty-lines h3 { margin: 0; font-size: 17px; }
.empty-lines p { margin: 7px 0 17px; color: #7a8496; font-size: 13px; }

.two-column-layout { display: grid; grid-template-columns: minmax(0, 1.6fr) minmax(320px, .8fr); gap: 20px; max-width: 1280px; margin: 0 auto; align-items: start; }
.two-column-layout .editor-card { margin-left: 0; margin-right: 0; }
.summary-card { position: sticky; top: 20px; }
.discount-options { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
.choice { display: flex; align-items: center; gap: 9px; padding: 12px; border: 1px solid #dfe3eb; border-radius: 9px; color: #596277; cursor: pointer; font-size: 13px; font-weight: 700; }
.choice.active { color: #5262d0; border-color: #8e99e6; background: #f4f5ff; }
.choice input { accent-color: #5969d7; }
.discount-value { max-width: 280px; margin-top: 16px; }
.bank-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }

.tax-toggle { display: flex; align-items: center; justify-content: space-between; gap: 15px; padding: 14px; border: 1px solid #e2e6ed; border-radius: 10px; cursor: pointer; }
.tax-toggle > span:first-child { display: flex; flex-direction: column; }
.tax-toggle strong { font-size: 14px; }
.tax-toggle small { margin-top: 3px; color: #7c8597; font-size: 12px; }
.tax-toggle input { position: absolute; opacity: 0; pointer-events: none; }
.toggle-track { position: relative; flex: 0 0 43px; width: 43px; height: 24px; border-radius: 20px; background: #cbd1dc; transition: .2s; }
.toggle-track span { position: absolute; top: 3px; left: 3px; width: 18px; height: 18px; border-radius: 50%; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.2); transition: .2s; }
.tax-toggle input:checked + .toggle-track { background: #5969d7; }
.tax-toggle input:checked + .toggle-track span { transform: translateX(19px); }
.summary-lines { margin-top: 20px; }
.summary-lines > div { display: flex; justify-content: space-between; gap: 20px; padding: 9px 0; color: #697286; font-size: 14px; }
.summary-lines strong { color: #333e53; white-space: nowrap; }
.summary-lines .negative { color: #d04d5b; }
.summary-lines .grand-total { padding-top: 17px; margin-top: 8px; border-top: 1px solid #dfe3e9; color: #273249; font-size: 17px; font-weight: 800; }
.summary-lines .grand-total strong { color: #4e5fd0; font-size: 20px; }
.summary-save { width: 100%; margin-top: 20px; }
.preview-note { display: flex; align-items: flex-start; gap: 6px; margin: 12px 0 0; color: #8a92a1; font-size: 11px; line-height: 1.45; }

.notice { display: flex; align-items: center; gap: 10px; padding: 13px 16px; margin-bottom: 16px; border-radius: 10px; font-size: 13px; font-weight: 600; }
.notice i { font-size: 20px; }
.notice button { margin-left: auto; border: 0; color: inherit; background: transparent; cursor: pointer; font-size: 21px; }
.notice-success { color: #136343; border: 1px solid #bce9d4; background: #eaf9f2; }
.notice-info { color: #4856a6; border: 1px solid #ccd2f5; background: #f0f2ff; }
.notice-error { align-items: flex-start; color: #9d2f3b; border: 1px solid #f1c3c8; background: #fff0f1; }
.validation-notice strong { display: block; margin: 1px 0 5px; }
.validation-notice ul { margin: 0; padding-left: 18px; font-weight: 500; }
.validation-notice li + li { margin-top: 3px; }

@media (max-width: 980px) {
    .form-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .two-column-layout { grid-template-columns: 1fr; }
    .summary-card { position: static; }
}

@media (max-width: 720px) {
    .invoice-editor { padding: 14px; }
    .editor-header { align-items: flex-start; padding: 22px; }
    .editor-header, .section-heading-actions { flex-direction: column; }
    .header-actions, .line-actions { width: 100%; }
    .header-actions .btn, .line-actions .btn { flex: 1; }
    .editor-card { padding: 18px; }
    .form-grid, .bank-grid { grid-template-columns: 1fr; }
    .field-wide { grid-column: auto; }
    .discount-options { grid-template-columns: 1fr; }
}

@media (max-width: 430px) {
    .editor-header h1 { font-size: 24px; }
    .header-actions { flex-direction: column-reverse; }
    .header-actions .btn, .line-actions .btn { width: 100%; }
    .line-actions { flex-direction: column; }
}
</style>
