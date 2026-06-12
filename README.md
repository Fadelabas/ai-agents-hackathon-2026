# 🚀 Jibli — AI Delivery Agent for Lebanon

## 📌 Overview

Jibli is an AI-powered delivery dispatch assistant built for Lebanon during the LB AI Agents Hackathon 2026.

The platform allows customers to request deliveries using natural language in:

- Arabic
- English
- French
- Franco-Arabic

The AI understands the request, extracts the required information, calculates delivery fees based on Lebanese locations, and automatically assigns drivers.

---

## 🌐 Live Demo

### Customer Chat

http://167.86.86.196/

### Driver Dashboard

http://167.86.86.196/driver/login

### Admin Dashboard

http://167.86.86.196/admin/orders

---

## 🔐 Demo Credentials

### Driver Login

URL:
http://167.86.86.196/driver/login

Phone:
03100004

Password:
password123

### Admin Dashboard

URL:
http://167.86.86.196/admin/orders

---

## 🎯 Problem

In Lebanon, requesting deliveries often requires multiple phone calls, unclear pricing, and manual coordination between customers and drivers.

Jibli simplifies this process through an AI-powered conversation that:

- Understands customer requests
- Supports Lebanese dialect and Franco-Arabic
- Resolves locations automatically
- Calculates delivery fees
- Assigns available drivers

---

## 🤖 AI Engine

Jibli originally started with Google Gemini during the early development phase and prototype testing.

Due to reliability, rate-limit, and availability issues encountered during development, the project was later migrated to OpenAI API, which provided more stable responses and better performance for the hackathon demo.

Some internal service names and files may still contain references to "Gemini" from the initial implementation.

### Current AI Provider

- OpenAI API
- GPT-4.1 Mini

### Legacy Notes

Some files may still contain names such as:

- GeminiService
- GEMINI_API_KEY
- Gemini-related comments

These names remain temporarily for compatibility and rapid hackathon development.

---

## 🧠 AI Features

Jibli uses OpenAI to:

- Understand customer intent
- Detect delivery type
- Extract delivery area
- Extract exact address
- Extract customer phone number
- Support multilingual conversations
- Understand Lebanese dialects
- Understand Franco-Arabic writing
- Handle spelling variations and typos

### Examples

Arabic:

```text
جيبلي دوا من الصيدلية
```

Franco-Arabic:

```text
jibli dawa mn saydali
```

English:

```text
Bring me medicine from the pharmacy
```

French:

```text
Apporte-moi un médicament
```

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
8. Driver accepts the delivery.
9. Driver completes the delivery.

---

## 🚗 Driver Dashboard

Drivers can:

- View assigned orders
- Accept orders
- View customer information
- View delivery details
- Mark deliveries as completed

---

## 🛠️ Admin Dashboard

Admins can:

- View all orders
- Monitor delivery statuses
- View assigned drivers
- Track active deliveries
- Manage demo data
- Review customer requests

---

## 🏗️ Tech Stack

### Backend

- Laravel 12
- PHP 8.3
- MySQL

### AI

- OpenAI API
- GPT-4.1 Mini

### Frontend

- Blade Templates
- JavaScript
- CSS

### Infrastructure

- Ubuntu VPS
- Nginx
- GitHub
- Laravel Service Architecture

---

## 🗄️ Core Services

### GeminiService

Legacy service name currently used for AI communication.

Handles:

- AI conversations
- Data extraction
- Customer intent detection

### ZoneResolverService

Maps customer input into:

- Areas
- Districts
- Governorates

### PriceLookupService

Calculates delivery fees using Lebanese area pricing.

### OrderService

Creates orders and generates order summaries.

### ConversationService

Stores and manages customer conversations.

---

## 🌍 Lebanese Localization

Supports:

- Arabic
- English
- French
- Franco-Arabic

Example supported locations:

- Zahle
- Hazerta
- Fanar
- Jdeideh
- Hamra
- Achrafieh
- Hazmieh
- Antelias
- Beirut
- Metn
- Bekaa

---

## 📦 Installation

Clone repository:

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

Generate application key:

```bash
php artisan key:generate
```

Configure database and OpenAI API credentials.

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
OPENAI_API_KEY=YOUR_API_KEY
OPENAI_MODEL=gpt-4.1-mini

DB_DATABASE=jibli
DB_USERNAME=root
DB_PASSWORD=
```

---

## 👥 Team

### Fadel Abou Hamdan

Computer Engineering Graduate

Lebanese International University (LIU)

Responsibilities:

- Backend Development
- Laravel Development
- AI Integration
- Database Design
- System Architecture
- VPS Deployment

---

### Mayada Abou Hamdan

Data Science Student

Saint Joseph University (USJ)

Responsibilities:

- Data Analysis
- AI Research
- Data Modeling
- Testing & Validation
- Documentation Support

---

## 🏆 Hackathon

LB AI Agents Hackathon 2026

Theme:

Life in Lebanon — Solving Real-World Challenges

---

## 📄 License

MIT License
