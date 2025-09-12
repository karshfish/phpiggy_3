# phpiggy

This project is a PHP-based application created for learning and demonstrating PHP native capabilities. It includes a reusable `Database` class for managing database interactions using PDO.

## Database Class

The `Database` class is a lightweight and reusable PHP class for interacting with a database using PDO. It simplifies database operations such as querying, fetching results, and managing connections.

### Features

- **PDO Integration**: Uses PHP's PDO for secure and efficient database interactions.
- **Query Execution**: Supports prepared statements with parameter binding.
- **Result Fetching**: Fetch single rows, multiple rows, or column counts.
- **Last Insert ID**: Retrieve the ID of the last inserted row.
- **Error Handling**: Gracefully handles connection errors.

### Requirements

- PHP 8.0 or higher
- PDO extension enabled
- A supported database driver (e.g., MySQL, SQLite)

### Usage

#### Initialization

Create an instance of the `Database` class by providing the database driver, configuration, username, and password.

```php
use Framework\Database;

$config = [
    'host' => 'localhost',
    'dbname' => 'example_db',
    'charset' => 'utf8mb4'
];

$db = new Database(
    driver: 'mysql',
    config: $config,
    username: 'root',
    password: 'password'
);
Methods
__construct(string $driver, array $config, string $username, string $password)
Initializes the database connection.

query(string $query, array $params = []): Database
Prepares and executes a query with optional parameters.

count()
Returns the number of rows from the last query.

find()
Fetches a single row from the result set.

findAll()
Fetches all rows from the result set.

id()
Returns the ID of the last inserted row.

Error Handling
If the connection fails, the constructor will terminate the script with an error message: Unable to Connect to database.

License
This project is open-source and available under the MIT License.
