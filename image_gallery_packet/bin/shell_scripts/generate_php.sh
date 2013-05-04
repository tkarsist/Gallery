#!/bin/sh
#tama hoitaa kaiken, eli skaalaa kuvat, siirtaa ne ja tekee xml:n exifisita... tama siirtaa kaiken /gallery/php_image/unprocessed hakemistosta processed hakemistoon
#auki=`ls -ltr -R /gallery/php_image/unprocessed/|grep .filepart | wc -l`
#if [ "$auki" == 0 ]
#then
#if [ "$(ls -A /gallery/php_image/unprocessed/)" ]
#then
mv /gallery/php_image/unprocessed/$1 /gallery/php_image/temporary/
sh /gallery/php_image/php_image_convert.sh /gallery/php_image/temporary/$1
sh /gallery/php_image/movit.sh /gallery/php_image/temporary/$1 /gallery/php_image/processed/
#fi
#fi