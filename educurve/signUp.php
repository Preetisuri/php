<?php include '/static/templates/header.html';?>
<br>
<form id="form_signUp">
<table width="100%">
    <tr>
        <td width="20%"></td>
        <td width="25%"></td>
        <td width="10%"></td>
        <td width="20%"></td>
        <td width="25%"></td>
    </tr>
    <tr>
        <td>Name</td>
        <td colspan="4"><input type="text" id="name" value=""></td>
    </tr>
    <tr>
        <td>Mobile No</td>
        <td><input type="text" id="mobile" value=""></td>
        <td></td>
        <td>Email</td>
        <td><input type="text" id="email" value=""></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="password" id="password" value=""></td>
        <td></td>
        <td>Confirm Password</td>
        <td><input type="password" id="confirm_password" value=""></td>
    </tr>
    <tr>
        <td colspan="5">
            <br>
            <h5><span id="errormsg"></span></h5>
            <br>
            <center><input type="button" id="signUpInfo" class="theme_button" value="Sign Up"></center>
            <br><br>
            <center><h2><span id="successmsg"></span></h2></center>
        </td>
    </tr>
</table>
</form>
<br>
<?php include '/static/templates/footer.html';?>