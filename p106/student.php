<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>
    <div class="card container">
        <div class="row justify-content-start align-items-start g-2 pb-3">
            <div class="col">
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./index.php" class="btn btn-warning w-50">กลับไปหน้าหลัก</a>
                </div>
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./addstudent.php" class="btn btn-primary w-50">เพิ่มนักศึกษา</a>
                </div>
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./editstudent.php" class="btn btn-primary w-50">แก้ไขนักศึกษา</a>
                </div>
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./delstudent.php" class="btn btn-primary w-50">ลบนักศึกษา</a>
                </div>
            </div>
            <div class="col"></div>
            <div class="col">
                <div class="row justify-content-center align-items-center g-2 mb-3">
                    <h1 class="text-end">ระบบจัดการนักศึกษา</h1>
                    <h5 class="text-end">ระบบจัดการนักศึกษา</h5>
                    <h6 class="text-end ">กรุณาเลือกทำรายการด้านซ้าย</h6>
                </div>
                <div class="row justify-content-center align-items-center g-2 border-top">
                    <h5 class="text-center">รายชื่อนักศึกษา</h5>
                </div>
                <?php
                echo "
                            <div class=\"row justify-content-center align-items-center g-2\">
                                <p class=\"col text-center\">เลขนักศึกษา</p>
                                <p class=\"col text-center\">ชื่อ</p>
                                <p class=\"col text-center\">นามสกุล</p>
                            </div>
                ";
                $conn = new mysqli("localhost", "root", "", "p106");
                $result = $conn->query("SELECT * FROM student");
                while ($r = $result->fetch_assoc()) {
                    echo "   <div class=\"row justify-content-center align-items-center g-2 border-top\">
                                <p class=\"col text-center\">$r[stid]</p>
                                <p class=\"col text-center\">$r[fname]</p>
                                <p class=\"col text-center\">$r[lname]</p>
                            </div>
                    ";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>