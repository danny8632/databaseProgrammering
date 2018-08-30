<?php
include 'nav.php';

if(isset($_POST['addname']))
{
    $fname = $_POST['addname'];
    $selclass = $_POST['selclass'];
    $sqlin = "INSERT INTO `Location` (`Name`, `Class`) VALUES ('$fname', '$selclass')";
    if ($conn->query($sqlin) === TRUE) {
        header("Location: location.php");
    } else {
        echo "Error: " . $sqlin . "<br>" . $conn->error;
    }
}
if(isset($_POST['editname']))
{
    $editname = $_POST['editname'];
    $currentid = $_POST['currentname'];
    $editclass = $_POST['editclass'];
    $sqlupdate = "UPDATE `Location` SET `Name`='".$editname."', `Class`=".$editclass." WHERE `ID` = ".$currentid."";
    if ($conn->query($sqlupdate) === TRUE) {
        header("Location: location.php");
    } else {
        echo "Error: " . $sqlupdate . "<br>" . $conn->error;
    }
}
if(isset($_POST['uname']))
{
    $delid = $_POST['uname'];
    $sqldel = "DELETE FROM `Location` WHERE `ID` = ".$delid."";
    if ($conn->query($sqldel) === TRUE) {
        header("Location: location.php");
    } else {
        echo "Error: " . $sqldel . "<br>" . $conn->error;
    }
}

?>

<script>
    
    function toogleEdit(x) {
        $("#editform").toggle();
        $name = document.getElementById("teachertable").rows[x].cells[1].innerHTML
        $editid = document.getElementById("teachertable").rows[x].cells[0].innerHTML
        document.getElementById("editinput").value = $name;
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

<h1>Location</h1>

<div class="row">
    <div class="col-12 col-md-8">
  
        <table class="table table-sm" id="teachertable">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Class</th>
            <th scope="col"><button class="btn btn-primary" onclick='toogleAdd()' id="add">Add</button></th>
            <th scope="col">Delete User</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM `LocationClass`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $numberrow = 1;
            while($row = $result->fetch_assoc()) {
                echo "<tr><td scope='row'>". $row['ID']. "</td>
                    <td>".$row['Name']."</td>
                    <td>".$row['Class']."</td>
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
    <form id="addform" style="display:none;" action="location.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Location name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="addname" placeholder="Location name">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Select Class</label>
            <select class="form-control" id="exampleFormControlSelect1" name="selclass">
                <?php
                    $sqlclass = "SELECT * FROM `Class`";
                    $result = $conn->query($sqlclass);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option>".$row["ID"].": ".$row["Name"]."</option>";
                        }
                    } else {
                        echo "No result";
                    }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>

    <form id="editform" style="display:none;" action="location.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Edit Location:</label>
            <input type="text" class="form-control" id="editinput" name="editname" value="">
            <input type="hidden" id="editinput2" name="currentname" value="" />

            <div class="form-group">
                <label for="exampleFormControlSelect1">Select Class</label>
                <select class="form-control" id="exampleFormControlSelect1" name="editclass">
                    <?php
                        $sqlclass = "SELECT * FROM `Class`";
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
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <form id="deluser" action="location.php" method="POST">
        <input type="hidden" id="delinput" name="uname" value="" />
    </form>
    </div>
</div>

