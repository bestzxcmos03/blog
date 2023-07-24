<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit2'])) {
        header("Location: ./grade.php");
    }
}
?>
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
                    <a href="./grade.php" class="btn btn-warning w-50">กลับ</a>
                </div>

            </div>
            <div class="col-8">
                <div class="row justify-content-center align-items-center g-2">
                    <h1 class="text-end">ระบบจัดการนักศึกษา</h1>
                    <h5 class="text-end">กรอกเกรด</h5>
                    <h6 class="text-end ">กรุณากรอกข้อมูลด้านล่างให้ครบ</h6>
                </div>
                <form method="post" onsubmit="return validateForm()">
                    <div class="row justify-content-end align-items-end g-2 mt-0">
                        <input type="text" class="form-control w-50" name="stid" id="stid" placeholder="เลขนักศึกษา">
                    </div>
                    <div class="row justify-content-end align-items-end g-2 mt-1">
                        <input type="submit" class="btn btn-primary w-50 " name="submit" id="submit" value="ค้นหา">
                    </div>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST["submit"])) {
                        $stid = $_POST['stid'];
                        $conn = new mysqli("localhost", "root", "", "p106");
                        $result = $conn->query("SELECT student.stid, student.fname, student.lname, course.cid, course.cname, regis.grade FROM regis
                                        JOIN student ON regis.stid = student.stid
                                        JOIN course ON regis.cid = course.cid
                                        WHERE regis.stid = '$stid'
                        ");
                        $stname = $conn->query("SELECT * FROM student
                        WHERE stid = '$stid'
                        ");
                        $name=$stname->fetch_assoc();
                        echo "
                        <form method=post onsubmit=\"return validateForm2()\">
                            <div class=\"row justify-content-center align-items-center g-2 border-top mt-5\">
                                <p class=\"col text-center\">วิชาที่ $name[stid] $name[fname] $name[lname] ลงทะเบียนไว้</p>
                            </div>
                            <div class=\"row justify-content-center align-items-center g-2 border-top\">
                                <p class=\"col text-center\">รหัสวิชา</p>
                                <p class=\"col text-center\">ชื่อวิชา</p>
                                <p class=\"col text-center\">เกรดที่บันทึกไว้</p>
                                <p class=\"col text-center\">ดรอป</p>
                            </div>
                ";
                        while ($r = $result->fetch_assoc()) {
                            if ($r['grade'] == "") {
                                $r['grade'] = "ยังไม่ได้ตัดเกรด";
                            }
                            echo "   <div class=\"row justify-content-center align-items-center g-2 border-top pb-3\">
                                    <p class=\"col text-center\">$r[cid]</p>
                                    <input type=hidden value=\"$r[stid]\" name=\"stid\">
                                    <p class=\"col text-center\">$r[cname]</p>
                                    <p class=\"col text-center\">$r[grade]</p>
                                    <div class=\"col form-check d-flex justify-content-center\"  style=\"margin:auto!important\">
                                        <input type=checkbox class=\"form-check-input\"name=\"drop[]\" value=\"$r[cid]\" >
                                    </div>
                                </div>
                        ";
                        }
                        echo "
                        <div class=\"row justify-content-end align-items-end g-2 mt-1\">
                            <input type=\"submit\" class=\"btn btn-primary w-50 \" name=\"submit2\" id=\"submit2\" value=\"บันทึก\">
                        </div>
                        </form>
                        ";
                    }
                    if (isset($_POST["submit2"])) {
                        $stid=$_POST['stid'];
                        $drop=isset($_POST['drop'])?$_POST['drop']:[];
                        $conn = new mysqli("localhost", "root", "", "p106");
                        foreach($drop as $d){
                            $conn->query("DELETE FROM regis WHERE stid='$stid' AND cid='$d'");
                            
                        }
                        
                        
                    }
                    die();
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    function validateForm() {
        if (document.getElementById('cid').value == "" || document.getElementById('cid').value.length != 4 || !(/^\d+$/.test(document.getElementById('cid').value))) {
            alert("เลขวิชาไม่ถูกต้อง");
            return false;
        }
    }
    function validateForm2() {
        const cf=confirm("คุณต้องการยืนยันที่จะบันทึกใช่ไหม");
        if(cf){
            return true;
        }else{
            return false;
        }
    }
</script>