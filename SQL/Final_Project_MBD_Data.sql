-- Data

-- Employees
INSERT INTO Employees (EmployeeID, Name, Gender, PhoneNumber, Email, Age)
VALUES 
    ('MASTER', 'Surya Alam', 'Male', '151-436-8344', 'suryalam@gmail.com', 21),
    ('MANAGE', 'Alif Satriadi', 'Male', '985-345-2304', 'satrialif@gmail.com', 20),
    ('EMP001', 'Josiah Galenos', 'Male', '123-456-7890', 'joshgale21@gmail.com', 35),
    ('EMP002', 'Tullia Anna', 'Female', '987-654-3210', 'tulip256@yahoo.com', 28),
    ('EMP003', 'Judikael Godehard', 'Male', '555-555-5555', 'kael123@gmail.com', 40),
    ('EMP004', 'Debbora Antonieta', 'Female', '777-777-7777', 'debby27@gmail.com', 32),
    ('EMP005', 'Igino Yedidyah', 'Male', '888-888-8888', 'Igiyhah9@yahoo.com', 29);

-- Membership
INSERT INTO Membership (MembershipID, CustomerID, Rank, JoinDate)
VALUES 
    ('MEM001', 'CUS001', 'Gold', '2023-04-15'),
    ('MEM002', 'CUS002', 'Silver', '2023-05-20'),
    ('MEM003', 'CUS003', 'Bronze', '2023-06-10'),
    ('MEM004', 'CUS004', 'Silver', '2023-07-03'),
    ('MEM005', 'CUS005', 'Bronze', '2023-08-18'),
    ('MEM006', 'CUS006', 'Gold', '2023-09-05');

-- Customers
INSERT INTO Customers (CustomerID, Name, PhoneNumber, Membership_MembershipID)
VALUES 
    ('CUS001', 'Alice Johnson', '111-111-1111', 'MEM001'),
    ('CUS002', 'Bob Smith', '222-222-2222', 'MEM002'),
    ('CUS003', 'Eva Davis', '333-333-3333', 'MEM003'),
    ('CUS004', 'Jack Wilson', '444-444-4444', 'MEM004'),
    ('CUS005', 'Sophia Brown', '555-555-5555', 'MEM005'),
    ('CUS006', 'David Taylor', '666-666-6666', 'MEM006');

-- CardCatalogue
INSERT INTO CardCatalogue (CardID, CardName, CardType, CardPrice, CardStock)
VALUES 
    ('PKMN01', 'Pokemon Sword and Shield "VSTAR UNIVERSE"', 'Booster Pack', 170000.00, 10),
    ('PKMN02', 'Pokemon Scarlet and Violet "Quaxly & Mimikyu ex"', 'Starter Decks', 20000.00, 50),
    ('PKMN03', 'Pokemon Sword and Shield "25th Anniversary Collection', 'Booster Pack', 75000.00, 26),
    ('YGO001', 'Starter Deck Codebreaker', 'Starter Deck', 15000.00, 120),
    ('YGO002', 'Yu-Gi-Oh! "Wild Survivors"', 'Booster Pack', 50000.00, 100),
    ('YGO003', 'Yu-Gi-Oh! "Dimension Force"', 'Booster Pack', 37000.00, 80),
    ('MTG001', 'MTG "Murder at Karlov Manor', 'Play Booster', 500000.00, 7),
    ('MTG002', 'MTG "The Lost Cavern of IXALANT"', 'Bundle Pack', 1300000.00, 5),
    ('MTG003', 'MTG "Wild of Eldraine', 'Booster Display', 290000.00, 20);

-- Merchandise
INSERT INTO Merchandise (ItemID, Name, Type, Price, MerchStock)
VALUES 
    ('MCH001', 'Pokemon Booster Pack', 'Trading Card Game', 40000.99, 200),
    ('MCH002', 'Yu-Gi-Oh! Starter Deck', 'Trading Card Game', 40000.99, 150),
    ('MCH003', 'Magic: The Gathering Deck Box', 'Accessories', 15000.50, 100),
    ('MCH004', 'Pokemon Playmat', 'Accessories', 19000.99, 80),
    ('MCH005', 'Yu-Gi-Oh! Card Sleeves', 'Accessories', 5000.99, 120),
    ('MCH006', 'Magic: The Gathering Dice Set', 'Accessories', 12000.99, 50),
    ('MCH007', 'Pokemon Collectible Figure', 'Collectibles', 70000.99, 90);

