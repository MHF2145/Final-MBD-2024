-- Index for CardCatalogue table based on CardName
CREATE INDEX idx_CardCatalogue_CardName ON CardCatalogue (CardName);

-- Index for Menu table based on MenuName
CREATE INDEX idx_Menu_MenuName ON Menu (MenuName);

-- Index for Merchandise table based on Name
CREATE INDEX idx_Merchandise_Name ON Merchandise (Name);

-- Index for Transactions table based on TransactionID (already primary key, so no need for additional index)
-- CREATE INDEX idx_Transactions_TransactionID ON Transactions (TransactionID);
