# FinTrackApp

FinTrackApp is a high-performance, enterprise-grade **RESTful API & Modern Financial Dashboard** engineered for precise tracking of micro-finance data, digital wallets, and QRIS payments. Built on top of **Laravel 12**, **Livewire v3**, and **Tailwind CSS**, this ecosystem provides high-throughput transaction ledger systems paired with intuitive, reactive internal governance tools.

This repository is strictly optimized for production environments, showcasing defensive programming paradigms, clean architectural separation of concerns, strict database constraints, and full type safety (PHP 8.2+).

---

## 🚀 Architectural & Engineering Highlights

- **High-Throughput Webhook Ingestion API:** Optimized RESTful endpoints built to capture, sanitize, and log complex multi-nested raw JSON payloads from third-party payment gateways and digital wallet webhooks without data dropping.
- **Dynamic Budget Guardrails:** Server-side budgeting engine that enforces monthly allocation spending caps per category with strict validation mechanisms.
- **Reactive Overspending Alerts:** A real-time event-driven notification architecture that instantly triggers alerts when specific budget thresholds are breached.
- **Single-Page Ledger Analytics Dashboard:** A modern administrative internal portal powered by Laravel Livewire v3 for real-time visual cash flow streams and balance analytics without the operational bloat of decoupled JavaScript frameworks.
- **Absolute Financial Data Precision:** Eliminates floating-point calculation discrepancies by implementing strict arithmetic precision definitions (`decimal:15,2`) across all transactional database schemas.

---

## 🛠️ Global Technology Stack

- **Core Framework:** Laravel 12 (PHP 8.2+)
- **Reactive Interface Layer:** Laravel Livewire v3 & Tailwind CSS
- **Relational Storage Engine:** PostgreSQL / MySQL (Fully indexed, relational transaction schemas)
- **API Architectural Style:** Stateless REST Architecture with JSON-API compliant resource formatting
- **Authentication & Security:** Token-based security isolation via Laravel Sanctum

---

## 📂 Production-Grade Directory Blueprint

The codebase enforces a highly decoupled layout pattern to maintain an absolute separation of concerns:

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/               # Dispatched RESTful controllers handling stateless JSON interactions
│   │   └── Web/               # Administrative views and dashboard routes
│   ├── Requests/              # Isolated Form Requests for strict incoming payload schema validation
│   └── Resources/             # Data transformation layers mapping Eloquent state to secure API payloads
├── Livewire/                  # Reactive server-driven UI components for internal ledger visualizations
└── Models/                    # Strictly typed Eloquent models encapsulating database state logic and casts
```
## 💻 Local Installation & Technical Deployment

### System Prerequisites
- PHP >= 8.2 (with open `zip` and `pdo` extensions)
- Composer Package Manager
- Node.js & NPM
- Relational Database Service (MySQL / PostgreSQL)

### Setup Workflow

1. **Clone the Infrastructure Workspace**
bash
```   git clone [https://github.com/muhamadmuhibudin/fintrackapp.git](https://github.com/muhamadmuhibudin/fintrackapp.git)
   cd fintrackapp```

2. **Provision Core Packages & Dependencies**

Bash
```   composer install
   npm install && npm run dev```

3. **Configure Environment Safeguards**

Bash
```   cp .env.example .env
   php artisan key:generate```

Note: Open the generated .env file and append your relational database credentials.

4. **Execute Transactional Schema Migrations**

Bash
```   php artisan migrate```

5. **Boot the Local Application Environment**

Bash
```   php artisan serve```

## 🧪 Production & Coding Compliance Standard
- Semantic Conventional Commits: Strict enforcement of meaningful git structures (feat(), fix(), refactor(), docs(), chore()) mapped linearly on an individual file basis.

- Defensive Static Typing: Mandatory explicit scalar type hinting, class properties definitions, and strict return types across the entire application domain.

- Idempotent Webhook Processing: Built-in validation structures guarding against duplicate webhook payloads and malicious raw data delivery.

## 📄 License
This ecosystem is open-sourced software licensed under the MIT License.