#!/bin/sh
#annetaan mista minne (eli mista siirretaan ja mika kohde root)
dest=$2
dir1=$1
pushd $dir1

#touch $2exif/exif.xml
#listataan kaikki hakemistot
#for name in `ls -l|egrep '^d'|awk '{print $9}'`

#do

#dirX=$dir1$name

#vaihdetaan kyseiseen hakemistoon
#pushd $dir1


#Kasitellaan kaikki hakemiston .jpg:t parametrien mukaisesti
echo "Processing $dir1 folders files..."
mv *.thumb.jpg $2thumb/
mv *.1024_768.jpg $21024_768/
mv *.1280_960.jpg $21280_960/
mv *.1400_1050.jpg $21400_1050/
mv *.1600_1200.jpg $21600_1200/
mv *.800_600.jpg $2800_600/
mv *.jpg $2full/
mv *.JPG $2full/

#Alla olevat on ihan validia, mutta exif-tiedot otetaan jo unprocessed hakemistosta kantaan eli nimet ei voi muuttua
#rename .JPG .jpg *.JPG
#mv *.jpg $2full/

#cat exif.xml >>$2exif/exif.xml
#rm exif.xml
echo "Files in $dir1 folder finished"



#vaihdetaan takaisin paahakemistoon
popd
rmdir $dir1
#done

echo "All processing done"