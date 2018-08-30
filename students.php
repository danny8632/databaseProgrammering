<?php
include 'nav.php';

if(isset($_POST['addname']))
{
    $fname = $_POST['addname'];
    $sqlin = "INSERT INTO `Students` (`Name`) VALUES ('$fname')";
    if ($conn->query($sqlin) === TRUE) {
        header("Location: students.php");
    } else {
        echo "Error: " . $sqlin . "<br>" . $conn->error;
    }
}
if(isset($_POST['editname']))
{
    $editname = $_POST['editname'];
    $currentid = $_POST['currentname'];
    $sqlupdate = "UPDATE `Students` SET `Name`='".$editname."' WHERE `ID` = ".$currentid."";
    if ($conn->query($sqlupdate) === TRUE) {
        header("Location: students.php");
    } else {
        echo "Error: " . $sqlupdate . "<br>" . $conn->error;
    }
}
if(isset($_POST['uname']))
{
    $delid = $_POST['uname'];
    $sqldel = "DELETE FROM `Students` WHERE `ID` = ".$delid."";
    if ($conn->query($sqldel) === TRUE) {
        header("Location: students.php");
    } else {
        echo "Error: " . $sqldel . "<br>" . $conn->error;
    }
}

?>

<script>
    
    function toogleEdit(x) {
        $("#editform").toggle();
        $name = document.getElementById("studenttable").rows[x].cells[1].innerHTML
        $editid = document.getElementById("studenttable").rows[x].cells[0].innerHTML
        document.getElementById("editinput").value = $name;
        document.getElementById("editinput2").value = $editid;
    }
    function toogleAdd() {
        $("#addform").toggle();
    }
    function deluser(x) {
        $delid = document.getElementById("studenttable").rows[x].cells[0].innerHTML
        document.getElementById("delinput").value = $delid;
        document.getElementById("deluser").submit();
    }
    
</script>

<h1>Students</h1>

<div class="row">
    <div class="col-12 col-md-8">
  
        <table class="table table-sm" id="studenttable">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col"><button class="btn btn-primary" onclick='toogleAdd()' id="add">Add</button></th>
            <th scope="col">Delete User</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM `Students`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $numberrow = 1;
            while($row = $result->fetch_assoc()) {
                echo "<tr><td scope='row'>". $row['ID']. "</td>
                    <td>".$row['Name']."</td>
                    <td><button class='btn btn-primary' onclick='toogleEdit(".$numberrow.")' id='edit'>Edit</button></td>
                    <td><button class='btn btn-primary' onclick='deluser(".$numberrow.")' id='del'>Delete</button></td></tr>";
                $numberrow++;
            }
        } else {
            echo "No result";
        }
        ?>
        </tbody>
        </table>
    </div>
    <div class="col-6 col-md-4">
    <form id="addform" style="display:none;" action="students.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Student name:</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="addname" placeholder="Student name">
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>

    <form id="editform" style="display:none;" action="students.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Edit Student:</label>
            <input type="text" class="form-control" id="editinput" name="editname" value="">
            <input type="hidden" id="editinput2" name="currentname" value="" />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <form id="deluser" action="students.php" method="POST">
        <input type="hidden" id="delinput" name="uname" value="" />
    </form>
    </div>
</div>

