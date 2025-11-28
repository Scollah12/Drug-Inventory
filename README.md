
💊 Drug Inventory Management System
 A Laravel Based Web Application for Managing Drug Stock, Requests & Pharmacy Operations  

This project is a   Drug Inventory Management System   developed using   Laravel 12+  . It helps hospitals, clinics, and pharmacies track drug stock levels, manage drug requests, and ensure efficient drug distribution. The system provides separate dashboards for   admins  ,   pharmacists  , and   doctors  , allowing smooth coordination and real time inventory updates.

   

   🚀 Features

      👨‍⚕️ Doctor Module  

  View available drug stock
  Request drugs for patients
  Track approval status

      💊 Pharmacist Module  

  View all incoming drug requests
  Approve or reject requests
  Issue drugs and update stock automatically
  Manage drug categories and drug entries

      🛠️ Admin Module  

  Manage pharmacists and doctors
  Add/update drug stock
  Monitor inventory levels
  Generate pharmacy activity reports

   

   🛠️ Technology Stack

    Laravel 12.1.1  
    PHP 8+  
    MySQL / MariaDB  
    Blade Templates  
    Bootstrap 5  
    Eloquent ORM  
    Laravel Authentication  

   

   📂 Project Structure

   
/app
   ├── Models
   ├── Http/Controllers
   ├── Http/Requests
/database
   ├── migrations
   ├── seeders
/resources
   ├── views
   │    ├── admin
   │    ├── pharmacist
   │    ├── doctor
/routes
   ├── web.php
public/
   ├── css
   ├── js
   

   

   ⚙️ Installation Guide

      1️⃣ Clone the repository  

bash
git clone https://github.com/your username/drug inventory system.git
cd drug inventory system


      2️⃣ Install dependencies  

bash
composer install
npm install
npm run build


      3️⃣ Configure environment  

Create  .env  file:

   bash
cp .env.example .env
   

Update DB settings:

   
DB_DATABASE=drug_inventory_db
DB_USERNAME=root
DB_PASSWORD=
   

      4️⃣ Generate app key  

   bash
php artisan key:generate
   

      5️⃣ Run migrations  

   bash
php artisan migrate   seed
   

      6️⃣ Start the server  

   bash
php artisan serve
   

Visit: 
http://localhost:8000
   
   
✅ Add API documentation
Just tell me!
