# 🚀 Jibli — AI Delivery Agent for Lebanon

## 📌 Overview

Jibli is an AI-powered delivery dispatch assistant built for Lebanon during the LB AI Agents Hackathon 2026.

The platform allows customers to request deliveries using natural language in:

- Arabic
- English
- French
- Franco-Arabic

The AI understands the request, extracts the required information, calculates the delivery fee based on Lebanese areas and districts, and automatically assigns a driver.

---

## 🌐 Live Demo

- Customer App: http://167.86.86.196/
- Driver Dashboard: http://167.86.86.196/driver/login
- Admin Dashboard: http://167.86.86.196/admin/orders

## 🔐 Demo Credentials

### Driver Login

- URL: http://167.86.86.196/driver/login
- Phone: 03100004
- Password: password123

### Admin Dashboard

- URL: http://167.86.86.196/admin/orders

## 🎯 Problem

In Lebanon, ordering deliveries often requires multiple phone calls, unclear pricing, and manual coordination.

Jibli simplifies this process through an AI conversation that:

- Understands customer requests
- Supports Lebanese dialect and Franco-Arabic
- Resolves locations automatically
- Calculates delivery fees
- Assigns available drivers

---

## 🧠 AI Features

Jibli uses Google Gemini to:

- Understand customer intent
- Detect delivery type
- Extract delivery area
- Extract exact address
- Extract customer phone number
- Support multilingual conversations
- Understand Lebanese dialects and spelling variations

Examples:

- "جيبلي دوا من الصيدلية"
- "jibli dawa mn saydali"
- "Bring me medicine from the pharmacy"
- "Apporte-moi un médicament"

---

## ⚙️ System Flow

### Customer Flow

1. Customer sends a request.
2. AI collects:
    - Service type
    - Area
    - Exact address
    - Phone number

3. System resolves the location.
4. System calculates delivery price.
5. Customer receives a confirmation message.
6. Customer replies:
    - Yes → Create order
    - No → Cancel order

7. Driver receives the order.
8. Driver accepts and completes delivery.

---

## 🚗 Driver Dashboard

Drivers can:

- View assigned orders
- Accept orders
- View customer information
- Mark deliveries as completed

---

## 🏗️ Tech Stack

### Backend

- Laravel 12
- PHP 8.2
- MySQL

### AI

- Google Gemini API

### Frontend

- Blade Templates
- JavaScript
- CSS

### Infrastructure

- GitHub
- Laravel Services Architecture

---

## 🗄️ Core Services

### GeminiService

Handles AI conversations and information extraction.

### ZoneResolverService

Maps customer input to Lebanese:

- Areas
- Districts
- Governorates

### PriceLookupService

Calculates delivery fees from the database.

### OrderService

Builds order summaries and confirmation messages.

### ConversationService

Stores and manages chat history.

---

## 🌍 Lebanese Localization

Supports:

- Arabic
- English
- French
- Franco-Arabic

Example locations:

- Zahle
- Hazerta
- Fanar
- Jdeideh
- Hamra
- Achrafieh
- Hazmieh
- Antelias

---

## 📦 Installation

Clone the repository:

```bash
git clone https://github.com/Fadelabas/ai-agents-hackathon-2026.git
```

Install dependencies:

```bash
composer install
```

Create environment file:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Configure database and Gemini API key.

Run migrations:

```bash
php artisan migrate
```

Start server:

```bash
php artisan serve
```

---

## 🔑 Environment Variables

```env
GEMINI_API_KEY=YOUR_API_KEY
DB_DATABASE=jibli
DB_USERNAME=root
DB_PASSWORD=
```

---

## 👥 Team

### Fadel Abou Hamdan

**Computer Engineering Graduate**
Lebanese International University (LIU)

**Role:**

- Backend Development
- AI Integration
- Database Design
- Laravel Development
- System Architecture

---

### Mayada Abou Hamdan

**Data Science Student**
Saint Joseph University (USJ)

**Role:**

- Data Analysis
- AI Research
- Data Modeling
- Testing & Validation
- Documentation Support

---

### Hackathon

**LB AI Agents Hackathon 2026**

**Theme:**
Life in Lebanon — Solving Real-World Challenges

---

## 📄 License

MIT License
