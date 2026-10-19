# 🧪 MyShop Testing Document
## Complete Site Testing Guide

---

## 📊 Database Statistics

### Current Users Count

| Type | Count | Table |
|------|-------|-------|
| **Admins/Employees** | **3** | `employees` |
| **Customers** | **16** | `customers` |
| **Total Users** | **19** | All tables |

### Other Counts

| Type | Count | Table |
|------|-------|-------|
| **Products** | **64** | `products` |
| **Orders** | **102** | `orders` |
| **Categories** | - | `categories` |

---

## 🚀 How The Site Works

### Architecture Overview

```
┌─────────────────────────────────────────────────────────────┐
│                    MyShop Application                        │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│   ┌─────────────┐         ┌─────────────┐                    │
│   │  Customer   │         │   Admin     │                    │
│   │  Frontend   │         │  Dashboard  │                    │
│   └──────┬──────┘         └──────┬──────┘                    │
│          │                         │                            │
│          ▼                         ▼                            │
│   ┌─────────────────────────────────────────────┐            │
│   │              Middleware                       │            │
│   │  • customer.auth (Customer routes)          │            │
│   │  • admin.auth (Admin routes)               │            │
│   └──────────────────┬────────────────────────┘            │
│                      │                                        │
│                      ▼                                        │
│   ┌─────────────────────────────────────────────┐            │
│   │              Database (MySQL)               │            │
│   │  • customers    • products                 │            │
│   │  • employees    • orders                   │            │
│   │  • carts        • ratings                 │            │
│   │  • categories   • complaints              │            │
│   │  • videos       • notifications           │            │
│   └─────────────────────────────────────────────┘            │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### User Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                      CUSTOMER FLOW                                │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│  1️⃣ Visit Site ──► Home Page (Products displayed)             │
│         │                                                        │
│         ▼                                                        │
│  2️⃣ Browse Products ──► View Details, Ratings                 │
│         │                                                        │
│         ▼                                                        │
│  3️⃣ Login/Register ──► Customer Auth (Glass UI)               │
│         │                                                        │
│         ▼                                                        │
│  4️⃣ Add to Cart ──► Cart Page                                 │
│         │                                                        │
│         ▼                                                        │
│  5️⃣ Checkout ──► Create Order                                 │
│         │                                                        │
│         ▼                                                        │
│  6️⃣ View Orders ──► Order History + Invoice                   │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                        ADMIN FLOW                                 │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│  1️⃣ Login ──► /admin/login (Auth required)                    │
│         │                                                        │
│         ▼                                                        │
│  2️⃣ Dashboard ──► Stats, Charts, Recent Activity             │
│         │                                                        │
│         ▼                                                        │
│  3️⃣ Manage Products ──► CRUD Operations                       │
│         │                                                        │
│         ▼                                                        │
│  4️⃣ Manage Orders ──► Approve/Reject                         │
│         │                                                        │
│         ▼                                                        │
│  5️⃣ Manage Employees ──► Add/Edit/Toggle Status               │
│         │                                                        │
│         ▼                                                        │
│  6️⃣ View Complaints ──► Handle Issues                        │
│         │                                                        │
│         ▼                                                        │
│  7️⃣ Settings ──► Reset Data, Backup, Maintenance              │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🧪 Testing Checklist

### 1️⃣ Customer Features

| # | Feature | URL | Test Steps | Expected Result |
|---|---------|-----|------------|-----------------|
| 1 | **Home Page** | `/` | Visit homepage | Products displayed, navbar visible |
| 2 | **Products List** | `/products` | Browse products | Grid of products with pagination |
| 3 | **Product Details** | `/products/{id}` | Click product | Product info, image, ratings |
| 4 | **Customer Register** | `/customer/register` | Glass UI register form | Create new account |
| 5 | **Customer Login** | `/customer/login` | Glass UI login form | Login with credentials |
| 6 | **Add to Cart** | `/cart/add/{id}` | Click add button | Item added to cart |
| 7 | **View Cart** | `/cart` | Visit cart page | List of cart items |
| 8 | **Update Cart** | `/cart/update/{id}` | Change quantity | Quantity updated |
| 9 | **Remove from Cart** | `/cart/remove/{id}` | Click remove | Item removed |
| 10 | **Checkout** | `/checkout` | Fill form & submit | Order created |
| 11 | **My Orders** | `/show/orders` | View orders | List of past orders |
| 12 | **Download Invoice** | `/orders/{id}/invoice` | Click download | PDF invoice downloaded |
| 13 | **Rate Product** | `/product/{id}/rate` | Submit rating | Rating saved |
| 14 | **Profile Page** | `/profile` | View profile | Avatar, info displayed |
| 15 | **Update Profile** | `/profile` | Edit & save | Profile updated |
| 16 | **Logout** | `/customer/logout` | Click logout | Redirected to login |

### 2️⃣ Admin Features

| # | Feature | URL | Test Steps | Expected Result |
|---|---------|-----|------------|-----------------|
| 1 | **Admin Login** | `/admin/login` | Login with admin credentials | Redirect to dashboard |
| 2 | **Dashboard** | `/admin/index` | View dashboard | Stats, charts visible |
| 3 | **Products CRUD** | `/admin/products` | Create/Edit/Delete | Products managed |
| 4 | **Orders Management** | `/admin/orders` | Approve/Reject | Orders updated |
| 5 | **Employees CRUD** | `/admin/employees` | Add/Toggle/Edit | Employees managed |
| 6 | **Complaints** | `/admin/complaints` | View/Delete | Complaints handled |
| 7 | **Videos** | `/admin/videos/create` | Add video | Video added |
| 8 | **Notifications** | `/admin/notifications` | View notifications | Bell badge updated |
| 9 | **Settings** | `/admin/settings` | Reset/Backup | Data reset works |
| 10 | **Logout** | `/admin/logout` | Click logout | Redirected to login |

### 3️⃣ Public Features

| # | Feature | URL | Test Steps | Expected Result |
|---|---------|-----|------------|-----------------|
| 1 | **Videos Page** | `/videos` | View videos | Videos displayed |
| 2 | **About Page** | `/aboutus` | View about | About content shown |
| 3 | **Contact Page** | `/contact` | Fill form | Message sent |
| 4 | **Language Switch** | Navbar | Click language | Locale changed |
| 5 | **Search** | `/products` | Type search | Products filtered |

### 4️⃣ Security Features

| # | Feature | Test Steps | Expected Result |
|---|---------|------------|-----------------|
| 1 | **Customer Auth** | Access `/profile` without login | Redirect to login |
| 2 | **Admin Auth** | Access `/admin/index` without login | Redirect to admin login |
| 3 | **Cart Auth** | Access `/cart` without login | Redirect to login |
| 4 | **Checkout Auth** | Access `/checkout` without login | Redirect to login |

---

## 📋 SQL Queries to Run

### Get User Counts

```sql
-- Total Customers
SELECT COUNT(*) AS total_customers FROM customers;

