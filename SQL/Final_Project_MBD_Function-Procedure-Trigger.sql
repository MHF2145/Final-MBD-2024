--Function and Procedure
--Procedure to create Transaction Records
DELIMITER / / CREATE PROCEDURE RecordTransaction(
    IN p_TransactionID CHAR(6),
    IN p_Date TIMESTAMP,
    IN p_TotalItems INT,
    IN p_TotalAmount DECIMAL(10, 2),
    IN p_PaymentMethod VARCHAR(50),
    IN p_EmployeeID CHAR(6),
    IN p_CustomerID CHAR(6),
    IN p_DiscountID CHAR(6)
) BEGIN
INSERT INTO
    TransactionLog (
        TransactionID,
        Date,
        TotalItems,
        TotalAmount,
        PaymentMethod,
        Employees_EmployeeID,
        Customers_CustomerID,
        Discount_DiscountID
    )
VALUES
    (
        p_TransactionID,
        p_Date,
        p_TotalItems,
        p_TotalAmount,
        p_PaymentMethod,
        p_EmployeeID,
        p_CustomerID,
        p_DiscountID
    );

END / / DELIMITER;

-- Function to get Membership Rank
DELIMITER / / CREATE FUNCTION GetCustomerMembershipRank(CustomerID CHAR(6)) RETURNS VARCHAR(10) BEGIN DECLARE Rank VARCHAR(10);

SELECT
    m.Rank INTO Rank
FROM
    Membership m
    JOIN Customers c ON c.Membership_MembershipID = m.MembershipID
WHERE
    c.CustomerID = CustomerID;

RETURN Rank;

END / / DELIMITER;

--Procedure to add new customer
DELIMITER / / CREATE PROCEDURE AddNewCustomer(
    IN CustomerID CHAR(6),
    IN Name VARCHAR(100),
    IN PhoneNumber VARCHAR(20),
    IN Membership_MembershipID CHAR(6)
) BEGIN
INSERT INTO
    Customers (
        CustomerID,
        Name,
        PhoneNumber,
        Membership_MembershipID
    )
VALUES
    (
        CustomerID,
        Name,
        PhoneNumber,
        Membership_MembershipID
    );

END / / DELIMITER;

-- Procedure to update stock after Transaction
CREATE PROCEDURE UpdateStockAfterTransaction(IN TransactionID CHAR(6)) BEGIN -- Update CardCatalogue stock
UPDATE
    CardCatalogue cc
    JOIN CardCatalogue_Transactions cct ON cc.CardID = cct.CardCatalogue_CardID
SET
    cc.CardStock = cc.CardStock - 1
WHERE
    cct.Transactions_TransactionID = TransactionID;

-- Update Merchandise stock
UPDATE
    Merchandise m
    JOIN Transactions_Merchandise tm ON m.ItemID = tm.Merchandise_ItemID
SET
    m.MerchStock = m.MerchStock - 1
WHERE
    tm.Transactions_TransactionID = TransactionID;

-- Update Menu stock
UPDATE
    Menu me
    JOIN Transactions_Menu tme ON me.MenuId = tme.Menu_MenuId
SET
    me.MenuStock = me.MenuStock - 1
WHERE
    tme.Transactions_TransactionID = TransactionID;

END;

--Procedure to update CardCataogue Table
DELIMITER / / CREATE PROCEDURE AddOrUpdateCardCatalogue(
    IN CardID CHAR(6),
    IN CardName VARCHAR(100),
    IN CardType VARCHAR(50),
    IN CardPrice DECIMAL(10, 2),
    IN CardStock INT
) BEGIN
INSERT INTO
    CardCatalogue (CardID, CardName, CardType, CardPrice, CardStock)
VALUES
    (CardID, CardName, CardType, CardPrice, CardStock) ON DUPLICATE KEY
UPDATE
    CardName =
VALUES
(CardName),
    CardType =
VALUES
(CardType),
    CardPrice =
VALUES
(CardPrice),
    CardStock = CardCatalogue.CardStock +
VALUES
(CardStock);

END / / DELIMITER;

