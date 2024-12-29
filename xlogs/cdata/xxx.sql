select statdate, cost from awsstats where id=3 and region='all' 
INTO OUTFILE '/var/www/xlogs/cdata/1'
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n';
