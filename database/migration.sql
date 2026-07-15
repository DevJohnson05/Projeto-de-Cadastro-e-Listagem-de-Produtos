ALTER TABLE produtos CHANGE COLUMN validade data_valid date DEFAULT NULL;
ALTER TABLE produtos MODIFY COLUMN un_medida enum('KG','UN','PCT','FD','CX') DEFAULT NULL;
