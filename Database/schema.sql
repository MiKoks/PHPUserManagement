DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS sectors;
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    sectors TEXT NOT NULL,
    agreed_terms BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE sectors (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    parent_id INT,
    FOREIGN KEY (parent_id) REFERENCES sectors(id)
);