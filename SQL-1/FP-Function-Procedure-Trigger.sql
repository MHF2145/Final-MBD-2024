-- Procedure for Membership table
DELIMITER //

CREATE PROCEDURE AddOrUpdateMembership(
    IN p_CustomerID CHAR(6),
    IN p_Name VARCHAR(100),
    IN p_PhoneNumber VARCHAR(20),
    IN p_Rank VARCHAR(10),
    IN p_JoinDate TIMESTAMP
)
BEGIN
    DECLARE v_MembershipID CHAR(6);
    DECLARE v_ExistingCustomer INT;
    
    -- Check if customer already exists
    SELECT COUNT(*) INTO v_ExistingCustomer FROM Customers WHERE CustomerID = p_CustomerID;
    
    IF v_ExistingCustomer = 0 THEN
        -- Add new customer
        INSERT INTO Customers (CustomerID, Name, PhoneNumber, Membership_MembershipID)
        VALUES (p_CustomerID, p_Name, p_PhoneNumber, NULL);
    ELSE
        -- Update customer information if necessary
        UPDATE Customers
        SET Name = p_Name, PhoneNumber = p_PhoneNumber
        WHERE CustomerID = p_CustomerID;
    END IF;
    
    -- Check if membership already exists
    SELECT MembershipID INTO v_MembershipID FROM Membership WHERE CustomerID = p_CustomerID;
    
    IF v_MembershipID IS NULL THEN
        -- Generate new MembershipID
        SET v_MembershipID = CONCAT('MEM', LPAD((SELECT COUNT(*)+1 FROM Membership), 3, '0'));
        
        -- Add new membership
        INSERT INTO Membership (MembershipID, CustomerID, Rank, JoinDate)
        VALUES (v_MembershipID, p_CustomerID, p_Rank, p_JoinDate);
        
        -- Update customer's membership id
        UPDATE Customers
        SET Membership_MembershipID = v_MembershipID
        WHERE CustomerID = p_CustomerID;
    ELSE
        -- Update existing membership
        UPDATE Membership
        SET Rank = p_Rank, JoinDate = p_JoinDate
        WHERE CustomerID = p_CustomerID;
    END IF;
END //

DELIMITER ;


-- Function
-- Function To Calculate Discount
DELIMITER //

CREATE FUNCTION CalculateDiscount(
    customer_id CHAR(6)
) RETURNS DECIMAL(10, 2)
BEGIN
    DECLARE discount_rate DECIMAL(5, 2);

    SELECT d.DiscountRate 
    INTO discount_rate
    FROM Customers c
    JOIN Membership m ON c.Membership_MembershipID = m.MembershipID
    JOIN Discount d ON m.Rank = d.DiscountType
    WHERE c.CustomerID = customer_id;

    RETURN discount_rate;
END //

DELIMITER ;

--Function to Calculate Total Amount
DELIMITER //

