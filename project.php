<html>
    <head>
        <title> CPSC 304 2023S T2 PHP/Oracle Project</title>
    </head>
    <style>
        <?php include 'project.css'; ?>
    </style>
    <body>
        <h1> Welcome to application portal for the BEST company! </h1>
        <p>Please click any button to begin with:</p>

        <div id="group" class="options-employee">
            <button onclick="browseJob()">Browse Job Listings</button>
            <button onclick="viewApp()">Past Applications</button>
            <button onclick="upcomingInterviews()">Upcoming Interviews</button>
            <button onclick="acceptDeny()">Accept/Deny Offer</button>
            <button onclick="manageAccount()">Manage Account</button>
            <button onclick="extraInfo()">Extra Information</button>
        </div>

        <div id="filterGroup" style="display: none" class="none">
            <button onclick="browseJob()">Filter By Category</button>
            <button onclick="viewApp()">Find</button>
        </div><br><br><br>

        <!-- form for filtering by category -->
        <form id="filterCatForm" style="display: none" method="POST" action="project.php"> 
            <input type="hidden" id="filterCatRequest" name="filterCatRequest">
            Position<input type="checkbox" name="POSITIONNAME" value="POSITIONNAME"> 
            , Spots Left<input type="checkbox" name="NUM_OF_SPOTS" value="NUM_OF_SPOTS"> 
            , Annual Salary <input type="checkbox" name="SALARY" value="SALARY"> 
            , Work Schedule<input type="checkbox" name="SHIFTSCHEDULE" value="SHIFTSCHEDULE"> 
            <input type="submit" value="Filter By Category" name="filterCat" style="font-weight: bold;"></p>
        </form>
        <!-- <form id="filterFindForm" method="POST" action="project.php"> 
            <input type="hidden" id="insertInterviewQueryRequest" name="insertInterviewQueryRequest">
            Find: <input type="text" name="insInt"> 
            In Category: <input type="text" name="insIntee"> 
            <input type="submit" value="Filter By Find" name="filterFind"></p>
        </form> -->

        <script>
            var show = false;
            function browseJob() {
                document.getElementById('printJobForm').submit(); }

            function viewApp() {
                document.getElementById('printAppForm').submit(); }

            function upcomingInterviews() {
                document.getElementById('printInterviewForm').submit(); }

            function acceptDeny() {
                // TODO
            }

            function manageAccount() {
                document.getElementById('manageAccForm').submit(); }
            
            function extraInfo(){
                document.getElementById('printExInfo').submit();
            }

            function getAG(){
                document.getElementById('printAggregateGroup').submit();
            }

            function getAH(){
                document.getElementById('printAggregateHaving').submit();
            }

            function getNS(){
                document.getElementById('printNested').submit();
            }

            function getDivi(){
                document.getElementById('printDivision').submit();
            }

        </script>

        
        <?php
        include 'functions.php';

        // HANDLE ALL GET REQUESTS
        // this is the position where all requests are printed
        if (isset($_GET['printRequest']) || isset($_GET['manageRequest']) || isset($_GET['printRequestInterview']) 
            || isset($_GET['printRequestAccount'])|| isset($_GET['printAppRequest']) || isset($_GET['printExInfo']) || isset($_GET['aggregateGroup']) || isset($_GET['aggregateHaving'])
            || isset($_GET['nested']) || isset($_GET['division'])){
            handleGETRequest();
        }
        if (isset($_POST['filterCat'])) {
            handlePOSTRequest();
        }
        // function to echo all the buttons to manage account
        function printManageButtons() {
            echo "Please choose an option from below: <br><br>";
            echo "<div><button onclick='createAcc()'>Create an Account</button><button onclick='updateAddy()'>Update Address</button><button onclick='updatePhone()'>Update Phone Number</button></div>";
        }

        function printInfoButtons() {
            echo "Please choose an option from below: <br><br>";
            echo "<div><button onclick='getAG()'>Average Salary By Type of Work</button><button onclick='getAH()'>Jobs With Salaries Above $50,000</button>
            <button onclick='getNS()'>Positions With The Highest Average Salaries</button><button onclick='getDivi()'>Jobs With Less Than 20 Spots Left</button></div>";
        }

        // one result will only allow for one fetch from OCI, so only one while loop for printing
        function handlePrintJobListing() {
            global $db_conn;
            echo "<b>All Job Listings:</b><br><br>";
            echo "<table>";
            echo "<tr><th>Position</th><th>Spots Left</th><th>Annual Salary</th><th>Work Schedule</th><th>Job Reference ID</th></tr>";
            $result = executePlainSQL("SELECT p.PositionName, sn.referenceID, sn.num_of_Spots, ss.Salary, ss.ShiftSchedule, sn.referenceID
                FROM JR1_ScheduleSalary ss 
                JOIN JR10_ID_Shift s ON ss.ShiftSchedule = s.ShiftSchedule 
                JOIN JR3_ID_SpotNum sn ON s.ReferenceID = sn.referenceID 
                JOIN JR9_ID_Qualifications q ON sn.referenceID = q.ReferenceID
                JOIN JR7_DutyQualifications dq ON q.Qualifications = dq.Qualifications 
                JOIN JR5_PositionDuties p ON dq.Duties = p.Duties");
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . '<a target = "_blank" 
                    href="https://www.students.cs.ubc.ca/~fulino/jobListing.php?posID='. $row[1].' ">' . 
                    $row[0] . "</a>" . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr>";
            }
            echo "</table>";
            echo "<br>";

            echo "Check any desired boxes for filtering by category:<br><br>";
            // form for filtering
            echo "<form id='filterCatForm' method='POST' action='project.php'> 
            <input type='hidden' id='filterCatRequest' name='filterCatRequest'>
            Position<input type='checkbox' name='POSITIONNAME' value='POSITIONNAME'> 
            , Spots Left<input type='checkbox' name='NUM_OF_SPOTS' value='NUM_OF_SPOTS'> 
            , Annual Salary <input type='checkbox' name='SALARY' value='SALARY'> 
            , Work Schedule<input type='checkbox' name='SHIFTSCHEDULE' value='SHIFTSCHEDULE'> 
            <input type='submit' value='Filter By Category' name='filterCat' style='font-weight: bold;'></p>
            </form>";
        }

        function handlePrintInterview() {
            global $db_conn;
            $result = executePlainSQL("SELECT * FROM Interview");
            echo "<b>All Upcoming Scheduled Interviews:</b><br><br>";
            echo "<table>";
            echo "<tr><th>Interviewer</th><th>Interviewee</th><th>IntDate</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
                echo $row["INTERVIEWER"] . "</td><td>" . $row["INTERVIEWEE"] . "</td><td>" . $row["DATE_"] . "</td></tr>";
            }
            echo "</table>";
        }

        function handlePrintAccount() {
            global $db_conn;
            $result = executePlainSQL("SELECT * FROM CreateAccount");
            $result2 = executePlainSQL("SELECT * FROM CreateAccount");
            echo "<br>Retrieved data from table accountTable:<br>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Phone Number</th><th>Address</th><th>Account Number</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
                echo $row["NAME"] . "</td><td>" . $row["EMAIL"] . "</td><td>" . $row["PHONE_NUMBER"] . 
                    "</td><td>" . $row["ADDRESS"] . "</td><td>" . $row["ACCOUNT_NUMBER"] . "</td></tr>";
            }
            echo "</table>";
        }

        function handlePrintPastApplication() {
            global $db_conn;
            $result = executePlainSQL("SELECT * FROM StoreApplication");
            printResultApplication($result);
            $result = executePlainSQL("SELECT * FROM CoverLetter");
            printApplicationCover($result);
            $result = executePlainSQL("SELECT * FROM Resumes");
            printApplicationResume($result);
        }


        // function to handle filtering 
        function handleFilterRequest() {
            global $db_conn;

            $tuple = array ();
            if (array_key_exists('POSITIONNAME', $_POST)) {
                array_push($tuple,"PositionName, ");
            } 
            if (array_key_exists('NUM_OF_SPOTS', $_POST)) {
                array_push($tuple,"Num_of_Spots, ");
            } 
            if (array_key_exists('SALARY', $_POST)) {
                array_push($tuple,"Salary, ");
            } 
            if (array_key_exists('SHIFTSCHEDULE', $_POST)) {
                array_push($tuple,"ShiftSchedule, ");
            } 
            if (!empty($tuple)) {
                array_push($tuple,"referenceID, "); // add reference ID to grab from sql
                $string = implode("",$tuple);
                $sub = substr($string, 0, -2);
                // echo $sub;
                echo "<b>All Filtered Job Listings:</b><br><br>";
                $result = executePlainSQL("SELECT $sub FROM 
                (SELECT p.PositionName, sn.referenceID, sn.num_of_Spots, ss.Salary, 
                ss.ShiftSchedule, q.Qualifications, dq.Duties
                FROM JR1_ScheduleSalary ss 
                JOIN JR10_ID_Shift s ON ss.ShiftSchedule = s.ShiftSchedule 
                JOIN JR3_ID_SpotNum sn ON s.ReferenceID = sn.referenceID 
                JOIN JR9_ID_Qualifications q ON sn.referenceID = q.ReferenceID
                JOIN JR7_DutyQualifications dq ON q.Qualifications = dq.Qualifications 
                JOIN JR5_PositionDuties p ON dq.Duties = p.Duties)");
                
                array_pop($tuple); // to remove the reference ID from header
                $reverse = array_reverse($tuple);
                $size = sizeof($reverse);
                echo "<table><tr>";
                while(!empty($reverse)) {
                    echo "<th>" . substr(end($reverse), 0, -2) . "</th>";
                    array_pop($reverse);
                }
                echo "</tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr>";
                    for ($x = 0; $x < $size; $x++) {
                        if ($x == 0) {
                            echo "<td>" . '<a target = "_blank" 
                            href="https://www.students.cs.ubc.ca/~fulino/jobListing.php?posID='. $row["REFERENCEID"].' ">' . 
                            $row[0] . "</a>" . "</td>";
                        } else {
                            echo "<td>" . $row[$x] . "</td>";
                        }
                    }
                    echo "</tr>";
                }
                echo "</table><br>";
            }
            
        }
        
        function printResultApplication($result) {
            echo "<b>All Past Job Applications:</b><br><br>";
            echo "<table>";
            echo "<tr><th>App Num #</th><th>Apply Date</th><th>Account Number</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . '<a target = "_blank" 
                    href="https://www.students.cs.ubc.ca/~daniren/applications.php?appID='.$row['JOB_APP_NUM'].' ">' . 
                    $row['JOB_APP_NUM'] . "</a>" . "</td><td>" . $row["APPLYDATE"] . "</td><td>" . $row["ACCOUNT_ACC_NUM_SA"] . "</td></tr>";
            }
            echo "</table>";
        }

        function printApplicationCover($result) {
            echo "<br><b>Retrieved data from table coverTable:</b><br><br>";
            echo "<table>";
            echo "<tr><th>Application #</th><th>Intro</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
                echo $row["JOB_APP_NUM_CV"] . "</td><td>" . $row["INTRODUCTION"] . "</td></tr>";
            }
            echo "</table>";
        }


        function printApplicationResume($result) {
            echo "<br><b>Retrieved data from table resumeTable:</b><br><br>";
            echo "<table>";
            echo "<tr><th>Application #</th><th>Name</th><th>Experience</th><th>Education</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
                echo $row["JOB_NUM"] . "</td><td>" . $row["RESNAME"] . "</td><td>" . $row["EXPERIENCE"] . "</td><td>" . $row["EDUCATION"] . "</td></tr>";
            }
            echo "</table>";
        }

        function printAggregateGroup() {
            global $db_conn;
            $query = executePlainSQL("SELECT ShiftSchedule, AVG(Salary) FROM JR1_ScheduleSalary GROUP BY ShiftSchedule");
            echo "<b>Print Aggregate Group Query:</b><br><br>";
            while ($row = OCI_Fetch_Array($query, OCI_BOTH)) {
                echo $row['SHIFTSCHEDULE'] . ', ' . $row['AVG(SALARY)'] . '<br>';
            }
            echo "</table>";
        }

        function printNested() {
            global $db_conn;
            $query = executePlainSQL("SELECT PositionName, ShiftSchedule, aves
            FROM (
                SELECT p.PositionName, ss.ShiftSchedule, AVG(Salary) AS aves
                FROM JR1_ScheduleSalary ss
                JOIN JR10_ID_Shift s ON ss.ShiftSchedule = s.ShiftSchedule
                JOIN JR3_ID_SpotNum sn ON s.ReferenceID = sn.ReferenceID
                JOIN JR9_ID_Qualifications q ON sn.referenceID = q.ReferenceID
                JOIN JR7_DutyQualifications dq ON q.Qualifications = dq.Qualifications
                JOIN JR5_PositionDuties p ON dq.duties = p.Duties
                GROUP BY p.PositionName, ss.ShiftSchedule
            ) nested
            WHERE aves = (SELECT MAX(aves) FROM (
                SELECT p.PositionName, AVG(Salary) AS aves
                FROM JR1_ScheduleSalary ss
                JOIN JR10_ID_Shift s ON ss.ShiftSchedule = s.ShiftSchedule
                JOIN JR3_ID_SpotNum sn ON s.ReferenceID = sn.ReferenceID
                JOIN JR9_ID_Qualifications q ON sn.referenceID = q.ReferenceID
                JOIN JR7_DutyQualifications dq ON q.Qualifications = dq.Qualifications
                JOIN JR5_PositionDuties p ON dq.duties = p.Duties
                GROUP BY p.PositionName
            ))");
            echo "<b>Print Aggregate Nested Query:</b><br><br>";
            while ($row = OCI_Fetch_Array($query, OCI_BOTH)) {
                echo $row['POSITIONNAME'] . ', ' . $row['SHIFTSCHEDULE'] . ', ' . $row['AVES'] .'<br>';
            }
            echo "</table>";
        }

        function printAggregateHaving() {
            global $db_conn;
            $query = executePlainSQL("SELECT ss.ShiftSchedule, p.PositionName, AVG(Salary)
            FROM JR1_ScheduleSalary ss JOIN JR10_ID_Shift s ON ss.ShiftSchedule = s.ShiftSchedule
            JOIN JR3_ID_SpotNum sn ON s.ReferenceID = sn.ReferenceID JOIN JR9_ID_Qualifications q
            ON sn.referenceID = q.ReferenceID JOIN JR7_DutyQualifications dq ON q.Qualifications = dq.Qualifications
            JOIN JR5_PositionDuties p ON dq.duties = p.Duties
            GROUP BY ss.ShiftSchedule, p.PositionName
            HAVING AVG(Salary) > 50000");
            echo "<b>Print Aggregate Group Query:</b><br><br>";
            while ($row = OCI_Fetch_Array($query, OCI_BOTH)) {
                echo $row['SHIFTSCHEDULE'] . ', ' . $row['POSITIONNAME'] . ', ' . $row['AVG(SALARY)'] .'<br>';
            }
            echo "</table>";
        }

        function printDivision() {
            global $db_conn;
            $query = executePlainSQL("SELECT p.PositionName, sn.num_of_Spots, ss.Salary, ss.ShiftSchedule
            FROM JR1_ScheduleSalary ss JOIN JR10_ID_Shift s ON ss.ShiftSchedule = s.ShiftSchedule
            JOIN JR3_ID_SpotNum sn ON s.ReferenceID = sn.ReferenceID JOIN JR9_ID_Qualifications q
            ON sn.referenceID = q.ReferenceID JOIN JR7_DutyQualifications dq ON q.Qualifications = dq.Qualifications
            JOIN JR5_PositionDuties p ON dq.duties = p.Duties
            WHERE q.ReferenceID IN (
                (SELECT q.ReferenceID FROM JR9_ID_Qualifications
                 MINUS
                 SELECT sn.referenceID FROM JR3_ID_SpotNum
                 WHERE sn.num_of_Spots >= 20)
            )");
            while ($row = OCI_Fetch_Array($query, OCI_BOTH)) {
                echo $row['POSITIONNAME'] . ', ' . $row['NUM_OF_SPOTS'] . ', ' . $row['SALARY'] . ', ' . $row['SHIFTSCHEDULE'] . '<br>';
            }
            echo "</table>";
        }

        // END OF ALL PRINTING GET FUNCTIONS
        ?>
        <br>
        <!-- button group for managing account UNUSED -->
        <div id="accountOptions" style="display: none" class="none">
            <button onclick="createAcc()">Create an Account</button>
            <button onclick="updateAddy()">Update Address</button>
            <button onclick="updatePhone()">Update Phone Number</button>
        </div>

        <!-- javascript for managing account button group -->
        <script>
            show = false;

            function createAcc() {
                var accGroup = document.getElementById('accountGroup');
                var addyGroup = document.getElementById('addyGroup');
                var phoneGroup = document.getElementById('phoneGroup');
                if (accGroup.style.display === "none") {
                    phoneGroup.style.display = "none";
                    addyGroup.style.display = "none";
                    accGroup.style.display = "block";
                } else {
                    accGroup.style.display = "none";
                }
                show = true;
            }
            function updateAddy() {
                var addyGroup = document.getElementById('addyGroup');
                var phoneGroup = document.getElementById('phoneGroup');
                var accGroup = document.getElementById('accountGroup');
                if (addyGroup.style.display === "none") {
                    phoneGroup.style.display = "none";
                    accGroup.style.display = "none";
                    addyGroup.style.display = "block";
                } else {
                    addyGroup.style.display = "none";
                }
                show = true;
            }
            function updatePhone() {
                var phoneGroup = document.getElementById('phoneGroup');
                var addyGroup = document.getElementById('addyGroup');
                var accGroup = document.getElementById('accountGroup');
                if (phoneGroup.style.display === "none") {
                    addyGroup.style.display = "none";
                    accGroup.style.display = "none";
                    phoneGroup.style.display = "block";
                } else {
                    phoneGroup.style.display = "none";
                }
                show = true;
            }
        </script>

        
        <!-- button group of elements for creating account -->
        <div id ="accountGroup" style="display: none">
        <h2 id="accHead"> Create Account</h2>
        <form id="insertAccount"  method="POST" action="project.php"> 
            <input type="hidden" id="insertAccountQueryRequest" name="insertAccountQueryRequest">
            Name: <input type="text" name="insName"> <br /><br />
            Email: <input type="text" name="insEmail"> <br /><br />
            PhoneNumber: <input type="text" name="insPhone"> <br /><br />
            Address: <input type="text" name="insAddress"> <br /><br />
            <input type="submit" value="Create Account" name="insertSubmitAccount"></p>
        </form>
        <hr/>
        </div>
        <!-- button group of elements for editing address -->        
        <div id ="addyGroup" style="display: none">
        <h2 id="addyHead">Update Address</h2>
        <p id="addyBody">Input values are sensitive, please ensure address is spelled correctly.</p>
        <form id="addyForm" method="POST" action="project.php"> 
            <input type="hidden" id="updateAddyRequest" name="updateAddyRequest">
            Old Address: <input type="text" name="oldAddress"> <br /><br />
            New Address: <input type="text" name="newAddress"> <br /><br />
            <input type="submit" value="UpdateAccount" name="updateSubmitAddy"></p>
        </form>
        <hr/>
        </div>
        <!-- button group of elements for editing phone number -->
        <div id ="phoneGroup" style="display: none">
        <h2 id="phoneHead">Update Phone Number</h2>
        <p id="phoneBody">Input values are sensitive, please ensure phone number is correct and in the format xxx-xxx-xxxx.</p>
        <form id="phoneForm"method="POST" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updatePhoneQueryRequest" name="updatePhoneQueryRequest">
            Old Phone Number: <input type="text" name="oldPhone"> <br /><br />
            New Phone Number: <input type="text" name="newPhone"> <br /><br />
            <input type="submit" value="UpdatePhone" name="updateSubmitPhone"></p>
        </form>
        <hr/>
        </div>

        <!-- form for inserting interview items -->
        <form id="insertInterview" style="display: none" method="POST" action="project.php"> 
            <input type="hidden" id="insertInterviewQueryRequest" name="insertInterviewQueryRequest">
            Interviewer: <input type="text" name="insInt"> <br /><br />
            Interviewee: <input type="text" name="insIntee"> <br /><br />
            IntDate: <input type="text" name="insIntDate>"> <br /><br />
            <input type="submit" value="Insert" name="insertSubmitInterview"></p>
        </form>
        <!-- form for updating address -->
        <form id="updateAccount" style="display: none" method="POST" action="project.php"> 
            <input type="hidden" id="updateAddyRequest" name="updateAddyRequest">
            Old Address: <input type="text" name="oldAddress"> <br /><br />
            New Address: <input type="text" name="newAddress"> <br /><br />
            <input type="submit" value="UpdateAccount" name="updateSubmitAddy"></p>
        </form>
        <!-- for for updating phone number -->
        <form id="updatePhone" style="display: none" method="POST" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updatePhoneQueryRequest" name="updatePhoneQueryRequest">
            Old Phone Number: <input type="text" name="oldPhone"> <br /><br />
            New Phone Number: <input type="text" name="newPhone"> <br /><br />
            <input type="submit" value="UpdatePhone" name="updateSubmitAddy"></p>
        </form>

        <!-- All hidden button group using GET for printing  -->
        <!-- ----------------------------------------------------- -->
        <form id="manageAccForm" method="GET" action="project.php"> 
            <input type="hidden" id="manageRequest" name="manageRequest">
            <input type="hidden" name="manageAcc"></p>
        </form>

        <form id="printJobForm" method="GET" action="project.php"> 
            <input type="hidden" id="printRequest" name="printRequest">
            <input type="hidden" name="printJob"></p>
        </form>

        <form id="printAppForm" method="GET" action="project.php">
            <input type="hidden" id="printAppRequest" name="printAppRequest">
            <input type="hidden" name="printApp"></p>
        </form>

        <form id="printInterviewForm" method="GET" action="project.php"> 
            <input type="hidden" id="printRequestInterview" name="printRequestInterview">
            <input type="hidden" name="printInterview"></p>
        </form>

        <form id="printAccount" style="display: none" method="GET" action="project.php"> 
            <input type="hidden" id="printRequestAccount" name="printRequestAccount">
            <input type="submit" value="Print Account Tables"name="printAccount"></p>
        </form>

        <form id="printExInfo" style="display: none" method="GET" action="project.php"> 
            <input type="hidden" id="printExInfo" name="printExInfo">
            <input type="hidden" value="Print Extra Info"name="exInfo"></p>
        </form>

        <form id="printAggregateGroup" style="display: none" method="GET" action="project.php"> 
            <input type="hidden" id="aggregateGroup" name="aggregateGroup">
            <input type="hidden" value="Print Extra Info"name="ag"></p>
        </form>

        <form id="printAggregateHaving" style="display: none" method="GET" action="project.php"> 
            <input type="hidden" id="aggregateHaving" name="aggregateHaving">
            <input type="hidden" value="Print Extra Info"name="ah"></p>
        </form>

        <form id="printNested" style="display: none" method="GET" action="project.php"> 
            <input type="hidden" id="aggNested" name="nested">
            <input type="hidden" value="Print Extra Info"name="ns"></p>
        </form>

        <form id="printDivision" style="display: none" method="GET" action="project.php"> 
            <input type="hidden" id="division" name="division">
            <input type="hidden" value="Print Extra Info"name="divi"></p>
        </form>
        <!-- ----------------------------------------------------- -->

        <p><b> ALL PHP ECHOS: </b></p>

        <?php
        // ALL POST FUNCTIONS 
        function handleInsertInterviewRequest() {
            global $db_conn;
            $tuple = array (
                ":bind1" => $_POST['insInt'],
                ":bind2" => $_POST['insIntee'],
                ":bind3" => $_POST['insIntDate'],
            );
            $alltuples = array (
                $tuple
            );
            executeBoundSQL("insert into interviewTable values (:bind1, :bind2, :bind3)", $alltuples);
            OCICommit($db_conn);
        }

        function handleInsertAccountRequest() {
            global $db_conn;
            $tuple = array (
                ":bind1" => $_POST['insName'],
                ":bind2" => $_POST['insEmail'],
                ":bind3" => $_POST['insPhone'],
                ":bind4" => $_POST['insAddress'],
            );
            $alltuples = array (
                $tuple
            );
            executeBoundSQL("insert into accountTable values (:bind1, :bind2, :bind3, :bind4, '000000')", $alltuples);
            OCICommit($db_conn);
        }

        function handleAccountUpdateRequest() {
            global $db_conn;
            $old_address = $_POST['oldAddress'];
            $new_address = $_POST['newAddress'];
            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE accountTable SET address='" . $new_address . "' WHERE address='" . $old_address . "'");
            OCICommit($db_conn);
        }

        function handlePhoneUpdateRequest() {
            global $db_conn;
            $old_phone = $_POST['oldPhone'];
            $new_phone = $_POST['newPhone'];
            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE accountTable SET phone_number='" . $new_phone . "' WHERE phone_number='" . $old_phone . "'");
            OCICommit($db_conn);
        }
        
        // HANDLE ALL POST REQUESTS
        // This is where all post statements will print
        if (isset($_POST['resetAll']) || isset($_POST['insertSubmitInterview']) || isset($_POST['insertSubmitAccount']) || 
            isset($_POST['updateSubmitAddy']) || isset($_POST['updateSubmitPhone'])) {
            handlePOSTRequest();
        } 

        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetAllRequest', $_POST)) {
                    handleResetAllRequest();
                } else if (array_key_exists('updateAddyRequest', $_POST)) {
                    handleAccountUpdateRequest();
                } else if (array_key_exists('updatePhoneQueryRequest', $_POST)) {
                    handlePhoneUpdateRequest(); 
                } else if (array_key_exists('insertInterviewQueryRequest', $_POST)) {
                    handleInsertInterviewRequest();
                } else if (array_key_exists('insertAccountQueryRequest', $_POST)) {
                    handleInsertAccountRequest();
                } else if (array_key_exists('filterCatRequest', $_POST)) {
                    handleFilterRequest();
                } 

                disconnectFromDB();
            }
        }

        // HANDLE ALL GET ROUTES
        // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('printJob', $_GET)) {
                    handlePrintJobListing();
                } else if (array_key_exists('printInterview', $_GET)) {
                    handlePrintInterview();
                } else if (array_key_exists('printAccount', $_GET)) {
                    handlePrintAccount();
                } else if (array_key_exists('printApp', $_GET)) {
                    handlePrintPastApplication();
                } else if (array_key_exists('manageAcc', $_GET)) {
                    printManageButtons();
                } else if(array_key_exists('exInfo', $_GET)) {
                    printInfoButtons();
                } else if(array_key_exists('ag', $_GET)) {
                    printAggregateGroup();
                } else if(array_key_exists('ah', $_GET)) {
                    printAggregateHaving();
                } else if(array_key_exists('ns', $_GET)) {
                    printNested();
                } else if(array_key_exists('divi', $_GET)) {
                    printDivision();
                }
                disconnectFromDB();
            }
        }
        //print_r($_POST)
        ?>
    </body>
</html>