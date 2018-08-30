<?php
include 'nav.php';

if(isset($_POST['selstudent']))
{
    $selStudent = $_POST['selstudent'];
    $selTeacher = $_POST['selteacher'];
    $selLocation = $_POST['sellocation'];
    $sqlin = "INSERT INTO `StudentTeacherRelation`(`Student`, `Teacher`, `Location`) VALUES ('$selStudent','$selTeacher','$selLocation')";
    if ($conn->query($sqlin) === TRUE) {
        header("Location: manage.php");
    } else {
        echo "Error: " . $sqlin . "<br>" . $conn->error;
    }
}
if(isset($_POST['editstudent']))
{
    $currentid = $_POST['currentname'];
    $editStudent = $_POST['editstudent'];
    $editTeacher = $_POST['editteacher'];
    $editLocation = $_POST['editlocation'];
    $sqlupdate = "UPDATE `StudentTeacherRelation` SET `Student`='".$editStudent."', `Teacher`=".$editTeacher.", `Location`=".$editLocation." WHERE `ID` = ".$currentid."";
    if ($conn->query($sqlupdate) === TRUE) {
        header("Location: manage.php");
    } else {
        echo "Error: " . $sqlupdate . "<br>" . $conn->error;
    }
}
if(isset($_POST['uname']))
{
    $delid = $_POST['uname'];
    $sqldel = "DELETE FROM `StudentTeacherRelation` WHERE `ID` = ".$delid."";
    if ($conn->query($sqldel) === TRUE) {
        header("Location: manage.php");
    } else {
        echo "Error: " . $sqldel . "<br>" . $conn->error;
    }
}

?>

<script>
    function toogleEdit(x) {
        $("#editform").toggle();
        $editid = document.getElementById("teachertable").rows[x].cells[0].innerHTML
    
        document.getElementById("editinput2").value = $editid;
    }
    function toogleAdd() {
        $("#addform").toggle();
    }
    function deluser(x) {
        $delid = document.getElementById("teachertable").rows[x].cells[0].innerHTML
        document.getElementById("delinput").value = $delid;
        document.getElementById("deluser").submit();
    }
</script>

<h1>Manage</h1>
<div class="row">
    <div class="col-12 col-md-8">
        <table class="table table-sm" id="teachertable">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Student</th>
            <th scope="col">Teacher</th>
            <th scope="col">Location</th>
            <th scope="col"><button class="btn btn-primary" onclick='toogleAdd()' id="add">Add</button></th>
            <th scope="col">Delete User</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM `StudentTeacherLocation`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $numberrow = 1;
            while($row = $result->fetch_assoc()) {
                echo "<tr><td scope='row'>". $row['ID']. "</td>
                    <td>".$row['Student']."</td>
                    <td>".$row['Teacher']."</td>
                    <td>".$row['Location']."</td>
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
        <form id="addform" style="display:none;" action="manage.php" method="POST">
        <div class="form-group">
                <label for="exampleFormControlSelect1">Select Student:</label>
                <select class="form-control" id="exampleFormControlSelect1" name="selstudent">
                    <?php
                        $sqlclass = "SELECT * FROM `Students`";
                        $result = $conn->query($sqlclass);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value=".$row["ID"].">".$row["Name"]."</option>";
                            }
                        } else {
                            echo "No result";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Select Teacher:</label>
                <select class="form-control" id="exampleFormControlSelect1" name="selteacher">
                    <?php
                        $sqlclass = "SELECT * FROM `Teachers`";
                        $result = $conn->query($sqlclass);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value=".$row["ID"].">".$row["Name"]."</option>";
                            }
                        } else {
                            echo "No result";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Select Lokation:</label>
                <select class="form-control" id="exampleFormControlSelect1" name="sellocation">
                    <?php
                        $sqlclass = "SELECT * FROM `Location`";
                        $result = $conn->query($sqlclass);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value=".$row["ID"].">".$row["Name"]."</option>";
                            }
                        } else {
                            echo "No result";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>



        <form id="editform" style="display:none;" action="manage.php" method="POST">
        <div class="form-group">
                <label for="exampleFormControlSelect1">Select Student:</label>
                <input type="hidden" id="editinput2" name="currentname" value="" />
                <select class="form-control" id="exampleFormControlSelect1" name="editstudent">
                    <?php
                        $sqlclass = "SELECT * FROM `Students`";
                        $result = $conn->query($sqlclass);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value=".$row["ID"].">".$row["Name"]."</option>";
                            }
                        } else {
                            echo "No result";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Select Teacher:</label>
                <select class="form-control" id="exampleFormControlSelect1" name="editteacher">
                    <?php
                        $sqlclass = "SELECT * FROM `Teachers`";
                        $result = $conn->query($sqlclass);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value=".$row["ID"].">".$row["Name"]."</option>";
                            }
                        } else {
                            echo "No result";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Select Lokation:</label>
                <select class="form-control" id="exampleFormControlSelect1" name="editlocation">
                    <?php
                        $sqlclass = "SELECT * FROM `Location`";
                        $result = $conn->query($sqlclass);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value=".$row["ID"].">".$row["Name"]."</option>";
                            }
                        } else {
                            echo "No result";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>



        <form id="deluser" action="manage.php" method="POST">
            <input type="hidden" id="delinput" name="uname" value="" />
        </form>
    </div>
</div>

