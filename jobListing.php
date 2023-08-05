<html>
    <head>
        <title> CPSC 304 2023S T2 PHP/Oracle Project</title>
    </head>
    <style>
        <?php include 'project.css'; ?>
    </style>
    <body>
        <h1> Application For Job </h1>
        <hr/>
        <script>
            function applyFor() {
                var a = document.getElementById("coverResume");
                var b = document.getElementById("resume");
                var c = document.getElementById("edit");
                a.style.display = "block";
                b.style.display = "block";
                c.style.display = "block";
            }
        </script>
        <?php
        include 'functions.php';
        $positionID = $_GET['posID'];
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('coverRequest', $_POST)) {
                    handleCoverRequest();
                } else if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } disconnectFromDB();
            }
        }
        if (isset($_POST['Save']) || isset($_POST['reset'])){
            handlePOSTRequest();
            echo "handling post request";
        } else if (isset($_GET['posID'])) {
            handleGETRequest();
        } 
        function handleCoverRequest() {

            global $db_conn;
            $tuple = array (
                ":bind1" => $_POST['cover'],
                ":bind2" => $_POST['res']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into coverTable values (:bind1, :bind2)", $alltuples);
            OCICommit($db_conn);
        }
        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE coverTable");
            echo "<br> old table dropped <br>";
            // Create new table
            echo "<br> creating new table <br>";
                executePlainSQL("CREATE TABLE storeTable (app_num int PRIMARY KEY, apply_date int)");
                executePlainSQL("CREATE TABLE coverTable (app_num int PRIMARY KEY, introduction char(300))");
                executePlainSQL("CREATE TABLE resumeTable (app_num int PRIMARY KEY, name char(30), experience char(300), education char(300))");
            OCICommit($db_conn);
        }
        // $positionID = $_GET['posID'];

        // echo $positionID;
        function handleJobRequest() {
            global $db_conn;
            $positionID = $_GET['posID'];
            $resultName = executePlainSQL("SELECT * FROM jobTable WHERE referenceID = $positionID");
            //echo "For Applying For Position: ". $resultName['POSITION'] . "<br>";
            while ($row = OCI_Fetch_Array($resultName, OCI_BOTH)) {
                echo "<br>";
                echo "Applying For Position: " . $row["POSITION"] . "<br><br>"; //or just use "echo $row[0]"
                echo "The qualifications for this job: " . $row["QUALIFICATION"] . "<br>";
                echo "The duties for this job: " . $row["DUTY"] . "<br>";
            }
            
            OCICommit($db_conn);
            
        }
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('posID', $_GET)) {
                    handleJobRequest();
                } else {
                    handleJobRequest();
                }
                disconnectFromDB();
            }
        }
        
        ?>
        <!-- <div id="group" class="application">
            <button onclick="applyFor()">New Application</button>
            <button>Load Application</button>
        </div> -->
        <div id="group" class="application">
            <button onclick="applyFor()">New Application</button>
            <button>Load Application</button>
        </div>
        
        <form id="buttons" method="POST" action="jobListing.php">
            <input type="hidden" id="showApp" name="showApp">
            <input type="button" name="new" value="New Application" />
            <input type="button" name="load" value="Load Application" />
        </form>

        <form id="buttons" method="GET" action="jobListing.php" name="fresh">
            <input type="hidden" id="yeet" name="posID" value="$_GET['posID']">
        </form>
        
        <!-- <input type="hidden" id="submitJob" name="submitJob"> -->
        <form id="coverResume"  method="POST" style="display: none" action="jobListing.php"> 
            <p>Cover Letter:</p>
            <input type="hidden" id="appRequest" name="appRequest">
            <input type="text" style="height:100px; width:350px;" name="cover"><br><br>
            <p>Resume:</p>
            <input type="text" style="height:100px; width:350px;" name="res"><br><br>
            <input type="button" value="Save" name="saveApp">
            <input type="button" value="Edit" name="editApp"> 
            <input type="submit" value="submit" name="submitApp">
        </form>
        
        <form id="reset" method="POST" action="project.php">
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
            <p><input type="submit" value="Reset Cover + Resume + Stores" name="reset"></p>
        </form>

        <?php
        if(array_key_exists('new', $_POST)) {
            newApp();
        } else if(array_key_exists('load', $_POST)) {
            loadApp();
        } else if(array_key_exists('showApp', $_POST)) {
            loadApp();
        }
        function newApp() {
            echo "This is Button1 that is selected";
        }
        function loadApp() {
            echo "This is Button2 that is selected";
        }
        ?>
    </body>
</html>
