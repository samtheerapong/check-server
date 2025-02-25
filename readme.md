# โปรแกรมนี้นำไปใช้งานได้ฟรี
## โปรดให้เครดิตผมด้วยครับ


## แนะนำโปรแกรม จำลอง server
#### Lalagon 6 ฟรี สำหรับ Windows (Version 7 เหมือนจะไม่ฟรีแล้วนะครับ)
#### https://github.com/leokhoa/laragon/releases/download/6.0.0/laragon-wamp.exe
#### หรือจะใช้ xampp หรืออื่นๆก็ได้ครับ

##### สร้างฐานข้อมูล check-server นำเข้าฐานข้อมูลจาก folder database/check-server.sql
##### เปลี่ยนชื่อไฟล์ .env-example เป็น .env
###### แล้วเปลี่ยนค่าให้ตรงกับฐานข้อมูลที่ใช้งาน เช่น
~~~ php
DB_HOST=localhost
DB_NAME=check-server
DB_USER=root
DB_PASS=
~~~ 


## เข้าใช้งานผ่าน http://localhost/check-server