<html>
    <head>
        <title> CPSC 304 2023S T2 PHP/Oracle Project</title>
    </head>
    <style>
        .options-employee button {
        background-color: #04AA6D; /* Green background */
        border: 1px solid green; /* Green border */
        color: white; /* White text */
        padding: 10px 24px; /* Some padding */
        cursor: pointer; /* Pointer/hand icon */
        float: left; /* Float the buttons side by side */
        }

        /* Clear floats (clearfix hack) */
        .options-employee:after {
        content: "";
        clear: both;
        display: table;
        }

        .options-employee button:not(:last-child) {
        border-right: none; /* Prevent double borders */
        }

        /* Add a background color on hover */
        .options-employee button:hover {
        background-color: #3e8e41;
        }
        table, td, th {
            border: 1px solid;
        }
        table {
            border-collapse: collapse;
        }
    </style>
    <body>
        <h1> Welcome to application portal for the BEST company! </h1>
        <p>Pick an option below to get started with</p><hr />

        <div id="group" class="options-employee">
            <button onclick="appliesFor()">Browse Job Listings</button>
            <button>Past Applications</button>
            <button onclick="upcomingInterviews()">Upcoming Interviews</button>
            <button onclick="acceptDeny()">Accept/Deny Offer</button>
        </div>
        <p id="demo"></p>
        <script>
            var show = false;
            function appliesFor() {
                var x = document.getElementById("reset");
                var y = document.getElementById("resetJob");
                var a = document.getElementById("insert");
                var b = document.getElementById("insertJob");


                var printJob = document.getElementById("printJob");
                // printJob.submit();
                if (x.style.display === "none") {
                    if (show) {
                        // a.style.display = "none";
                        b.style.display = "none";
                    }
                    // x.style.display = "block";
                    y.style.display = "block";
                } else {
                    x.style.display = "none";
                }
                show = true;
            }

            function upcomingInterviews() {
                // var x = document.getElementById("reset");
                // var y = document.getElementById("resetInterview");
                // var a = document.getElementById("insert");
                // var b = document.getElementById("insertInterview");
                // var printInterview = document.getElementByID("printInterview");
                // if (x.style.display === "none") {
                //                 if (show) {
                //                     a.style.display = "none";
                //                     b.style.display = "none";
                //                 }
                //                 x.style.display = "block";
                //                 y.style.display = "block";
                //             } else {
                //                 x.style.display = "none";
                //             }
                //             show = true;

                var x = document.getElementById("reset");
                var y = document.getElementById("resetJob");
                var a = document.getElementById("insert");
                var b = document.getElementById("insertJob");

                var s = document.getElementById("resetInterview");
                // var t = document.getElementById("insertInterview");


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


        <form id="update" style="display: none" method="POST" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            Old Name: <input type="text" name="oldName"> <br /><br />
            New Name: <input type="text" name="newName"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form>

        <!-- <h2>Count the Tuples in DemoTable</h2>
        <form method="GET" action="project.php"> refresh page when submitted-->
            <!-- <input type="hidden" id="countTupleRequest" name="countTupleRequest">
            <input type="submit" name="countTuples"></p> -->
        <!-- </form> -->

        <h2>Print Tuples from jobTable</h2>
        <form id="printJob" method="GET" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="printRequest" name="printRequest">
            <input type="submit" name="printJob"></p>
        </form>

        <!-- NEW -->
        <h2>Print Tuples from interviewTable</h2>
        <form id="printInterview" method="GET" action="project.php"> <!--refresh page when submitted-->
            <input type="hidden" id="printRequestInterview" name="printRequestInterview">
            <input type="submit" name="printInterview"></p>
        </form>
        <!-- <form method="GET" action="jobListing.php">
            <input type="hidden" name="positionName" value="positionName">
            <input type="submit">
        </form> -->

        <?php
        //this tells the system that it's no longer just parsing html; it's now parsing PHP

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

        function connectToDB() {
            global $db_conn;

            // Your username is ora_(CWL_ID) and the password is a(student number). For example,
			// ora_platypus is the username and a12345678 is the password.
            $db_conn = OCILogon("ora_daniren", "a86258282", "dbhost.students.cs.ubc.ca:1522/stu");

            if ($db_conn) {
                debugAlertMessage("Database is Connected");
                return true;
            } else {
                debugAlertMessage("Cannot connect to Database");
                $e = OCI_Error(); // For OCILogon errors pass no handle
                echo htmlentities($e['message']);
                return false;
            }
        }

        function debugAlertMessage($message) {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }

        function disconnectFromDB() {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

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


        function handleUpdateRequest() {
            //ob_end_clean();
            global $db_conn;

            $old_name = $_POST['oldName'];
            $new_name = $_POST['newName'];

            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE demoTable SET name='" . $new_name . "' WHERE name='" . $old_name . "'");
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


        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('resetJobTablesRequest', $_POST)) {
                    handleResetJobRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                } else if (array_key_exists('insertJobQueryRequest', $_POST)) {
                    handleInsertJobRequest();
                } // NEW:
                else if (array_key_exists('resetInterviewTablesRequest', $_POST)) {
                    handleResetInterviewRequest();
                } else if (array_key_exists('insertInterviewQueryRequest', $_POST)) {
                    handleInsertInterviewRequest();
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
                }

                disconnectFromDB();
            }
        }

        if (isset($_POST['resetJob']) || isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['insertSubmitJob']) || isset($_POST['resetInterview']) || isset($_POST['insertSubmitInterview'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest']) || isset($_GET['printRequest']) || isset($_GET['printRequestInterview'])) {
            handleGETRequest();
        }

        function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
            //echo "<br>running ".$cmdstr."<br>";
            global $db_conn, $success;

            $statement = OCIParse($db_conn, $cmdstr);
            //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
                echo htmlentities($e['message']);
                $success = False;
            }

            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                $success = False;
            }

			return $statement;
		}

        function executeBoundSQL($cmdstr, $list) {
            /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
		See the sample code below for how this function is used */

			global $db_conn, $success;
			$statement = OCIParse($db_conn, $cmdstr);

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn);
                echo htmlentities($e['message']);
                $success = False;
            }

            foreach ($list as $tuple) {
                foreach ($tuple as $bind => $val) {
                    //echo $val;
                    //echo "<br>".$bind."<br>";
                    OCIBindByName($statement, $bind, $val);
                    unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
				}

                $r = OCIExecute($statement, OCI_DEFAULT);
                if (!$r) {
                    echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                    $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
                    echo htmlentities($e['message']);
                    echo "<br>";
                    $success = False;
                }
            }
        }
        print_r($_GET);
        ?>
    </body>
</html>