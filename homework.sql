ALTER TABLE products ADD UNIQUE INDEX SKU_INDEX(sku)
ALTER TABLE orders ADD UNIQUE DATE_CUSTOMERS_ID(created_at, customer_id);


ALTER TABLE orders ADD INDEX CUSTOMER_ID_INDEX (customer_id);
ALTER TABLE orders ADD INDEX SELLER_ID_INDEX (seller_id);

ALTER TABLE order_products ADD INDEX PRODUCT_ID_INDEX (product_id);
ALTER TABLE order_products ADD INDEX ORDER_ID_INDEX (order_id);


ALTER TABLE orders ADD FOREIGN KEY CUSTOMER_ID (customer_id) REFERENCES customers (customer_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE orders ADD FOREIGN KEY SELLER_ID (seller_id) REFERENCES sellers (seller_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE order_products ADD FOREIGN KEY PRODUCT_ID (product_id) REFERENCES products (product_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE order_products ADD FOREIGN KEY ORDER_ID (order_id) REFERENCES orders (order_id) ON DELETE CASCADE ON UPDATE CASCADE;