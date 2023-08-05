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
                var x = document.getElementById("reset");
                var y = document.getElementById("resetJob");
                var a = document.getElementById("insert");
                var b = document.getElementById("insertJob");
                var m = document.getElementById("insertAccount");
                var r = document.getElementById("resetAccount");



                var printJob = document.getElementById("printJob");
                // printJob.submit();
                if (x.style.display === "none") {
                    if (show) {
                        // a.style.display = "none";
                        b.style.display = "none";
                        a.style.display = "none";
                        x.style.display = "none";
                        m.style.display = "none";
                        r.style.display = "none";
                    }
                    // x.style.display = "block";
                    y.style.display = "block";
                } else {
                    x.style.display = "none";
                }
                show = true;
            }

            function upcomingInterviews() {
                var x = document.getElementById("reset");
                var y = document.getElementById("resetJob");
                var a = document.getElementById("insert");
                var b = document.getElementById("insertJob");

                var s = document.getElementById("resetInterview");
                var printJob = document.getElementById("printJob");
                // printJob.submit();
                if (x.style.display === "none") {
                    if (show) {
                        a.style.display = "none";
                        b.style.display = "none";
                        x.style.display = "none";
                        y.style.display = "none";
                    }

                    s.style.display = "block";
                    // t.style.display = "block";
                } else {
                    x.style.display = "none";
                }
                show = true;
                        }


            function acceptDeny() {
                var x = document.getElementById("insert");
                var y = document.getElementById("insertJob");
                var a = document.getElementById("reset");
                var b = document.getElementById("resetJob");
                if (x.style.display === "none") {
                    if (show) {
                        a.style.display = "none";
                        b.style.display = "none";
                    }
                    x.style.display = "block";
                    y.style.display = "block";
                } else {
                    x.style.display = "none";
                    y.style.display = "none";
                }
                show = true;
            }

            function manageAccount() {
                var x = document.getElementById("reset");
                var y = document.getElementById("resetJob");
                var a = document.getElementById("insert");
                var b = document.getElementById("insertJob");
                var m = document.getElementById("insertAccount");
                var r = document.getElementById("resetAccount");

                var printAccount = document.getElementById("printAccount");
                // printJob.submit();
                if (x.style.display === "none") {
                    if (show) {
                        a.style.display = "none";
                        b.style.display = "none";
                        x.style.display = "none";
                        y.style.display = "none";
                    }
                    // x.style.display = "block";
                    m.style.display = "block";
                    r.style.display = "block";
                } else {
                    x.style.display = "none";
                }
                show = true;
            }


        </script>

        <form id="reset" style="display: none" method="POST" action="project.php">
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
            <p><input type="submit" value="Reset Demo" name="reset"></p>
        </form>

        <form id="resetJob" style="display: none" method="POST" action="project.php">
            <input type="hidden" id="resetJobTablesRequest" name="resetJobTablesRequest">
            <p><input type="submit" value="Reset Job" name="resetJob"></p>
        </form>

        <!-- NEW: -->
        <form id="resetInterview" style="display: none" method="POST" action="project.php">
            <input type="hidden" id="resetInterviewTablesRequest" name="resetInterviewTablesRequest">
            <p><input type="submit" value="Reset Interview" name="resetInterview"></p>
        </form>

        <form id="resetAccount" style="display: none" method="POST" action="project.php">
            <input type="hidden" id="resetAccountTablesRequest" name="resetAccountTablesRequest">
            <p><input type="submit" value="Reset Account" name="resetAccount"></p>
        </form>

        <form id="insert" style="display: none" method="POST" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            Number: <input type="text" name="insNo"> <br /><br />
            Name: <input type="text" name="insName"> <br /><br />

            <input type="submit" value="Insert" name="insertSubmit"></p>
        </form>

        <form id="insertJob" style="display: none" method="POST" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertJobQueryRequest" name="insertJobQueryRequest">
            Position: <input type="text" name="insPo"> <br /><br />
            ReferenceID: <input type="text" name="insRef"> <br /><br />
            Spots Left: <input type="text" name="insSpot"> <br /><br />
            Annual Salary: <input type="text" name="insSal"> <br /><br />
            Work Type: <input type="text" name="insType"> <br /><br />

            <input type="submit" value="Insert" name="insertSubmitJob"></p>
        </form>

        <!-- NEW -->
        <form id="insertInterview" style="display: none" method="POST" action="project.php"> <!--refresh page when submitted-->
                <input type="hidden" id="insertInterviewQueryRequest" name="insertInterviewQueryRequest">
                Interviewer: <input type="text" name="insInt"> <br /><br />
                Interviewee: <input type="text" name="insIntee"> <br /><br />
                IntDate: <input type="text" name="insIntDate>"> <br /><br />

                <input type="submit" value="Insert" name="insertSubmitInterview"></p>
            </form>

            <hr />

            <h2> Add Account Information</h2>
            <form id="insertAccount" style="display: none" method="POST" action="project.php"> <!--refresh page when submitted-->
                <input type="hidden" id="insertAccountQueryRequest" name="insertAccountQueryRequest">
                Name: <input type="text" name="insName"> <br /><br />
                Email: <input type="text" name="insEmail"> <br /><br />
                PhoneNumber: <input type="text" name="insPhone"> <br /><br />
                Address: <input type="text" name="insAddress"> <br /><br />
                AccountNumber: <input type="text" name="insNum>"> <br /><br />

                <input type="submit" value="Insert" name="insertSubmitAccount"></p>
            </form>

            <hr />

        <form id="update" style="display: none" method="POST" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            Old Name: <input type="text" name="oldName"> <br /><br />
            New Name: <input type="text" name="newName"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
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

        function printResult($result) {
            echo "<br>Retrieved data from table demoTable:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th></tr>";

            // style='border:1px solid black;border-collapse:collapse'
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>";
                echo $row["ID"] . "</td><td>" . $row["NAME"] . "</td></tr>"; //or just use "echo $row[0]"
            }
            echo "</table>";
        }
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

        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE demoTable");
            echo "<br> old table dropped <br>";
            // Create new table
            echo "<br> creating new table <br>";
            executePlainSQL("CREATE TABLE demoTable (id int PRIMARY KEY, name char(30))");
            OCICommit($db_conn);
        }


        function handleResetJobRequest() {
            $jobTuple1 = array (":bind1" => "Assistant Chef", ":bind2" => "00001", ":bind3" => "5",b":bind4" => "40534", ":bind5" => "Part",
                ":bind6" => "<ul> <li>Food Safe Level 3</li> <li> 2 years of kitchen prep </li></ul>",
                ":bind7" => "<ul> <li>Kitchen food prep</li> <li> assist in creation of new menu </li></ul>" );
            $jobTuple2 = array (":bind1" => "Head Janitor", ":bind2" => "00002", ":bind3" => "2",b":bind4" => "49998", ":bind5" => "Full",
                ":bind6" => "<ul><li> 2 years of janitoring </li></ul>",
                ":bind7" => "<ul><li> cleaning of the entire 30 floor office tower </li></ul>" );
            $jobTuple3 = array (":bind1" => "Software Enginner", ":bind2" => "00003", ":bind3" => "20",b":bind4" => "90615", ":bind5" => "Full",
                ":bind6" => "<ul><li> 100 years of related experience </li></ul>",
                ":bind7" => "<ul><li> make whatever that makes big money </li></ul>" );
            $jobTuple4 = array (":bind1" => "Customer Service Rep", ":bind2" => "00004", ":bind3" => "20",b":bind4" => "62983", ":bind5" => "Full",
                ":bind6" => "<ul><li> 2 years of related experience</li></ul>",
                ":bind7" => "duti<ul><li> be nice to customers </li></ul>es" );
            $jobTuple5 = array (":bind1" => "Database Intern", ":bind2" => "00005", ":bind3" => "30",b":bind4" => "0", ":bind5" => "Part",
                ":bind6" => "<ul><li> none required </li></ul>",
                ":bind7" => "<ul><li> learn and not get paid unlucky </li></ul>" );
            $jobTuple6 = array (":bind1" => "Marketing Analyst", ":bind2" => "00006", ":bind3" => "10",b":bind4" => "76526", ":bind5" => "Part",
                ":bind6" => "<ul><li> 2 years of related experience </li></ul>",
                ":bind7" => "<ul><li> analyze the market </li></ul>" );
            $jobTuple7 = array (":bind1" => "Sales Assistant", ":bind2" => "00007", ":bind3" => "15",b":bind4" => "54219", ":bind5" => "Part",
                ":bind6" => "<ul><li> 2 years of related experience </li></ul>",
                ":bind7" => "duti<ul><li> assist in sales? </li></ul>es" );
            $allJobtuples = array ($jobTuple1, $jobTuple2, $jobTuple3, $jobTuple4, $jobTuple5, $jobTuple6, $jobTuple7);
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE jobTable");
            executePlainSQL("DROP TABLE storeTable");
            executePlainSQL("DROP TABLE coverTable");
            executePlainSQL("DROP TABLE resumeTable");
            echo "<br> all old tables dropped <br>";
            // Create new table
            echo "<br> creating new tables <br>";
            executePlainSQL("CREATE TABLE jobTable (position char(30), referenceID char(30) PRIMARY KEY, spots_left int, annual_salary int, work_type char(30), qualification char(100), duty char(100))");
            executeBoundSQL("insert into jobTable values (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6, :bind7)", $allJobtuples);
            echo "<br> default tuples inserted <br>";
            executePlainSQL("CREATE TABLE storeTable (app_num int PRIMARY KEY, apply_date int)");
            executePlainSQL("CREATE TABLE coverTable (app_num int PRIMARY KEY, introduction char(300))");
            executePlainSQL("CREATE TABLE resumeTable (app_num int PRIMARY KEY, name char(30), experience char(300), education char(300))");
            echo "<br> tables created for store, cover, resume created <br>";
            OCICommit($db_conn);
        }

        function handleResetInterviewRequest() {
            $interviewTuple1 = array (":bind1" => "Elon Musk", ":bind2" => "Yan", b":bind3" => "120923");
            $interviewTuple2 = array (":bind1" => "Steve Jobs", ":bind2" => "Yan", b":bind3" => "121023");
            $interviewTuple3 = array (":bind1" => "Bill Gates", ":bind2" => "Yan", b":bind3" => "120923");
            $interviewTuple4 = array (":bind1" => "Elon Musk", ":bind2" => "Yan", b":bind3" => "122323");
            $interviewTuple5 = array (":bind1" => "Mark Zuckerberg", ":bind2" => "Yan", b":bind3" => "122323");
            $allInterviewtuples = array ($interviewTuple1, $interviewTuple2, $interviewTuple3, $interviewTuple4, $interviewTuple5);
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE interviewTable");
            echo "<br> old interview table dropped <br>";
            // Create new table
            echo "<br> creating new table <br>";
            executePlainSQL("CREATE TABLE interviewTable (interviewer char(30), interviewee char(30), intDate int, PRIMARY KEY (interviewer, interviewee, intDate))");
            echo "<br> new table created <br>";
            executeBoundSQL("insert into interviewTable values (:bind1, :bind2, :bind3)", $allInterviewtuples);
            echo "<br> default tuples inserted <br>";
            OCICommit($db_conn);
            }

            function handleResetAccountRequest() {
                $accountTuple = array (":bind1" => "Yan", ":bind2" => "yan@gmail.com", ":bind3" => "778-866-9999", ":bind4" => "123 TA Street", b":bind5" => "123456");
                $allAccounttuples = array ($accountTuple);
                global $db_conn;
                // Drop old table
                executePlainSQL("DROP TABLE accountTable");
                echo "<br> old account table dropped <br>";
                // Create new table
                echo "<br> creating new table <br>";
                executePlainSQL("CREATE TABLE accountTable (name char(30), email char(30), phone_number char(30), address char(100), account_number int PRIMARY KEY)");
                echo "<br> new table created <br>";
                executeBoundSQL("insert into accountTable values (:bind1, :bind2, :bind3, :bind4, :bind5)", $allAccounttuples);
                echo "<br> default tuples inserted <br>";
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


        function handleInsertJobRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insPo'],
                ":bind2" => $_POST['insRef'],
                ":bind3" => $_POST['insSpot'],
                ":bind4" => $_POST['insSal'],
                ":bind5" => $_POST['insType']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into jobTable values (:bind1, :bind2, :bind3, :bind4, :bind5)", $alltuples);
            OCICommit($db_conn);
        }

        // NEW:
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



        function handleUpdateRequest() {
            //ob_end_clean();
            global $db_conn;

            $old_name = $_POST['oldName'];
            $new_name = $_POST['newName'];

            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE demoTable SET name='" . $new_name . "' WHERE name='" . $old_name . "'");
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


        function handleCountRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM demoTable");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in demoTable: " . $row[0] . "<br>";
            }
            $result = executePlainSQL("SELECT * FROM demoTable");
            printResult($result);
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
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('resetJobTablesRequest', $_POST)) {
                    handleResetJobRequest();
                } else if (array_key_exists('updateAccountQueryRequest', $_POST)) {
                    handleAccountUpdateRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                } else if (array_key_exists('insertJobQueryRequest', $_POST)) {
                    handleInsertJobRequest();
                } // NEW:
                else if (array_key_exists('resetInterviewTablesRequest', $_POST)) {
                    handleResetInterviewRequest();
                } else if (array_key_exists('insertInterviewQueryRequest', $_POST)) {
                    handleInsertInterviewRequest();
                } // NEW:
                else if (array_key_exists('resetAccountTablesRequest', $_POST)) {
                    handleResetAccountRequest();
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
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                } else if (array_key_exists('printJob', $_GET)) {
                    handleCountJobRequest();
                } // NEW
                else if (array_key_exists('printInterview', $_GET)) {
                    handleCountInterviewRequest();
                } // NEW
                else if (array_key_exists('printAccount', $_GET)) {
                    handleCountAccountRequest();
                }

                disconnectFromDB();
            }
        }

        if (isset($_POST['resetJob']) || isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['insertSubmitJob']) || isset($_POST['resetInterview']) || isset($_POST['insertSubmitInterview']) || isset($_POST['resetAccount']) || isset($_POST['insertSubmitAccount']) || isset($_POST['updateSubmitAccount']) ) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest']) || isset($_GET['printRequest']) || isset($_GET['printRequestInterview']) || isset($_GET['printRequestAccount'])) {
            handleGETRequest();
        }
        ?>
    </body>
</html>