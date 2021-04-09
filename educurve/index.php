<?php include '/static/templates/header.html';
if(isset($_GET['logout'])) {
    if(!session_id())
        session_start();
    session_destroy();
    unset($_SESSION['user_id']);
}
else if(isset($_SESSION['user_id'])) {
    header("location:showDetails.php");
}
?>
<br>
<table width="100%">
    <tr>
        <td width="20%"></td>
        <td width="25%">
            <input type="button" id="signIn" class="theme_button" value="Sign In">
        </td>
        <td width="10%"></td>
        <td width="25%">
            <input type="button" id="signUp" class="theme_button" value="Sign Up">
        </td>
        <td width="20%"></td>
    </tr>
</table>
<br>
<?php include '/static/templates/footer.html';?>