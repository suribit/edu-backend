CREATE TABLE products (
    product_id  INT(11) UNSIGNED  NOT NULL  AUTO_INCREMENT,
    name VARCHAR(255) COLLATE utf8_bin NULL,
    sku VARCHAR(255) COLLATE utf8_bin NULL,
    image VARCHAR(255) COLLATE utf8_bin NULL,
    price FLOAT(24) NULL,
    special_price FLOAT(24) NULL, 
   PRIMARY KEY (product_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

INSERT INTO products(name, sku, image, price, special_price) VALUES("Iphone 3G", "753159", "https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcS9PfMgsH_lafNyTkeUIjy8mfNqI7VenxqLDw69wQng2aFXhEVGbw", 4500, 4499);
INSERT INTO products(name, sku, image, price, special_price) VALUES("Iphone 4", "4569852", "http://paulov.ru/files/2012/02/step1-2.jpg", 13490, NULL);
INSERT INTO products(name, sku, image, price, special_price) VALUES("Iphone 4G", "12365478", "http://www.apple-iphone.ru/iphone4/iphone4.jpg", 19000, 18990);
INSERT INTO products(name, sku, image, price, special_price) VALUES("Iphone 5", "557878794", "http://appsgrade.ru/wp-content/uploads/2013/03/iphone5-v-moskve.png", 23000, NULL);
INSERT INTO products(name, sku, image, price, special_price) VALUES("Iphone 5S", "753159", "http://www.oszone.net/figs/u/316767/131014123221/iphone-5s-shop-le-monde-edit.jpg", 26000, NULL);
INSERT INTO products(name, sku, image, price, special_price) VALUES("Samsung Galax S", "999779797", "http://technocrash.ru/wp-content/uploads/2010/08/Samsung-Captivate-i897_1.jpg", 6010, 4000);
INSERT INTO products(name, sku, image, price, special_price) VALUES("Samsung Galax S2", "2992458924", "http://s.4pda.to/wp-content/uploads/2013/01/galaxy-s-ii-plus-product-image-1-320x480.jpg", 10000, 9500);
INSERT INTO products(name, sku, image, price, special_price) VALUES("Samsung Galax S3", "3998547475441333", "http://www.droid-life.com/wp-content/uploads/2012/06/galaxy-s3-review.jpg", 19000, NULL);
INSERT INTO products(name, sku, image, price, special_price) VALUES("Samsung Galax S4", "47851145588417", "http://s4galaxy.ru/wp-content/uploads/2013/06/samsung_galaxy_s_4_zoom_1.jpg", 26000, NULL);

CREATE TABLE customers (
    customer_id  INT(11) UNSIGNED  NOT NULL  AUTO_INCREMENT,
    name VARCHAR(255) COLLATE utf8_bin NULL,
    password VARCHAR(255) COLLATE utf8_bin NULL,
    email VARCHAR(255) COLLATE utf8_bin NULL,
    quote_id INT(11) UNSIGNED NULL,
    rating DECIMAL(10,2) NULL,

   PRIMARY KEY (customer_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

CREATE TABLE quotes (
    quote_id  INT(11) UNSIGNED  NOT NULL  AUTO_INCREMENT,
    address_id  INT(11) UNSIGNED NULL,
    subtotal DECIMAL(10,2) NULL,
    shipping INT(11) UNSIGNED NULL,
    grand_total DECIMAL(10,2) NULL,
 
   PRIMARY KEY (quote_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

CREATE TABLE quote_items (
    item_id  INT(11) UNSIGNED  NOT NULL  AUTO_INCREMENT,
    quote_id INT(11) UNSIGNED  NOT NULL,
    qty INT(11) UNSIGNED NULL,
    product_id INT(11) UNSIGNED NULL,
 
   PRIMARY KEY (item_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

CREATE TABLE product_reviews (
    review_id  INT(11) UNSIGNED  NOT NULL  AUTO_INCREMENT,
    product_id  INT(11) UNSIGNED  NULL,
    name VARCHAR(255) COLLATE utf8_bin NULL,
    email VARCHAR(255) COLLATE utf8_bin NULL,
    rating DECIMAL(10,2) NULL,
    text_review VARCHAR(255) COLLATE utf8_bin NULL,
   PRIMARY KEY (review_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

CREATE TABLE admins (
    admin_id  INT(11) UNSIGNED  NOT NULL  AUTO_INCREMENT,
    name VARCHAR(255) COLLATE utf8_bin NULL,
    password VARCHAR(255) COLLATE utf8_bin NULL,
    email VARCHAR(255) COLLATE utf8_bin NULL,

   PRIMARY KEY (admin_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

INSERT INTO admins(name, password, email) VALUES("admin", "3a523780ee1bbb78bb52bc657449d257", "wss.world@gmail.com");





CREATE TABLE abstract_collection (
	id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	data VARCHAR(255) COLLATE utf8_bin NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;