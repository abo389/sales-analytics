-- Create tables
CREATE TABLE Category (
    category_id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE SubCategory (
    sub_category_id INTEGER PRIMARY KEY AUTOINCREMENT,
    category_id INTEGER,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (category_id) 
    REFERENCES Category(category_id) ON DELETE SET NULL
);

CREATE TABLE Product (
    product_id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category_id INTEGER,
    sub_category_id INTEGER,
    description TEXT,
    FOREIGN KEY (category_id) 
    REFERENCES Category(category_id) ON DELETE SET NULL,
    FOREIGN KEY (sub_category_id) 
    REFERENCES SubCategory(sub_category_id) ON DELETE SET NULL
);

CREATE TABLE Orders (
    order_id INTEGER PRIMARY KEY AUTOINCREMENT, 
    product_id INTEGER NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INTEGER NOT NULL,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) 
    REFERENCES Product(product_id) ON DELETE CASCADE
);

-- Insert categories
INSERT INTO Category (name) VALUES 
('Drinks'), 
('Clothes');

-- Insert sub-categories
INSERT INTO SubCategory (name, category_id) VALUES 
('Hot Drinks', 1), -- Sub-category for Drinks
('Cold Drinks', 1), -- Sub-category for Drinks
('Summer Clothes', 2), -- Sub-category for Clothes
('Winter Clothes', 2); -- Sub-category for Clothes

-- Insert products with sub-category IDs
-- Hot Drinks (sub_category_id = 1)
INSERT INTO Product (name, price, category_id, sub_category_id, description) VALUES
('Coffee', 3.50, 1, 1, 'Freshly brewed hot coffee'),
('Tea', 2.50, 1, 1, 'Classic black tea'),
('Hot Chocolate', 4.00, 1, 1, 'Rich and creamy hot chocolate'),
('Cappuccino', 4.50, 1, 1, 'Espresso with steamed milk foam'),
('Latte', 4.75, 1, 1, 'Espresso with steamed milk'),
('Green Tea', 3.00, 1, 1, 'Healthy green tea'),
('Chai Latte', 4.25, 1, 1, 'Spiced tea with steamed milk'),
('Mocha', 5.00, 1, 1, 'Chocolate-flavored coffee'),
('Americano', 3.75, 1, 1, 'Espresso with hot water'),
('Macchiato', 4.50, 1, 1, 'Espresso with a dollop of milk foam');

-- Cold Drinks (sub_category_id = 2)
INSERT INTO Product (name, price, category_id, sub_category_id, description) VALUES
('Iced Coffee', 4.00, 1, 2, 'Chilled coffee with ice'),
('Iced Tea', 3.00, 1, 2, 'Refreshing cold tea'),
('Lemonade', 3.50, 1, 2, 'Sweet and tangy lemonade'),
('Smoothie', 5.50, 1, 2, 'Mixed fruit smoothie'),
('Cold Brew', 4.75, 1, 2, 'Slow-steeped cold coffee'),
('Frappuccino', 5.25, 1, 2, 'Blended iced coffee drink'),
('Orange Juice', 3.25, 1, 2, 'Freshly squeezed orange juice'),
('Apple Juice', 3.25, 1, 2, 'Freshly squeezed apple juice'),
('Cola', 2.50, 1, 2, 'Classic cola drink'),
('Sparkling Water', 2.00, 1, 2, 'Carbonated water with a hint of flavor');

-- Summer Clothes (sub_category_id = 3)
INSERT INTO Product (name, price, category_id, sub_category_id, description) VALUES
('T-Shirt', 15.00, 2, 3, 'Lightweight cotton t-shirt'),
('Shorts', 20.00, 2, 3, 'Casual summer shorts'),
('Sunglasses', 25.00, 2, 3, 'UV-protected sunglasses'),
('Flip Flops', 10.00, 2, 3, 'Comfortable beach flip flops'),
('Tank Top', 12.00, 2, 3, 'Sleeveless summer top'),
('Sun Hat', 18.00, 2, 3, 'Wide-brimmed sun hat'),
('Swim Trunks', 30.00, 2, 3, 'Quick-drying swimwear'),
('Summer Dress', 35.00, 2, 3, 'Light and breezy dress'),
('Sandals', 22.00, 2, 3, 'Casual summer sandals'),
('Beach Towel', 15.00, 2, 3, 'Large and absorbent beach towel');

-- Winter Clothes (sub_category_id = 4)
INSERT INTO Product (name, price, category_id, sub_category_id, description) VALUES
('Winter Jacket', 100.00, 2, 4, 'Heavy-duty winter coat'),
('Scarf', 20.00, 2, 4, 'Warm woolen scarf'),
('Beanie', 15.00, 2, 4, 'Knitted winter hat'),
('Gloves', 18.00, 2, 4, 'Insulated winter gloves'),
('Sweater', 45.00, 2, 4, 'Thick woolen sweater'),
('Thermal Underwear', 30.00, 2, 4, 'Warm base layer'),
('Snow Boots', 80.00, 2, 4, 'Waterproof winter boots'),
('Fleece Jacket', 60.00, 2, 4, 'Lightweight fleece jacket'),
('Earmuffs', 12.00, 2, 4, 'Soft and warm earmuffs'),
('Winter Socks', 10.00, 2, 4, 'Thick woolen socks');

-- Insert orders
INSERT INTO Orders (product_id, price, quantity, date) VALUES
(1, 3.50, 2, '2023-10-01 08:30:00'), -- Coffee
(12, 3.00, 1, '2023-10-02 12:15:00'), -- Iced Tea
(21, 15.00, 3, '2023-10-03 14:00:00'), -- T-Shirt
(30, 100.00, 1, '2023-10-04 09:45:00'), -- Winter Jacket
(5, 4.75, 2, '2023-10-05 10:30:00'), -- Latte
(18, 35.00, 1, '2023-10-06 16:20:00'), -- Summer Dress
(7, 4.25, 1, '2023-10-07 11:10:00'), -- Chai Latte
(25, 45.00, 2, '2023-10-08 13:50:00'), -- Sweater
(14, 5.50, 1, '2023-10-09 17:00:00'), -- Smoothie
(29, 12.00, 1, '2023-10-10 08:00:00'), -- Earmuffs
(3, 4.00, 3, '2023-10-11 10:15:00'), -- Hot Chocolate
(22, 20.00, 2, '2023-10-12 14:30:00'), -- Shorts
(8, 5.00, 1, '2023-10-13 12:45:00'), -- Mocha
(27, 80.00, 1, '2023-10-14 09:00:00'), -- Snow Boots
(16, 5.25, 2, '2023-10-15 15:10:00'), -- Frappuccino
(24, 18.00, 1, '2023-10-16 11:20:00'), -- Gloves
(9, 3.75, 1, '2023-10-17 13:00:00'), -- Americano
(26, 30.00, 2, '2023-10-18 16:40:00'), -- Thermal Underwear
(19, 22.00, 1, '2023-10-19 10:50:00'), -- Sandals
(4, 4.50, 2, '2023-10-20 08:20:00'); -- Cappuccino