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

Method:POST  |	 Endpoint:/api/auth/register  |	 Description:Register a new user <br />
Method:POST  |	 Endpoint:/api/auth/login	  |  Description:Login & get token <br />
Method:POST  |	 Endpoint:/api/auth/logout    |  Description:Logout & revoke token <br />
Method:GET   |   Endpoint:/api/auth/user      |  Description:Get user info <br />


### ** Trip Booking** <br />
Method:POST  |   Endpoint:/api/create-trip       |  Description:Generate a trip <br />
Method:POST	 |   Endpoint:/api/book-seat	     |  Description:Book a seat if available <br />
Method:POST	 |   Endpoint:/api/available-seats   |  Description:Get available seats for a trip segment <br />

## APT Documentation
https://documenter.getpostman.com/view/33683196/2sAYX3rPZN



## Developed By
Maghfera Hassan | maghferaelorbany6@gmail.com

