-- Data

-- Employees
INSERT INTO Employees (EmployeeID, Name, Gender, PhoneNumber, Email, Age) VALUES
('MASTER', 'Surya Alam', 'Male', '123-876-7890', 'gale21@gmail.com', 20),
('MANAGE', 'Alif Satriadi', 'Male', '123-434-7890', 'joshe21@gmail.com', 20),
('E00001', 'Alice Smith', 'Female', '081234567890', 'alice@example.com', 28),
('E00002', 'Bob Johnson', 'Male', '081234567891', 'bob@example.com', 32),
('E00003', 'Charlie Davis', 'Male', '081234567892', 'charlie@example.com', 29),
('E00004', 'David Wilson', 'Male', '081234567893', 'david@example.com', 35),
('E00005', 'Eva Brown', 'Female', '081234567894', 'eva@example.com', 26),
('E00006', 'Frank Miller', 'Male', '081234567895', 'frank@example.com', 40),
('E00007', 'Grace Lee', 'Female', '081234567896', 'grace@example.com', 30),
('E00008', 'Hannah Taylor', 'Female', '081234567897', 'hannah@example.com', 27),
('E00009', 'Ian Anderson', 'Male', '081234567898', 'ian@example.com', 33),
('E00010', 'Julia Thomas', 'Female', '081234567899', 'julia@example.com', 31);

-- Membership
INSERT INTO Membership (MembershipID, CustomerID, Rank, JoinDate) VALUES
('M00001', 'C00001', 'Gold', '2023-01-01 10:00:00'),
('M00002', 'C00002', 'Silver', '2023-01-02 11:00:00'),
('M00003', 'C00003', 'Gold', '2023-01-03 12:00:00'),
('M00004', 'C00004', 'Bronze', '2023-01-04 13:00:00'),
('M00005', 'C00005', 'Silver', '2023-01-05 14:00:00'),
('M00006', 'C00006', 'Gold', '2023-01-06 15:00:00'),
('M00007', 'C00007', 'Bronze', '2023-01-07 16:00:00'),
('M00008', 'C00008', 'Silver', '2023-01-08 17:00:00'),
('M00009', 'C00009', 'Gold', '2023-01-09 18:00:00'),
('M00010', 'C00010', 'Bronze', '2023-01-10 19:00:00');


-- Customers
INSERT INTO Customers (CustomerID, Name, PhoneNumber, Membership_MembershipID) VALUES
('C00001', 'Customer1', '0811111111', 'M00001'),
('C00002', 'Customer2', '0811111112', 'M00002'),
('C00003', 'Customer3', '0811111113', 'M00003'),
('C00004', 'Customer4', '0811111114', 'M00004'),
('C00005', 'Customer5', '0811111115', 'M00005'),
('C00006', 'Customer6', '0811111116', 'M00006'),
('C00007', 'Customer7', '0811111117', 'M00007'),
('C00008', 'Customer8', '0811111118', 'M00008'),
('C00009', 'Customer9', '0811111119', 'M00009'),
('C00010', 'Customer10', '0811111120', 'M00010'),
('C00011', 'Customer11', '0811111121', NULL),
('C00012', 'Customer12', '0811111122', NULL),
('C00013', 'Customer13', '0811111123', NULL),
('C00014', 'Customer14', '0811111124', NULL),
('C00015', 'Customer15', '0811111125', NULL),
('C00016', 'Customer16', '0811111126', NULL),
('C00017', 'Customer17', '0811111127', NULL),
('C00018', 'Customer18', '0811111128', NULL),
('C00019', 'Customer19', '0811111129', NULL),
('C00020', 'Customer20', '0811111130', NULL),
('C00021', 'Customer21', '0811111131', NULL),
('C00022', 'Customer22', '0811111132', NULL),
('C00023', 'Customer23', '0811111133', NULL),
('C00024', 'Customer24', '0811111134', NULL),
('C00025', 'Customer25', '0811111135', NULL),
('C00026', 'Customer26', '0811111136', NULL),
('C00027', 'Customer27', '0811111137', NULL),
('C00028', 'Customer28', '0811111138', NULL),
('C00029', 'Customer29', '0811111139', NULL),
('C00030', 'Customer30', '0811111140', NULL),
('C00031', 'Customer31', '0811111141', NULL),
('C00032', 'Customer32', '0811111142', NULL),
('C00033', 'Customer33', '0811111143', NULL),
('C00034', 'Customer34', '0811111144', NULL),
('C00035', 'Customer35', '0811111145', NULL),
('C00036', 'Customer36', '0811111146', NULL),
('C00037', 'Customer37', '0811111147', NULL),
('C00038', 'Customer38', '0811111148', NULL),
('C00039', 'Customer39', '0811111149', NULL),
('C00040', 'Customer40', '0811111150', NULL),
('C00041', 'Customer41', '0811111151', NULL),
('C00042', 'Customer42', '0811111152', NULL),
('C00043', 'Customer43', '0811111153', NULL),
('C00044', 'Customer44', '0811111154', NULL),
('C00045', 'Customer45', '0811111155', NULL),
('C00046', 'Customer46', '0811111156', NULL),
('C00047', 'Customer47', '0811111157', NULL),
('C00048', 'Customer48', '0811111158', NULL),
('C00049', 'Customer49', '0811111159', NULL),
('C00050', 'Customer50', '0811111160', NULL);



