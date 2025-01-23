---------- Database ----------
-- TABLE Products --
CREATE TABLE Products (
    product_id VARCHAR(10) PRIMARY KEY,
	type tinyint DEFAULT 1, -- 1: plant, 2: pot
    code VARCHAR(15),
    name NVARCHAR(255),
    short_description NVARCHAR(MAX),
    detailed_description NVARCHAR(MAX),
    price BIGINT,
    total_orders INT,
    total_ratings INT,
    overall_stars FLOAT,
    is_returnable TINYINT DEFAULT 1,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);
-- =>  ROWS 940
-- xoá not null và unique của name và xoá indentity, THAY DOI INT -> VARCHAR(10), TEXT -> NVARCHAR(MAX) 
drop table Products
select * from Products;

-- TABLE Categories --
CREATE TABLE Categories (
    category_id VARCHAR(10) PRIMARY KEY,
    name NVARCHAR(100) NOT NULL UNIQUE,
    background_url VARCHAR(255),
    description NVARCHAR(MAX),
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);
-- => 52 ROWS 
-- xoá not null background_url và xoá indentity, THAY DOI INT -> VARCHAR(10), TEXT -> NVARCHAR(MAX) 
drop table Categories
select * from Categories

-- TABLE Product_Categories --
CREATE TABLE Product_Categories (
    product_id VARCHAR(10) ,
    category_id VARCHAR(10) ,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    PRIMARY KEY (product_id, category_id)
);

-- => 5930 ROWS
-- INT -> VARCHAR(10) 
drop table Product_Categories

SELECT * FROM Product_Categories

