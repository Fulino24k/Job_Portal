// extra code for my own referenceID



<html>
    <head>
        <title> CPSC 304 2023S T2 PHP/Oracle Project</title>
    </head>
    <style>
        <?php include 'project.css'; ?>
    </style>
    <body>
        <h1> Application INFO </h1>
        <hr/>
        <script>
            var hide = FALSE;

            var condition = sessionStorage.getItem("key");
            if (condition) {
                var b = document.getElementById("group");
                b.style.display = "none";
            }

            </script>
        <?php
include 'functions.php';
$positionID2 = $_GET['appID'];
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
} else if (isset($_GET['appID'])) {
    handleGETRequest();
} 
if (isset($_POST['appRequest'])) {
    handlePOSTRequest();
} else if (isset($_GET['printRequest']) || isset($_GET['printRequestInterview']) || isset($_GET['printRequestAccount'])) {
    handleGETRequest();
}
function handleAppRequest() {
    global $db_conn;
    $positionID2 = $_GET['appID'];
    $resName = executePlainSQL("SELECT * FROM resumeTable WHERE app_num = $positionID2");
    $coverName = executePlainSQL("SELECT * FROM coverTable WHERE app_num = $positionID2")
    while ($row = OCI_Fetch_Array($resName, OCI_BOTH)) {
        echo "<br>";
        echo "Name: " . $row["NAME"] . "<br><br>"; //or just use "echo $row[0]"
        echo "Experience: " . $row["EXPERIENCE"] . "<br>";
        echo "Education: " . $row["EDUCATION"] . "<br>";
    }
    while ($row = OCI_Fetch_Array($coverName, OCI_BOTH)) {
        echo "<br>";
        echo "My cover letter: " . $row["INTRODUCTION"] . "<br><br>"; //or just use "echo $row[0]"
    }
    
    OCICommit($db_conn);
}

function handleGETRequest() {
    if (connectToDB()) {
        } if (array_key_exists('appID', $_GET)) {
            handleAppRequest();
        }
        disconnectFromDB();
    }


    ?>
    </body>
</html>
