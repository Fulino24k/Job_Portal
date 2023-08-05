<html>
    <head>
        <title> CPSC 304 2023S T2 PHP/Oracle Project</title>
    </head>
    <style>
        <?php include 'project.css'; ?>
    </style>
    <body>
        <h1> Welcome to application portal for the BEST company! </h1>
        <p>Pick an option below to get started with</p><hr />

        <div id="group" class="options-employee">
            <button onclick="appliesFor()">Browse Job Listings</button>
            <button>Past Applications</button>
            <button onclick="upcomingInterviews()">Upcoming Interviews</button>
            <button onclick="acceptDeny()">Accept/Deny Offer</button>
            <button onclick="manageAccount()">Manage Account</button>
        </div><br><br><br>
        <p id="demo"></p>
        <script>
            var show = false;
            function appliesFor() {
                var r = document.getElementById("reset");
                var a = document.getElementById("insertAccount");
                var h = document.getElementById("accHead");
                if (r.style.display === "none") {
                    if (show) {
                        a.style.display = "none";
                        h.style.display = "none";
                    }
                    r.style.display = "block";
                } else {
                    r.style.display = "none";
                }
                show = true;
            }

            function upcomingInterviews() {
                // TODO
            }


            function acceptDeny() {
                // TODO
            }

            function manageAccount() {
                var a = document.getElementById("insertAccount");
                var r = document.getElementById("reset");
                var h = document.getElementById("accHead");
                if (a.style.display === "none") {
                    if (show) {
                        r.style.display = "none";
                    }
                    // x.style.display = "block";
                    a.style.display = "block";
                    h.style.display = "block";
                } else {
                    a.style.display = "none";
                    h.style.display = "none";
                }
                show = true;
            }


        </script>

        <form id="reset" style="display: none" method="POST" action="project.php">
            <input type="hidden" id="resetAllRequest" name="resetAllRequest">
            <p><input type="submit" value="Reset All Tables" name="resetAll"></p>
        </form>

        <form id="insertInterview" style="display: none" method="POST" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertInterviewQueryRequest" name="insertInterviewQueryRequest">
            Interviewer: <input type="text" name="insInt"> <br /><br />
            Interviewee: <input type="text" name="insIntee"> <br /><br />
            IntDate: <input type="text" name="insIntDate>"> <br /><br />
            <input type="submit" value="Insert" name="insertSubmitInterview"></p>
        </form>

        <h2 id="accHead" style="display: none"> Add Account Information</h2>
        <form id="insertAccount" style="display: none" method="POST" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertAccountQueryRequest" name="insertAccountQueryRequest">
            Name: <input type="text" name="insName"> <br /><br />
            Email: <input type="text" name="insEmail"> <br /><br />
            PhoneNumber: <input type="text" name="insPhone"> <br /><br />
            Address: <input type="text" name="insAddress"> <br /><br />
            AccountNumber: <input type="text" name="insNum>"> <br /><br />
            <input type="submit" value="Insert" name="insertSubmitAccount"></p>
        </form>

        <form id="updateAccount" style="display: none" method="POST" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateAccountQueryRequest" name="updateAccountQueryRequest">
            Old Name: <input type="text" name="oldName"> <br /><br />
            New Name: <input type="text" name="newName"> <br /><br />

            <input type="submit" value="UpdateAccount" name="updateSubmitAccount"></p>
        </form>

        <hr />

        <h2>Print Tuples from jobTable</h2>
        <form id="printJob" method="GET" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="printRequest" name="printRequest">
            <input type="submit" name="printJob"></p>
        </form>

        <hr />
        <!-- NEW -->
        <h2>Print Tuples from interviewTable</h2>
        <form id="printInterview" method="GET" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="printRequestInterview" name="printRequestInterview">
            <input type="submit" name="printInterview"></p>
        </form>
        <hr />

        <h2>Print Tuples from accountTable</h2>
        <form id="printAccount" method="GET" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="printRequestAccount" name="printRequestAccount">
            <input type="submit" name="printAccount"></p>
        </form>

        <hr />

        <h2>Update Name in DemoTable</h2>
        <p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

        <form method="POST" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateAccountQueryRequest" name="updateAccountQueryRequest">
            Old Name: <input type="text" name="oldName"> <br /><br />
            New Name: <input type="text" name="newName"> <br /><br />

            <input type="submit" value="UpdateAccount" name="updateSubmitAccount"></p>
        </form>


        <?php
        include 'functions.php';

        function printResultJob($result) {
            echo "<br>Retrieved data from table jobTable:<br>";
            echo "<table>";
            echo "<tr><th>Position</th><th>ReferenceID</th><th>Spots Left</th><th>Annual Salary</th><th>Full/Part</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . '<a target = "_blank" href="https://www.students.cs.ubc.ca/~fulino/jobListing.php?posID='.$row['REFERENCEID'].' ">' . $row['POSITION'] . "</a>" . "</td><td>" . $row["REFERENCEID"] . "</td><td>" . $row["SPOTS_LEFT"] . "</td><td>" . $row["ANNUAL_SALARY"] . "</td><td>" . $row["WORK_TYPE"] . "</td></tr>"; //or just use "echo $row[0]"
            }
            //echo "<br>Retrieved data from table demoTable:<br>";
            echo "</table>";
        }

        function printResultInterview($result) {
            echo "<br>Retrieved data from table interviewTable:<br>";
            echo "<table>";
            echo "<tr><th>Interviewer</th><th>Interviewee</th><th>IntDate</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
                // WILL need to change the hyperlink
                // echo "<tr><td>" . '<a target = "_blank" href="https://www.students.cs.ubc.ca/~fulino/jobListing.php?posID='.$row['REFERENCEID'].' ">' . $row['POSITION'] . "</a>" . "</td><td>" . $row["REFERENCEID"] . "</td><td>" . $row["SPOTS_LEFT"] . "</td><td>" . $row["ANNUAL_SALARY"] . "</td><td>" . $row["WORK_TYPE"] . "</td></tr>"; //or just use "echo $row[0]"
                echo $row["INTERVIEWER"] . "</td><td>" . $row["INTERVIEWEE"] . "</td><td>" . $row["INTDATE"] . "</td></tr>";
            }
            //echo "<br>Retrieved data from table demoTable:<br>";
            echo "</table>";
        }

        function printResultAccount($result) {
            echo "<br>Retrieved data from table accountTable:<br>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Phone Number</th><th>Address</th><th>Account Number</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
                // WILL need to change the hyperlink
                // echo "<tr><td>" . '<a target = "_blank" href="https://www.students.cs.ubc.ca/~fulino/jobListing.php?posID='.$row['REFERENCEID'].' ">' . $row['POSITION'] . "</a>" . "</td><td>" . $row["REFERENCEID"] . "</td><td>" . $row["SPOTS_LEFT"] . "</td><td>" . $row["ANNUAL_SALARY"] . "</td><td>" . $row["WORK_TYPE"] . "</td></tr>"; //or just use "echo $row[0]"
                echo $row["NAME"] . "</td><td>" . $row["EMAIL"] . "</td><td>" . $row["PHONE_NUMBER"] . "</td><td>" . $row["ADDRESS"] . "</td><td>" . $row["ACCOUNT_NUMBER"] . "</td></tr>";
            }
            //echo "<br>Retrieved data from table demoTable:<br>";
            echo "</table>";
        }

        function handleResetAllRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE jobTable");
            executePlainSQL("DROP TABLE storeTable");
            executePlainSQL("DROP TABLE coverTable");
            executePlainSQL("DROP TABLE resumeTable");
            executePlainSQL("DROP TABLE interviewTable");
            executePlainSQL("DROP TABLE accountTable");

            echo "<br> SUCCESS: all old tables dropped <br>";

            executePlainSQL("CREATE TABLE jobTable (
                position       char(30), 
                referenceID    char(30) PRIMARY KEY, 
                spots_left     int, 
                annual_salary  int, 
                work_type      char(30), 
                qualification  char(100), 
                duty           char(100))");
            executePlainSQL("CREATE TABLE storeTable (
                app_num        int PRIMARY KEY, 
                apply_date     int)");
            executePlainSQL("CREATE TABLE coverTable (
                app_num        int PRIMARY KEY, 
                introduction  char(300))");
            executePlainSQL("CREATE TABLE resumeTable (
                app_num        int PRIMARY KEY, 
                name           char(30), 
                experience     char(300), 
                education      char(300))");
            executePlainSQL("CREATE TABLE interviewTable (
                interviewer    char(30), 
                interviewee    char(30), 
                intDate        int, 
                PRIMARY KEY (interviewer, interviewee, intDate))");
            executePlainSQL("CREATE TABLE accountTable (
                name           char(30), 
                email          char(30), 
                phone_number   char(30), 
                address        char(100), 
                account_number int PRIMARY KEY)");

            executeBoundSQL("insert into jobTable values (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6, :bind7)", getDefaultJobTuples());
            executeBoundSQL("insert into interviewTable values (:bind1, :bind2, :bind3)", getDefaultInterviewTuples());
            executeBoundSQL("insert into accountTable values (:bind1, :bind2, :bind3, :bind4, :bind5)", getDefaultAccountTuples());

            echo "<br> SUCCESS: default tuples inserted for all tuples<br>";
            OCICommit($db_conn);
        }

        function handleInsertRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insNo'],
                ":bind2" => $_POST['insName']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into demoTable values (:bind1, :bind2)", $alltuples);
            OCICommit($db_conn);
        }

        function handleInsertInterviewRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
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

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insName'],
                ":bind2" => $_POST['insEmail'],
                ":bind3" => $_POST['insPhone'],
                ":bind4" => $_POST['insAddress'],
                // ":bind5" => $_POST['insNum']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into accountTable values (:bind1, :bind2, :bind3, :bind4, '000000')", $alltuples);
            OCICommit($db_conn);
        }

        function handleAccountUpdateRequest() {
            //ob_end_clean();
            global $db_conn;

            $old_name = $_POST['oldName'];
            $new_name = $_POST['newName'];

            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE accountTable SET name='" . $new_name . "' WHERE name='" . $old_name . "'");
            OCICommit($db_conn);
        }
        function handleCountJobRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM jobTable");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in jobTable: " . $row[0] . "<br>";
            }
            $result = executePlainSQL("SELECT * FROM jobTable");
            printResultJob($result);
        }

        // NEW:
        function handleCountInterviewRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM interviewTable");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in interviewTable: " . $row[0] . "<br>";
            }
            $result = executePlainSQL("SELECT * FROM interviewTable");
            printResultInterview($result);
        }

        // NEW:
        function handleCountAccountRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM accountTable");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in accountTable: " . $row[0] . "<br>";
            }
            $result = executePlainSQL("SELECT * FROM accountTable");
            printResultAccount($result);
        }


        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetAllRequest', $_POST)) {
                    handleResetAllRequest();
                } else if (array_key_exists('updateAccountQueryRequest', $_POST)) {
                    handleAccountUpdateRequest();
                } else if (array_key_exists('insertInterviewQueryRequest', $_POST)) {
                    handleInsertInterviewRequest();
                } else if (array_key_exists('insertAccountQueryRequest', $_POST)) {
                    handleInsertAccountRequest();
                } 
                disconnectFromDB();
            }
        }
        // test commit
        // HANDLE ALL GET ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('printJob', $_GET)) {
                    handleCountJobRequest();
                } else if (array_key_exists('printInterview', $_GET)) {
                    handleCountInterviewRequest();
                } else if (array_key_exists('printAccount', $_GET)) {
                    handleCountAccountRequest();
                }

                disconnectFromDB();
            }
        }

        if (isset($_POST['resetAll']) || isset($_POST['insertSubmitInterview']) || isset($_POST['insertSubmitAccount']) || isset($_POST['updateSubmitAccount']) ) {
            handlePOSTRequest();
        } else if (isset($_GET['printRequest']) || isset($_GET['printRequestInterview']) || isset($_GET['printRequestAccount'])) {
            handleGETRequest();
        }
        ?>
    </body>
</html>