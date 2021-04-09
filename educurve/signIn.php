<?php include '/static/templates/header.html';?>
<br>
<form>
<table width="100%">
    <tr>
        <td width="20%"></td>
        <td width="25%">
            User Name :
        </td>
        <td width="35%">
            <input type="text" id="name" value="">
        </td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td></td>
        <td>
            Password :
        </td>
        <td>
            <input type="password" id="password" value="">
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan="4">
            <center><br>
            <h5><span id="errormsg"></span></h5>
            <br><input type="button" class="theme_button" id="signInInfo" value="Sign In"></center>
        </td>
    </tr>
</table>
</form>
<br>
<?php include '/static/templates/footer.html';?>