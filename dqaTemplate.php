<?php
    include "backend/include/conn.php";
    $username = $_GET['username'];
    $sql = "select teacher,dqa,intAudit from hodhomee where courseID ='".$courseID."' AND audType ='aud1' AND teaType='speTea' ";
    $result = $conn->query($sql);
    $data = mysqli_query($conn,$sql);
    $total =mysqli_num_rows($data);
    if ( $total != 0) { 
        while($result=mysqli_fetch_assoc($data)) {

            // ###################################################################################################
            //                                     Form submitted by Teacher
            // ###################################################################################################

            if(strcmp($result['teacher'],"submitted")===0){
                echo '<a href="dqaTeam.php?courseID='.$courseID.'&username='.$username.'" ><button id="teaOrange">Form submitted</button></a>';
            }
            else if(strcmp($result['teacher'], "Nsubmitted") === 0){
                echo '<a href="#" ><button id="teaGrey">Form submitted</button></a>';
            }
            else if(strcmp($result['teacher'], "approved") === 0){
                echo '<a href="dqaFinalTeacherRes.php?courseID='.$courseID.'&username='.$username.'"><button id="teaGreen">Form Approved</button></a>';
            }


            // ###################################################################################################
            //                                     View Response
            // ###################################################################################################


            echo '<a href="dqaTeaResFinalDqa.php?courseID='.$courseID.'&username='.$username.' " ><button id="viewForm">View Response</button></a>';




                
            }
    } else {
        echo "0 results";
    }
    $username = $_GET['username'];
        $sql = "select dqaTeam from hod_feedback where courseID ='".$courseID."' and dqaTeam is not NULL";
        $result = $conn->query($sql);
        $data = mysqli_query($conn, $sql);
        $total = mysqli_num_rows($data);
        if ($total != 0) {
            // output data of each row
            while ($result = mysqli_fetch_assoc($data)) {
        
                // ###################################################################################################
                //                                     Hod 
                // ###################################################################################################
        
                echo '<a href="hodDqaFeed.php?courseID='.$courseID.'&username='.$username.'" ><button id="button2">HOD Response</button></a>';
        
            }
        } else {
            echo '<button id="buttonn2">HOD Response</button>';
        }





?>