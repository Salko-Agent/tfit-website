# 🏋️‍♂️ FlexFit: Database-Less PHP & Flat-File CMS Ecosystem

> High-performance, database-less PHP website and custom flat-file editor (`bms-hub`). Replaces a legacy, bloated WordPress Elementor setup with a sub-100ms loading architecture.

![FlexFit Showcase Mockup](assets/img/logo.jpg) *(Logo placeholder)*

---

## 🔗 Links
*   **Tech Stack:** PHP 8.x, Vanilla JS, JSON Flat-File Store, Tailwind CSS, Python (migration compiler)

---

## 💡 Project Overview

### ❌ The Challenge
The training studio's original website was built on WordPress and Elementor, resulting in sluggish load times, high server resource consumption, and constant security vulnerabilities from outdated plugins. However, the business owner still required a simple user interface to dynamically edit pricing, FAQs, trainer profiles, and class times without editing code.

### 🛠️ The Solution
A custom-built, **database-less (flat-file) PHP engine**. All content is organized in a central, structured JSON file (`data/content.json`) and parsed instantly. Studio owners manage all copy and modules via a secure, local admin interface (`bms-hub`). Custom Python migration scripts automate parsing and cleaning of WordPress Elementor HTML structures into clean, reusable PHP template components.

### 🌟 Key Highlights
*   **⚡ Sub-100ms Page Loads:** Instantly serves page layouts without database overhead. Fully compatible with edge caching and scores 100/100 on Google PageSpeed.
*   **✏️ BMS Hub Flat-File Editor:** A custom-made admin panel that performs atomic file updates to the JSON structure without database locking, remaining maintenance-free and highly secure.
*   **🔄 Webhook Rebuilding:** Auto-rebuild endpoints (`_webhook.php` and `_upload-receive.php`) securely process updates from the central Zentra CMS, optimizing images to WebP on the fly.
*   **🛠️ WP Extraction Engine:** Dedicated Python parser scripts to automate cleaning and extracting raw WordPress template layouts into clean, modern markup.

---

## 🚀 Setup & Local Setup

### Prerequisites
*   Web server with PHP 8.0+ support (e.g., Apache, Laragon, XAMPP)

### Installation
1.  **Clone the repository:**
    ```bash
    git clone https://github.com/Salko-Agent/tfit-website.git
    cd tfit-website
    ```
2.  **Configure environment:**
    *   Copy `.env.example` to `.env` and set your API keys and admin password hashes.
3.  **Run Locally:**
    *   Point your local server document root (e.g. Laragon) to the folder.
    *   Open `http://localhost/bms-hub` to access the content editor.
