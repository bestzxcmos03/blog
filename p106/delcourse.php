<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['submit'])){
        header("Location: ./course.php");
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
            <div class="col">
                <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./course.php" class="btn btn-warning w-50">กลับ</a>
                </div>
            </div>
            <div class="col"></div>
            <div class="col">
                <div class="row justify-content-center align-items-center g-2 mb-3">
                    <h1 class="text-end">ระบบจัดการนักศึกษา</h1>
                    <h5 class="text-end">ลบวิชา</h5>
                    <h6 class="text-end ">กรุณาเลือกทำรายการด้านล่าง</h6>
                </div>
                <div class="row justify-content-center align-items-center g-2 border-top">
                    <h5 class="text-center">รายชื่อวิชา</h5>
                </div>
                <?php
                echo "
                            <div class=\"row justify-content-center align-items-center g-2\">
                                <p class=\"col-2 text-center\">เลขวิชา</p>
                                <p class=\"col-8 text-center\">ชื่อวิชา</p>
                                <p class=\"col-2 text-center\">ลบ</p>
                            </div>
                            <form method=POST onsubmit=\"return validateForm()\">
                ";
                $conn = new mysqli("localhost", "root", "", "p106");
                $result = $conn->query("SELECT * FROM course");
                while ($r = $result->fetch_assoc()) {
                    echo "   <div class=\"row justify-content-center align-items-center g-2 border-top\">
                                <input type=hidden name=\"cid[]\" value=$r[cid]>
                                <p type=text name=\"cid[]\" class=\"col-2 text-center\" >$r[cid]</p>
                                <p type=text name=\"cname[]\" class=\"col-8 text-center\">$r[cname]</p>
                                <div class=\"col-2 form-check \" >
                                    <input type=checkbox class=\" form-check-input\" name=\"del[]\" value=$r[cid] style=\"margin:auto\">
                                </div>
                            </div>
                    ";
                }

                echo"
                            <div class=\"row justify-content-center align-items-center g-2 border-top\">
                                <input type=submit value=บันทึก name=submit class=\"btn btn-primary\">
                            </div>
                            </form>
                ";
                
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    if(isset($_POST['submit'])){
                        $del=isset($_POST['del'])?$_POST['del']:[];
                        $conn = new mysqli("localhost", "root", "", "p106");
                        foreach($del as $d){
                            $conn->query("DELETE FROM course WHERE cid='$d'");
                            
                        }
                    }
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