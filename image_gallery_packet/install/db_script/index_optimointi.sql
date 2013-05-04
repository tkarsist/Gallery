ALTER TABLE Attribuutit ADD INDEX(nimi);
ALTER TABLE Kuva ADD INDEX(nimi);
ALTER TABLE Arvot ADD INDEX(arvo,attribuutti);
ALTER TABLE Album_meta ADD INDEX(albumi_atr,albumi,kuva,meta);
ALTER TABLE Albumi ADD INDEX(nimi);
ALTER TABLE Albumi_atr ADD INDEX(nimi);


analyze table Attribuutit;
optimize table Attribuutit;

analyze table Kuva;
optimize table Kuva;

analyze table Arvot;
optimize table Arvot;

analyze table Album_meta;
optimize table Album_meta;

analyze table Albumi;
optimize table Albumi;

analyze table Albumi_atr;
optimize table Albumi_atr;