CSIT 314
Welcome to the Used Car Marketplace project! This is a web application where users can browse, buy, and sell used cars. It is built using PHP, HTML, and a bit of JavaScript for internal verifications.

Features
Registration and Login: User admin will help to create the user account and then users will be able to use the credentials to login.
Car Listings: Buyers can view available cars, each with detailed information including price, model, year, and seller contact.
Search and Filter Options: Users can filter listings based on price, make, model, year, and other criteria.
Add Car Listings: Agents can create new car listings with images, descriptions, and prices for sellers.
Favourites and views: Extra statistics such as favourites and view counts are provided for sellers as insights. 
PHP: For server-side logic, handling user data, and interacting with the database.
HTML/CSS: For building the structure and styling of the web pages.
JavaScript: To add interactivity, such as form validation and dynamic filtering of listings.
MySQL: Used as the database to store user data, car listings, and other related information.
Setup Instructions
To run this project locally, follow the steps below:

Prerequisites
PHP and MySQL installed on your local machine. You can use tools like XAMPP or WAMP to install both PHP and MySQL.
A code editor (e.g., Visual Studio Code, Sublime Text, or any other of your choice).
Steps to Get Started
Clone the repository to your local machine:

bash
Copy code
git clone https://github.com/valianxd/smallbrain.git
Navigate to the project directory:

bash
Copy code
cd smallbrain
Set up the MySQL database:

Open your MySQL database management tool (e.g., phpMyAdmin) and create a new database called smallbrain.
Import the SQL file (database.sql) from the project directory to set up the necessary tables.
Configure database settings:

If you are using XAMPP or WAMP, launch Apache and MySQL.
Navigate to http://localhost/smallbrain in your browser.
Enjoy the app! You can now log in, and start browsing car listings.

Folder Structure
Class: Contains all entity classes with functions to communicate directly with the database.
SQL: SQL Tables information.

License
This project is licensed under the MIT License - see the LICENSE file for details.

