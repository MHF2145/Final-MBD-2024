-- Table: Transaction_Log
CREATE TABLE Transaction_Log (
    LogID INT AUTO_INCREMENT PRIMARY KEY,
    TransactionID CHAR(6) NOT NULL,
    LogTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    LogMessage VARCHAR(255) NOT NULL,
    FOREIGN KEY (TransactionID) REFERENCES Transactions(TransactionID)
);


DELIMITER //

CREATE PROCEDURE Log_Transaction(
    IN p_TransactionID CHAR(6),
    IN p_LogMessage VARCHAR(255)
)
BEGIN
    DECLARE v_LogMessage VARCHAR(255);

    SET v_LogMessage = CONCAT('Transaction ', p_TransactionID, ': ', p_LogMessage);

    INSERT INTO Transaction_Log (TransactionID, LogMessage)
    VALUES (p_TransactionID, v_LogMessage);
END //

DELIMITER ;

-- Create trigger to automatically log transactions
DELIMITER //

CREATE TRIGGER trg_after_insert_transactions
AFTER INSERT ON Transactions
FOR EACH ROW
BEGIN
    DECLARE v_LogMessage VARCHAR(255);
    
    SET v_LogMessage = CONCAT('Transaction ', NEW.TransactionID, ': Transaction created successfully.');
    
    -- Call the logging procedure
    CALL Log_Transaction(NEW.TransactionID, v_LogMessage);
END //

DELIMITER ;

-- Insert transactions for testing trigger
INSERT INTO Transactions (TransactionID, Date, TotalItems, TotalAmount, PaymentMethod, Employees_EmployeeID, Customers_CustomerID, Discount_DiscountID)
VALUES 
('T00008', '2024-06-08 10:00:00', 3, 72000.00, 'Credit Card', 'E00008', 'C00008', 'DIS003'),
('T00009', '2024-06-09 11:00:00', 1, 15000.00, 'Cash', 'E00009', 'C00009', 'DIS001');


CALL Log_Transaction('T00001', 'Transaction created successfully.');    

SELECT * FROM Transaction_Log;


DELIMITER //

CREATE FUNCTION GetTotalIncomeByMonth(year INT, month INT)
RETURNS DECIMAL(10,2)
BEGIN
    DECLARE total_income DECIMAL(10,2);

    SELECT SUM(TotalAmount) INTO total_income
    FROM Transactions
    WHERE YEAR(Date) = year AND MONTH(Date) = month;

    RETURN total_income;
END //

DELIMITER ;

-- Contoh penggunaan fungsi GetTotalIncomeByMonth
SELECT GetTotalIncomeByMonth(2024, 6) AS TotalIncome;


