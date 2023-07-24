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
                    <a href="./addcourse.php" class="btn btn-primary w-50">เพิ่มวิชา</a>
                </div>
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./editcourse.php" class="btn btn-primary w-50">แก้ไขวิชา</a>
                </div>
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./delcourse.php" class="btn btn-primary w-50">ลบวิชา</a>
                </div>
            </div>
            <div class="col"></div>
            <div class="col">
                <div class="row justify-content-center align-items-center g-2 mb-3">
                    <h1 class="text-end">ระบบจัดการนักศึกษา</h1>
                    <h5 class="text-end">ระบบจัดการวิชา</h5>
                    <h6 class="text-end ">กรุณาเลือกทำรายการด้านซ้าย</h6>
                </div>
                <div class="row justify-content-center align-items-center g-2 border-top">
                    <h5 class="text-center">รายชื่อวิชา</h5>
                </div>
                <?php
                echo "
                            <div class=\"row justify-content-center align-items-center g-2\">
                                <p class=\"col text-center\">เลขวิชา</p>
                                <p class=\"col text-center\">ชื่อวิชา</p>
                            </div>
                ";
                $conn = new mysqli("localhost", "root", "", "p106");
                $result = $conn->query("SELECT * FROM course");
                while ($r = $result->fetch_assoc()) {
                    echo "   <div class=\"row justify-content-center align-items-center g-2 border-top\">
                                <p class=\"col text-center\">$r[cid]</p>
                                <p class=\"col text-center\">$r[cname]</p>
                            </div>
                    ";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>