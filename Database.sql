CREATE TABLE IF NOT EXISTS users  (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    country varchar(255) NOT NULL,
    age tinyint(3) NOT NULL,
    social_media_url varchar(255) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id),
    UNIQUE (email)
);
 CREATE TABLE IF NOT EXISTS  transactions(
    id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    description varchar(255) NOT NULL,
    amount decimal(10,2) NOT NULL,
    date datetime NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    user_id bigint(20) UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY(user_id) REFERENCES users(id)
 );
 CREATE TABLE IF NOT EXISTS  transaction_receipts(
    id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    originalFilename varchar(255)  NOT NULL,
    storageFilename varchar(255) NOT NULL,
    mediaType varchar(255) NOT NULL,
    transaction_id bigint(20) UNSIGNED NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),  
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id),
    FOREIGN KEY(transaction_id) REFERENCES transactions(id)
 );