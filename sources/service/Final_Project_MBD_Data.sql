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
('C00001', 'Andi', '0811111111', 'M00001'),
('C00002', 'Budi', '0811111112', 'M00002'),
('C00003', 'Citra', '0811111113', 'M00003'),
('C00004', 'Dewi', '0811111114', 'M00004'),
('C00005', 'Eko', '0811111115', 'M00005'),
('C00006', 'Fajar', '0811111116', 'M00006'),
('C00007', 'Gita', '0811111117', 'M00007'),
('C00008', 'Hendra', '0811111118', 'M00008'),
('C00009', 'Indra', '0811111119', 'M00009'),
('C00010', 'Joko', '0811111120', 'M00010'),
('C00011', 'Kiki', '0811111121', NULL),
('C00012', 'Lina', '0811111122', NULL),
('C00013', 'Maya', '0811111123', NULL),
('C00014', 'Nina', '0811111124', NULL),
('C00015', 'Oka', '0811111125', NULL),
('C00016', 'Putri', '0811111126', NULL),
('C00017', 'Rian', '0811111127', NULL),
('C00018', 'Sari', '0811111128', NULL),
('C00019', 'Tina', '0811111129', NULL),
('C00020', 'Umar', '0811111130', NULL),
('C00021', 'Vina', '0811111131', NULL),
('C00022', 'Wawan', '0811111132', NULL),
('C00023', 'Xena', '0811111133', NULL),
('C00024', 'Yoga', '0811111134', NULL),
('C00025', 'Zara', '0811111135', NULL),
('C00026', 'Adi', '0811111136', NULL),
('C00027', 'Banu', '0811111137', NULL),
('C00028', 'Cici', '0811111138', NULL),
('C00029', 'Dina', '0811111139', NULL),
('C00030', 'Eka', '0811111140', NULL),
('C00031', 'Fina', '0811111141', NULL),
('C00032', 'Gilang', '0811111142', NULL),
('C00033', 'Hana', '0811111143', NULL),
('C00034', 'Ivan', '0811111144', NULL),
('C00035', 'Joni', '0811111145', NULL),
('C00036', 'Kamal', '0811111146', NULL),
('C00037', 'Lusi', '0811111147', NULL),
('C00038', 'Miko', '0811111148', NULL),
('C00039', 'Novi', '0811111149', NULL),
('C00040', 'Oni', '0811111150', NULL),
('C00041', 'Putu', '0811111151', NULL),
('C00042', 'Qori', '0811111152', NULL),
('C00043', 'Rosi', '0811111153', NULL),
('C00044', 'Sandi', '0811111154', NULL),
('C00045', 'Tari', '0811111155', NULL),
('C00046', 'Uli', '0811111156', NULL),
('C00047', 'Vino', '0811111157', NULL),
('C00048', 'Widi', '0811111158', NULL),
('C00049', 'Xeni', '0811111159', NULL),
('C00050', 'Yudi', '0811111160', NULL);




-- CardCatalogue
INSERT INTO CardCatalogue (CardID, CardName, CardType, CardPrice, CardStock) VALUES
('C00001', 'Fire Dragon Pack', 'Booster Pack', 30000.00, 100),
('C00002', 'Water Spirit Pack', 'Booster Pack', 30000.00, 150),
('C00003', 'Golden Phoenix Card', 'Limited Card', 35000.00, 50),
('C00004', 'Silver Griffin Card', 'Limited Card', 35000.00, 75),
('C00005', 'Elemental Deck', 'Card Deck', 45000.00, 200),
('C00006', 'Mystic Deck', 'Card Deck', 45000.00, 150),
('C00007', 'Earth Titan Pack', 'Booster Pack', 30000.00, 80),
('C00008', 'Air Serpent Pack', 'Booster Pack', 30000.00, 120),
('C00009', 'Platinum Unicorn Card', 'Limited Card', 35000.00, 60),
('C00010', 'Diamond Dragon Card', 'Limited Card', 35000.00, 70);


-- Merchandise
INSERT INTO Merchandise (ItemID, Name, Type, Price, MerchStock) VALUES
('M00001', 'Dragon T-shirt', 'T-shirt', 30000.00, 100),
('M00002', 'Phoenix Mug', 'Mug', 10000.00, 200),
('M00003', 'Griffin Poster', 'Poster', 5000.00, 150),
('M00004', 'Unicorn Hat', 'Hat', 15000.00, 50),
('M00005', 'Titan Keychain', 'Keychain', 15000.00, 300),
('M00006', 'Mystic Sticker', 'Sticker', 20000.00, 400),
('M00007', 'Elemental Notebook', 'Notebook', 230000.00, 250),
('M00008', 'Serpent Pen', 'Pen', 130000.00, 500),
('M00009', 'Dragon Bag', 'Bag', 360000.00, 100),
('M00010', 'Phoenix Phone Case', 'Phone Case', 10000.00, 120);


-- Menu
INSERT INTO Menu (MenuId, MenuName, MenuType, MenuPrice, MenuStock) VALUES
('F00001', 'Nasi Goreng Spesial', 'Makanan', 25000, 50),
('F00002', 'Mie Goreng Pedas', 'Makanan', 20000, 50),
('F00003', 'Sate Ayam Madura', 'Makanan', 30000, 50),
('F00004', 'Bakso Sapi', 'Makanan', 15000, 50),
('F00005', 'Rendang Padang', 'Makanan', 35000, 50),
('F00006', 'Soto Ayam Lamongan', 'Makanan', 18000, 50),
('F00007', 'Gado-Gado Betawi', 'Makanan', 15000, 50),
('F00008', 'Ayam Goreng Kremes', 'Makanan', 22000, 50),
('F00009', 'Nasi Padang Komplit', 'Makanan', 25000, 50),
('F00010', 'Sop Buntut Spesial', 'Makanan', 40000, 50),
('D00001', 'Es Teh Manis Segar', 'Minuman', 5000, 100),
('D00002', 'Es Jeruk Segar', 'Minuman', 7000, 100),
('D00003', 'Kopi Hitam Nusantara', 'Minuman', 10000, 100),
('D00004', 'Cappuccino Classic', 'Minuman', 20000, 100),
('D00005', 'Latte Vanilla', 'Minuman', 22000, 100),
('D00006', 'Es Kopi Susu Gula Aren', 'Minuman', 18000, 100),
('D00007', 'Jus Alpukat Kental', 'Minuman', 15000, 100),
('D00008', 'Jus Mangga Segar', 'Minuman', 15000, 100),
('D00009', 'Air Mineral Dingin', 'Minuman', 3000, 200),
('D00010', 'Teh Botol Jasmine', 'Minuman', 6000, 100);


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


