# Laravel 12 & Vue.js Project

This project is built using Laravel 12 for the backend API and Vue.js for the frontend interface.

## Project Description

This e-commerce application provides a user-friendly interface for browsing and purchasing products. Key features include:

- **Product Catalog:** Displays a list of available products with details such as images, descriptions, and prices.
- **Shopping Cart:** Allows users to add and manage items in their cart.
- **Checkout Process:** Guides users through a simplified checkout process, including order confirmation.
- **Basic User Authentication:** Allows user registration and login.
- **API Driven:** Backend is built as an API, allowing for scalability and future expansion.
- **Email Notifications:** Order confirmations and other relevant emails are sent using Laravel's email functionality.

## Technologies Used

- **Backend:** Laravel 12 (PHP Framework), Docker (for containerization),
- **Frontend:** Vue.js (JavaScript Framework), Node.js (JavaScript runtime environment), Bootstrap 5 (for styling)
- **Database:** MySQL
- **Other Dependencies:** PHPUnit (for testing), Symfony Mailer uses SMTP by default(for emailing), Axios (for API requests), Pinia (for state management)
- **Testing (Planned):** Cypress (for end-to-end testing, implementation in progress)

## Prerequisites

Before running this project, ensure you have the following installed:

- **PHP:** Version 8.2 or higher
- **Composer:** Dependency Manager for PHP
- **Node.js:** JavaScript runtime environment
- **npm or Yarn:** Package managers for Node.js
- **MySQL:** Database server
- **Docker:** Containerization platform (optional, but recommended)

## Installation

For detailed installation instructions, please refer to the `backend/README.md` and `frontend/README.md` files within their respective directories. Docker setup instructions can be found in the project's root `README.md` or within a `docker-compose.yml` file.

## API Endpoints (Laravel)

API endpoint details can be found in the project's OpenAPI specification file.

## Database Structure

The database structure is defined within the Laravel migrations located in the `database/migrations` directory of the backend.

## Deployment

[Provide instructions on how to deploy the application to a production environment. Include steps for configuring the web server, database, and environment variables. If docker is used, provide docker related deployment instructions.]

## Contributing

Thank you for your interest in contributing to this project! I'd like to extend a special thanks to my co-developers for their invaluable guidance and support throughout the development process. Their expertise and mentorship have been instrumental in my learning and growth.

If you'd like to contribute, please follow these guidelines:

- Fork the repository and create a new branch for your feature or bug fix.
- Ensure your code adheres to the project's coding standards.
- Submit a pull request with a clear description of your changes.

## License

This project will be licensed under the MIT License.

Copyright (c) 2025 Mark Wilfred C. Juan

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

## Additional Notes

- Ensure your `.env` file has the correct database credentials.
- The frontend uses Axios to communicate with the Laravel API.
- The checkout process is a simplified example and may require further development for a production environment.
- To enable user authentication, make sure to run the migration for users table.
- Pinia is used for managing the global state of the application, such as the shopping cart.
- Docker is used for containerization, simplifying the setup and deployment process.
- If using docker, configure the .env file with the database configuration for docker.
- PHPUnit is used for writing and running unit tests for the Laravel backend.
- Cypress will be implemented soon for end-to-end testing of the application's user interface.
- Laravel's built-in email functionality (using Symfony Mailer via SMTP by default) is used to send order confirmations and other email notifications. Ensure your `.env` file is configured with the correct email settings.
- Bootstrap 5 is used for styling the frontend components.
