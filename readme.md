# โปรแกรมนี้นำไปใช้งานได้ฟรี
## โปรดให้เครดิตผมด้วยครับ


## แนะนำโปรแกรม จำลอง server
#### Lalagon 6 ฟรี สำหรับ Windows (Version 7 เหมือนจะไม่ฟรีแล้วนะครับ)
#### https://github.com/leokhoa/laragon/releases/download/6.0.0/laragon-wamp.exe
#### หรือจะใช้ xampp หรืออื่นๆก็ได้ครับ

##### แก้ไข model/ServerModel.php
~~~ php
 $this->db = new PDO("mysql:host=localhost;dbname=ชื่อฐานข้อมูล", "username_database", "password_database");
 //ex
 $this->db = new PDO("mysql:host=localhost;dbname=check-server", "root", "");
~~~ 

##### นำเข้าฐานข้อมูลจาก folder database/check-server.sql

## เข้าใช้งานผ่าน http://localhost/check-server