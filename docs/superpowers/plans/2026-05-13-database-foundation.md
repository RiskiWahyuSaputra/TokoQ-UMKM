# TokoQ-UMKM Database Foundation Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Implement the multi-tenant database schema (migrations and models) for TokoQ-UMKM.

**Architecture:** A multi-tenant system where `Shop` is the central entity. `User` can be an owner. `Category`, `Product`, `Transaction`, and `TransactionItem` belong to a `Shop`.

**Tech Stack:** Laravel (PHP), SQLite.

---

### Task 1: Test Setup and Initial Failing Test

**Files:**
- Create: `tests/Feature/DatabaseFoundationTest.php`

- [ ] **Step 1: Write the failing test**

```php
<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseFoundationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_have_a_shop()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $shop = Shop::create([
            'owner_id' => $user->id,
            'name' => 'Toko Saya',
            'slug' => 'toko-saya',
        ]);

        $this->assertEquals('Toko Saya', $user->shop->name);
    }

    public function test_shop_can_have_categories_and_products()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $shop = Shop::create([
            'owner_id' => $user->id,
            'name' => 'Toko Saya',
            'slug' => 'toko-saya',
        ]);

        $category = Category::create([
            'shop_id' => $shop->id,
            'name' => 'Elektronik',
        ]);

        $product = Product::create([
            'shop_id' => $shop->id,
            'category_id' => $category->id,
            'name' => 'Laptop',
            'sku' => 'LP-001',
            'price' => 10000000,
            'stock' => 15,
        ]);

        $this->assertCount(1, $shop->categories);
        $this->assertCount(1, $shop->products);
        $this->assertEquals('aman', $product->status);
    }

    public function test_product_status_logic()
    {
        $product = new Product(['stock' => 15]);
        $this->assertEquals('aman', $product->status);

        $product->stock = 8;
        $this->assertEquals('menipis', $product->status);

        $product->stock = 3;
        $this->assertEquals('kritis', $product->status);
    }

    public function test_shop_can_have_transactions_with_items()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $shop = Shop::create([
            'owner_id' => $user->id,
            'name' => 'Toko Saya',
            'slug' => 'toko-saya',
        ]);

        $transaction = Transaction::create([
            'shop_id' => $shop->id,
            'total_amount' => 100000,
            'discount_amount' => 0,
            'net_amount' => 100000,
            'payment_method' => 'tunai',
        ]);

        $product = Product::create([
            'shop_id' => $shop->id,
            'name' => 'Kopi',
            'sku' => 'KP-001',
            'price' => 50000,
            'stock' => 20,
        ]);

        $item = TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price_at_sale' => 50000,
        ]);

        $this->assertCount(1, $shop->transactions);
        $this->assertCount(1, $transaction->items);
        $this->assertEquals(2, $transaction->items->first()->quantity);
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test tests/Feature/DatabaseFoundationTest.php`
Expected: FAIL (Classes not found, migrations missing)

- [ ] **Step 3: Commit**

```bash
git add tests/Feature/DatabaseFoundationTest.php
git commit -m "test: add DatabaseFoundationTest"
```

---

### Task 2: User and Shop Migrations

**Files:**
- Create: `database/migrations/2024_05_13_000001_modify_users_table.php`
- Create: `database/migrations/2024_05_13_000002_create_shops_table.php`

- [ ] **Step 1: Implement modify users table migration**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $column) {
            $column->string('role')->default('owner'); // admin, owner
            $column->string('status')->default('active'); // pending, active
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $column) {
            $column->dropColumn(['role', 'status']);
        });
    }
};
```

- [ ] **Step 2: Implement create shops table migration**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo_path')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
```

- [ ] **Step 3: Run migrations**

Run: `php artisan migrate`
Expected: SUCCESS

- [ ] **Step 4: Commit**

```bash
git add database/migrations/
git commit -m "migration: modify users and create shops table"
```

---

### Task 3: Category and Product Migrations

**Files:**
- Create: `database/migrations/2024_05_13_000003_create_categories_table.php`
- Create: `database/migrations/2024_05_13_000004_create_products_table.php`

- [ ] **Step 1: Implement create categories table migration**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
```

- [ ] **Step 2: Implement create products table migration**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('name');
            $table->string('sku')->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('stock')->default(0);
            $table->string('status')->default('aman'); // aman, menipis, kritis
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```

- [ ] **Step 3: Run migrations**

Run: `php artisan migrate`

- [ ] **Step 4: Commit**

```bash
git add database/migrations/
git commit -m "migration: create categories and products table"
```

---

### Task 4: Transaction Migrations

**Files:**
- Create: `database/migrations/2024_05_13_000005_create_transactions_table.php`
- Create: `database/migrations/2024_05_13_000006_create_transaction_items_table.php`

- [ ] **Step 1: Implement create transactions table migration**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->decimal('total_amount', 15, 2);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('net_amount', 15, 2);
            $table->string('payment_method'); // tunai, qris, e-wallet
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
```

- [ ] **Step 2: Implement create transaction items table migration**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price_at_sale', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};
```

- [ ] **Step 3: Run migrations**

Run: `php artisan migrate`

- [ ] **Step 4: Commit**

```bash
git add database/migrations/
git commit -m "migration: create transactions and transaction_items table"
```

---

### Task 5: User and Shop Models

**Files:**
- Modify: `app/Models/User.php`
- Create: `app/Models/Shop.php`

- [ ] **Step 1: Update User model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function shop(): HasOne
    {
        return $this->hasOne(Shop::class, 'owner_id');
    }
}
```

- [ ] **Step 2: Create Shop model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'logo_path',
        'description',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
```

- [ ] **Step 3: Commit**

```bash
git add app/Models/
git commit -m "model: update User and create Shop model"
```

---

### Task 6: Category, Product, Transaction Models

**Files:**
- Create: `app/Models/Category.php`
- Create: `app/Models/Product.php`
- Create: `app/Models/Transaction.php`
- Create: `app/Models/TransactionItem.php`

- [ ] **Step 1: Create Category model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'name'];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
```

- [ ] **Step 2: Create Product model with status logic**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'category_id',
        'name',
        'sku',
        'price',
        'stock',
        'image_path',
    ];

    protected function status(): Attribute
    {
        return Attribute::get(function () {
            if ($this->stock > 10) return 'aman';
            if ($this->stock >= 5) return 'menipis';
            return 'kritis';
        });
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
```

- [ ] **Step 3: Create Transaction and TransactionItem models**

```php
// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'total_amount',
        'discount_amount',
        'net_amount',
        'payment_method',
    ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
}

// app/Models/TransactionItem.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price_at_sale',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
```

- [ ] **Step 4: Run tests to verify everything passes**

Run: `php artisan test tests/Feature/DatabaseFoundationTest.php`
Expected: PASS

- [ ] **Step 5: Commit**

```bash
git add app/Models/
git commit -m "model: create Category, Product, Transaction, and TransactionItem models"
```
