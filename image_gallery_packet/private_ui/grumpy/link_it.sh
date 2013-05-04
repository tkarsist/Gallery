#!/bin/bash

#to creata ja new user make first a directory under private_ui e.g. "grumpy"
#copy this script to foldet
#run this script and after this change the config_pub_ui.php to match your preferences
ln -s ../../public_ui/album.php
ln -s ../../public_ui/album_det.php
ln -s ../../public_ui/album_det_get.php
ln -s ../../public_ui/index.php
ln -s ../../public_ui/style.css
cp ../../public_ui/config_pub_ui.php .

