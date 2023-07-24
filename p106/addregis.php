<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['submit'])){
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
            <div class="col">
            <div class="row justify-content-center align-items-center g-2 mt-1">
                    <a href="./grade.php" class="btn btn-warning w-50">กลับ</a>
                </div>

            </div>
            <div class="col"></div>
            <div class="col">
                <div class="row justify-content-center align-items-center g-2">
                    <h1 class="text-end">ระบบจัดการนักศึกษา</h1>
                    <h5 class="text-end">ลงทะเบียนเรียน</h5>
                    <h6 class="text-end ">กรุณากรอกข้อมูลด้านล่างให้ครบ</h6>
                </div>
                <form method="post" onsubmit="return validateForm()">
                    <div class="row justify-content-end align-items-end g-2 mt-0">
                        <input type="text" class="form-control w-50" name="stid" id="stid" placeholder="เลขนักศึกษา">
                    </div>
                    <div class="row justify-content-end align-items-end g-2 mt-0">
                        <input type="text" class="form-control w-50" name="cid" id="cid" placeholder="เลขวิชา">
                    </div>
                    <div class="row justify-content-end align-items-end g-2 mt-1">
                        <input type="submit" class="btn btn-primary w-50 " name="submit" id="submit" value="ลงทะเบียน">
                    </div>
                </form>
                <?php
                    if($_SERVER["REQUEST_METHOD"]==="POST"){
                        if(isset($_POST["submit"])){
                            $stid=$_POST['stid'];
                            $cid=$_POST['cid'];
                            $conn = new mysqli("localhost","root","","p106");
                            $test = $conn->query("SELECT * FROM regis WHERE stid='$stid' AND cid='$cid'");
                            if($test->num_rows===0){
                                $conn->query("INSERT INTO regis(stid,cid) VALUES('$stid','$cid')");
                                echo"<p class=\"text-end\">ลงทะเบียน $cid สำเร็จ</p>";
                            }else{
                                echo"<p class=\"text-end\">$cid ได้เคยลงทะเบียนไว้แล้ว</p>";
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
    function validateForm(){
        if(document.getElementById('stid').value=="" || document.getElementById('stid').value.length!=5 || !(/^\d+$/.test(document.getElementById('stid').value))){
            alert("เลขนักศึกษาไม่ถูกต้อง");
            return false;
        }
        if(document.getElementById('cid').value=="" || document.getElementById('cid').value.length!=4 || !(/^\d+$/.test(document.getElementById('cid').value))){
            alert("เลขวิชาไม่ถูกต้อง");
            return false;
        }
        const cf=confirm("คุณต้องการยืนยันที่จะเพิ่มนักศึกษาใช่ไหม");
        if(cf){
            return true;
        }else{
            return false;
        }
}
</script>