CREATE FUNCTION CalculateTotalAmount(
    item_ids TEXT,
    item_quantities TEXT
) RETURNS DECIMAL(10, 2)
BEGIN
    DECLARE total_amount DECIMAL(10, 2) DEFAULT 0.00;
    DECLARE item_id CHAR(6);
    DECLARE quantity INT;
    DECLARE item_price DECIMAL(10, 2);
    DECLARE remaining_item_ids TEXT;
    DECLARE remaining_item_quantities TEXT;

    SET remaining_item_ids = item_ids;
    SET remaining_item_quantities = item_quantities;

    -- Iterate through items and calculate total
    WHILE LOCATE(',', remaining_item_ids) > 0 DO
        SET item_id = LEFT(remaining_item_ids, LOCATE(',', remaining_item_ids) - 1);
        SET quantity = CAST(LEFT(remaining_item_quantities, LOCATE(',', remaining_item_quantities) - 1) AS UNSIGNED);

        -- Remove processed item from list
        SET remaining_item_ids = SUBSTRING(remaining_item_ids, LOCATE(',', remaining_item_ids) + 1);
        SET remaining_item_quantities = SUBSTRING(remaining_item_quantities, LOCATE(',', remaining_item_quantities) + 1);

        -- Get item price and update total
        IF (SELECT COUNT(*) FROM Merchandise WHERE ItemID = item_id) > 0 THEN
            SET item_price = (SELECT Price FROM Merchandise WHERE ItemID = item_id);
        ELSEIF (SELECT COUNT(*) FROM CardCatalogue WHERE CardID = item_id) > 0 THEN
            SET item_price = (SELECT CardPrice FROM CardCatalogue WHERE CardID = item_id);
        ELSEIF (SELECT COUNT(*) FROM Menu WHERE MenuId = item_id) > 0 THEN
            SET item_price = (SELECT MenuPrice FROM Menu WHERE MenuId = item_id);
        END IF;

        SET total_amount = total_amount + (item_price * quantity);
    END WHILE;

    -- Handle the last item
    SET item_id = remaining_item_ids;
    SET quantity = CAST(remaining_item_quantities AS UNSIGNED);

    IF (SELECT COUNT(*) FROM Merchandise WHERE ItemID = item_id) > 0 THEN
        SET item_price = (SELECT Price FROM Merchandise WHERE ItemID = item_id);
    ELSEIF (SELECT COUNT(*) FROM CardCatalogue WHERE CardID = item_id) > 0 THEN
        SET item_price = (SELECT CardPrice FROM CardCatalogue WHERE CardID = item_id);
    ELSEIF (SELECT COUNT(*) FROM Menu WHERE MenuId = item_id) > 0 THEN
        SET item_price = (SELECT MenuPrice FROM Menu WHERE MenuId = item_id);
    END IF;

    SET total_amount = total_amount + (item_price * quantity);

    RETURN total_amount;
END //

DELIMITER ;

-- Function to Calculate Total Item
DELIMITER //

CREATE FUNCTION CalculateTotalItems(
    item_ids TEXT, 
    item_quantities TEXT
) RETURNS INT
BEGIN
    DECLARE total_items INT DEFAULT 0;
    DECLARE current_quantity INT;
    DECLARE remaining_item_quantities TEXT;

    -- Initialize remaining_item_quantities for iteration
    SET remaining_item_quantities = item_quantities;

    -- Iterate through item_quantities to calculate total items
    WHILE LENGTH(remaining_item_quantities) > 0 DO
        -- Get quantity from the start of the list
        SET current_quantity = CAST(SUBSTRING_INDEX(remaining_item_quantities, ',', 1) AS UNSIGNED);

        -- Update remaining quantities by removing processed quantity
        SET remaining_item_quantities = TRIM(BOTH ',' FROM SUBSTRING(remaining_item_quantities, LENGTH(current_quantity) + 2));

        -- Accumulate total items
        SET total_items = total_items + current_quantity;
    END WHILE;

    RETURN total_items;
END //

DELIMITER ;



-- Procedure untuk membuat Transaksi baru
DELIMITER //

