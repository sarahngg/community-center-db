<html>
    <head>
        <title>CPSC 304 Community Centre Database</title>
        <link rel="stylesheet" href="https://www.students.cs.ubc.ca/~sarahn26/ccstyles.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&display=swap" rel="stylesheet"> 
    </head>

    <body>
      <div id="app-bar"> 
        <div class="app-bar-content">
          <h1>📊 Community Centre Management Tool</h1>
        </div>
        <div class="app-bar-content">
          <div class="nav-button"><a href="#employee">👥 Employee</a></div>
          <div class="nav-button"><a href="#class">📚 Class</a></div>
          <div class="nav-button"><a href="#employee">...</a></div>
        </div>
      </div>
      <div class="row">
      <div>
        <h2>Show All Data</h2>
        <h6>Display all tuples in a table</h6>
        <form method="GET" action="cc.php"> <!--refresh page when submitted-->
            <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
              <select name="table_list" id="table_list">
              <option value="Takes">Takes</option>
              <option value="Process_Purchase_Membership">Process_Purchase_Membership</option>
              <option value="Uses">Uses</option>
              <option value="Has_Room_Booking">Has_Room_Booking</option>
              <option value="Workshop">Workshop</option>
              <option value="Lesson">Lesson</option>
              <option value="Front_Desk_Staff">Front_Desk_Staff</option>
              <option value="Instructor">Instructor</option>
              <option value="Pays_Payment">Pays_Payment</option>
              <option value="Orders_Equipment">Orders_Equipment</option>
              <option value="Class_Leads">Class_Leads</option>
              <option value="Employee">Employee</option>
              <option value="Customer">Customer</option>
            </select>
            <input class="submit-button" type="submit" name="displayTuples">
        </form>
        <hr />

        <h2 id="employee">Add New Employee</h2>
        <h6>Insert Values into Employee</h6>
        <form method="POST" action="cc.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            <input type="number" min="0" step="1" name="eID" placeholder="Employee ID"> 
            <input type="text" name="firstName" placeholder="First Name"> 
            <input type="text" name="lastName" placeholder="Last Name">
            <input class="submit-button" type="submit" value="Insert" name="insertSubmit">
        </form>

        <hr />

        <h2 id="class">Delete a class</h2>
        <h6>Remove a class with user provided class name</h6>
        <form method="POST" action="cc.php"> <!--refresh page when submitted-->
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            <input type="text" name="className" placeholder="Class Name (exact)">
            <input class="submit-button" type="submit" value="Delete" name="deleteSubmit">
        </form>

        <hr />

        <h2>Update Front-Desk Staff Wages </h2>
        <h6>Update a specific front desk staff's wages</h6>
        <form method="POST" action="cc.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            <input type="int" name="eID" placeholder="Employee ID"> 
            <input type="real" min="0.00" name="hourlyRate" placeholder="New Wage">
            <input class="submit-button" type="submit" value="Update" name="updateSubmit">
        </form>
        
        <hr />
        <h2>Front Desk Staff Average Hourly Rate</h2>
        <h6>Aggregation Calculate the average hourly rate for front desk employees</h6>
        <form method="GET" action="cc.php"> <!--refresh page when submitted-->
            <input type="hidden" id="aggregateTupleRequest" name="aggregateTupleRequest">
            <input class="submit-button" type="submit" name="aggregateTuples">
        </form>
        <hr />

        <h2>Look Up An Employees</h2>
        <h6>Selection: Find Employees with eID smaller than some integer AND last name string match</h6>
        <form method="POST" action="cc.php"> <!--refresh page when submitted-->
            <input type="hidden" id="selectionRequest" name="selectionRequest">
            <input type="number" min="0" step="1" name="eID" placeholder="Employee ID smaller than"> AND
            <input type="text" name="lastName" placeholder="Last Name starts with the character...">
            <input class="submit-button" type="submit" value="Query" name="selectionSubmit">
        </form>
        <hr />

        <h2>How many classes does each Instructor Lead?</h2>
        <h6>Aggregation: Groups Class_Leads by eID, displays COUNT</h6>
        <form method="GET" action="cc.php"> <!--refresh page when submitted-->
            <input type="hidden" id="aggregateGroupByRequest" name="aggregateGroupByRequest">
            <input class="submit-button" type="submit" value="Query" name="aggregateTupleRequest">
        </form>
        <hr />

        <h2>Full Names of all Customers who took class with specific instructor</h2>
        <h6>Join: Joins Takes, Customer, and Class_Leads</h6>
        <form method="POST" action="cc.php"> <!--refresh page when submitted-->
            <input type="hidden" id="joinRequest" name="joinRequest">
            <input type="int" min="0" step="1" name="eID" placeholder="Instructor ID"> 
            <input class="submit-button" type="submit" value="Query" name="joinSubmit">
        </form>
        <hr />

        <h2>Show Details of Classes</h2>
        <h6>Projection: Show these attributes of Class_Leads</h6>
        <form method="POST" action="cc.php">
            <input type="hidden" id="projectionRequest" name="projectionRequest">
            <select name="projection_list1" id="projection_list1">
                <option value="classID">classID</option>
                <option value="date">date</option>
                <option value="memberDiscount">memberDiscount</option>
                <option value="classType">classType</option>
                <option value="className">className</option>
                <option value="maxSpots">maxSpots</option>
                <option value="eID" selected>eID</option>
            </select>
            <select name="projection_list2" id="projection_list2">
                <option value="classID">classID</option>
                <option value="date">date</option>
                <option value="memberDiscount">memberDiscount</option>
                <option value="classType">classType</option>
                <option value="className" selected>className</option>
                <option value="maxSpots">maxSpots</option>
                <option value="eID">eID</option>
            </select>
            <select name="projection_list3" id="projection_list3">
                <option value="classID">classID</option>
                <option value="date">date</option>
                <option value="memberDiscount">memberDiscount</option>
                <option value="classType">classType</option>
                <option value="className">className</option>
                <option value="maxSpots" selected>maxSpots</option>
                <option value="eID">eID</option>
            </select>
            <input class="submit-button" type="submit" value="Query" name="projectionSubmit">
        </form>
        <hr />

        <h2>Who takes all the classes?</h2>
        <h6>Division: Find the customers that take all the classes</h6>
        <form method="GET" action="cc.php">
            <input type="hidden" id="divisionRequest" name="divisionRequest">
            <input class="submit-button" type="submit" name="divisionSubmit">
        </form>
        <hr />

        <h2>What are the total spots available for instructors who teach multiple classes?</h2>
        <h6>For each instructor that teaches more than 1 class, find the total number of spots available across all his/her classes.</h6>
        <form method="GET" action="cc.php">
            <input type="hidden" id="aggregateHavingRequest" name="aggregateHavingRequest">
            <input class="submit-button" type="submit" name="aggregateHavingSubmit">
        </form>
      </div>
      <div id="result">
        <?php
		//this tells the system that it's no longer just parsing html; it's now parsing PHP

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

        function debugAlertMessage($message) {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
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

        // General print function; useful to look at for help!
        function printResult($result) { //prints results from a select statement
            echo "<br>Retrieved from Employee:<br>";
            echo "<table>";
            echo "<tr><th>eID</th><th>firstName</th><th>lastName</th></tr>";
            while (($row = OCI_Fetch_Array($result, OCI_BOTH)) != false) {
                echo "<tr><td>" . $row["EID"] . "</td><td>" . $row["FIRSTNAME"] . "</td><td>" . $row["LASTNAME"] . "</td></tr>"; //or just use "echo $row[0]"; 
            }

            echo "</table>";
        }

        function connectToDB() {
            global $db_conn;

            // Your username is ora_(CWL_ID) and the password is a(student number). For example, 

            // ora_platypus is the username and a12345678 is the password.
            // $db_conn = OCILogon("ora_cwl", "password", "dbhost.students.cs.ubc.ca:1522/stu");
            $db_conn = OCILogon("ora_cwl", "password", "dbhost.students.cs.ubc.ca:1522/stu");

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

        function disconnectFromDB() {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

        function handleUpdateRequest() {
            global $db_conn;

            $eID = $_POST['eID'];
            $hourlyRate = $_POST['hourlyRate'];

            // you need the wrap the pay, specialization and eID values with single quotations
            executePlainSQL("UPDATE Front_Desk_Staff SET hourlyRate='" . $hourlyRate . "' WHERE eID='" . $eID . "'");
            $result = executePlainSQL("SELECT F.eID as ID, E.FIRSTNAME as FN, E.LASTNAME as LN, F.HOURLYRATE as RATE 
            FROM Front_Desk_Staff F, EMPLOYEE E WHERE F.eID = E.eID AND F.eID='" . $eID . "'");
            echo "<br>Updated staff hourly rate<br>";
            echo "<table>";
            echo "<tr><th>eID</th><th>firstName</th><th>lastName</th><th>hourlyRate</th></tr>";
            while (($row = OCI_Fetch_Array($result, OCI_BOTH)) != false) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["FN"] . "</td><td>" . $row["LN"] . "</td><td>" . $row["RATE"] ."</td></tr>";
            }
            echo "</table>";
            
            OCICommit($db_conn);
        }

        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE demoTable");

            // Create new table
            echo "<br> creating new table <br>";
            executePlainSQL("CREATE TABLE demoTable (id int PRIMARY KEY, name char(30))");
            OCICommit($db_conn);
        }

        function handleInsertRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['eID'],
                ":bind2" => $_POST['firstName'],
                ":bind3" => $_POST['lastName']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("INSERT INTO Employee VALUES (:bind1, :bind2, :bind3)", $alltuples);
            OCICommit($db_conn);
        }

        function handleDeleteRequest() {
          global $db_conn;
          $className = $_POST['className'];
          // you need the wrap the eID and lastName values with single quotations
          $result = executePlainSQL("DELETE FROM Class_Leads WHERE className <='" . $className . "'");
          OCICommit($db_conn);
      }

        function handleAggregationRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Avg(hourlyRate) FROM Front_Desk_Staff");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br>Front desk staff average hourly rate:". "<br> CAD " . round($row[0], 2) . "<br>";
            }
        }

        function handleAggregationGroupByRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT CL.eID, COUNT(*) FROM Class_Leads CL GROUP BY CL.eID");

            echo "<br>Retrieved from Class_Leads:<br>";
            echo "<table>";
            echo "<tr><th>eID</th><th>Classes Led</th></tr>";
            while (($row = OCI_Fetch_Array($result, OCI_BOTH)) != false) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>"; //or just use "echo $row[0]"; 
            }
            echo "</table>";
        }

        function handleAggregationHavingRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT I.eID, SUM(CL.maxSpots) FROM Instructor I, Class_Leads CL WHERE I.eID=CL.eID GROUP BY I.eID HAVING COUNT(*)>1");

            echo "<br>Max total spots for instructors that teach multiple classes:<br>";
            echo "<table>";
            echo "<tr><th>eID</th><th>Total spots available</th></tr>";

            while (($row = OCI_Fetch_Array($result, OCI_BOTH)) != false) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>"; //or just use "echo $row[0]"; 
            }
            echo "</table>";
        }

        function handleSelectionRequest() {
            global $db_conn;

            $eID = $_POST['eID'];
            $lastName = $_POST['lastName'];

            // you need the wrap the eID and lastName values with single quotations
            $result = executePlainSQL("SELECT * FROM Employee WHERE eID<='" . $eID . "' AND lastName LIKE'" . $lastName . "%'");
            echo "<br>Retrieved from Employee:<br>";
            echo "<table>";
            echo "<tr><th>eID</th><th>firstName</th><th>lastName</th></tr>";
            while (($row = OCI_Fetch_Array($result, OCI_BOTH)) != false) {
                echo "<tr><td>" . $row["EID"] . "</td><td>" . $row["FIRSTNAME"] . "</td><td>" . $row["LASTNAME"] . "</td></tr>"; //or just use "echo $row[0]"; 
            }

            echo "</table>";
            OCICommit($db_conn);
        }

        function handleDivisionRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT * FROM Customer C WHERE NOT EXISTS ((SELECT CL.classID FROM Class_Leads CL) MINUS (SELECT T.classID FROM Takes T  WHERE T.email=C.email)) ");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br>Our number one fan:". "<br>" . $row[0] . "<br>";
            }
        }

        function handleJoinRequest() {
            global $db_conn;

            $eID = $_POST['eID'];

            // you need the wrap the pay, specialization and eID values with single quotations
            $result = executePlainSQL("SELECT DISTINCT C.firstName as FN, C.lastName as LN FROM Customer C, Takes T, Class_Leads CL 
            WHERE eID='" . $eID . "' AND T.email = C.email AND T.classID = CL.classID");
            
            echo "<br>Retrieved from Join:<br>";
            echo "<table>";
            echo "<tr><th>firstName</th><th>lastName</th></tr>";
            while (($row = OCI_Fetch_Array($result, OCI_BOTH)) != false) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>"; //or just use "echo $row[0]"; 
            }
            echo "</table>";
            
            OCICommit($db_conn); 
        }

        function handleProjectionRequest() {
            global $db_conn;

            $projection_list1 = $_POST['projection_list1'];
            $projection_list2 = $_POST['projection_list2'];
            $projection_list3 = $_POST['projection_list3'];
            if ($projection_list1 == 'date') {
              $projection_list1 = '"' . $projection_list1 . '"' ;
            }

            if ($projection_list2 == 'date') {
              $projection_list2 = '"' . $projection_list2 . '"' ;
            }

            if ($projection_list3 == 'date') {
              $projection_list3 = '"' . $projection_list3 . '"' ;
            }
            $result = executePlainSQL("SELECT $projection_list1, $projection_list2, $projection_list3 FROM Class_Leads");

            echo "<br>Retrieved from Class_Leads:<br>";
            echo "<table>";
            echo "<tr><th>$projection_list1</th><th>$projection_list2</th><th>$projection_list3</th></tr>";
            while (($row = OCI_Fetch_Array($result, OCI_BOTH)) != false) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>"; //or just use "echo $row[0]"; 
            }
            echo "</table>";
            OCICommit($db_conn);
        }
        
        function handleDisplayRequest() {
          global $db_conn;
          $table_list = strtoupper ($_GET['table_list']);
          $header = executePlainSQL("SELECT DISTINCT COLUMN_NAME FROM ALL_TAB_COLUMNS WHERE TABLE_NAME = '" . $table_list . "' ");
          echo "<br>Display all tuples from $table_list:<br>";
          echo "<table class='full-width'>";
          echo "<tr>";
          $count = 0;
          while (($row = OCI_Fetch_Array($header, OCI_BOTH)) != false) {
              echo "<th>" . $row[0] . "</th>";
              $count++;
          }
          echo "</tr>";
          $result = executePlainSQL("SELECT * FROM $table_list");
          while (($row = OCI_Fetch_Array($result, OCI_BOTH)) != false) {
            echo "<tr>";
            $tempcount = 0;
            while ($tempcount < $count) {
              echo "<td>" . $row[$tempcount] . "</td>"; //or just use "echo $row[0]"; 
              $tempcount++;
            }
            echo "</tr>";
          }
          echo "</table>";
      }
        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                } else if (array_key_exists('deleteQueryRequest', $_POST)) {
                    handleDeleteRequest();
                } else if (array_key_exists('selectionRequest', $_POST)) {
                    handleSelectionRequest();
                } else if (array_key_exists('projectionRequest', $_POST)) {
                    handleProjectionRequest();
                } else if (array_key_exists('joinRequest', $_POST)) {
                    handleJoinRequest();
                }
                disconnectFromDB();
            }
        }

        // HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('aggregateTuples', $_GET)) {
                    handleAggregationRequest();
                } else if (array_key_exists('displayTuples', $_GET)) {
                    handleDisplayRequest();
                } else if (array_key_exists('divisionRequest', $_GET)) {
                    handleDivisionRequest();
                } else if (array_key_exists('aggregateGroupByRequest', $_GET)) {
                    handleAggregationGroupByRequest();
                } else if (array_key_exists('aggregateHavingRequest', $_GET)) {
                    handleAggregationHavingRequest();
                }

                disconnectFromDB();
            }
        }

    if (isset($_POST['reset']) || isset($_POST['updateSubmit']) 
        || isset($_POST['insertSubmit']) || isset($_POST['selectionSubmit']) 
        || isset($_POST['projectionSubmit']) || isset($_POST['deleteSubmit']) || isset($_POST['joinSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['aggregateTupleRequest']) || isset($_GET['displayTupleRequest'])  || isset($_GET['divisionSubmit'])  || isset($_GET['aggregateHavingSubmit'])) {
            handleGETRequest();
        }
		?>
    </div>
    </div>
	</body>
</html>
