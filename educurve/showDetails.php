<?php
include '/static/templates/header.html';
include "dbOps.php";
if(isset($_SESSION['user_id'])) {?>
    <table width="100%"><tr><td class="pull_right"><span id="logout" class="actionBtn"><b><h4>Logout</h4></b></span></td></tr></table><br>
<?php } else { 
    header("location:index.php");
}
$user_id = $_SESSION['user_id'];
$sql_query =  "select * from users where id=".$user_id." or parent=".$user_id." order by parent";
$result = mysqli_query($con,$sql_query);
$row = mysqli_fetch_all($result);
if($row[0][2] != null) {?>
<table width="100%">
    <tr>
        <td width="30%"></td>
        <td width="25%">
            User Name :
        </td>
        <td width="25%">
            <input type="text" value="<?php echo $row[0][1]?>" disabled>
        </td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td></td>
        <td>
            Grade :
        </td>
        <td>
            <input type="text" value="<?php echo $row[0][3]?>" disabled>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>
            Password :
        </td>
        <td>
            <input type="text" value="<?php echo $row[0][4]?>" disabled>
        </td>
        <td></td>
    </tr>
</table>
<?php
}
else {?>
<input type="hidden" id="user_id" value="<?php echo $user_id?>">
<table width="100%">
    <tr>
        <td width="20%"></td>
        <td width="25%"></td>
        <td width="10%"></td>
        <td width="20%"></td>
        <td width="25%"></td>
    </tr>
    <tr>
        <td>Name:</td>
        <td colspan="4"><input type="text" value="<?php echo $row[0][1]?>" disabled></td>
    </tr>
    <tr>
        <td>Mobile No</td>
        <td><input type="text" value="<?php echo $row[0][5]?>" disabled></td>
        <td></td>
        <td>Email</td>
        <td><input type="text" value="<?php echo $row[0][6]?>" disabled></td>
    </tr>
</table>
<br>
<b><h3>Children</h3></b>
<center>
<table width="90%" style="text-align:center" id="childInfo">
    <thead>
        <tr>
            <th width="10%">S.No.<br></th>
            <th width="40%">Name</th>
            <th width="20%">Grade</th>
            <th width="25%">Password</th>
            <th width="5%"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $lastIndex = 0;
        for($i=1; $i<count($row);$i++) { ?>
        <tr id="<?php echo $i?>" height="50px">
            <td><?php echo $i?></td>
            <td><?php echo $row[$i][1]?></td>
            <td><?php echo $row[$i][3]?></td>
            <td><?php echo $row[$i][4]?></td>
        </tr>
        <?php 
        $lastIndex = $i;
        } 
        if($lastIndex<10) {?>
        <tr id="<?php echo ++$lastIndex;?>" height="50px">
            <td><?php echo $lastIndex?></td>
            <td id="addChildName<?php echo $lastIndex?>"><input type="text" id="name" value=""></td>
            <td id="addChildGrade<?php echo $lastIndex?>"><input type="text" id="grade" value=""></td>
            <td id="addChildCell<?php echo $lastIndex?>" onclick="addChild(<?php echo $lastIndex?>)" class="actionBtn"><h5><span>Add Child</span></h5></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<h5><span id="errormsg"></span></h5>
</center>
<?php
}
?>
<?php include '/static/templates/footer.html';?>