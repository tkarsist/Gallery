dir1=$1
base=/gallery/php_image/unprocessed/

pushd $base$dir1
for file in *.jpg; do mv "$file" `echo $file | sed -e 's/  */_/g' -e 's/_-_/-/g'`; done
for file in *.JPG; do mv "$file" `echo $file | sed -e 's/  */_/g' -e 's/_-_/-/g'`; done
popd

