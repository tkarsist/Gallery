CREATE TABLE kuvatest2.Album_meta (
       id INT NOT NULL AUTO_INCREMENT
     , meta VARCHAR(2000)
     , kuva INT
     , albumi INT NOT NULL
     , albumi_atr INT NOT NULL
     , meta_int INT
     , meta_double DOUBLE
     , meta_datetime DATETIME
     , meta_time TIME
     , stamp TIMESTAMP
     , PRIMARY KEY (id)
     , INDEX (albumi_atr)
     , CONSTRAINT FK_Album_meta_3 FOREIGN KEY (albumi_atr)
                  REFERENCES kuvatest2.Albumi_atr (id) ON DELETE CASCADE
     , INDEX (albumi)
     , CONSTRAINT FK_Album_meta_2 FOREIGN KEY (albumi)
                  REFERENCES kuvatest2.Albumi (id) ON DELETE CASCADE
     , INDEX (kuva)
     , CONSTRAINT FK_Album_meta_1 FOREIGN KEY (kuva)
                  REFERENCES kuvatest2.Kuva (id) ON DELETE CASCADE
)ENGINE=InnoDB;

