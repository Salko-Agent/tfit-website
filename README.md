# 🏋️‍♂️ FlexFit: Database-Less PHP & Flat-File CMS Ecosystem

> High-performance, database-less PHP website and custom flat-file editor (`bms-hub`). Replaces a legacy, bloated WordPress Elementor setup with a sub-100ms loading architecture.

![FlexFit Showcase Mockup](assets/img/hero-bg.jpg) *(Background placeholder)*

---

## 🔗 Live & Links
*   **Live Demo:** [bmsdigitalsolutions.com/demos/smartfit/](https://bmsdigitalsolutions.com/demos/smartfit/) *(Demo location on portfolio hub)*
*   **Tech Stack:** PHP 8.x, Vanilla JS, JSON Flat-File Store, Tailwind CSS, Python (migration compiler)

---

## 💡 Project Overview

### ❌ Was war das Problem?
Die ursprüngliche Website des Fitnessstudios basierte auf WordPress und Elementor, was zu extrem langsamen Ladezeiten, hohem Server-Ressourcenverbrauch und ständigen Sicherheitsrisiken durch Plugins führte. Dennoch benötigte der Inhaber eine einfache Benutzeroberfläche, um Trainingspreise, FAQs, Trainerprofile und Kurszeiten flexibel anzupassen, ohne Code schreiben zu müssen.

### 🛠️ Was habe ich gebaut?
Ein maßgeschneidertes, **datenbankloses (flat-file) PHP-System**. Alle Website-Inhalte sind in einer zentralen JSON-Struktur (`data/content.json`) organisiert und werden blitzschnell ausgelesen. Über ein sicheres, eigenes Admin-Interface (`bms-hub`) kann das Studio alle Inhalte verwalten. Ein Python-Compiler extrahiert WordPress-Elementor-Layouts und überführt sie in saubere, wiederverwendbare PHP-Komponenten.

### 🌟 Was ist besonders?
*   **⚡ Sub-100ms Ladezeiten:** Durch den Verzicht auf MySQL-Datenbankabfragen lädt die Website nahezu instinktiv. Sie ist voll caching-kompatibel und erreicht perfekte Google PageSpeed Scores.
*   **✏️ BMS Hub Flat-File Editor:** Ein maßgeschneidertes Admin-Panel, das Daten atomar (ohne File-Locks) in JSON-Dateien zurückschreibt. Dadurch bleibt das Backend wartungsfrei und extrem sicher.
*   **🔄 Webhook Rebuilding:** Automatisierte Webhooks (`_webhook.php` und `_upload-receive.php`) verarbeiten ankommende Aktualisierungen und konvertieren Bilder auf Server-Ebene direkt in das performante WebP-Format.
*   **🛠️ WP Extraction Engine:** Eigene Python-Migrationsskripte automatisieren das Parsen und Bereinigen von HTML-Strukturen aus Page-Buildern in standardkonformen PHP-Code.

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
