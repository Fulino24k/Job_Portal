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
            var hide = FALSE;
            var condition = sessionStorage.getItem("key");
            if (condition) {
                var b = document.getElementById("group");
                b.style.display = "none";
            }
            function applyFor() {
                var a = document.getElementById("coverResume");
                var b = document.getElementById("resume");
                var c = document.getElementById("edit");
                a.style.display = "block";
                b.style.display = "block";
                c.style.display = "block";
            }
            function end() {
                var b = document.getElementById("group");
                b.style.display = "none";
                hide = TRUE;
                sessionStorage.setItem("key", hide);
                var frm = document.getElementsByName('coverResume');
                frm.submit(); // Submit the form
                frm.reset();  // Reset all form data
                return false;
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
                } else if (array_key_exists('submitApp', $_POST)) {
                    handleSubmitRequest();
                } 
                disconnectFromDB();
            }
        }
        if (isset($_POST['Save']) || isset($_POST['reset'])){
            handlePOSTRequest();
            echo "handling post request";
        } else if (isset($_GET['posID'])) {
            handleGETRequest();
        } 
        if (isset($_POST['appRequest'])) {
            handlePOSTRequest();
        } else if (isset($_GET['printRequest']) || isset($_GET['printRequestInterview']) || isset($_GET['printRequestAccount'])) {
            handleGETRequest();
        }

        function handleJobRequest() {
            global $db_conn;
            $positionID = $_GET['posID'];
            $resultName = executePlainSQL("SELECT * FROM jobTable WHERE referenceID = $positionID");

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
                } 
                disconnectFromDB();
            }
        }
        
        ?>
        <div id="group" class="application">
            <button onclick="applyFor()">New Application</button>
            <button>Load Application</button>
        </div>
        
        <!-- <form id="buttons" method="POST" action="jobListing.php">
            <input type="hidden" id="showApp" name="showApp">
            <input type="button" name="new" value="New Application" />
            <input type="button" name="load" value="Load Application" />
        </form> -->

        <form id="buttons" method="GET" action="jobListing.php" name="fresh">
            <input type="hidden" id="yeet" name="posID" value="$_GET['posID']">
        </form>
        <br>
        <!-- <input type="hidden" id="submitJob" name="submitJob"> -->
        <form id="coverResume"  method="POST" style="display: none" > 
            <p>Cover Letter:</p>
            <input type="hidden" id="appRequest" name="appRequest">
            <input type="text" style="height:100px; width:350px;" name="insCover"><br><br>
            <p>Resume:</p>
            <p>Name: </p> 
            <input type="text" name="insName"> 
            <p>Experience:</p>
            <input type="text" style="height:100px; width:350px;" name="insExp">
            <p>Education:</p>
            <input type="text" style="height:100px; width:350px;" name="insEdu"><br><br>
            <input type="button" value="Save" name="saveApp">
            <input type="button" value="Edit" name="editApp"> 
            <input type="submit" value="submit" name="submitApp" >
        </form>

        <?php
        function handleSubmitRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tupleCover = array (
                ":bind1" => "333",
                ":bind2" => $_POST['insCover']
            );

            $tupleResume = array (
                ":bind1" => "333",
                ":bind2" => $_POST['insName'],
                ":bind3" => $_POST['insExp'],
                ":bind4" => $_POST['insEdu'],
            );

            $cover = array (
                $tupleCover
            );

            $resume = array (
                $tupleResume
            );

            executeBoundSQL("insert into coverTable values (:bind1, :bind2)", $cover);
            executeBoundSQL("insert into resumeTable values (:bind1, :bind2, :bind3, :bind4)", $resume);
            OCICommit($db_conn);
            echo "Application Submitted, Thank You!";
        }
        ?>
    </body>
</html>
