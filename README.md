# 🍽️ POS System

This is a self-service Point of Sale (POS) web application, inspired by modern ordering kiosks such as those found in fast-food chains. The system allows customers to browse meals, customize their order, and place it directly through the interface. Built with Laravel, Livewire, and PHP, the platform offers real-time updates and a user-friendly experience.

⚠️ **This project is still under development. Core functionalities are implemented and functional.**

## 🚀 Features

### ✅ Customer Side
- **Self-Ordering Flow**: Select meals and customize by removing ingredients or adding extras
- **Livewire-Powered UI**: Smooth dynamic updates without full-page reloads
- **Menu Overview**: Clear and structured overview of available dishes and combinations

### 🛠️ Admin Panel
- **Meal Management**: Add, edit, or remove meals from the system
- **Menu Creation**: Define meal combinations and prices
- **Ingredient Management**: Manage available ingredients and extras
- **Order Overview**: View and manage all incoming orders

## 🧱 Tech Stack

| Technology | Usage |
|------------|-------|
| PHP | Backend logic |
| Laravel | MVC framework |
| Livewire | Reactive frontend behavior |
| Blade | Templating engine |

## 📷 Screenshots

### 🧑‍🍳 Customer UI
![image](https://github.com/user-attachments/assets/0a85baa9-cee7-42b3-be67-b15a1a22849e)

![image](https://github.com/user-attachments/assets/4036fdd8-0e87-43fa-b7ae-3245eb287c3c)

![image](https://github.com/user-attachments/assets/978de227-aebe-4cc2-a195-a5d3232478c9)

### 🔐 Admin Dashboard
![image](https://github.com/user-attachments/assets/6f84d5eb-b4c9-40fc-8914-58086ccc3faf)

![image](https://github.com/user-attachments/assets/a35315aa-933d-4ed8-a268-b8c248c3e652)

## 🗃️ Database Schema

![image](https://github.com/user-attachments/assets/15dca52d-dff4-48d2-928f-5ff74d0f538f)
## 📦 Setup Instructions

### 1. Clone the repository
```bash
git clone https://github.com/your-username/pos-system.git
cd pos-system
```

### 2. Install dependencies
```bash
composer install
npm install && npm run dev
```

### 3. Configure environment
- Copy `.env.example` to `.env` and fill in your DB credentials
- Generate the application key:
```bash
php artisan key:generate
```

### 4. Run migrations
```bash
php artisan migrate
```

### 5. Start the server
```bash
php artisan serve
```

## 📌 Roadmap

- [ ] Order payment integration
- [ ] Print-ready order receipts
- [ ] Table/seat management
- [ ] Multi-language support

