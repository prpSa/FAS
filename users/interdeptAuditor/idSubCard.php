<?php
    session_start();
    global $username, $year, $sem, $sub,$dept;
    $username = $_SESSION['username'];
    $year = $_SESSION['year'];
    // $sem = $_SESSION['sem'];
    $sub = $_SESSION['sub']; //Teacher username
    $dept = $_SESSION['dept'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../css/extAud.css">
  <!-- Font Awesome  -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <!-- Bootstrap css  -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
  <!-- js for file and bootstrap  -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>External Auditor Home</title>
</head>
<body>
<!-- Navbar -->
<div class="bs-example">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
    <div id="navbarCollapse" class="collapse navbar-collapse">
 
        <div class="navbarLeft">
        <a href="users/interdeptAuditor/idAuditHome.php?username=<?php echo $username; ?>"><img src="../../css/images/dylogo.png" style="width:10rem; height:4rem" ></a>
        </div>

        <div class="navbarCenter">
            <h4 style="font-weight:1000">Inter-Departmental Auditor Home</h4>
        </div>

        <div class="navbarRight">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item dropdown" >
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="font-size:1rem; font-weight:600"><?php echo $username;?></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="fasprofile/profile.php?username=<?php echo $username; ?>" class="dropdown-item" style="font-size:1rem; font-weight:600"><i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
                        <a href="contactus.php?username=<?php echo $username;?>" class="dropdown-item" style="font-size:1rem; font-weight:600"><i class="fas fa-question-circle fa-sm fa-fw mr-2 text-gray-400"></i>Query</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
                    </div>
                </li>
            </ul>
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size:30px">??</span>
                        </button>
                    </div>

                    
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a href="destroy.php"> <button name="logout_btn" class="btn btn-primary">Logout</button> </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
            
    
    </nav>
</div>
<main>
 

<?php  
                include "../../backend/include/conn.php";
                $username = $_SESSION['username'];
                $sql = "SELECT DISTINCT sub_name FROM hodhomee WHERE tea_username = '".$_SESSION['sub']."' AND year = '".$_SESSION['year']."'";
                $result = $conn->query($sql);
                $data = mysqli_query($conn, $sql);
                $total = mysqli_num_rows($data);
                if ($total != 0) {
                    while ($result = mysqli_fetch_assoc($data)) {
                       
                        card($result['sub_name']);
                    }
                }?>
                <?php
                function instName($uName){
                    include "../../backend/include/conn.php";
                    $sql = "SELECT name FROM users WHERE username = '$uName'";
                    $result = $conn->query($sql);
                    $data = mysqli_query($conn, $sql);
                    $total = mysqli_num_rows($data);
                    if ($total != 0) {
                        while ($result = mysqli_fetch_assoc($data)) {
                            return $result['name'];
                        }
                    }
                }
                function subCode($cID){
                    include "../../backend/include/conn.php";
                    $sql = "SELECT subjectCode FROM course WHERE courseID = '$cID'";
                    $result = $conn->query($sql);
                    $data = mysqli_query($conn, $sql);
                    $total = mysqli_num_rows($data);
                    if ($total != 0) {
                        while ($result = mysqli_fetch_assoc($data)) {
                            return $result['subjectCode'];
                        }
                    }
                }
function card($subname){
    global $username, $year, $sem, $sub,$dept;
    $username = $_SESSION['username'];
    $year = $_SESSION['year'];
    $sem = $_SESSION['sem'];
    $sub = $_SESSION['sub']; //Teacher username
    $dept = $_SESSION['dept'];
    
    echo'
    <div class="box">
        <div class="card">
            <div class="subname">
                '.$subname.'
            </div>

            <div class="sub">';
                
                    include "../../backend/include/conn.php";
                    $sql = "SELECT division FROM hodhomee WHERE tea_username = '".$_SESSION['sub']."' AND sub_name= '".$subname."' GROUP BY division ORDER BY division";
                    $result = $conn->query($sql);
                    $data = mysqli_query($conn, $sql);
                    $total = mysqli_num_rows($data);
                    if ($total != 0) {
                        $i = 0;
                        while ($result = mysqli_fetch_assoc($data)) {
                            $i++;
                            if($i!=1){echo '<h3>|</h3>';}
                            echo '<div class="sub'.$i.'"><button id="sub'.$i.'">Div '.$result['division'].'</button>
                                  </div>';
                        }
                    }
                
           echo' </div>';

            
                

                $sql = "SELECT * FROM hodhomee WHERE tea_username = '".$_SESSION['sub']."' AND sub_name='".$subname."' GROUP BY division ORDER BY division";
                $result = $conn->query($sql);
                $data = mysqli_query($conn, $sql);
                $total = mysqli_num_rows($data);
                if ($total != 0) {
                    $i = 0;
                    while ($result = mysqli_fetch_assoc($data)) {
                        $i++;
                        $teaUsername = instName($result['tea_username']);
                        echo '<div class="container" id="'.$i.'">
                                <br>
                                <p>Instructor : '.$teaUsername.' </p>
                                <p>Subject Code : '.subCode($result['courseID']).'</p> 
                                <p><a href="idAud1.php?teaUsername='.$sub.'&division='.$result['division'].'&year='.$year.'&sem='.$sem.'&subj='.$subname.'">Audit 1 </a></p>
                                <p><a href="idAud2.php?teaUsername='.$sub.'&division='.$result['division'].'&year='.$year.'&sem='.$sem.'&subj='.$subname.'">Audit 2 </a></p>
                                </div>';
                    }
                }

            
            
            echo '
                <div class="cl">
                    <div class="c">
                        <button><a href="theory.php?teaUname='.$sub.'&year='.$year.'&sem='.$sem.'&subj='.$subname.'">Course</button>
                    </div><h3>|</h3>
                    <div class="l">
                        <button><a href="lab.php?teaUname='.$sub.'&year='.$year.'&sem='.$sem.'&subj='.$subname.'">Lab</button>
                    </div>
                </div>
            
            
        </div>
    </div>
   
            ';
}
            ?>

    
</main>
<script>
$(document).ready(function(){
    $("#1").show().default;
    $("#2").hide().default;
    $("#3").hide().default;
  $("#sub1").click(function(){
    $("#1").show();
    $("#2").hide();
    $("#3").hide();
  });
  $("#sub2").click(function(){
    $("#1").hide();
    $("#2").show();
    $("#3").hide();
  });
  $("#sub3").click(function(){
    $("#1").hide();
    $("#2").hide();
    $("#3").show();
  });
});
    </script>
    <?php
    include '../../backend/include/footer.php'
    ?>
    
</body>
</html>