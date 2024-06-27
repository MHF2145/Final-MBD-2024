    -- Created by Vertabelo (http://vertabelo.com)
    -- Last modification date: 2024-05-02 08:46:25.755

    -- tables
    -- Table: CardCatalogue
    CREATE TABLE CardCatalogue (
        CardID char(6)  NOT NULL,
        CardName varchar(100)  NOT NULL,
        CardType varchar(50)  NOT NULL,
        CardPrice decimal(10,2)  NOT NULL,
        CardStock int  NOT NULL,
        CONSTRAINT CardCatalogue_pk PRIMARY KEY (CardID)
    ); 

    -- Table: Customers
    CREATE TABLE Customers (
        CustomerID char(6)  NOT NULL,
        Name varchar(100)  NOT NULL,
        PhoneNumber varchar(20)  NOT NULL,
        Membership_MembershipID char(6)  NULL,
        CONSTRAINT Customers_pk PRIMARY KEY (CustomerID)
    );

    -- Table: Discount
    CREATE TABLE Discount (
        DiscountID char(6)  NOT NULL,
        DiscountType varchar(30)  NOT NULL,
        DiscountRate decimal(5,2)  NOT NULL,
        CONSTRAINT Discount_pk PRIMARY KEY (DiscountID)
    );

    -- Table: Employees
    CREATE TABLE Employees (
        EmployeeID char(6)  NOT NULL,
        Name varchar(100)  NOT NULL,
        Gender varchar(10)  NOT NULL,
        PhoneNumber varchar(20)  NOT NULL,
        Email varchar(100)  NOT NULL,
        Age int  NOT NULL,
        CONSTRAINT Employees_pk PRIMARY KEY (EmployeeID)
    );

    -- Table: Membership
    CREATE TABLE Membership (
        MembershipID char(6)  NOT NULL,
        CustomerID char(6) NOT NULL,
        Rank varchar(10)  NOT NULL,
        JoinDate timestamp  NOT NULL,
        CONSTRAINT Membership_pk PRIMARY KEY (MembershipID)
    );

    -- Table: Menu
    CREATE TABLE Menu (
        MenuId char(6)  NOT NULL,
        MenuName varchar(100)  NOT NULL,
        MenuType varchar(20)  NOT NULL,
        MenuPrice int  NOT NULL,
        MenuStock int  NOT NULL,
        CONSTRAINT Menu_pk PRIMARY KEY (MenuId)
    );

    -- Table: Merchandise
    CREATE TABLE Merchandise (
        ItemID char(6)  NOT NULL,
        Name varchar(100)  NOT NULL,
        Type varchar(50)  NOT NULL,
        Price decimal(10,2)  NOT NULL,
        MerchStock int  NOT NULL,
        CONSTRAINT Merchandise_pk PRIMARY KEY (ItemID)
    );

    -- Table: Transactions
    CREATE TABLE Transactions (
        TransactionID char(6)  NOT NULL,
        Date timestamp  NOT NULL,
        TotalItems int  NOT NULL,
        TotalAmount decimal(10,2)  NOT NULL,
        PaymentMethod varchar(50)  NOT NULL,
        Employees_EmployeeID char(6)  NOT NULL,
        Customers_CustomerID char(6)  NOT NULL,
        Discount_DiscountID char(6)  NULL,
        CONSTRAINT Transactions_pk PRIMARY KEY (TransactionID)
    );

    -- Table: Transactions_Menu
    CREATE TABLE Transactions_Menu (
        Transactions_TransactionID char(6)  NOT NULL,
        Menu_MenuId char(6)  NOT NULL,
        CONSTRAINT Transactions_Menu_pk PRIMARY KEY (Transactions_TransactionID,Menu_MenuId)
    );

    -- Table: Transactions_Merchandise
    CREATE TABLE Transactions_Merchandise (
        Transactions_TransactionID char(6)  NOT NULL,
        Merchandise_ItemID char(6)  NOT NULL,
        CONSTRAINT Transactions_Merchandise_pk PRIMARY KEY (Transactions_TransactionID,Merchandise_ItemID)
    );

        -- Table: Transactions_CardCatalogue
    CREATE TABLE Transactions_CardCatalogue (
        Transactions_TransactionID char(6)  NOT NULL,
        CardCatalogue_CardID char(6)  NOT NULL,
        CONSTRAINT Transactions_CardCatalogue_pk PRIMARY KEY (CardCatalogue_CardID,Transactions_TransactionID)
    );

    -- foreign keys
    -- Reference: Transactions_CardCatalogue_CardCatalogue (table: Transactions_CardCatalogue)
    ALTER TABLE Transactions_CardCatalogue ADD CONSTRAINT Transactions_CardCatalogue_CardCatalogue FOREIGN KEY Transactions_CardCatalogue_CardCatalogue (CardCatalogue_CardID)
        REFERENCES CardCatalogue (CardID);

    -- Reference: Transactions_CardCatalogue_Transactions (table: Transactions_CardCatalogue)
    ALTER TABLE Transactions_CardCatalogue ADD CONSTRAINT Transactions_CardCatalogue_Transactions FOREIGN KEY Transactions_CardCatalogue_Transactions (Transactions_TransactionID)
        REFERENCES Transactions (TransactionID);

    -- Reference: Customers_Membership (table: Customers)
    ALTER TABLE Customers ADD CONSTRAINT Customers_Membership FOREIGN KEY Customers_Membership (Membership_MembershipID)
        REFERENCES Membership (MembershipID);

    -- Reference: Transactions_Customers (table: Transactions)
    ALTER TABLE Transactions ADD CONSTRAINT Transactions_Customers FOREIGN KEY Transactions_Customers (Customers_CustomerID)
        REFERENCES Customers (CustomerID);

    -- Reference: Transactions_Discount (table: Transactions)
    ALTER TABLE Transactions ADD CONSTRAINT Transactions_Discount FOREIGN KEY Transactions_Discount (Discount_DiscountID)
        REFERENCES Discount (DiscountID);

    -- Reference: Transactions_Employees (table: Transactions)
    ALTER TABLE Transactions ADD CONSTRAINT Transactions_Employees FOREIGN KEY Transactions_Employees (Employees_EmployeeID)
        REFERENCES Employees (EmployeeID);

    -- Reference: Transactions_Menu_Menu (table: Transactions_Menu)
    ALTER TABLE Transactions_Menu ADD CONSTRAINT Transactions_Menu_Menu FOREIGN KEY Transactions_Menu_Menu (Menu_MenuId)
        REFERENCES Menu (MenuId);

    -- Reference: Transactions_Menu_Transactions (table: Transactions_Menu)
    ALTER TABLE Transactions_Menu ADD CONSTRAINT Transactions_Menu_Transactions FOREIGN KEY Transactions_Menu_Transactions (Transactions_TransactionID)
        REFERENCES Transactions (TransactionID);

    -- Reference: Transactions_Merchandise_Merchandise (table: Transactions_Merchandise)
    ALTER TABLE Transactions_Merchandise ADD CONSTRAINT Transactions_Merchandise_Merchandise FOREIGN KEY Transactions_Merchandise_Merchandise (Merchandise_ItemID)
        REFERENCES Merchandise (ItemID);

    -- Reference: Transactions_Merchandise_Transactions (table: Transactions_Merchandise)
    ALTER TABLE Transactions_Merchandise ADD CONSTRAINT Transactions_Merchandise_Transactions FOREIGN KEY Transactions_Merchandise_Transactions (Transactions_TransactionID)
        REFERENCES Transactions (TransactionID);

    -- End of file.