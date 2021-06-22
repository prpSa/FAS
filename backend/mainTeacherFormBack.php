<?php
include "include/conn.php";
error_reporting(0);
if (isset($_POST['save'])) {
    
    
    $username = $_GET['username'];
    $fromAcademicYear = $_POST['year1'];
    $toAcademicYear = $_POST['year2'];
    $semester = $_POST['sem'];
    $subjectCode = $_POST['subcode'];
    $courseName = $_POST['cname'];
    $credits = $_POST['cred'];
    $lectureHoursPerWeek = $_POST['lec'];
    $totalContactHours = $_POST['contact'];

    $Objective = $_POST['Objective'];
    $Text = $_POST['Text'];

  
    
    
    $sql = " INSERT INTO `course`(fromAcadYr,toAcadYr ,sem ,subjectCode,courseName,credits,lectHr,totLectHr) VALUES ('$fromAcademicYear','$toAcademicYear','$semester','$subjectCode','$courseName','$credits','$lectureHoursPerWeek','$totalContactHours');";
    $query = mysqli_query($conn, $sql);

    $sql_courseID = "SELECT * FROM `course` WHERE subjectCode= '" . $subjectCode . "' ";
    $data_courseID = mysqli_query($conn, $sql_courseID);
    $total_courseID = mysqli_num_rows($data_courseID);

    if ($total_courseID != 0) {
        while ($result_courseID = mysqli_fetch_assoc($data_courseID)) {
            $courseID = $result_courseID['courseID'];
        }
    }


    foreach ($Objective as $key => $value) {
        $save = "INSERT INTO courseobjective (courseID, objNo, objName)VALUES('" . $courseID . "','" . $value . "','" . $Text[$key] . "')";

        $query = mysqli_query($conn, $save);
    }


    $CO_no = $_POST['CO_no'];
    $CO_name = $_POST['CO_name'];
    foreach ($CO_no as $key => $value) {
        $savee = "INSERT INTO courseoutcome (courseID, CO_no, CO_name)VALUES('" . $courseID . "','" . $value . "','" . $CO_name[$key] . "')";

        $queryy = mysqli_query($conn, $savee);
    }


    $PO_no = $_POST['PO_no'];
    $PO_title = $_POST['PO_title'];
    $PO_description = $_POST['PO_description'];

    foreach ($PO_no as $key => $value) {
        $save_progOut = "INSERT INTO progoutcomes (courseID, PO_no,PO_title,PO_description)VALUES('" . $courseID . "','" . $value . "','" . $PO_title[$key] . "','" . $PO_description[$key] . "')";
        $queryy = mysqli_query($conn, $save_progOut);
    }


    for ($i = 1; $i <= 6; $i++) {
        for ($j = 1; $j <= 12; $j++) {
            $rating = $_POST["rco$i" . "cpo$j"];
            $CO_no = "CO$i";
            $PO_no = "PO$j";
            $sql_mCOpo = " INSERT INTO `co_po_mapping`(courseID,CO_no,PO_no ,rating) VALUES ('$courseID','$CO_no','$PO_no','$rating');";
            $query = mysqli_query($conn, $sql_mCOpo);
        }
    }


    $PSO_no = $_POST['PSO_no'];
    $PSO_description = $_POST['PSO_description'];
    foreach ($PSO_no as $key => $value) {
        $save_pso = "INSERT INTO progspecificoutcome (courseID, PSO_no, PSO_description)VALUES('" . $courseID . "','" . $value . "','" . $PSO_description[$key] . "')";
        $queryy = mysqli_query($conn, $save_pso);
    }


    for ($i = 1; $i <= 6; $i++) {
        for ($j = 1; $j <= 3; $j++) {
            $rating = $_POST["rcoo$i" . "cpoo$j"];
            $CO_no = "CO$i";
            $PSO_no = "PSO$j";
            $sql_mCOpso = " INSERT INTO `co_pso_mapping`(courseID,CO_no,PSO_no ,rating) VALUES ('$courseID','$CO_no','$PSO_no','$rating');";
            $query = mysqli_query($conn, $sql_mCOpso);
        }
    }


    $CO_noo = $_POST['CO_noo'];
    $noOfExp = $_POST['noOfExp'];
    $weightagePercent = $_POST['weightagePercent'];

    foreach ($CO_noo as $key => $value) {
        $save_coWei = "UPDATE courseoutcome SET weightagePercent='" . $weightagePercent[$key] . "',noOfExp='" . $noOfExp[$key] . "' WHERE courseID='" . $courseID . "' AND CO_no='" . $value . "' ";
        $queryy = mysqli_query($conn, $save_coWei);
    }

    // $expNo =$_POST['expNo'];
    // $CO_no_expLi =$_POST['CO_no_expLi'];
    // $expName =$_POST['expName'];
    // $weight =$_POST['weight'];

    // foreach ($expNo as $key => $value){
    //     $save_expLi =" INSERT INTO experimentlist (`courseID`, `expNo`, `CO_no`, `expName`, `weight`) VALUES ('".$courseID."','".$value."','".$CO_no_expLi[$key]."','".$expName[$key]."','".$weight[$key]."');";
    //     $queryy = mysqli_query($conn, $save_expLi);
    // }


    $chp_no = $_POST['Chp_no'];
    $topic = $_POST['topic'];
    $duration = $_POST['duration'];
    $CO_nooo = $_POST['CO_nooo'];
    $weightage = $_POST['weightage'];

    foreach ($CO_nooo as $key => $value) {
        $sql_chpPlan = "INSERT INTO `coursetopics`(`courseID`, `chp_expNo`, `chp_expTopic`, `CO_meet`, `chp_exp_weightage`, `duration`) VALUES ('" . $courseID . "','" . $chp_no[$key] . "','" . $topic[$key] . "','" . $value . "','" . $weightage[$key] . "','" . $duration[$key] . "');";
        $queryy = mysqli_query($conn, $sql_chpPlan);
    }

    for ($i = 1; $i <= 13; $i++) {
        for ($j = 1; $j <= 4; $j++) {
            $weekno = "$i";;
            $lecno = "$j";
            $subTopics = $_POST["Details$i$j"];
            $coMeet = $_POST["COlp$i$j"];
            $weightage = $_POST["Weightage$i$j"];
            $TeachM = $_POST["TeachingMethod$i$j"];
            $sql_lp = " INSERT INTO `lessonplan`(`courseID`, `weekNo`, `lectNo`, `subTopics`, `CO_meet`, `weightage`, `teachingMethod`) VALUES ('$courseID','$weekno','$lecno','$subTopics','$coMeet','$weightage','$TeachM');";
            $query = mysqli_query($conn, $sql_lp);
        }
    }



    for ($k = 1; $k <= 2; $k++) {
        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 6; $j++) {
                $marks = $_POST["t$k" . "q$i" . "c$j"];
                $term = "Term$k";
                $qNo = "Q$i";
                $Co_no = "CO$j";
                $sql_ia = "INSERT INTO `ia`(`courseID`, `term`, `qNo`, `CO_no`, `marks`) VALUES ('$courseID','$term','$qNo','$Co_no','$marks');";
                $query = mysqli_query($conn, $sql_ia);
            }
        }
    }


    $sqlll = "INSERT INTO `dqa`(`courseID`, `courseDetails`, `courseDetailsSugg`, `courseObj`, `courseObjSugg`, `courseOut`, `courseOutSugg`, `progOut`, `progOutSugg`, `m_copo`, `m_copoSugg`, `pso`, `psoSugg`, `m_copso`, `m_copsoSugg`, `courseWeig`, `courseWeigSugg`, `chpPlan`, `chpPlanSugg`,`lesPlan`,`lesPlanSugg`, `ia`, `iaSugg`, `btLevel`, `grammar`, `finalSugg`) VALUES ('$courseID','NULL','NULL','NULL', 'NULL','NULL', 'NULL','NULL','NULL' ,'NULL','NULL','NULL','NULL' ,'NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL' , 'NULL',  'NULL', 'NULL', 'NULL','NULL')";
    $query = mysqli_query($conn, $sqlll);

    // $sql_hod = "INSERT INTO `hodhomee`(`courseID`, `teacher`,`auditorSheet`, `dqa`, `intAudit`, `teacherInt`,`intAuditII`,`teacherIntII`,`extAudit`) VALUES ('" . $courseID . "','submitted','Nsubmitted','NULL','NULL','NULL','NULL','NULL','NULL')";
    // $query_hod = mysqli_query($conn, $sql_hod);

    $sql_hodd = "INSERT INTO `hod_all_feedback`(`courseID`, `teaType`, `audType`, `teacher`, `dqaTeam`, `intAudit`, `extAudit`, `classOrLab`) VALUES ('$courseID','NULL','NULL','NULL','NULL','NULL','NULL','NULL')";
    $query_hod = mysqli_query($conn, $sql_hodd);


    $audit_docs = "UPDATE `audit_docs` SET `courseID`='$courseID' WHERE sub_name ='$courseName'";
    $audit_docs = mysqli_query($conn, $audit_docs);
    $audit_docs = "UPDATE `audit_res` SET `courseID`='$courseID' WHERE sub_name ='$courseName'";
    $audit_docs = mysqli_query($conn, $audit_docs);
    $audit_docs = "UPDATE `hodhomee` SET `courseID`='$courseID', `teacher`='submitted' WHERE sub_name ='$courseName' AND `teaType`='speTea'";
    $audit_docs = mysqli_query($conn, $audit_docs);






    if ($sql_ia == TRUE) {
        include('../smtp/PHPMailerAutoload.php');
        include('../smtp.php');
        $mail->addAddress($username);
        $mail->isHTML(true);
        $mail->Subject="Form has been Submitted for correction toDQA Team";
        $mail->Body="Your draft course handout has been submitted for further process. <br> Course Details:  <br>Coursename: $courseName <br>Semester: $semester <br> Subject Code: $subjectCode ";
        $mail->SMTPOptions=array("ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
            "allow_self_signed"=>false,
        ));

        if($mail->send()){
            echo '<script type="text/javascript">'; 
            echo 'alert("ThankYou for Your Response");'; 
            echo 'window.open("teacherhome.php?username='.$username.'","_self");';
            echo '</script>';
            exit();
        }else{
           
           echo '<script src="../js/sweetalert.min.js"></script>
           <script>
           swal({
               title: "Form Submitted Successfully!!",
               text: "",
               type: "success"
           }).then(function() {
               window.open("teacherome.php?username='.$username.'","_self");;
           });
           
           </script>';
        }

        exit;
    }





} else if (isset($_POST['saveTea'])) {
    $username = $_GET['username'];
    $fromAcademicYear = $_POST['year1'];
    $toAcademicYear = $_POST['year2'];
    $semester = $_POST['sem'];
    $subjectCode = $_POST['subcode'];
    $courseName = $_POST['cname'];
    $credits = $_POST['cred'];
    $lectureHoursPerWeek = $_POST['lec'];
    $totalContactHours = $_POST['contact'];

    $Objective = $_POST['Objective'];
    $Text = $_POST['Text'];
   

    $sql = " INSERT INTO `course`(fromAcadYr,toAcadYr ,sem ,subjectCode,courseName,credits,lectHr,totLectHr) VALUES ('$fromAcademicYear','$toAcademicYear','$semester','$subjectCode','$courseName','$credits','$lectureHoursPerWeek','$totalContactHours');";
    $query = mysqli_query($conn, $sql);

    $sql_courseID = "SELECT * FROM `course` WHERE subjectCode= '" . $subjectCode . "' ";
    $data_courseID = mysqli_query($conn, $sql_courseID);
    $total_courseID = mysqli_num_rows($data_courseID);

    if ($total_courseID != 0) {
        while ($result_courseID = mysqli_fetch_assoc($data_courseID)) {
            $courseID = $result_courseID['courseID'];
        }
    }


    foreach ($Objective as $key => $value) {
        $save = "INSERT INTO courseobjective (courseID, objNo, objName)VALUES('" . $courseID . "','" . $value . "','" . $Text[$key] . "')";

        $query = mysqli_query($conn, $save);
    }


    $CO_no = $_POST['CO_no'];
    $CO_name = $_POST['CO_name'];
    foreach ($CO_no as $key => $value) {
        $savee = "INSERT INTO courseoutcome (courseID, CO_no, CO_name)VALUES('" . $courseID . "','" . $value . "','" . $CO_name[$key] . "')";

        $queryy = mysqli_query($conn, $savee);
    }


    $PO_no = $_POST['PO_no'];
    $PO_title = $_POST['PO_title'];
    $PO_description = $_POST['PO_description'];

    foreach ($PO_no as $key => $value) {
        $save_progOut = "INSERT INTO progoutcomes (courseID, PO_no,PO_title,PO_description)VALUES('" . $courseID . "','" . $value . "','" . $PO_title[$key] . "','" . $PO_description[$key] . "')";
        $queryy = mysqli_query($conn, $save_progOut);
    }


    for ($i = 1; $i <= 6; $i++) {
        for ($j = 1; $j <= 12; $j++) {
            $rating = $_POST["rco$i" . "cpo$j"];
            $CO_no = "CO$i";
            $PO_no = "PO$j";
            $sql_mCOpo = " INSERT INTO `co_po_mapping`(courseID,CO_no,PO_no ,rating) VALUES ('$courseID','$CO_no','$PO_no','$rating');";
            $query = mysqli_query($conn, $sql_mCOpo);
        }
    }


    $PSO_no = $_POST['PSO_no'];
    $PSO_description = $_POST['PSO_description'];
    foreach ($PSO_no as $key => $value) {
        $save_pso = "INSERT INTO progspecificoutcome (courseID, PSO_no, PSO_description)VALUES('" . $courseID . "','" . $value . "','" . $PSO_description[$key] . "')";
        $queryy = mysqli_query($conn, $save_pso);
    }


    for ($i = 1; $i <= 6; $i++) {
        for ($j = 1; $j <= 3; $j++) {
            $rating = $_POST["rcoo$i" . "cpoo$j"];
            $CO_no = "CO$i";
            $PSO_no = "PSO$j";
            $sql_mCOpso = " INSERT INTO `co_pso_mapping`(courseID,CO_no,PSO_no ,rating) VALUES ('$courseID','$CO_no','$PSO_no','$rating');";
            $query = mysqli_query($conn, $sql_mCOpso);
        }
    }


    $CO_noo = $_POST['CO_noo'];
    $noOfExp = $_POST['noOfExp'];
    $weightagePercent = $_POST['weightagePercent'];

    foreach ($CO_noo as $key => $value) {
        $save_coWei = "UPDATE courseoutcome SET weightagePercent='" . $weightagePercent[$key] . "',noOfExp='" . $noOfExp[$key] . "' WHERE courseID='" . $courseID . "' AND CO_no='" . $value . "' ";
        $queryy = mysqli_query($conn, $save_coWei);
    }

    // $expNo =$_POST['expNo'];
    // $CO_no_expLi =$_POST['CO_no_expLi'];
    // $expName =$_POST['expName'];
    // $weight =$_POST['weight'];

    // foreach ($expNo as $key => $value){
    //     $save_expLi =" INSERT INTO experimentlist (`courseID`, `expNo`, `CO_no`, `expName`, `weight`) VALUES ('".$courseID."','".$value."','".$CO_no_expLi[$key]."','".$expName[$key]."','".$weight[$key]."');";
    //     $queryy = mysqli_query($conn, $save_expLi);
    // }


    $chp_no = $_POST['Chp_no'];
    $topic = $_POST['topic'];
    $duration = $_POST['duration'];
    $CO_nooo = $_POST['CO_nooo'];
    $weightage = $_POST['weightage'];

    foreach ($CO_nooo as $key => $value) {
        $sql_chpPlan = "INSERT INTO `coursetopics`(`courseID`, `chp_expNo`, `chp_expTopic`, `CO_meet`, `chp_exp_weightage`, `duration`) VALUES ('" . $courseID . "','" . $chp_no[$key] . "','" . $topic[$key] . "','" . $value . "','" . $weightage[$key] . "','" . $duration[$key] . "');";
        $queryy = mysqli_query($conn, $sql_chpPlan);
    }

    for ($i = 1; $i <= 13; $i++) {
        for ($j = 1; $j <= 4; $j++) {
            $weekno = "$i";;
            $lecno = "$j";
            $subTopics = $_POST["Details$i$j"];
            $coMeet = $_POST["COlp$i$j"];
            $weightage = $_POST["Weightage$i$j"];
            $TeachM = $_POST["TeachingMethod$i$j"];
            $sql_lp = " INSERT INTO `lessonplan`(`courseID`, `weekNo`, `lectNo`, `subTopics`, `CO_meet`, `weightage`, `teachingMethod`) VALUES ('$courseID','$weekno','$lecno','$subTopics','$coMeet','$weightage','$TeachM');";
            $query = mysqli_query($conn, $sql_lp);
        }
    }



    for ($k = 1; $k <= 2; $k++) {
        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 6; $j++) {
                $marks = $_POST["t$k" . "q$i" . "c$j"];
                $term = "Term$k";
                $qNo = "Q$i";
                $Co_no = "CO$j";
                $sql_ia = "INSERT INTO `ia`(`courseID`, `term`, `qNo`, `CO_no`, `marks`) VALUES ('$courseID','$term','$qNo','$Co_no','$marks');";
                $query = mysqli_query($conn, $sql_ia);
            }
        }
    }
    $sql_hod = "INSERT INTO `hodhometea`(`courseID`, `teacher`) VALUES ('" . $courseID . "','inprocess')";
    $query_hod = mysqli_query($conn, $sql_hod);


    if ($sql_hod == TRUE) {

        echo '<script type="text/javascript">'; 
        echo 'alert("ThankYou for Your Response");'; 
        echo 'window.open("teacherhome.php?username='.$username.'","_self");';
        echo '</script>';
        exit;
    }
}


?>