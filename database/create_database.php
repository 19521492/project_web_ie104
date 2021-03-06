<?php
define('HOST', 'localhost');
define('USENAME', 'root');
define('PASSWORD', '');
define('N_DATABASE', 'PROJECT_WEB_TRUYEN');


$connect = mysqli_connect(HOST, USENAME, PASSWORD);

if (!$connect) {
    die("(101)Kết nối database thất bại: " . mysqli_connect_error());
}

// Lệnh tạo database
$sql_query = "CREATE DATABASE N_DATABASE";

// Thực thi câu truy vấn
if (!mysqli_query($connect, $sql_query)) {
    echo "(102)Tạo database thất bại. " . mysqli_error($connect);
}

// Tạo xong thì ngắt kết nối
mysqli_close($connect);




//====================================================================================================




$sql_query = "CREATE TABLE DANGNHAP (
	TENDN VARCHAR(50) REFERENCES TAIKHOAN(TENDN),
    MATKHAU CHAR(20) NOT NULL,
    CHUCDANH CHAR(20) CHECK IN ('ADMIN', 'MEMBER'),
    CONSTRAINT TDN_UNI UNIQUE (TENDN)
);

CREATE TABLE TAIKHOAN (
    TENDN VARCHAR(50) PRIMARY KEY,
    EMAIL CHAR(100) NOT NULL,
    GIOITINH VARCHAR(3) CHECK IN('NAM', 'NỮ'),
    FACEBOOK VARCHAR(200),
    ANHDD VARCHAR(200),
    NGAYSINH DATE,
    NGAYKT DATETIME
);

CREATE TABLE TRUYEN (
    MSTRUYEN INT PRIMARY KEY AUTO_INCREMENT,
    TENTRUYEN VARCHAR(100) NOT NULL,
    TACGIA VARCHAR(50) NOT NULL,
    NGUOIDANG VARCHAR(50) REFERENCES TAIKHOAN(TENDN),
    DANHGIA FLOAT CHECK (DANHGIA >= 1 AND DANHGIA <=5),
    TINHTRANG VARCHAR(50) CHECK IN ('Đã hoàn thành', 'Đang tiến hành', 'Tạm ngưng', 'Chờ duyệt'),
    LUOTXEM INT CHECK (LUOTXEM >= 0),
    QUOCGIA INT REFERENCES QUOCGIA(MSQG),
    SOCHUONG INT CHECK (SOCHUONG >= 1),
    MOTA LONGTEXT,
    NGAYKT DATETIME,
    NGAYCN DATETIME
);

CREATE TABLE TENTRUYEN_KHAC (
    MSTRUYEN INT REFERENCES TRUYEN(MSTRUYEN),
    TENKHAC VARCHAR(100),
    CONSTRAINT PR_TR_TK PRIMARY KEY (MSTRUYEN, TENKHAC)
);

CREATE TABLE THELOAI (
	MSTL INT PRIMARY KEY AUTO_INCREMENT,
    TENTL VARCHAR(50)
);

CREATE TABLE THELOAI_TRUYEN (
    MSTRUYEN INT,
    MSTL INT,
    CONSTRAINT PK_TR_TL PRIMARY KEY (MSTRUYEN, MSTL)
);

CREATE TABLE QUOCGIA (
	MSQG INT PRIMARY KEY AUTO_INCREMENT,
    TENQG VARCHAR(30)
);

CREATE TABLE CHUONGTRUYEN (
	MSCHUONG CHAR(10) PRIMARY KEY,
    MSTRUYEN INT REFERENCES TRUYEN(MSTRUYEN),
    TENCHUONG VARCHAR(100),
    SOTRANG INT
);

CREATE TABLE TRANGTRUYEN (
	MSTRANG INT PRIMARY KEY,
    MSCHUONG CHAR(10) REFERENCES CHUONGTRUYEN(MSTRUYEN),
    ANHTRUYEN VARCHAR(200)
);

CREATE TABLE PHANHOI (
    MSPH INT PRIMARY KEY AUTO_INCREMENT,
    NGUOIGUI VARCHAR(50) REFERENCES TAIKHOAN(TENDN),
    NGUOINHAN VARCHAR(50) REFERENCES TAIKHOAN(TENDN),
    NOIDUNG LONGTEXT,
    NGAYGUI DATETIME,
    TRANGTHAI VARCHAR(30)
);

CREATE TABLE FILEDINHKEM_PHANHOI (
    MSPH INT REFERENCES PHANHOI(MSPH),
    LINK VARCHAR(200)
);

CREATE TABLE BINHLUAN_TRUYEN (
    MSTRUYEN INT REFERENCES TRUYEN(MSTRUYEN),
    NGUOIDANG VARCHAR(50) REFERENCES TAIKHOAN(TENDN),
    TIEUDE VARCHAR(100),
    NOIDUNG LONGTEXT,
    NGAYDANG DATETIME
);

CREATE TABLE DANHGIA_TRUYEN (
	MSTRUYEN INT REFERENCES TRUYEN(MSTRUYEN),
    DIEM INT CHECK (DIEM >= 1 AND DIEM <= 5),
    NGUOIDG VARCHAR(50) REFERENCES TAIKHOAN(TENDN)
);

CREATE TABLE THONGBAO (
    MSTB INT PRIMARY KEY AUTO_INCREMENT,
    NGUOINTB VARCHAR(50),
    THOIGIAN DATETIME,
    TRANGTHAI VARCHAR(200)
);";

$connect = mysqli_connect(HOST, USENAME, PASSWORD, N_DATABASE);

if(!$connect) {
    die("(103) Kết nối DATABASE thất bại. " . mysqli_connect_error());
} 
else if (!mysqli_query($connect, $sql_query)) {
    echo "(104)Tạo TABLE thất bại. " . mysqli_error($connect);
}

mysqli_close($connect);




