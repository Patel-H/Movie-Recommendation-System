{\rtf1\ansi\ansicpg1252\cocoartf1561\cocoasubrtf200
{\fonttbl\f0\fswiss\fcharset0 Helvetica;\f1\fnil\fcharset0 AndaleMono;}
{\colortbl;\red255\green255\blue255;\red47\green255\blue18;\red0\green0\blue0;}
{\*\expandedcolortbl;;\cssrgb\c15686\c99608\c7843;\csgray\c0\c47000;}
\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural\partightenfactor0

\f0\fs24 \cf0 To start project:\
Make sure you have MySQLWorkbench installed and also have the \'93Preferences\'94 tab for \'91MySQL\'92 to start the server\
\
User for SQLWorkbench should be \'91root\'92 and password: \'91root\'92\
\
Method One:\
go to the Movies directory and do php 
\f1 \cf2 \cb3 \CocoaLigature0 php -S localhost:8000
\f0 \cf0 \cb1 \CocoaLigature1 \
\
then go to the URL: localhost:8000/createdb.php -> this should create the db and if exist then will throw error\
\
then run copycsvdata.php by changing the previous URL to localhost:8000/copycsvdata.php\
\
then run form.php just like the 2 url\'92s run above\
\
and then going to recommender.php will show the results of the the users ratings and stuff\'85\
\
\
Method Two:\
Go to the directory of the project and start the server in MySQLWorkbench and have a server setup with the 127.0.0.1 url and port of 3306\
\
Make sure to insert multiple users ratings in order for it to work\
It only returns recommendation for user 1\
\
then once server is running, run:\
\pard\tx560\tx1120\tx1680\tx2240\tx2800\tx3360\tx3920\tx4480\tx5040\tx5600\tx6160\tx6720\pardirnatural\partightenfactor0

\f1 \cf2 \cb3 \CocoaLigature0 php createdb.php\
php copycsvdata.php\
php form.php\
php recommender.php}