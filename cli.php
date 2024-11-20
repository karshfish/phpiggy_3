<?php
include __DIR__ . "/src/Framework/Database.php";

use Framework\Database;

$db = new Database(
    driver: "mysql",
    config: [
        "host" => 'localhost',
        'port' => 3306,
        'dbname' => 'phpiggy'
    ],
    username: 'root',
    password: ''
);
echo "Connection with database established \n ";

try {
    $db->connection->beginTransaction();   //Begin a transaction
    $db->connection->query("INSERT INTO products VALUES(100, 'Gloves')");  //Dummy query to simulate a transaction

    $cond = "Gloves";
    $query = "SELECT * FROM products WHERE name = :name";

    $stmt = $db->connection->prepare($query); // This to make a prepared statement to prevent SQl injection

    $stmt->bindValue('name', $cond, PDO::PARAM_STR); //To bind values in the prepared statement without executing the script

    $stmt->execute(); // To execute our statement keep in mind this important so that we can fetch a prepared statement

    var_dump($stmt->fetchAll(PDO::FETCH_OBJ));

    $db->connection->commit(); // End transaction

} catch (Exception $error) {
    if ($db->connection->inTransaction()) { //Checking If we are in a transaction or not
        $db->connection->rollBack(); // Revert Changes happens in the transaction if it's failed 
        echo "Transaction failed";
    }
}
