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
            <div class="col-4">
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./index.php" class="btn btn-warning w-50">กลับไปหน้าหลัก</a>
                </div>
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./addregis.php" class="btn btn-primary w-50">ลงทะเบียนเรียน</a>
                </div>
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./grading.php" class="btn btn-primary w-50">กรอกเกรด</a>
                </div>
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./drop.php" class="btn btn-primary w-50">ดรอปวิชาเรียน</a>
                </div>
            </div>
            <div class="col-8">
                <div class="row justify-content-center align-items-center g-2">
                    <h1 class="text-end">ระบบกรอกเกรด</h1>
                    <h5 class="text-end">ระบบลงทะเบียนนักศึกษา</h5>
                    <h6 class="text-end ">กรุณาเลือกทำรายการด้านซ้าย</h6>
                </div>
                <div class="row justify-content-center align-items-center g-2 border-top">
                    <h5 class="text-center">ข้อมูลลงทะเบียน</h5>
                </div>
                <?php
                echo "
                            <div class=\"row justify-content-center align-items-center g-2\">
                                <p class=\"col text-center\">เลขวิชา</p>
                                <p class=\"col text-center\">ชื่อวิชา</p>
                                <p class=\"col text-center\">เลขนักศึกษา</p>
                                <p class=\"col text-center\">ชื่อ</p>
                                <p class=\"col text-center\">นามสกุล</p>
                                <p class=\"col text-center\">เกรด</p>
                            </div>
                ";
                $conn = new mysqli("localhost", "root", "", "p106");
                $result = $conn->query("SELECT student.stid, student.fname, student.lname, course.cid, course.cname, regis.grade FROM regis
                                        JOIN student ON regis.stid = student.stid
                                        JOIN course ON regis.cid = course.cid
                ");
                while ($r = $result->fetch_assoc()) {
                    if($r['grade']==""){
                        $r['grade']="ยังไม่ได้ตัดเกรด";
                    }
                    echo "   <div class=\"row justify-content-center align-items-center g-2 border-top\">
                                <p class=\"col text-center\">$r[cid]</p>
                                <p class=\"col text-center\">$r[cname]</p>
                                <p class=\"col text-center\">$r[stid]</p>
                                <p class=\"col text-center\">$r[fname]</p>
                                <p class=\"col text-center\">$r[lname]</p>
                                <p class=\"col text-center\">$r[grade]</p>
                            </div>
                    ";
                }
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>

<script>
    function validateForm(){
        const cf=confirm("คุณต้องการยืนยันที่จะบันทึกข้อมูลใช่ไหม");
        if(cf){
            return true;
        }else{
            return false;
        }
}
</script>