# User Service

A PHP-based microservice for user management, including user registration, login, and retrieval of user details. Utilizes MySQL for data storage.

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/user-service.git
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Configure the database in `config/database.php`.

4. Run the service:

    ```bash
    php -S localhost:8000
    ```

## API Endpoints

- `POST /user-service/users`: Register a new user.
- `POST /user-service/login`: Authenticate a user.
- `GET /user-service/users?id=[user_id]`: Get details of a specific user.

## Dependencies

- PHP
- MySQL
- Composer
