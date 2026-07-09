# 🏋️‍♂️ FlexFit Website & Flat-File CMS Ecosystem

A high-performance, database-less (flat-file) PHP & JSON content engine built to replace a legacy, resource-heavy WordPress Elementor installation.

---

## 🚀 Key Features

*   **WordPress Extraction Engine:** Integrates custom Python compilation scripts that take Elementor HTML layouts and convert them into native, modular PHP templates.
*   **JSON-Based Flat-File Database:** Core content, trainer profiles, FAQs, prices, and SEO configurations are structured in `data/content.json` to enable instantaneous pages loads without MySQL bottlenecks.
*   **BMS Hub Flat-File CMS:** A custom-built, secure admin interface (`bms-hub`) that lets the client update copy, FAQs, and price structures directly via the browser. Modifications are dynamically compiled and written atomically.
*   **Webhook Rebuilding:** Integrates with Zentra CMS and automated webhooks (`_webhook.php`, `_upload-receive.php`) to automatically fetch latest content and process images into optimized WebP formats on update.
*   **Sub-100ms Page Load Speeds:** Fully caching-compatible, responsive, and lightweight structure resulting in near-perfect PageSpeed scores.

---

## 🛠️ Tech Stack

*   **Backend:** PHP 8.x (Routing, templates parsing, JSON handler)
*   **CMS Administration:** HTML5, CSS3, ES6+ Javascript
*   **Asset Management:** Tailwind CSS utilities
*   **Build Scripts:** Python 3.12 (HTML extractors, data parsing, structural audits)

---

## 📂 Project Structure

```
├── bms-hub/                   # Admin dashboard (CMS Editor)
│   ├── config.php             # Session configuration & admin credentials
│   ├── content-editor.php     # Dynamic content editor interface
│   └── index.php              # Auth & admin gateway
├── data/
│   └── content.json           # Central flat-file content storage
├── includes/                  # PHP modular includes (Header, Footer, Navigation)
├── assets/                    # Optimized images, JS, CSS
├── _webhook.php               # Receives CMS updates via secure POST webhooks
├── _upload-receive.php        # Receives WebP images from CMS
├── index.php                  # Home page template (parses content.json)
├── personal-training.php      # Service page template
├── trainer.php                # Team listing template
└── _build_content.py          # Python compiler for structural updates
```

---

## ⚙️ Installation & Local Setup

1. Clone this repository to your local web server (e.g. Apache/Nginx with PHP 8.x):
   ```bash
   git clone https://github.com/yourusername/flexfit-website.git
   ```
2. Copy `.env.example` to `.env` and set your Zentra API keys and administrator password hash.
3. Configure your web server document root to point to the project directory.
4. Open your browser and navigate to `http://localhost/bms-hub` to access the administrator editor.
