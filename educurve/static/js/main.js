let isError = false;
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
       return false;
    }else{
       return true;
    }
}
function IsMobile(mobile) {
    var regex = /^([0-9\-\+\ ]{10,50})+$/;
    if(!regex.test(mobile)) {
       return false;
    }else{
       return true;
    }
}
function setError(element) {
    if($(element).val() == "") {
        $(element).css("border","solid 1px red")
        isError = true;
    }
    else
        $(element).css("border","solid 1px black")
}
function addChild(childIndex) {
    if($("#name").val()=="" || $("#grade").val()=="") {
        $("#name").css("border","solid 1px red");
        $("#grade").css("border","solid 1px red");
        $("#errormsg").html("*Required Fields");
    }
    else {
        postData = {
            'name' : $("#name").val(),
            'grade' : $("#grade").val(),
            'parent_id' : $("#user_id").val()
        }
        $.ajax({
            type: 'POST',
            url: "controllerUsers.php",
            data: postData,
            success: function (data) {
                if(data === "3.")
                    $("#errormsg").html("Error occured while saving, please try again")
                else if(data === "2.")
                    $("#errormsg").html("Error occured while saving, please try again")
                else if(data) {
                    childname = $("#name").val();
                    childgrade = $("#grade").val();
                    $("#addChildName"+childIndex).html(childname);
                    $("#addChildGrade"+childIndex).html(childgrade);
                    $("#addChildCell"+childIndex).removeClass("actionBtn");
                    $("#addChildCell"+childIndex).html(data);
                    if(childIndex < 10) {
                        childIndex++;
                        var newChildRow = '<tr id="'+childIndex+'" height="50px">'
                        newChildRow += '<td>'+childIndex+'</td>'
                        newChildRow += '<td id="addChildName'+childIndex+'"><input type="text" id="name" value=""></td>'
                        newChildRow += '<td id="addChildGrade'+childIndex+'"><input type="text" id="grade" value=""></td>'  
                        newChildRow += '<td id="addChildCell'+childIndex+'" onclick="addChild('+childIndex+')" class="actionBtn"><h5><span>Add Child</span></h5></td></tr>'
                        $("#childInfo > tbody").append(newChildRow);
                    }
                }
            },
            error: function (data) {
                $("#errormsg").html("Error while adding the user")
            }
        });
    }
    
}
$(document).ready(function () {
    $("#signIn").click(function () {
        document.location.href = "signIn.php";
    });

    $("#signUp").click(function () {
        document.location.href = "signUp.php";
    });

    $("#logout").click(function () {
        document.location.href = "index.php?logout";
    });

    $("#signUpInfo").click(function () {
        isError = false;
        $("#errormsg").html("");
        $("#successmsg").html("");
        setError("#name")
        setError("#mobile")
        setError("#email")
        setError("#password")
        setError("#confirm_password")
        if(isError == true)
            $("#errormsg").html("Values cannot be empty")
        else{
            
            if(!IsMobile($("#mobile").val())) {
                $("#mobile").css("border","solid 1px red")
                $("#errormsg").html("Format of mobile is not correct")
            }
            else if(!IsEmail($("#email").val())) {
                $("#email").css("border","solid 1px red")
                $("#errormsg").html("Format of email is not correct")
            }
            else if ($("#password").val() !== $("#confirm_password").val())
            {
                $("#confirm_password").css("border","solid 1px red")
                $("#errormsg").html("Password does not match")
            }
            else {
                $("#errormsg").html("");
                postData = {
                    'name' : $("#name").val(),
                    'mobile' : $("#mobile").val(),
                    'email' : $("#email").val(),
                    'password' : $("#password").val()
                }
                $.ajax({
                    type: 'POST',
                    url: "controllerUsers.php",
                    data: postData,
                    success: function (data) {
                        if(data==="1.") {
                            $("#successmsg").html("User added successfully");
                            $("#name").val("");
                            $("#mobile").val("");
                            $("#email").val("");
                            $("#password").val("");
                            $("#confirm_password").val("");
                        }
                        else if(data === "2.")
                            $("#errormsg").html("User already exists, if its not you try with different credetials")
                        else if(data === "3.")
                            $("#errormsg").html("Error occured while saving, please try again")
                    },
                    error: function (data) {
                        $("#errormsg").html("Error while adding the user")
                    }
                });
            }
        }
    });

    $("#signInInfo").click(function () {
        isError = false;
        $("#errormsg").html("");
        setError("#name")
        setError("#password")
        if(isError == true)
            $("#errormsg").html("Values cannot be empty")
        else{
            $("#errormsg").html("");
            getData = {
                'name' : $("#name").val(),
                'password' : $("#password").val()
            }
            $user_id = null;
            $.ajax({
                type: 'GET',
                url: "controllerUsers.php?name="+$("#name").val()+"&password="+$("#password").val(),
                async: false,
                data: null,
                success: function (data) {
                    if(data==="no user.") {
                        $("#errormsg").html("User name or password is incorrect");
                    }
                    else if(data === "3.")
                        $("#errormsg").html("Error occured while retrieving information, please try again")
                    else
                        $user_id = parseInt(data)
                },
                error: function (data) {
                    $("#errormsg").html("Error while retrieving the user information")
                }
            });
            if($user_id)
                document.location.href = "showDetails.php";
        }
    });
}); 