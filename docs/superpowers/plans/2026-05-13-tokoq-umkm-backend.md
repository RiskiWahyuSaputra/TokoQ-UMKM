# TokoQ-UMKM Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build a dynamic multi-tenant backend for TokoQ-UMKM, digitalizing shop operations with POS and inventory management.

**Architecture:** Multi-tenant (single database) with `shop_id` scoping. Laravel 11 with Blade views integrating existing Tailwind templates.

**Tech Stack:** Laravel 11, PHP 8.2+, MySQL/MariaDB, TailwindCSS, Alpine.js (for POS interactivity).

---

## Task 1: Database Foundation (Migrations & Models)

**Files:**
- Create: `database/migrations/2024_05_13_000001_modify_users_table.php`
- Create: `database/migrations/2024_05_13_000002_create_shops_table.php`
- Create: `database/migrations/2024_05_13_000003_create_categories_table.php`
- Create: `database/migrations/2024_05_13_000004_create_products_table.php`
- Create: `database/migrations/2024_05_13_000005_create_transactions_table.php`
- Create: `database/migrations/2024_05_13_000006_create_transaction_items_table.php`
- Modify: `app/Models/User.php`
- Create: `app/Models/Shop.php`
- Create: `app/Models/Category.php`
- Create: `app/Models/Product.php`
- Create: `app/Models/Transaction.php`
- Create: `app/Models/TransactionItem.php`

- [ ] **Step 1: Create migrations for schema**
Define the tables as per the spec (Users role/status, Shops, Categories, Products with stock status, Transactions, and Items).

- [ ] **Step 2: Run migrations**
Run: `php artisan migrate`
Expected: Successfully creates all tables.

- [ ] **Step 3: Define Models and Relationships**
Set up `hasMany`, `belongsTo`, and `belongsToMany` relationships between User, Shop, Product, and Transaction.

- [ ] **Step 4: Verify relationships with a seed or test**
Write a simple test to verify that a User can have a Shop, and a Shop can have Products.

## Task 2: Authentication & Onboarding

**Files:**
- Modify: `routes/web.php`
- Create: `app/Http/Controllers/Auth/OnboardingController.php`
- Create: `app/Http/Controllers/Admin/ValidationController.php`
- Create: `resources/views/auth/register-owner.blade.php`
- Create: `resources/views/admin/pending-shops.blade.php`

- [ ] **Step 1: Implement Owner Registration**
Create a form for UMKM owners to register. Set default `role` to `owner` and `status` to `pending`.

- [ ] **Step 2: Implement Admin Validation Dashboard**
Create a view for the Super Admin (role: `admin`) to list `pending` owners and a button to set their status to `active`.

- [ ] **Step 3: Implement Middleware for Active Status**
Create a middleware `EnsureAccountIsActive` to prevent `pending` owners from accessing the dashboard.

- [ ] **Step 4: Integrate Landing Page "Masuk" button**
Update `public/template/landing_page_tokoq/code.html` (copy to `resources/views/landing.blade.php`) to point to the login route.

## Task 3: Inventory Management (CRUD)

**Files:**
- Create: `app/Http/Controllers/ProductController.php`
- Create: `app/Http/Controllers/CategoryController.php`
- Create: `resources/views/owner/inventory/index.blade.php`
- Create: `resources/views/owner/inventory/create.blade.php`

- [ ] **Step 1: Implement Category CRUD**
Allow owners to manage their private product categories.

- [ ] **Step 2: Implement Product CRUD with Stock Logic**
Allow owners to add products. Implement `save` logic that automatically sets `status` (aman/menipis/kritis) based on the `stock` value.

- [ ] **Step 3: Integrate Inventory UI**
Port `public/template/inventaris_produk_tokoq/code.html` to Blade, making the product list dynamic.

## Task 4: POS System (Interactive Kasir)

**Files:**
- Create: `app/Http/Controllers/PosController.php`
- Create: `resources/views/owner/pos/index.blade.php`
- Create: `app/Services/TransactionService.php`

- [ ] **Step 1: Dynamic Product Catalog in POS**
Fetch and display products for the logged-in owner's shop. Implement search and category filters.

- [ ] **Step 2: Cart Logic (JavaScript)**
Use Alpine.js or Vanilla JS to manage the cart state (add/remove items, update quantity, calculate subtotal).

- [ ] **Step 3: Checkout Endpoint**
Create a POST route to `api/transactions` or `web/pos/checkout` that:
1. Validates stock availability.
2. Creates a `Transaction` and `TransactionItems`.
3. Decrements product stock.
4. Returns success data.

- [ ] **Step 4: Integrate POS UI**
Port `public/template/kasir_pos_tokoq/code.html` to Blade, binding the cart buttons and search input to the logic.

## Task 5: Dashboard & Analytics

**Files:**
- Create: `app/Http/Controllers/DashboardController.php`
- Create: `resources/views/owner/dashboard.blade.php`

- [ ] **Step 1: Implement Analytics Queries**
Write queries for:
- `Omzet Hari Ini` (Daily Revenue).
- `Produk Terlaris` (Top 5 transaction_items).
- `7-Day Revenue Trend`.

- [ ] **Step 2: Integrate Dashboard UI**
Port `public/template/dashboard_pemilik_tokoq/code.html` to Blade, populating the metric cards and "Stok Kritis" table with real data.

- [ ] **Step 3: Final Verification**
Conduct an end-to-end test: Register -> Activate -> Add Product -> Sell via POS -> Check Dashboard.