-- CardCatalogue
INSERT INTO CardCatalogue (CardID, CardName, CardType, CardPrice, CardStock) VALUES
('C00001', 'Booster Pack A', 'Booster Pack', 30000.00, 100),
('C00002', 'Booster Pack B', 'Booster Pack', 30000.00, 150),
('C00003', 'Limited Card A', 'Limited Card', 35000.00, 50),
('C00004', 'Limited Card B', 'Limited Card', 35000.00, 75),
('C00005', 'Card Deck A', 'Card Deck', 45000.00, 200),
('C00006', 'Card Deck B', 'Card Deck', 45000.00, 150),
('C00007', 'Booster Pack C', 'Booster Pack', 30000.00, 80),
('C00008', 'Booster Pack D', 'Booster Pack', 30000.00, 120),
('C00009', 'Limited Card C', 'Limited Card', 35000.00, 60),
('C00010', 'Limited Card D', 'Limited Card', 35000.00, 70);

-- Merchandise
INSERT INTO Merchandise (ItemID, Name, Type, Price, MerchStock) VALUES
('M00001', 'Merchandise A', 'T-shirt', 30000.00, 100),
('M00002', 'Merchandise B', 'Mug', 10000.00, 200),
('M00003', 'Merchandise C', 'Poster', 5000.00, 150),
('M00004', 'Merchandise D', 'Hat', 15000.00, 50),
('M00005', 'Merchandise E', 'Keychain', 15000.00, 300),
('M00006', 'Merchandise F', 'Sticker', 20000.00, 400),
('M00007', 'Merchandise G', 'Notebook', 230000.00, 250),
('M00008', 'Merchandise H', 'Pen', 130000.00, 500),
('M00009', 'Merchandise I', 'Bag', 360000.00, 100),
('M00010', 'Merchandise J', 'Phone Case', 10000.00, 120);

-- Menu
INSERT INTO Menu (MenuId, MenuName, MenuType, MenuPrice, MenuStock) VALUES
('F00001', 'Nasi Goreng', 'Makanan', 25000, 50),
('F00002', 'Mie Goreng', 'Makanan', 20000, 50),
('F00003', 'Sate Ayam', 'Makanan', 30000, 50),
('F00004', 'Bakso', 'Makanan', 15000, 50),
('F00005', 'Rendang', 'Makanan', 35000, 50),
('F00006', 'Soto Ayam', 'Makanan', 18000, 50),
('F00007', 'Gado-Gado', 'Makanan', 15000, 50),
('F00008', 'Ayam Goreng', 'Makanan', 22000, 50),
('F00009', 'Nasi Padang', 'Makanan', 25000, 50),
('F00010', 'Sop Buntut', 'Makanan', 40000, 50),
('D00001', 'Es Teh Manis', 'Minuman', 5000, 100),
('D00002', 'Es Jeruk', 'Minuman', 7000, 100),
('D00003', 'Kopi Hitam', 'Minuman', 10000, 100),
('D00004', 'Cappuccino', 'Minuman', 20000, 100),
('D00005', 'Latte', 'Minuman', 22000, 100),
('D00006', 'Es Kopi Susu', 'Minuman', 18000, 100),
('D00007', 'Jus Alpukat', 'Minuman', 15000, 100),
('D00008', 'Jus Mangga', 'Minuman', 15000, 100),
('D00009', 'Air Mineral', 'Minuman', 3000, 200),
('D00010', 'Teh Botol', 'Minuman', 6000, 100);

-- Discount
INSERT INTO Discount (DiscountID, DiscountType, DiscountRate)
VALUES 
    ('DIS001', 'Bronze', 10.00),
    ('DIS002', 'Silver', 15.00),
    ('DIS003', 'Gold', 20.00),
    ('DIS004', 'Black Friday', 70.00),
    ('DIS005', 'Anniversary', 30.00),
    ('DIS006', 'Grand Opening', 20.00);

-- Transactions
INSERT INTO Transactions (TransactionID, Date, TotalItems, TotalAmount, PaymentMethod, Employees_EmployeeID, Customers_CustomerID, Discount_DiscountID)
VALUES 
('T00001', '2024-06-01 10:00:00', 3, 96000.00, 'Credit Card', 'E00001', 'C00001', 'DIS003'),
('T00002', '2024-06-02 11:00:00', 2, 63000.00, 'Cash', 'E00002', 'C00002', 'DIS002'),
('T00003', '2024-06-03 12:00:00', 4, 112000.00, 'Debit Card', 'E00003', 'C00003', 'DIS004'),
('T00004', '2024-06-04 13:00:00', 1, 13500.00, 'Cash', 'E00004', 'C00004', 'DIS001'),
('T00005', '2024-06-05 14:00:00', 5, 153000.00, 'Credit Card', 'E00005', 'C00005', 'DIS005');


-- Transactions_Merchandise
INSERT INTO Transactions_Merchandise (Transactions_TransactionID, Merchandise_ItemID)
VALUES 
('T00001', 'M00001'),
('T00001', 'M00002'),
('T00002', 'M00003'),
('T00003', 'M00004'),
('T00003', 'M00005'),
('T00003', 'M00006'),
('T00004', 'M00007'),
('T00005', 'M00008'),
('T00005', 'M00009'),
('T00005', 'M00010');


-- Transactions_Menu
INSERT INTO Transactions_Menu (Transactions_TransactionID, Menu_MenuId)
VALUES 
('T00001', 'F00001'),
('T00001', 'D00001'),
('T00002', 'F00002'),
('T00003', 'F00003'),
('T00003', 'F00004'),
('T00003', 'D00002'),
('T00004', 'F00005'),
('T00005', 'F00006'),
('T00005', 'F00007'),
('T00005', 'D00003');


-- CardCatalogue_Transactions
INSERT INTO Transactions_CardCatalogue (CardCatalogue_CardID, Transactions_TransactionID)
VALUES 
('C00001', 'T00001'),
('C00002', 'T00001'),
('C00003', 'T00002'),
('C00004', 'T00003'),
('C00005', 'T00004'),
('C00006', 'T00005');


