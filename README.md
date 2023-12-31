This README file includes a brief description of the project, instructions for setting up your development environment, and a guide to the application's features.

# Project Description
This project is a simple application that uses Apache, PHP and PostgreSQL. The application consists of a registration page, login page, a form for client data collection, and a search page. The following functions are performed;


1. Registration
2. User login
3. Client data collection and storage
4. Search function to retrieve client data

## Project Demo

[demo.webm](https://github.com/DevBarham/user-data/assets/62616273/e65babf5-1b40-4ae6-8c5f-4b521050894c)


## Database Screenshot

- Register Table
![register_Screenshot from 2023-08-16 11-18-41](https://github.com/abdulmalik-devs/abdulmalik-devs/assets/62616273/b484e198-04a4-4eaf-8f59-6e0789b5c61d)


- Profile Table
![profile_Screenshot from 2023-08-16 11-17-16](https://github.com/abdulmalik-devs/abdulmalik-devs/assets/62616273/1eb55b65-8d99-4deb-8684-056616dc1049)


# Setup

Before beginning, confirm that the following are installed on your machine:

1. Apache web server with PHP support
2. PostgreSQL

Next, setup your development environment as follows:

1. Download and install a PHP compatible code editor (preferable Visual Studio Code)
2. Clone this repository to your local machine

# Instructions 

To get this project running on your local machine, follow these steps:

1. Start Apache web server
2. In PostgreSQL, create a database with tables for user credentials and client information. Create a user with permissions to access the database.
3. Navigate to the project directory and start the application 

# Features

## Registration
- The application will ask a new user to sign up. These data will will be sent to the PostgreSQL register table.

## User Login
- The application will ask for username and password. These will be verified against the data in the register table in PostgreSQL database.

## Client Data Form
- This form collects client name, mobile number, address, gender, and occupation. This data is stored in the profile table in PostgreSQL database.

## Search Function
- This function queries the PostgreSQL profle table in PostgreSQL databse based on user input and displays matching results.

# Security Considerations
- The application uses prepared statements to safeguard against SQL injection.
- Passwords are hashed and salted before being stored in the database.

# Appearance & Design
- The application is designed to be user-friendly.
- Error handling is implemented to provide users with meaningful feedback.

# Contact
Please feel free to contact me with any questions or concerns.

Hopefully, this README file gives a clear understanding of the project and how it works. A README file is crucial as it keeps track of the project details, setup, and instructions. It's an essential document for every software project and should be maintained meticulously.
