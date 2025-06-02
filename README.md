# FinTrackApp

FinTrackApp is a high-performance, enterprise-grade **RESTful API & Modern Financial Dashboard** engineered for precise tracking of micro-finance data, digital wallets, and QRIS payments.

Built on top of **Laravel 12**, **Livewire v3**, and **Tailwind CSS**, this ecosystem provides high-throughput transaction ledger systems paired with intuitive, reactive internal governance tools.

This repository is strictly optimized for production environments, showcasing defensive programming paradigms, clean architectural separation of concerns, strict database constraints, and full type safety (PHP 8.2+).

---

# 🚀 Architectural & Engineering Highlights

- **High-Throughput Webhook Ingestion API**  
  Optimized RESTful endpoints built to capture, sanitize, and log complex multi-nested raw JSON payloads from third-party payment gateways and digital wallet webhooks without data dropping.

- **Dynamic Budget Guardrails**  
  Server-side budgeting engine that enforces monthly allocation spending caps per category with strict validation mechanisms.

- **Reactive Overspending Alerts**  
  A real-time event-driven notification architecture that instantly triggers alerts when specific budget thresholds are breached.

- **Single-Page Ledger Analytics Dashboard**  
  A modern administrative internal portal powered by Laravel Livewire v3 for real-time visual cash flow streams and balance analytics without the operational bloat of decoupled JavaScript frameworks.

- **Absolute Financial Data Precision**  
  Eliminates floating-point calculation discrepancies by implementing strict arithmetic precision definitions (`decimal:15,2`) across all transactional database schemas.

---

# 🛠️ Global Technology Stack

- **Core Framework:** Laravel 12 (PHP 8.2+)
- **Reactive Interface Layer:** Laravel Livewire v3 & Tailwind CSS
- **Relational Storage Engine:** PostgreSQL / MySQL
- **API Architectural Style:** Stateless REST Architecture with JSON-API compliant resource formatting
- **Authentication & Security:** Laravel Sanctum

---

# 📂 Production-Grade Directory Blueprint

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/               # Stateless JSON API controllers
│   │   └── Web/               # Dashboard and web controllers
│   ├── Requests/              # Form Request validation layers
│   └── Resources/             # API transformation resources
├── Livewire/                  # Reactive server-driven UI components
└── Models/                    # Strictly typed Eloquent models
```

---

# 💻 Local Installation & Technical Deployment

## System Prerequisites

Before starting, ensure your environment includes:

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL or PostgreSQL
- PHP Extensions:
  - `pdo`
  - `zip`

---

## 1. Clone the Repository

```bash
git clone https://github.com/muhamadmuhibudin/fintrackapp.git

cd fintrackapp
```

---

## 2. Install Backend & Frontend Dependencies

```bash
composer install

npm install
npm run dev
```

---

## 3. Configure Environment Variables

```bash
cp .env.example .env

php artisan key:generate
```

Then update your `.env` database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fintrackapp
DB_USERNAME=root
DB_PASSWORD=
```

---

## 4. Run Database Migrations

```bash
php artisan migrate
```

---

## 5. Start the Local Development Server

```bash
php artisan serve
```

---

# 🧪 Production & Coding Compliance Standard

- **Semantic Conventional Commits**  
  Strict enforcement of structured commit naming:
  - `feat()`
  - `fix()`
  - `refactor()`
  - `docs()`
  - `chore()`

- **Defensive Static Typing**  
  Mandatory explicit scalar typing, typed properties, and strict return types across the application domain.

- **Idempotent Webhook Processing**  
  Validation mechanisms preventing duplicate webhook ingestion and malicious payload re-delivery.

---

# 📄 License

This project is open-sourced software licensed under the MIT License.