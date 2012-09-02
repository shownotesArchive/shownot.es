#Shownot.es

##export.php - readme

http://shownot.es/export.php?

query | info 
------|--------
pc    | select podcast (podcastname or all)
mode  | json, csv
hash  | select hash-algo to hash shownote file
desc  | if is set sort (a->z) else sort (z->a)
title | export title of episode

###examples

<http://shownot.es/export.php?pc=all&hash=crc32&desc&title>  
<http://shownot.es/export.php?pc=all&mode=csv&hash=crc32&desc&title>  
<http://shownot.es/export.php?pc=mm&hash=md5>  
<http://shownot.es/export.php?pc=ep&hash=SHA512&title>  
