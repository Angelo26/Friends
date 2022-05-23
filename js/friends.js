
$(document).ready(()=> {

    const fields = { emailVal: false, pwdVal: false, clicked: false };
    const patterns = {
        email: /^([a-zA-Z\d\.-_])+@[a-z\d-]+\.([a-z]{2,7})(\.[a-z]{2,5})?$/,
        rpwd: {
            size: /^.{8,}$/,
            capital: /[A-Z]+/,
            number: /\d+/,
            special: /[!"#\$%&'\(\)\*\+,-\.\/:;<=>\?@\[\\\]\^_`\{\|\}~]+/
        }
    };


    $(".logForm").submit(()=>{
        const ulname = $('#uname').val();
        const ulpwd = $('#lpwd').val();
        $.post("includes/signin.inc.php", {uname:ulname,upwd:ulpwd}, function(data){ 
            if (data < 1){
                $("#uname").css("border", "1px solid rgb(255, 51, 51)");
                $(".unameValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> User doesn't exist");
                $(".unameValMsg").fadeOut(5000);
                setTimeout(()=>{$("#uname").css("border", "1px solid #555");},4000);
                return false;
            }
            else{
                if (data === "wp"){
                    $('#lpwd').css("border", "1px solid rgb(255, 51, 51)");
                    $(".lpwdValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> Incorrect password");
                    $(".lpwdValMsg").fadeOut(5000);
                    setTimeout(()=>{$("#lpwd").css("border", "1px solid #555");},4000);
                    return false;
                }
                else if(data === "sl"){
                    $url = "http://localhost:8080/friends/friends.php";
                    window.location = $url;
                    return false;
                }
            }
        });
        return false;
    });



    $("#email").focusout(()=> {
        if ($("#email").val() !== "") {
            const uemail = $('#email').val();
            
            if (patterns.email.test($("#email").val())) {
                $.post("includes/checkEmailReg.inc.php", {email:uemail}, function(data){ 
                
                    if (data < 1){
                        $('#email').css("border", "1px solid #555");
                        $(".emailValMsg").html("");
                        fields.emailVal = true;
                    }
                    else{
                        $('#email').css("border", "1px solid rgb(255, 51, 51)");
                        $(".emailValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> Email already exist");

                        fields.emailVal = false;
                    }
                });
            }
            else {
                $('#email').css("border", "1px solid rgb(255, 51, 51)");
                $(".emailValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> Invalid email address");
                fields.emailVal = false;
            }
        }
        else {
            $('#email').css("border", "1px solid #555");
            $(".emailValMsg").html("");
        }
    });

    $("#rpwd").focusout(()=> {
        if ($("#rpwd").val() !== "") {

            if (patterns.rpwd.size.test($("#rpwd").val()) && patterns.rpwd.capital.test($("#rpwd").val()) && patterns.rpwd.number.test($("#rpwd").val()) && patterns.rpwd.special.test($("#rpwd").val())) {
                $('#rpwd').css("border", "1px solid #555");
                $(".rpwdValMsg").html("");
            } else {
                $('#rpwd').css("border", "1px solid rgb(255, 51, 51)");
                $(".rpwdValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> Include atleast 8 characters, a number, a capital letter and a special charater");
            }
        }
        else {
            $('#rpwd').css("border", "1px solid #555");
            $(".rpwdValMsg").html("");
        }
    });

    $("#crpwd").focusout(()=> {
        if ($("#crpwd").val() !== "") {
            $("#crpwd").keyup(()=> {
                if ($("#crpwd").val() === $("#rpwd").val()) {
                    $('#crpwd').css("border", "1px solid #555");
                    $(".crpwdValMsg").html("");
                    fields.pwdVal = true;
                } else {
                    $('#crpwd').css("border", "1px solid rgb(255, 51, 51)");
                    $(".crpwdValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> Passwords did no match");
                    fields.pwdVal = false;
                }
            });
        }
        else {
            $('#crpwd').css("border", "1px solid #555");
            $(".crpwdValMsg").html("");
        }
    });

    $(".regForm").submit(()=>{
        if(fields.emailVal && fields.pwdVal){
            return true;
        }
        else{
            alert("Sorry, we couldn't register account.")
            return false;
        }
    });

    $(".checkPwd").focusin(()=> {
        $(".checkPwd").css("padding", "0 1.75rem 0 0.25rem");
        if ($(".checkPwd").prop('type') === "password") {
            $(".togglePwdView").html('<i class="fa-solid fa-eye-slash"></i>');
            $(".togglePwdView").css("right", "0.25rem");
        } else {
            $(".togglePwdView").html('<i class="fa-solid fa-eye"></i>');
            $(".togglePwdView").css("right", "0.3125rem");
        }
    });

    $(".checkCPwd").focusin(()=> {
        $(".checkCPwd").css("padding", "0 1.75rem 0 0.25rem");
        if ($(".checkCPwd").prop('type') === "password") {
            $(".toggleCPwdView").html('<i class="fa-solid fa-eye-slash"></i>');
            $(".toggleCPwdView").css("right", "0.25rem");
        } else {
            $(".toggleCPwdView").html('<i class="fa-solid fa-eye"></i>');
            $(".toggleCPwdView").css("right", "0.3125rem");
        }
    });
    $(".checkPwd").focusin(()=> {
        $(".checkPwd").css("padding", " 0 0.25rem");
    });
    $(".checkCPwd").focusin(()=> {
        $(".checkCPwd").css("padding", " 0 0.25rem");
    });

    $(".togglePwdView").click(()=> {
        fields.clicked = true;
        if ($(".checkPwd").prop('type') === "password") {
            $(".togglePwdView").html('<i class="fa-solid fa-eye"></i>');
            $(".togglePwdView").css("right", "0.3125rem")
            $(".checkPwd").prop('type', 'text');
        } else {
            $(".togglePwdView").html('<i class="fa-solid fa-eye-slash"></i>');
            $(".togglePwdView").css("right", "0.25rem")
            $(".checkPwd").prop('type', 'password');
        }
    });

    $(".toggleCPwdView").click(()=> {
        fields.clicked = true;
        if ($(".checkCPwd").prop('type') === "password") {
            $(".toggleCPwdView").html('<i class="fa-solid fa-eye"></i>');
            $(".toggleCPwdView").css("right", "0.3125rem")
            $(".checkCPwd").prop('type', 'text');
        } else {
            $(".toggleCPwdView").html('<i class="fa-solid fa-eye-slash"></i>');
            $(".toggleCPwdView").css("right", "0.25rem")
            $(".checkCPwd").prop('type', 'password');
        }
    });

    function defaultChanges() {
        fields.emailVal = false;
        fields.pwdVal = false;
        $(".checkPwd").prop('type', 'password');
        $(".checkCPwd").prop('type', 'password');
        $(".togglePwdView").html('');
        $(".toggleCPwdView").html('');
        $(":input").val("");
        $(':input').css("border", "1px solid #555");
        $(".errMsg").html("");
    }

    $("#signup").click(()=> {
        $(".log").css("display", "none");
        $(".reg").fadeIn(500);
        defaultChanges();
    });
    $("#signin").click(()=> {
        $(".reg").css("display", "none");
        $(".log").fadeIn(500);
        defaultChanges();
    });
});