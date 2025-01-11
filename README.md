# Metrics Collector

A node.js server with a front end hosted via apache which communicates with an sql database through REST API. When users reloads this page, their browser's metrics get dumped and sent over to the endpoints. This tool allows you to view some visualizations of real time data from the express server. This tool also allows you to preview one of the database tables as well as add and remove users. 

Tool is currently hosted on a digital ocean droplet at: http://146.190.15.250/

## Local Setup Instructions
Note: the following tutorial works for an ubuntu server with at least 1gb ram.

Install apache and setup firewall
```
sudo apt update
sudo apt install apache2 apache2-utils
sudo ufw allow 'Apache Full'
sudo ufw allow OpenSSH
sudo ufw allow 3306
sudo ufw allow 3000
sudo ufw enable
```
Clone repo and setup apache configuration
```
cd /var/www/html
sudo git clone https://github.com/revisor07/metrics-collector.git
sudo a2enmod proxy
sudo a2enmod proxy_http
sudo vi /etc/apache2/sites-available/metrics-collector.conf
```
Add the following to the just opened conf file
```
<VirtualHost *:80>
     ServerName 146.190.15.250
     DocumentRoot /var/www/html/metrics-collector/public_html/

     ProxyPass /api http://127.0.0.1:3000
     ProxyPassReverse /api http://127.0.0.1:3000
</VirtualHost>
```
Activate apache
```
sudo a2ensite metrics-collector
sudo systemctl reload apache2
```
Install PHP and MySQL
```
sudo apt install php libapache2-mod-php
sudo apt install mysql-server
sudo apt install php-mysqli
```
Configure MySQL user and setup database (don't need to create a user if root)
```
sudo mysql 
CREATE USER 'ubuntu'@'localhost' IDENTIFIED BY '';
ALTER USER 'ubuntu'@'localhost' IDENTIFIED WITH mysql_native_password BY '';
CREATE DATABASE data;
USE data;
CREATE TABLE users (id INT PRIMARY KEY AUTO_INCREMENT, email VARCHAR(255), username VARCHAR(255),password VARCHAR(255), admin INT);
INSERT INTO users (email, username, password, admin) VALUES ('admin@gmail.com', 'admin', 'de1b2a7baf7850243db71c4abd4e5a39', 1);
CREATE TABLE initialBrowserData (id INT PRIMARY KEY AUTO_INCREMENT, data VARCHAR(255), vitalsScore VARCHAR(255) );
CREATE TABLE navigationTiming like initialBrowserData;
CREATE TABLE networkInformation like initialBrowserData;
CREATE TABLE fcp like initialBrowserData;
CREATE TABLE fid like initialBrowserData;
CREATE TABLE lcp like initialBrowserData;
CREATE TABLE lcpFinal like initialBrowserData;
CREATE TABLE cls like initialBrowserData;
CREATE TABLE clsFinal like initialBrowserData;
CREATE TABLE tbt like initialBrowserData;
CREATE TABLE storageEstimate like initialBrowserData;
CREATE TABLE fp like initialBrowserData;
GRANT ALL PRIVILEGES ON data.* TO 'ubuntu'@'localhost';
FLUSH PRIVILEGES;
```
Install and setup Node.js and PM2
```
sudo apt install nodejs
sudo apt install npm
sudo npm i pm2 -g
cd /var/www/html/metrics-collector/public_html
sudo npm i
pm2 start server.js
```
### Useful commands
```
sudo shutdown -r now
sudo cat /var/log/apache2/error.log
sudo bash -c 'echo > /var/log/apache2/error.log'
cd /var/www/html/metrics-collector
vi /etc/apache2/sites-available/metrics-collector.conf
pm2 logs
pm2 flush
```