--Procedure to update Merchandise Table
DELIMITER / / CREATE PROCEDURE AddOrUpdateMerchandise(
    IN ItemID CHAR(6),
    IN Name VARCHAR(100),
    IN Type VARCHAR(50),
    IN Price DECIMAL(10, 2),
    IN MerchStock INT
) BEGIN
INSERT INTO
    Merchandise (ItemID, Name, Type, Price, MerchStock)
VALUES
    (ItemID, Name, Type, Price, MerchStock) ON DUPLICATE KEY
UPDATE
    Name =
VALUES
(Name),
    Type =
VALUES
(Type),
    Price =
VALUES
(Price),
    MerchStock = Merchandise.MerchStock +
VALUES
(MerchStock);

END / / DELIMITER;

--Procedure to update Menu Table
DELIMITER / / CREATE PROCEDURE AddOrUpdateMenu(
    IN MenuId CHAR(6),
    IN MenuName VARCHAR(100),
    IN MenuType VARCHAR(20),
    IN MenuPrice DECIMAL(10, 2),
    IN MenuStock INT
) BEGIN
INSERT INTO
    Menu (MenuId, MenuName, MenuType, MenuPrice, MenuStock)
VALUES
    (MenuId, MenuName, MenuType, MenuPrice, MenuStock) ON DUPLICATE KEY
UPDATE
    MenuName =
VALUES
(MenuName),
    MenuType =
VALUES
(MenuType),
    MenuPrice =
VALUES
(MenuPrice),
    MenuStock = Menu.MenuStock +
VALUES
(MenuStock);

END / / DELIMITER;

-- Procedure to update Membership Table
DELIMITER / / CREATE PROCEDURE AddOrUpdateMember(
    IN NewCustomerID CHAR(6),
    IN NewName VARCHAR(100),
    IN NewPhoneNumber VARCHAR(20),
    IN NewMembershipID CHAR(6),
    IN NewRank VARCHAR(10),
    IN NewJoinDate TIMESTAMP
) BEGIN DECLARE CustomerExists INT;

DECLARE MembershipExists INT;

-- Cek apakah Customer ID sudah ada
SELECT
    COUNT(*) INTO CustomerExists
FROM
    Customers
WHERE
    CustomerID = NewCustomerID;

-- Cek apakah Membership ID sudah ada
SELECT
    COUNT(*) INTO MembershipExists
FROM
    Membership
WHERE
    MembershipID = NewMembershipID;

IF CustomerExists = 0 THEN -- Tambahkan ke tabel Customers jika pelanggan baru
INSERT INTO
    Customers (
        CustomerID,
        Name,
        PhoneNumber,
        Membership_MembershipID
    )
VALUES
    (
        NewCustomerID,
        NewName,
        NewPhoneNumber,
        NewMembershipID
    );

ELSE -- Perbarui informasi pelanggan jika pelanggan sudah ada
UPDATE
    Customers
SET
    Name = NewName,
    PhoneNumber = NewPhoneNumber,
    Membership_MembershipID = NewMembershipID
WHERE
    CustomerID = NewCustomerID;

END IF;

IF MembershipExists = 0 THEN -- Tambahkan ke tabel Membership jika keanggotaan baru
INSERT INTO
    Membership (MembershipID, CustomerID, Rank, JoinDate)
VALUES
    (
        NewMembershipID,
        NewCustomerID,
        NewRank,
        NewJoinDate
    );

ELSE SIGNAL SQLSTATE '45000'
SET
    MESSAGE_TEXT = 'Duplicate Membership ID: The MembershipID already exists.';

END IF;

END / / DELIMITER;

--Triggers
-- Create Log after Insertion on Transaction
DELIMITER / / CREATE TRIGGER After_Insert_Transactions
AFTER
INSERT
    ON transactions FOR EACH ROW BEGIN CALL RecordTransaction(
        NEW.TransactionID,
        NEW.Date,
        NEW.TotalItems,
        NEW.TotalAmount,
        NEW.PaymentMethod,
        NEW.Employees_EmployeeID,
        NEW.Customers_CustomerID,
        NEW.Discount_DiscountID
    );

END;

/ / DELIMITER;