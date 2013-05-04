#!/bin/sh
#Tama skripti tekee eri kokoisia jpg-tiedostoja. Skripti kasittelee kaikki hakemiston annetun polun alla (vain yksi taso)
#ajetaan esim sh php_image_creator.sh polku_hakemistoon_jonka_alla_on_hakemistoissa_kuvia
#tiedostonimet : (orig)=.jpg, (thumb)=.thumb.jpg, (800x600)=.800_600.jpg jne. Alkuperainen tiedosto jaa hakemistoon

dir1=$1
pushd $dir1

#listataan kaikki hakemistot
#for name in `ls -l|egrep '^d'|awk '{print $9}'`

#do

#dirX=$dir1$name

#vaihdetaan kyseiseen hakemistoon
#pushd $dirX


#Kasitellaan kaikki hakemiston .jpg:t parametrien mukaisesti
echo "Processing $dir1 folders files..."

#Poistetaan tiedostonnimista arsyttavat toosa-jutut... kuten valit
for file in *; do mv "$file" `echo $file | sed -e 's/  */_/g' -e 's/_-_/-/g'`; done

for img in `ls *.jpg`
do
convert -quality 95 -auto-orient -sample 1800x1200 $img $img.1600_1200.jpg
convert -quality 95 -auto-orient -sample 1575x1050 $img $img.1400_1050.jpg
convert -quality 95 -auto-orient -sample 1440x960 $img $img.1280_960.jpg
convert -quality 95 -auto-orient -sample 1152x768 $img $img.1024_768.jpg
convert -quality 95 -auto-orient -sample 900x600 $img $img.800_600.jpg
convert -thumbnail 400x150 $img $img.thumb.jpg
done

for img in `ls *.JPG`
do
convert -quality 95 -auto-orient -sample 1800x1200 $img $img.1600_1200.jpg
convert -quality 95 -auto-orient -sample 1575x1050 $img $img.1400_1050.jpg
convert -quality 95 -auto-orient -sample 1440x960 $img $img.1280_960.jpg
convert -quality 95 -auto-orient -sample 1152x768 $img $img.1024_768.jpg
convert -quality 95 -auto-orient -sample 900x600 $img $img.800_600.jpg
convert -thumbnail 400x150 $img $img.thumb.jpg
done

echo "Files in $dir1 folder finished"



#vaihdetaan takaisin paahakemistoon
popd
#done

echo "All processing done"