<?php
    session_start();
    include ('connect.php');
        if(!empty($_POST['btregis'])){
            $er_mes = '';
                //th
                if(!empty($_POST['t_name'])){
                    $t_name = $_POST['t_name'];
                }else{
                    $er_mes .= 'กรุณากรอกชื่อประเภท-ไทย<br/>';
                }
                //en
                if(!empty($_POST['t_name_eng'])){
                    $t_name_eng = $_POST['t_name_eng'];
                }else{
                    $er_mes .= 'กรุณากรอกชื่อประเภท-อังกฤษ<br/>';
                }
            
                
                //Insert
                if(empty($er_mes)){
                    mysqli_query($connect,"UPDATE `tb_type` SET `t_name`='$t_name',`t_name_eng`='$t_name_eng' WHERE t_id = '".$_GET['edittype']."' ");
                      echo '<script type="text/Javascript">  ';
                      echo 'alert("แก้ไขประเภทสินค้าเรียบร้อย"); window.location="show_type.php" ;</script>';
                }else{
                    $_SESSION['error'] = $er_mes;
                }
        }
        $rs_type = mysqli_query($connect,"SELECT * FROM `tb_type` WHERE t_id = '".$_GET['edittype']."' ");
        $show_type = mysqli_fetch_array($rs_type);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสมาชิก</title>
    <?php include ('head.php'); ?>
    <style>
        .bg{
            background : linear-gradient(to right,rgba(300,300,1,1),rgba(100,255,1,1));
        }
    </style>
</head>
<body class="bg">
<?php include ('menu.php'); ?>
    <div class="container py-4">
        <div class="row d-flex justify-conntent-center align-item-center">
            <div class="card cascading-right" style="border-radius : 1rem; background : hsla(0,0%,100%,0.55); backdrop-filter : bulr(50px);">
                <div class="card-body p-5 text-center">  
                    <div class="m-mt-5 pb-5">
                        <h2 class="fw-bold text-uppercase mb-4">เพิ่มประเภทสินค้า</h2>

                        <?php if(!empty($_SESSION['error'])){ ?>
                            <div class="alert alert-danger col-4 container" role="alert">
                                <?php echo $_SESSION['error']; ?>
                            </div>
                        <?php $_SESSION['error'] = ''; } ?>

                        <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-12 col-lg-4 container mb-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="t_name" placeholder="ชื่อประเภท-ไทย" value="<?php echo $show_type['t_name']; ?>">
                                        <label>ชื่อประเภท-ไทย</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 container mb-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="t_name_eng" placeholder="ชื่อประเภท-อังกฤษ" value="<?php echo $show_type['t_name_eng']; ?>">
                                        <label>ชื่อประเภท-อังกฤษ</label>
                                    </div>
                                </div>
                            <input type="submit" name="btregis" class="btn btn-outline-success  btn-lg px-5" value="เพิ่มประเภทสินค้า">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>