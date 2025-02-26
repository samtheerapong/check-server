# โปรแกรมนี้นำไปใช้งานได้ฟรี
###### โปรดให้เครดิตผมด้วยครับ
![alt text](https://github.com/samtheerapong/check-server/blob/master/assets/images/check-server.png)
## แนะนำโปรแกรม จำลอง server
#### Lalagon 6 ฟรี สำหรับ Windows (Version 7 เหมือนจะไม่ฟรีแล้วนะครับ)
#### https://github.com/leokhoa/laragon/releases/download/6.0.0/laragon-wamp.exe
<!-- #### https://windows.php.net/downloads/releases/php-7.4.33-Win32-vc15-x64.zip
#### แตกไฟล์ เอาไปไว้ที่ Path laragon\bin\php\php-7.4.33-Win32-vc15-x64 -->

###### หรือจะใช้ xampp หรือ docker https://github.com/sprintcube/docker-compose-lamp หรือตัวจำลองอื่นๆก็ได้ครับ

### ติดตั้ง composer
##### https://getcomposer.org/
##### เลือกไปที่ laragon\bin\php\php-เวอร์ชั่น หรือ floder ที่เก็บโปรแกรม php

###### cmd -> ที่อยู่ Project
~~~ bash
composer update
~~~
###### จะได้ folder vendor ที่โหลด package มา

### สร้างฐานข้อมูล check-server นำเข้าฐานข้อมูลจาก folder database/check-server.sql
##### เปลี่ยนชื่อไฟล์ .env-example เป็น .env
###### แล้วเปลี่ยนค่าให้ตรงกับฐานข้อมูลที่ใช้งาน เช่น
~~~ php
DB_HOST=localhost
DB_NAME=check-server
DB_USER=root
DB_PASS=

ADMIN_PASS=admin
~~~ 



## เข้าใช้งานผ่าน http://localhost/check-server