CREATE PROCEDURE AddTransaction(
    IN transaction_id CHAR(6),
    IN customer_id CHAR(6),
    IN employee_id CHAR(6),
    IN payment_method VARCHAR(50),
    IN item_ids TEXT, -- Comma-separated item IDs
    IN item_quantities TEXT -- Comma-separated quantities
)
BEGIN
    DECLARE total_items INT;
    DECLARE total_amount DECIMAL(10, 2);
    DECLARE discount_rate DECIMAL(5, 2) DEFAULT 0.00;
    DECLARE final_amount DECIMAL(10, 2);
    DECLARE discount_id CHAR(6) DEFAULT NULL; -- Initialize as NULL
    DECLARE remaining_item_ids TEXT;
    DECLARE remaining_item_quantities TEXT;
    DECLARE current_item_id CHAR(6);
    DECLARE current_quantity INT;

    -- Calculate discount rate based on customer's membership or other criteria
    SET discount_rate = CalculateDiscount(customer_id);
    
    -- Get DiscountID based on discount_rate
    SELECT DiscountID INTO discount_id
    FROM Discount
    WHERE DiscountRate = discount_rate;

    -- Calculate total amount using the function
    SET total_amount = CalculateTotalAmount(item_ids, item_quantities);

    -- Calculate total items using the new function
    SET total_items = CalculateTotalItems(item_ids, item_quantities);

    -- Insert into Transactions table (without item details yet)
    INSERT INTO Transactions (TransactionID, Date, TotalItems, TotalAmount, PaymentMethod, Employees_EmployeeID, Customers_CustomerID, DiscountID, item_ids, item_quantities)
    VALUES (transaction_id, NOW(), total_items, 0.00, payment_method, employee_id, customer_id, discount_id, item_ids, item_quantities);

    -- Initialize remaining items for iteration
    SET remaining_item_ids = item_ids;
    SET remaining_item_quantities = item_quantities;

    -- Iterate through items to calculate total items and insert into respective tables
    WHILE LENGTH(remaining_item_ids) > 0 DO
        -- Get item_id and quantity from the start of the list
        SET current_item_id = SUBSTRING_INDEX(remaining_item_ids, ',', 1);
        SET current_quantity = CAST(SUBSTRING_INDEX(remaining_item_quantities, ',', 1) AS UNSIGNED);

        -- Insert into Transactions_Menu or CardCatalogue_Transactions based on item type
        IF LEFT(current_item_id, 3) = 'MNU' THEN
            INSERT INTO Transactions_Menu (Transactions_TransactionID, Menu_MenuId)
            SELECT transaction_id, current_item_id
            WHERE EXISTS (SELECT 1 FROM Menu WHERE MenuId = current_item_id);
        ELSEIF LEFT(current_item_id, 3) = 'MCH' THEN
            INSERT INTO Transactions_Merchandise (Transactions_TransactionID, Merchandise_ItemID)
            SELECT transaction_id, current_item_id
            WHERE EXISTS (SELECT 1 FROM Merchandise WHERE ItemID = current_item_id);
        ELSE
            -- Assume it belongs to CardCatalogue
            INSERT INTO CardCatalogue_Transactions (CardCatalogue_CardID, Transactions_TransactionID)
            SELECT current_item_id, transaction_id
            WHERE EXISTS (SELECT 1 FROM CardCatalogue WHERE CardID = current_item_id);
        END IF;

        -- Update remaining items by removing processed item
        SET remaining_item_ids = TRIM(BOTH ',' FROM SUBSTRING(remaining_item_ids, LENGTH(current_item_id) + 2));
        SET remaining_item_quantities = TRIM(BOTH ',' FROM SUBSTRING(remaining_item_quantities, LENGTH(current_quantity) + 2));
    END WHILE;

    -- Calculate final amount after discount
    SET final_amount = total_amount - (total_amount * (discount_rate / 100));

    -- Update total amount in Transactions table
    UPDATE Transactions
    SET TotalAmount = final_amount
    WHERE TransactionID = transaction_id;
    
END //

DELIMITER ;


-- Trigger 
-- Trigger to Update Item Stock
DELIMITER //

CREATE TRIGGER AfterTransactionInsert
AFTER INSERT ON Transactions
FOR EACH ROW
BEGIN
    DECLARE item_id CHAR(6);
    DECLARE quantity INT;
    DECLARE remaining_item_ids TEXT;
    DECLARE remaining_item_quantities TEXT;

    SET remaining_item_ids = NEW.item_ids;
    SET remaining_item_quantities = NEW.item_quantities;

    -- Iterate through items to update stock
    WHILE LOCATE(',', remaining_item_ids) > 0 DO
        SET item_id = LEFT(remaining_item_ids, LOCATE(',', remaining_item_ids) - 1);
        SET quantity = CAST(LEFT(remaining_item_quantities, LOCATE(',', remaining_item_quantities) - 1) AS UNSIGNED);

        -- Remove processed item from list
        SET remaining_item_ids = SUBSTRING(remaining_item_ids, LOCATE(',', remaining_item_ids) + 1);
        SET remaining_item_quantities = SUBSTRING(remaining_item_quantities, LOCATE(',', remaining_item_quantities) + 1);

        -- Call procedure to update stock
        CALL UpdateItemStock(item_id, quantity);
    END WHILE;

    -- Handle the last item
    SET item_id = remaining_item_ids;
    SET quantity = CAST(remaining_item_quantities AS UNSIGNED);

    -- Call procedure to update stock
    CALL UpdateItemStock(item_id, quantity);
END //

DELIMITER ;