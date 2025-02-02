# Fleet Management System (Bus Booking API)

##  Project Overview
This is a **bus booking system** where users can:
- View available seats for a trip segment.
- Book a seat if available.
- Seats automatically become available when the user reaches the destination

##  Installation & Setup

### ** Clone the Repository**
git clone https://github.com/maghfra/Bus_Booking_Sysrem.git
cd Bus_Booking_Sysrem

### ** Install Dependencies**
composer install
npm install

### ** Set Up Environment Variables**
cp .env.example .env
 and update the necessary database


### ** Generate Application Key**
php artisan key:generate

### ** Run Migrations & Seed Database**
php artisan migrate --seed

### ** Start the server**
php artisan serve

### ** API Endpoints**

Use Postman or any API testing tool to test the following endpoints.

## Authentication

Method	   Endpoint	            Description
POST	/api/auth/register	   Register a new user
POST	/api/auth/login	       Login & get token
POST	/api/auth/logout        Logout & revoke token
GET    /api/auth/user          Get user info


Trip Booking
Method	   Endpoint	           Description
POST    /api/create-trip     Generate a trip
POST	/api/book-seat	     Book a seat if available
POST	/api/available-seats Get available seats for a trip segment

## APT Documentation
https://documenter.getpostman.com/view/33683196/2sAYX3rPZN



## Developed By
Maghfera Hassan
maghferaelorbany6@gmail.com