-- Menu
INSERT INTO Menu (MenuId, MenuName, MenuType, MenuPrice, MenuStock)
VALUES 
    ('MNU001', 'Iced Coffee', 'Drink', 3000.00, 100),
    ('MNU002', 'Club Sandwich', 'Food', 10000.50, 75),
    ('MNU003', 'Green Tea', 'Drink', 6000.75, 50),
    ('MNU004', 'Caesar Salad', 'Food', 17000.99, 80),
    ('MNU005', 'Orange Juice', 'Drink', 5000.99, 120),
    ('MNU006', 'Margherita Pizza', 'Food', 20000.50, 60),
    ('MNU007', 'Milkshake', 'Drink', 8000.75, 90);

-- Discount
INSERT INTO Discount (DiscountID, DiscountType, DiscountRate)
VALUES 
    ('DIS001', 'Perunggu', 10.00),
    ('DIS002', 'Perak', 15.00),
    ('DIS003', 'Emas', 20.00),
    ('DIS004', 'Black Friday', 70.00),
    ('DIS005', 'Anniversary', 30.00),
    ('DIS006', 'Grand Opening', 20.00);

-- Transactions
INSERT INTO Transactions (TransactionID, Date, TotalItems, TotalAmount, PaymentMethod, Employees_EmployeeID, Customers_CustomerID, Discount_DiscountID)
VALUES 
    ('TRS001', '2024-04-01 08:30:00', 3, 25.00, 'Cash', 'EMP001', 'CUS001', 'DIS001'),
    ('TRS002', '2024-04-02 12:15:00', 2, 15.50, 'Credit Card', 'EMP002', 'CUS002', 'DIS002'),
    ('TRS003', '2024-04-03 14:45:00', 5, 42.75, 'Debit Card', 'EMP003', 'CUS003', NULL),
    ('TRS004', '2024-04-04 10:00:00', 1, 8.99, 'Cash', 'EMP004', 'CUS004', 'DIS003'),
    ('TRS005', '2024-04-05 16:20:00', 4, 33.25, 'Credit Card', 'EMP005', 'CUS005', NULL),
    ('TRS006', '2024-04-06 11:30:00', 2, 18.00, 'Cash', 'EMP001', 'CUS001', 'DIS004'),
    ('TRS007', '2024-04-07 13:45:00', 3, 28.50, 'Credit Card', 'EMP002', 'CUS002', 'DIS005'),
    ('TRS008', '2024-04-08 09:20:00', 1, 12.75, 'Debit Card', 'EMP003', 'CUS003', NULL),
    ('TRS009', '2024-04-09 15:10:00', 4, 35.99, 'Cash', 'EMP004', 'CUS004', 'DIS001'),
    ('TRS010', '2024-04-10 17:00:00', 2, 22.50, 'Credit Card', 'EMP005', 'CUS005', NULL);

-- Transactions_Merchandise
INSERT INTO Transactions_Merchandise (Transactions_TransactionID, Merchandise_ItemID)
VALUES 
    ('TRS001', 'MCH001'),
    ('TRS001', 'MCH002'),
    ('TRS002', 'MCH003'),
    ('TRS003', 'MCH004'),
    ('TRS004', 'MCH005'),
    ('TRS004', 'MCH006'),
    ('TRS005', 'MCH007'),
    ('TRS006', 'MCH005'),
    ('TRS007', 'MCH003'),
    ('TRS008', 'MCH002');

-- Transactions_Menu
INSERT INTO Transactions_Menu (Transactions_TransactionID, Menu_MenuId)
VALUES 
    ('TRS001', 'MNU001'),
    ('TRS001', 'MNU002'),
    ('TRS010', 'MNU003'),
    ('TRS003', 'MNU004'),
    ('TRS004', 'MNU005'),
    ('TRS009', 'MNU006'),
    ('TRS005', 'MNU007'),
    ('TRS010', 'MNU007'),
    ('TRS007', 'MNU002'),
    ('TRS008', 'MNU003');

-- CardCatalogue_Transactions
INSERT INTO CardCatalogue_Transactions (CardCatalogue_CardID, Transactions_TransactionID)
VALUES 
    ('PKMN01', 'TRS001'),
    ('PKMN02', 'TRS001'),
    ('PKMN03', 'TRS001'),
    ('YGO001', 'TRS001'),
    ('YGO002', 'TRS001'),
    ('YGO003', 'TRS001'),
    ('MTG001', 'TRS001'),
    ('MTG002', 'TRS002'),
    ('MTG003', 'TRS002');

