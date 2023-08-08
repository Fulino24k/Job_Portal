<html>
    <head>
        <title> CPSC 304 2023S T2 PHP/Oracle Project</title>
    </head>
    <style>
        <?php include 'project.css'; ?>
    </style>
    <body>
        <h1> Welcome to application portal for the BEST company! </h1>
        <p>If this is your first time running, please press "reset all tables" below!</p>

        <!-- button to reset and creat all tables for initialization -->
        <form id="reset" method="POST" action="project.php">
            <input type="hidden" id="resetAllRequest" name="resetAllRequest">
            <p><input type="submit" value="Reset All Tables" name="resetAll"></p>
        </form>

        <hr/>

        <p>Please click any button to begin with:</p>

        <div id="group" class="options-employee">
            <button onclick="browseJob()">Browse Job Listings</button>
            <button onclick="viewApp()">Past Applications</button>
            <button onclick="upcomingInterviews()">Upcoming Interviews</button>
            <button onclick="acceptDeny()">Accept/Deny Offer</button>
            <button onclick="manageAccount()">Manage Account</button>
        </div><br><br><br>

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
        </script>

        
        <?php
        include 'functions.php';

        // HANDLE ALL GET REQUESTS
        // this is the position where all requests are printed
        if (isset($_GET['printRequest']) || isset($_GET['manageRequest']) || isset($_GET['printRequestInterview']) 
            || isset($_GET['printRequestAccount'])|| isset($_GET['printAppRequest'])) {
            handleGETRequest();
        }

        // function to echo all the buttons to manage account
        function printManageButtons() {
            echo "Please choose an option from below: <br><br>";
            echo "<div><button onclick='createAcc()'>Create an Account</button><button onclick='updateAddy()'>Update Address</button><button onclick='updatePhone()'>Update Phone Number</button></div>";
        }

        function handlePrintJobListing() {
            global $db_conn;
            $result = executePlainSQL("SELECT p.PositionName, sn.referenceID, sn.num_of_Spots, ss.Salary, ss.ShiftSchedule FROM JR1_ScheduleSalary ss 
            JOIN JR10_ID_Shift s ON ss.ShiftSchedule = s.ShiftSchedule JOIN JR3_ID_SpotNum sn ON s.ReferenceID = sn.referenceID JOIN JR9_ID_Qualifications q ON sn.referenceID = q.ReferenceID
            JOIN JR7_DutyQualifications dq ON q.Qualifications = dq.Qualifications JOIN JR5_PositionDuties p ON dq.Duties = p.Duties");
            echo "<b>All Available Job Listings:</b><br><br>";
            echo "<table>";
            echo "<tr><th>Position</th><th>ReferenceID</th><th>Spots Left</th><th>Annual Salary</th><th>Work Type</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0]. "</td><td>" . $row[1]. "</td><td>" .$row[2]. "</td><td>" . $row[3]. "</td><td>" .$row[4]. "</td><tr>" ;
            }
            // while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            //     echo "<tr><td>" . '<a target = "_blank" 
            //         href="https://www.students.cs.ubc.ca/~aarwo74/jobListing.php?posID='. $row['REFERENCEID'].' ">' . 
            //         $row['POSITION'] . "</a>" . "</td><td>" . $row["REFERENCEID"] . "</td><td>" . $row["SPOTS_LEFT"] . 
            //         "</td><td>" . $row["ANNUAL_SALARY"] . "</td><td>" . $row["WORK_TYPE"] . "</td></tr>";
            // }
            echo "</table>";
        }

        function handlePrintInterview() {
            global $db_conn;
            $result = executePlainSQL("SELECT * FROM interviewTable");
            echo "<b>All Upcoming Scheduled Interviews:</b><br><br>";
            echo "<table>";
            echo "<tr><th>Interviewer</th><th>Interviewee</th><th>IntDate</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
                echo $row["INTERVIEWER"] . "</td><td>" . $row["INTERVIEWEE"] . "</td><td>" . $row["INTDATE"] . "</td></tr>";
            }
            echo "</table>";
        }

        function handlePrintAccount() {
            global $db_conn;
            $result = executePlainSQL("SELECT * FROM accountTable");
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
            $result = executePlainSQL("SELECT * FROM storeAppTable");
            printResultApplication($result);
            $result = executePlainSQL("SELECT * FROM coverTable");
            printApplicationCover($result);
            $result = executePlainSQL("SELECT * FROM resumeTable");
            printApplicationResume($result);
        }
        
        function printResultApplication($result) {
            echo "<b>All Past Job Applications:</b><br><br>";
            echo "<table>";
            echo "<tr><th>App Num #</th><th>Apply Date</th><th>Account Number</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
            //     echo $row["APP_NUM"] . "</td><td>" . $row["APPLY_DATE"] . "</td><td>" . $row["ACCOUNT_NUMBER"] . "</td></tr>";
            echo "<tr><td>" . '<a target = "_blank" href="https://www.students.cs.ubc.ca/~daniren/applications.php?appID='.$row['APP_NUM'].' ">' . $row['APP_NUM'] . "</a>" . "</td><td>" . $row["APPLY_DATE"] . "</td><td>" . $row["ACCOUNT_NUMBER"] . "</td></tr>"; //or just use "echo $row[0]"
            }
            echo "</table>";
        }

        function printApplicationCover($result) {
            echo "<br><b>Retrieved data from table coverTable:</b><br><br>";
            echo "<table>";
            echo "<tr><th>Application #</th><th>Intro</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
                echo $row["APP_NUM"] . "</td><td>" . $row["INTRODUCTION"] . "</td></tr>";
            }
            echo "</table>";
        }


        function printApplicationResume($result) {
            echo "<br><b>Retrieved data from table resumeTable:</b><br><br>";
            echo "<table>";
            echo "<tr><th>Application #</th><th>Name</th><th>Experience</th><th>Education</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
                echo $row["APP_NUM"] . "</td><td>" . $row["NAME"] . "</td><td>" . $row["EXPERIENCE"] . "</td><td>" . $row["EDUCATION"] . "</td></tr>";
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

        <form id="printAccount" method="GET" action="project.php"> 
            <input type="hidden" id="printRequestAccount" name="printRequestAccount">
            <input type="hidden" name="printAccount"></p>
        </form>
        <!-- ----------------------------------------------------- -->

        <p><b> ALL PHP ECHOS: </b></p>

        <?php
        // ALL POST FUNCTIONS 
        function handleResetAllRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE jobTable");
            executePlainSQL("DROP TABLE coverTable");
            executePlainSQL("DROP TABLE resumeTable");
            executePlainSQL("DROP TABLE storeAppTable");
            executePlainSQL("DROP TABLE interviewTable");
            executePlainSQL("DROP TABLE accountTable");

            echo "<br> SUCCESS: all old tables dropped <br>";

            executePlainSQL("CREATE TABLE accountTable (
                name char(30), 
                email char(30), 
                phone_number char(30), 
                address char(100), 
                account_number int PRIMARY KEY)");
            executePlainSQL("CREATE TABLE jobTable (
                position char(30), 
                referenceID char(30) PRIMARY KEY, 
                spots_left int, 
                annual_salary int, 
                work_type char(30), 
                qualification char(100), 
                duty char(100))");
            executePlainSQL("CREATE TABLE storeAppTable (
                app_num int PRIMARY KEY, 
                apply_date int,
                account_number int,
                FOREIGN KEY(account_number) REFERENCES accountTable(account_number))");
            executePlainSQL("CREATE TABLE coverTable (
                app_num int PRIMARY KEY, 
                introduction char(300),
                FOREIGN KEY(app_num) REFERENCES storeAppTable(app_num))");
            executePlainSQL("CREATE TABLE resumeTable (
                app_num int PRIMARY KEY, 
                name char(30), 
                experience char(300), 
                education char(300),
                FOREIGN KEY(app_num) REFERENCES storeAppTable(app_num))");
            executePlainSQL("CREATE TABLE interviewTable (
                interviewer char(30), 
                interviewee char(30), 
                intDate int, 
                PRIMARY KEY (interviewer, interviewee, intDate))");
            

            executeBoundSQL("insert into jobTable values (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6, :bind7)", getDefaultJobTuples());
            executeBoundSQL("insert into interviewTable values (:bind1, :bind2, :bind3)", getDefaultInterviewTuples());
            executeBoundSQL("insert into accountTable values (:bind1, :bind2, :bind3, :bind4, :bind5)", getDefaultAccountTuples());
            executeBoundSQL("insert into storeAppTable values (:bind1, :bind2, :bind3)", getDefaultAppTuples());
            executeBoundSQL("insert into resumeTable values (:bind1, :bind2, :bind3, :bind4)", getDefaultResumeTuples());
            executeBoundSQL("insert into coverTable values (:bind1, :bind2)", getDefaultCoverTuples());

            echo "<br> SUCCESS: default tuples inserted for all tuples<br>";
            OCICommit($db_conn);
        }

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
        if (isset($_POST['resetAll']) || isset($_POST['insertSubmitInterview']) 
            || isset($_POST['insertSubmitAccount']) || isset($_POST['updateSubmitAddy']) || isset($_POST['updateSubmitPhone']) ) {
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
                }
                disconnectFromDB();
            }
        }

        

        ?>
    </body>
</html>