-- TABLE Attributes --
CREATE TABLE Attributes (
    attribute_id VARCHAR(10) PRIMARY KEY,
    name NVARCHAR(30) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

-- => 34 ROWS 
-- xoá indentity, INT -> VARCHAR(10), VARCHAR(20) -> NVARCHAR(30), xoá cột description
drop table Attributes
select * from Attributes

-- TABLE Product_Attributes --
CREATE TABLE Product_Attributes (
    product_id VARCHAR(10),
    attribute_id VARCHAR(10),
    value NVARCHAR(255),
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    PRIMARY KEY (product_id, attribute_id)
);
-- => 5085 ROWS 
-- INT -> VARCHAR(10), VARCHAR(255) -> NVARCHAR(255)
drop table Product_Attributes
select * from Product_Attributes

-- TABLE Product_Images --
CREATE TABLE Product_Images (
    product_image_id INT IDENTITY(1, 1) PRIMARY KEY,
    product_id VARCHAR(10),
    product_image_name VARCHAR(100),
    product_image VARBINARY(MAX),
    product_image_url VARCHAR(255),
    image_type TINYINT DEFAULT 1, -- 1: product, 2: slideshow in homepage
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
); 

-- => 1961 ROWS
-- INT -> VARCHAR(10), VARCHAR(255) -> NVARCHAR(255)
drop table Product_Images
select * from Product_Images

---------- Processing ----------
CREATE TABLE Product_Feedbacks (
    product_feedback_id INT PRIMARY KEY IDENTITY,
    product_id VARCHAR(10),
    user_id INT NULL,
    feedback_content TEXT,
    num_star INT NOT NULL, -- 1, 2, 3, 4, 5 stars
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

CREATE TABLE Feedback_Images (
    feedback_image_id INT PRIMARY KEY IDENTITY,
    product_feedback_id INT,
    feedback_image VARBINARY(MAX),
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

--
CREATE TABLE Vouchers (
    voucher_id CHAR(6) PRIMARY KEY,
    voucher_name VARCHAR(255),
    voucher_type VARCHAR(50),
    description TEXT,
    voucher_start_date DATETIME,
    voucher_end_date DATETIME,
    value INT,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

--
CREATE TABLE Users (
    user_id INT PRIMARY KEY IDENTITY,
    role_type TINYINT NOT NULL, -- 1: Admin, 0: User
    email VARCHAR(150) UNIQUE,
    full_name NVARCHAR(50) NOT NULL,
    user_name NVARCHAR(50) UNIQUE,
    password VARCHAR(32), -- not sure about datatype
    phone_number CHAR(10) NOT NULL UNIQUE,
    province_city NVARCHAR(255) NOT NULL,
    district NVARCHAR(255) NOT NULL,
    commune_ward NVARCHAR(255),
    address NVARCHAR(255) NOT NULL,
    gender NVARCHAR(4),
    date_of_birth DATE,
    avatar VARBINARY(MAX),
    card_id INT,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

CREATE TABLE Carts (
    cart_id INT PRIMARY KEY IDENTITY,
    items_count INT,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

CREATE TABLE Cart_Items (
    cart_id INT,
    product_id VARCHAR(10),
    quantity INT,
    unit_price INT,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    PRIMARY KEY (cart_id, product_id)
);

--
CREATE TABLE Orders (
    order_id INT PRIMARY KEY IDENTITY,
    user_id INT,
    voucher_id CHAR(6),
    provisional_price INT,
    deliver_cost INT,
    total_price INT,
    payment_date DATETIME,
    payment_method VARCHAR(50),
    is_paid TINYINT DEFAULT 0,
    is_delivered TINYINT DEFAULT 0,
    additional_note TEXT,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

CREATE TABLE Order_Items (
    order_items_id INT PRIMARY KEY IDENTITY,
    order_id INT,
    product_id VARCHAR(10),
    quantity INT,
    total_price INT,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

--
CREATE TABLE Return_Refund_Items (
    return_refund_id INT PRIMARY KEY IDENTITY,
    order_items_id INT,
    user_id INT,
    type VARCHAR(50),
    quantity INT DEFAULT 1,
    reason_tag VARCHAR(100),
    reason_description TEXT,
    status VARCHAR(25),
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

CREATE TABLE Refund_Return_Images (
    refund_return_image_id INT PRIMARY KEY IDENTITY,
    refund_return_image VARBINARY(MAX),
    return_refund_id INT,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

----- FOREIGN KEY -----
ALTER TABLE Users
ADD CONSTRAINT FK_Users_Carts FOREIGN KEY (card_id) REFERENCES Carts(cart_id);

ALTER TABLE Product_Categories
ADD CONSTRAINT FK_ProductCategories_Products FOREIGN KEY (product_id) REFERENCES Products(product_id);

ALTER TABLE Product_Categories
ADD CONSTRAINT FK_ProductCategories_Categories FOREIGN KEY (category_id) REFERENCES Categories(category_id);

ALTER TABLE Product_Attributes
ADD CONSTRAINT FK_ProductAttributes_Products FOREIGN KEY (product_id) REFERENCES Products(product_id);

ALTER TABLE Product_Attributes
ADD CONSTRAINT FK_ProductAttributes_Attributes FOREIGN KEY (attribute_id) REFERENCES Attributes(attribute_id);

ALTER TABLE Product_Feedbacks
ADD CONSTRAINT FK_Feedbacks_Products FOREIGN KEY (product_id) REFERENCES Products(product_id);

ALTER TABLE Product_Feedbacks
ADD CONSTRAINT FK_Feedbacks_Users FOREIGN KEY (user_id) REFERENCES Users(user_id);

ALTER TABLE Feedback_Images
ADD CONSTRAINT FK_FeedbackImages_Feedbacks FOREIGN KEY (product_feedback_id) REFERENCES Product_Feedbacks(product_feedback_id);

ALTER TABLE Orders
ADD CONSTRAINT FK_Orders_Users FOREIGN KEY (user_id) REFERENCES Users(user_id);

ALTER TABLE Orders
ADD CONSTRAINT FK_Orders_Vouchers FOREIGN KEY (voucher_id) REFERENCES Vouchers(voucher_id);

ALTER TABLE Order_Items
ADD CONSTRAINT FK_OrderItems_Orders FOREIGN KEY (order_id) REFERENCES Orders(order_id);

ALTER TABLE Order_Items
ADD  CONSTRAINT FK_OrderItems_Products FOREIGN KEY (product_id) REFERENCES Products(product_id);

ALTER TABLE Return_Refund_Items
ADD CONSTRAINT FK_ReturnRefund_OrderItems FOREIGN KEY (order_items_id) REFERENCES Order_Items(order_items_id);

ALTER TABLE Return_Refund_Items
ADD CONSTRAINT FK_ReturnRefund_Users FOREIGN KEY (user_id) REFERENCES Users(user_id);

ALTER TABLE Refund_Return_Images
ADD CONSTRAINT FK_RefundImages_ReturnRefund FOREIGN KEY (return_refund_id) REFERENCES Return_Refund_Items(return_refund_id);

------ TRIGGERS ------


----- PROCEDURES -----


--------------------------------- Xoá tất cả các khoá ngoại ---------------------------------
DECLARE @sql NVARCHAR(MAX) = N'';
SELECT 
    @sql += 'ALTER TABLE ' + QUOTENAME(OBJECT_SCHEMA_NAME(parent_object_id)) + '.' + QUOTENAME(OBJECT_NAME(parent_object_id)) + 
    ' DROP CONSTRAINT ' + QUOTENAME(name) + ';' + CHAR(13)
FROM sys.foreign_keys;
EXEC sp_executesql @sql;

------------------------------------ Xoá tất cả các bảng ------------------------------------
DECLARE @sql NVARCHAR(MAX) = N'';
SELECT @sql += 'DROP TABLE ' + QUOTENAME(SCHEMA_NAME(schema_id)) + '.' + QUOTENAME(name) + ';' + CHAR(13)
FROM sys.tables;
EXEC sp_executesql @sql;