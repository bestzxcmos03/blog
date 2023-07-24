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
                        <input type="text" class="form-control w-50" name="cid" id="cid" placeholder="เลขวิชา">
                    </div>
                    <div class="row justify-content-end align-items-end g-2 mt-1">
                        <input type="submit" class="btn btn-primary w-50 " name="submit" id="submit" value="ค้นหา">
                    </div>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST["submit"])) {
                        $cid = $_POST['cid'];
                        $conn = new mysqli("localhost", "root", "", "p106");
                        $result = $conn->query("SELECT student.stid, student.fname, student.lname, course.cid, course.cname, regis.grade FROM regis
                                        JOIN student ON regis.stid = student.stid
                                        JOIN course ON regis.cid = course.cid
                                        WHERE regis.cid = '$cid'
                        ");
                        $cname = $conn->query("SELECT * FROM course
                        WHERE cid = '$cid'
                        ");
                        $name=$cname->fetch_assoc();
                        echo "
                        <form method=post onsubmit=\"return validateForm2()\">
                            <div class=\"row justify-content-center align-items-center g-2 border-top mt-5\">
                                <p class=\"col text-center\">$name[cid] $name[cname]</p>
                            </div>
                            <div class=\"row justify-content-center align-items-center g-2 border-top\">
                                <p class=\"col text-center\">รหัสนักศึกษา</p>
                                <p class=\"col text-center\">ชื่อนักศึกษา</p>
                                <p class=\"col text-center\">นามสกุลนักศึกษา</p>
                                <p class=\"col text-center\">เกรดที่บันทึกไว้</p>
                                <p class=\"col text-center\">เกรดใหม่</p>
                            </div>
                ";
                        while ($r = $result->fetch_assoc()) {
                            if ($r['grade'] == "") {
                                $r['grade'] = "ยังไม่ได้ตัดเกรด";
                            }
                            echo "   <div class=\"row justify-content-center align-items-center g-2 border-top pb-3\">
                                    <p class=\"col text-center\">$r[stid]</p>
                                    <input type=hidden value=\"$r[stid]\" name=\"stid[]\">
                                    <input type=hidden value=\"$r[cid]\" name=\"cid[]\">
                                    <p class=\"col text-center\">$r[fname]</p>
                                    <p class=\"col text-center\">$r[lname]</p>
                                    <p class=\"col text-center\">$r[grade]</p>
                                    <select class=\"col form-select\" name=\"newgrade[]\" style=\"width:50px!important\">
                                        <option value=\"-1\" Selected>ไม่เปลี่ยนแปลง</option>
                                        <option value=\"A\">A</option>
                                        <option value=\"B\">B</option>
                                        <option value=\"C\">C</option>
                                        <option value=\"D\">D</option>
                                        <option value=\"F\">F</option>
                                    </select>
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
                        $cid = $_POST['cid'];
                        $newg=$_POST['newgrade'];
                        $conn = new mysqli("localhost", "root", "", "p106");
                        foreach($newg as $i=>$g){
                            if($g!="-1"){
                                $conn->query("UPDATE regis SET grade='$g' WHERE stid='$stid[$i]' AND cid='$cid[$i]'");
                            }
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