-- Total Admins/Employees
SELECT COUNT(*) AS total_employees FROM employees;

-- Active Employees
SELECT COUNT(*) AS active_employees FROM employees WHERE status = 'active';

-- Customers with Orders
SELECT COUNT(DISTINCT customer_id) AS customers_with_orders FROM orders;
```

### Get Other Counts

```sql
-- Total Products
SELECT COUNT(*) AS total_products FROM products;

-- Total Orders
SELECT COUNT(*) AS total_orders FROM orders;

-- Pending Orders
SELECT COUNT(*) AS pending_orders FROM orders WHERE status = 'pending';

-- Total Ratings
SELECT COUNT(*) AS total_ratings FROM ratings;

-- Total Cart Items
SELECT COUNT(*) AS cart_items FROM carts;
```

---

## 🎯 Test Scenarios

### Scenario 1: Complete Purchase Flow
```
1. Register new customer
2. Login with new account
3. Browse products
4. Add 2 products to cart
5. Update quantity of one item
6. Remove one item
7. Proceed to checkout
8. Fill shipping info
9. Submit order
10. View order in history
11. Download invoice
```

### Scenario 2: Admin Product Management
```
1. Login as admin
2. Go to products
3. Create new product
4. Edit the product
5. Delete the product
6. Check if deleted
```

### Scenario 3: Customer Profile Update
```
1. Login as customer
2. Go to profile
3. Upload avatar
4. Update name
5. Update email
6. Save changes
7. Verify changes
```

---

## 🔧 Pre-Testing Requirements

### 1. Start Services
```bash
# Start XAMPP/WAMP
# - Apache
# - MySQL (must be running!)

# Or if using Laravel Sail/Docker
php artisan sail:up
```

### 2. Clear Cache
```bash
cd C:\Users\4G\Desktop\show
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear
```

### 3. Run Migrations (if needed)
```bash
php artisan migrate
php artisan db:seed  # If you have seeders
```

### 4. Create Storage Link
```bash
php artisan storage:link
```

---

## 📁 Test Accounts

### Admin Account
```
URL: /admin/login
Email: [Check your database]
Password: [Set during registration]
```

### Customer Account
```
URL: /customer/login
Email: [Register new one]
Password: [Set during registration]
```

---

## 🐛 Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| 404 after login | Check MySQL is running |
| CSS not loading | Run `php artisan view:clear` |
| Session expired | Check session driver in config |
| Avatar not showing | Run `php artisan storage:link` |
| Database connection | Check .env file settings |

---

## ✅ Test Results Template

| # | Feature | Status | Notes |
|---|---------|--------|-------|
| 1 | Home Page | ⬜ Pass / ❌ Fail | |
| 2 | Login | ⬜ Pass / ❌ Fail | |
| 3 | Register | ⬜ Pass / ❌ Fail | |
| 4 | Products | ⬜ Pass / ❌ Fail | |
| 5 | Cart | ⬜ Pass / ❌ Fail | |
| 6 | Checkout | ⬜ Pass / ❌ Fail | |
| 7 | Orders | ⬜ Pass / ❌ Fail | |
| 8 | Profile | ⬜ Pass / ❌ Fail | |
| 9 | Admin Dashboard | ⬜ Pass / ❌ Fail | |
| 10 | Admin Products | ⬜ Pass / ❌ Fail | |

---

## 📞 Need Help?

If you encounter issues:
1. Check MySQL is running
2. Run `php artisan config:clear`
3. Check .env database settings
4. Verify all routes: `php artisan route:list`

---

**Generated**: {{ date('Y-m-d H:i:s') }}
