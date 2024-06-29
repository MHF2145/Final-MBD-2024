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


CREATE TABLE WeeklyFinancialAnalysis (
    AnalysisID INT AUTO_INCREMENT PRIMARY KEY,
    Year INT NOT NULL,
    Month INT NOT NULL,
    Week INT NOT NULL,
    WeekStartDate DATE NOT NULL,
    WeekEndDate DATE NOT NULL,
    WeeklyTotalAmount DECIMAL(10,2) NOT NULL
);



DELIMITER //

CREATE PROCEDURE CalculateWeeklyFinancialAnalysis(
    IN p_year INT,
    IN p_month INT,
    IN p_week INT
)
BEGIN
    DECLARE v_start_date DATE;
    DECLARE v_end_date DATE;
    DECLARE v_weekly_total DECIMAL(10,2);
    DECLARE v_temp_date DATE;

    -- Set the first day of the specified month and year
    SET v_start_date = MAKEDATE(p_year, 1) + INTERVAL (p_month - 1) MONTH;

    -- Calculate the start date of the specified week within the month
    SET v_temp_date = v_start_date + INTERVAL ((p_week - 1) * 7) DAY;

    -- Determine the actual start and end dates for the specified week within the month
    SET v_start_date = v_temp_date - INTERVAL (DAYOFWEEK(v_temp_date) - 1) DAY;
    SET v_end_date = v_start_date + INTERVAL 6 DAY;

    -- Calculate the weekly total amount for transactions within the specified week
    SELECT IFNULL(SUM(TotalAmount), 0) INTO v_weekly_total
    FROM Transactions
    WHERE YEAR(Date) = p_year
        AND MONTH(Date) = p_month
        AND WEEK(Date, 1) = p_week;

    -- Insert the result into the WeeklyFinancialAnalysis table
    INSERT INTO WeeklyFinancialAnalysis (Year, Month, Week, WeekStartDate, WeekEndDate, WeeklyTotalAmount)
    VALUES (p_year, p_month, p_week, v_start_date, v_end_date, v_weekly_total);

END //

DELIMITER ;


DELIMITER //

DROP TRIGGER IF EXISTS After_Insert_Transactions //

CREATE TRIGGER After_Insert_Transactions
AFTER INSERT ON Transactions
FOR EACH ROW
BEGIN
    DECLARE v_year INT;
    DECLARE v_month INT;
    DECLARE v_week INT;

    -- Extract year, month, and week number from the transaction date
    SET v_year = YEAR(NEW.Date);
    SET v_month = MONTH(NEW.Date);
    SET v_week = WEEK(NEW.Date, 1); -- Week number starting from Monday

    -- Call the procedure to calculate weekly financial analysis with parameters
    CALL CalculateWeeklyFinancialAnalysis(v_year, v_month, v_week);
END //

DELIMITER ;



-- Total income per bulan
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


-- Total income per tahun
DELIMITER //

CREATE FUNCTION GetTotalIncomeByYear(year INT)
RETURNS DECIMAL(10,2)
BEGIN
    DECLARE total_income DECIMAL(10,2);

    SELECT SUM(TotalAmount) INTO total_income
    FROM Transactions
    WHERE YEAR(Date) = year;

    RETURN total_income;
END //

DELIMITER ;


SELECT GetTotalIncomeByYear(2024);


-- Index and explain
-- Menambahkan indeks pada kolom MenuName di tabel Menu
CREATE INDEX idx_MenuName ON Menu(MenuName);
EXPLAIN SELECT * FROM Menu WHERE MenuName = 'Nasi Goreng Spesial';

-- Menambahkan indeks pada kolom Name di tabel Merchandise
CREATE INDEX idx_Merchandise_Name ON Merchandise(Name);
EXPLAIN SELECT * FROM Merchandise WHERE Name = 'Dragon T-shirt';

-- Menambahkan indeks pada kolom CardName di tabel CardCatalogue
CREATE INDEX idx_CardCatalogue_CardName ON CardCatalogue(CardName);
EXPLAIN SELECT * FROM CardCatalogue WHERE CardName = 'Fire Dragon Pack';
