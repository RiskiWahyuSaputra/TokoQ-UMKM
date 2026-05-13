# Design Spec: TokoQ-UMKM Backend Implementation

**Date:** 2026-05-13
**Status:** Approved
**Topic:** Digitalizing MSMEs with a dynamic Laravel backend based on custom UI templates.

## 1. Executive Summary
TokoQ-UMKM is a multi-tenant platform designed to help Indonesian MSMEs (UMKM) digitalize their operations. The platform provides a custom POS (Point of Sale) system, inventory management, and a business dashboard with analytics. The backend will be built using Laravel 11, integrating existing UI templates while providing data isolation for different shop owners.

## 2. Architecture & Tech Stack
- **Framework:** Laravel 11 (PHP 8.2+)
- **Database:** MySQL/MariaDB (as per user's `.env`)
- **Tenancy:** Multi-tenant (Single Database) with `shop_id` scoping for all business data.
- **Frontend:** Laravel Blade, TailwindCSS (integrated from existing templates), and Alpine.js or Vanilla JS for POS interactivity.
- **Authentication:** Laravel Fortify or Breeze (standard session-based auth) with custom roles.

## 3. Roles & Permissions
- **Super Admin:**
  - View all registered UMKM.
  - Validate and activate UMKM accounts (Onboarding process).
- **Shop Owner:**
  - Manage their own Shop profile.
  - Manage private product categories and inventory.
  - Use the POS system for sales.
  - View shop-specific analytics and reports.

## 4. Database Schema

### `users`
- `id`, `name`, `email`, `password`, `role` (admin, owner), `status` (pending, active), `remember_token`, `timestamps`.

### `shops`
- `id`, `owner_id` (FK: users.id), `name`, `slug`, `logo_path`, `description`, `timestamps`.

### `categories`
- `id`, `shop_id` (FK: shops.id), `name`, `timestamps`.

### `products`
- `id`, `shop_id` (FK: shops.id), `category_id` (FK: categories.id), `name`, `sku`, `description`, `price`, `stock`, `image_path`, `status` (aman, menipis, kritis), `timestamps`.

### `transactions`
- `id`, `shop_id` (FK: shops.id), `total_amount`, `discount_amount`, `net_amount`, `payment_method` (tunai, qris, e-wallet), `notes`, `timestamps`.

### `transaction_items`
- `id`, `transaction_id` (FK: transactions.id), `product_id` (FK: products.id), `quantity`, `price_at_sale`, `timestamps`.

## 5. Feature Requirements

### Onboarding & Authentication
- Landing page with Login/Register links.
- Registration for Shop Owners (Status: Pending).
- Admin dashboard to list pending owners and "Activate" them.
- Login redirects based on role and status.

### Inventory Management
- CRUD for Products.
- Automatic stock status update logic:
  - `aman`: Stock > 10
  - `menipis`: Stock 5 - 10
  - `kritis`: Stock < 5
- Filter by category and status.

### POS Kasir
- Product search by name or SKU.
- Filter products by category.
- Shopping cart (client-side state).
- Checkout process: Select payment method -> Save transaction -> Update product stock -> Show success popup.

### Dashboard & Reporting
- Daily/Weekly Omzet (Revenue) calculation.
- Average transaction value.
- Best selling products (Top 5).
- Hourly peak sales (Jam teramai).
- 7-day revenue trend chart.
- Report generation (Daily/Monthly summaries).

## 6. Implementation Plan (Phased)
1. **Foundation:** Setup migrations, models, and relationships. Configure Auth.
2. **Onboarding:** Implement Landing Page dynamic routes and Admin Validation flow.
3. **Inventory:** Build Product and Category management.
4. **POS System:** Implement the checkout logic and cart management.
5. **Dashboard:** Build the analytics queries and charts.

## 7. Spec Self-Review
1. **Placeholder scan:** AI Prediction (Prediksi AI) is noted as a future placeholder as per user request ("AI insight itu nanti saja").
2. **Internal consistency:** Multi-tenancy is consistently applied via `shop_id`.
3. **Scope check:** The scope is large but well-defined. We will build it incrementally.
4. **Ambiguity check:** "Validation" is clearly defined as an Admin action to activate pending owners.
