<?php

$host = "localhost";
$dbname = "dbname";
$user = "dbuser"; 
$password = "dbpass";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database.\n";
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS authors (
            id SERIAL PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS books (
            id SERIAL PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            publication_year INT NOT NULL,
            isbn VARCHAR(13) UNIQUE NOT NULL,
            author_id INT REFERENCES authors(id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS reviews (
            id SERIAL PRIMARY KEY,
            rating INT CHECK (rating >= 1 AND rating <= 10),
            content TEXT,
            book_id INT REFERENCES books(id) ON DELETE CASCADE
        );
    ");
    echo "Database schema created successfully.\n";
} catch (PDOException $e) {
    die("Error creating schema: " . $e->getMessage());
}

try {
    $pdo->exec("
        DELETE FROM reviews;
        DELETE FROM books;
        DELETE FROM authors;
        
        INSERT INTO authors (first_name, last_name) VALUES 
        ('John', 'Smith'),
        ('Jane', 'Doe'),
        ('Emily', 'Bronte'),
        ('William', 'Shakespeare'),
        ('Leo', 'Tolstoy'),
        ('George', 'Orwell');

        INSERT INTO books (title, publication_year, isbn, author_id) VALUES
        ('Book 1 by John', 1995, '1234567890123', 1),
        ('Book 2 by John', 1998, '1234567890124', 1),
        ('Book 1 by Jane', 2001, '2234567890123', 2),
        ('Book 1 by Emily', 1847, '3234567890123', 3),
        ('Book 1 by William', 1603, '4234567890123', 4),
        ('Book 2 by William', 1606, '4234567890124', 4),
        ('Book 1 by Leo', 1869, '5234567890123', 5),
        ('Book 1 by George', 1949, '6234567890123', 6);

        INSERT INTO reviews (rating, content, book_id) VALUES
        (9, 'Great book by John!', 1),
        (8, 'Another great book by John!', 2),
        (7, 'Interesting book by Jane.', 3),
        (9, 'Masterpiece by Emily.', 4),
        (10, 'Classic by William.', 5),
        (9, 'Another classic by William.', 6),
        (8, 'Masterpiece by Leo.', 7),
        (10, 'Dystopian classic by George.', 8);
    ");
    echo "Data inserted successfully.\n";
} catch (PDOException $e) {
    die("Error inserting data: " . $e->getMessage());
}

try {
    $stmt = $pdo->query("
        SELECT a.first_name, a.last_name, COUNT(b.id) AS books_count
        FROM authors a
        LEFT JOIN books b ON a.id = b.author_id
        GROUP BY a.id
        ORDER BY books_count DESC;
    ");
    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "\nList of authors and number of books:\n";
    foreach ($authors as $author) {
        echo $author['first_name'] . " " . $author['last_name'] . " - " . $author['books_count'] . " books\n";
    }
} catch (PDOException $e) {
    die("Error fetching authors: " . $e->getMessage());
}

try {
    $pdo->exec("
        CREATE OR REPLACE VIEW top_5_authors AS
        SELECT a.first_name, a.last_name, AVG(r.rating) AS avg_rating
        FROM authors a
        JOIN books b ON a.id = b.author_id
        JOIN reviews r ON b.id = r.book_id
        GROUP BY a.id
        ORDER BY avg_rating DESC
        LIMIT 5;
    ");
    echo "\nView 'top_5_authors' created successfully.\n";

    $stmt = $pdo->query("SELECT * FROM top_5_authors;");
    $top_authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "\nTop 5 authors with highest average ratings:\n";
    foreach ($top_authors as $author) {
        echo $author['first_name'] . " " . $author['last_name'] . " - Average Rating: " . $author['avg_rating'] . "\n";
    }
} catch (PDOException $e) {
    die("Error creating view or fetching top authors: " . $e->getMessage());
}
