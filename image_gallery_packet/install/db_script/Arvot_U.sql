CREATE TABLE kuvatest2.Arvot (
       id INT NOT NULL AUTO_INCREMENT
     , arvo VARCHAR(2000)
     , attribuutti INT NOT NULL
     , kuva INT NOT NULL
     , meta_int INT
     , arvo_int INT
     , arvo_double DOUBLE
     , arvo_datetime DATETIME
     , arvo_time TIME
     , stamp TIMESTAMP
     , PRIMARY KEY (id)
     , INDEX (kuva)
     , CONSTRAINT FK_arvot_2 FOREIGN KEY (kuva)
                  REFERENCES kuvatest2.Kuva (id) ON DELETE CASCADE
     , INDEX (attribuutti)
     , CONSTRAINT FK_arvot_1 FOREIGN KEY (attribuutti)
                  REFERENCES kuvatest2.Attribuutit (id) ON DELETE CASCADE
)ENGINE=InnoDB;

