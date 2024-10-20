# PHP and PostgreSQL Task Solutions

This repository contains the solutions for two tasks: a virtual zoo system and a PostgreSQL database for authors, books, and reviews.

## Task 1: Virtual Zoo System

The task involves creating a class system for a virtual zoo, including various animal species and their characteristics. The animals can be added to the zoo and listed.

### Example Output for Task 1:

```bash
Tiger Shere Khan has been added to the zoo.
Elephant Dumbo has been added to the zoo.
Rhino Rino has been added to the zoo.
Fox Foxy has been added to the zoo.
Snow Leopard Snowy has been added to the zoo.
Rabbit Peter Rabbit has been added to the zoo.

List of animals in the zoo:
Tiger Shere Khan
Elephant Dumbo
Rhino Rino
Fox Foxy
Snow Leopard Snowy
Rabbit Peter Rabbit
```

## Task 2: PostgreSQL Database for Authors, Books, and Reviews

The task involves creating a PostgreSQL database schema to store authors, books, and reviews. Additionally, SQL queries are written to retrieve information about authors and their books, and create a view that lists the top 5 authors based on the average rating of their books.

### Example Output for Task 2:

```bash
Connected to the database.
Database schema created successfully.
Data inserted successfully.

List of authors and number of books:
William Shakespeare - 2 books
John Smith - 2 books
Jane Doe - 1 book
Emily Bronte - 1 book
Leo Tolstoy - 1 book
George Orwell - 1 book

View 'top_5_authors' created successfully.

Top 5 authors with highest average ratings:
George Orwell - Average Rating: 10
William Shakespeare - Average Rating: 9.5
Emily Bronte - Average Rating: 9
John Smith - Average Rating: 8.5
Leo Tolstoy - Average Rating: 8
```

## Requirements

```bash
PHP 7.4+ for running the PHP scripts.
PostgreSQL 14 for the database schema and queries.
```