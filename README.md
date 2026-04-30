# SalesGen — AI Sales Page Generator

An AI-powered web application that transforms product information into complete, structured, and persuasive sales pages instantly.

## 🚀 Live Demo
**URL:** [your-railway-url]
**Demo Account:**
- Email: demo@salespage.com
- Password: demo123456

## 🛠 Tech Stack
- **Backend:** Laravel 11 (PHP)
- **Frontend:** Blade + Tailwind CSS v4
- **Database:** MySQL
- **AI:** Groq API (LLaMA 3.3 70B)
- **Deploy:** Railway
- **Export:** DomPDF (PDF), html2canvas (PNG), HTML

## ✨ Features
- User Authentication (Register, Login, Logout) via Laravel Auth
- AI-powered sales page generation with Groq API
- 3 Design Templates: Modern, Minimalist, Dark Luxury
- 5 Tone Options: Persuasive, Formal, Casual, Urgent, Friendly
- Live Preview of generated sales page
- Export as HTML, PDF, or PNG
- Generation History with search, preview, and delete
- Responsive design for all screen sizes

## 📋 How It Works
1. Register or login to your account
2. Fill in your product/service details
3. Choose your preferred tone and design template
4. Click "Generate" — AI creates your complete sales page in seconds
5. Preview, export (HTML/PDF/PNG), or delete from history

## 🔧 Local Installation
```bash
git clone https://github.com/USERNAME/sales-page-generator.git
cd sales-page-generator
composer install
npm install
cp .env.example .env
php artisan key:generate
# Configure .env with your DB and GROQ_API_KEY
php artisan migrate --seed
npm run dev
php artisan serve
```

## 🤖 AI Logic
User input → GroqService builds structured prompt → Groq API (LLaMA 3.3 70B) returns JSON → Parsed and stored in MySQL → Rendered as styled Blade template

## 📁 Project Structure
- `app/Services/GroqService.php` — AI API integration
- `app/Http/Controllers/GeneratorController.php` — Handle generation flow
- `app/Http/Controllers/SalesPageController.php` — CRUD & export
- `resources/views/sales-pages/templates/` — 3 design templates
- `database/migrations/` — Database schema