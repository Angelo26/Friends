
$(document).ready(()=> {

    const fields = {unameVal: false, emailVal: false, pwdVal: false, cpwdVal: false};
    const patterns = {
        uname:/^[\w]{3,}$/,
        email: /^([a-zA-Z\d\.-_])+@[a-z\d-]+\.([a-z]{2,7})(\.[a-z]{2,5})?$/,
        rpwd: {
            size: /^.{8,}$/,
            capital: /[A-Z]+/,
            number: /\d+/,
            special: /[!"#\$%&'\(\)\*\+,-\.\/:;<=>\?@\[\\\]\^_`\{\|\}~]+/
        }
    };


    $(".logForm").submit(()=>{
        const ulname = $('#ulname').val();
        const ulpwd = $('#lpwd').val();
        $.post("includes/signin.inc.php", {uname:ulname,upwd:ulpwd}, (data)=>{ 
            if (data < 1){
                $("#ulname").css("border", "1px solid rgb(255, 51, 51)");
                $(".ulnameValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> User doesn't exist");
                $(".ulnameValMsg").fadeOut(5000);
                setTimeout(()=>{$("#ulname").css("border", "1px solid #555");},4000);
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
                    return true;
                }
            }
        });
        return false;
    });

    $("#uname").focusout(()=> {
        if ($("#uname").val() !== "") {
            const uname = $('#uname').val();
            
            if (patterns.uname.test($("#uname").val())) {
                $.post("includes/checkEmailReg.inc.php", {uname:uname}, (data)=>{ 
                    console.log(data);
                    if (data < 1){
                        $('#uname').css("border", "1px solid #555");
                        $(".unameValMsg").html("");
                        fields.unameVal = true;
                    }
                    else{
                        $('#uname').css("border", "1px solid rgb(255, 51, 51)");
                        $(".unameValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> Username taken");

                        fields.unameVal = false;
                    }
                });
            }
            else {
                $('#uname').css("border", "1px solid rgb(255, 51, 51)");
                $(".unameValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> eg. John_Doe23, John12");
                fields.unameVal = false;
            }
        }
        else {
            $('#uname').css("border", "1px solid #555");
            $(".unameValMsg").html("");
        }
    });



    $("#email").focusout(()=> {
        if ($("#email").val() !== "") {
            const uemail = $('#email').val();
            
            if (patterns.email.test($("#email").val())) {
                $.post("includes/checkEmailReg.inc.php", {email:uemail}, (data)=>{ 
                
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

    $("#rpwd").keyup(()=> {
        if ($("#rpwd").val() !== "") {
            if (patterns.rpwd.size.test($("#rpwd").val()) && patterns.rpwd.capital.test($("#rpwd").val()) && patterns.rpwd.number.test($("#rpwd").val()) && patterns.rpwd.special.test($("#rpwd").val())) {
                $('#rpwd').css("border", "1px solid #555");
                $(".rpwdValMsg").html("");
                fields.pwdVal = true;

            } else {
                $('#rpwd').css("border", "1px solid rgb(255, 51, 51)");
                $(".rpwdValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> Include atleast 8 characters, a number, a capital letter and a special charater");
                fields.pwdVal = false;
            }

            if(fields.cpwdVal){
                $("#rpwd").keyup(()=>{
                    crpwdCheck();
                });
            }

        }
        else {
            $('#rpwd').css("border", "1px solid #555");
            $(".rpwdValMsg").html("");
        }
    });

    $("#crpwd").keyup(()=> {
        if ($("#crpwd").val() !== "" && $("#rpwd").val() !== "") {
            const regPwd = $("#rpwd").val();
            const arrRpwd = [...regPwd];
            const confirmPwd = $("#crpwd").val();
            const arrCpwd = [...confirmPwd];
            
            if(arrRpwd[arrCpwd.length-1] === arrCpwd[arrCpwd.length-1]){
                

                $('#crpwd').css("border", "1px solid #555");
                $(".crpwdValMsg").html("");
                
                if ($("#crpwd").val() === $("#rpwd").val()) {
                    fields.cpwdVal = true;
                }
                else{
                    fields.cpwdVal = false;
                }
            }
            else{
                $('#crpwd').css("border", "1px solid rgb(255, 51, 51)");
                $(".crpwdValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> Passwords did no match");
                fields.cpwdVal = false;
            }
        }
        else {
            $('#crpwd').css("border", "1px solid #555");
            $(".crpwdValMsg").html("");
        }
    });

    $("#rpwd").focusout(()=> {
        crpwdCheck();
    });

    $("#crpwd").focusout(()=> {
        crpwdCheck();
    });

    function crpwdCheck(){
        if ($("#crpwd").val() !== ""){
            if ($("#crpwd").val() === $("#rpwd").val()) {
                $('#crpwd').css("border", "1px solid #555");
                $(".crpwdValMsg").html("");
                fields.cpwdVal = true;
            } else {
                $('#crpwd').css("border", "1px solid rgb(255, 51, 51)");
                $(".crpwdValMsg").html("<i class='fa-solid fa-circle-exclamation'></i> Passwords did no match");
                fields.cpwdVal = false;
            }
        }
    }

    $(".regForm").submit(()=>{
        crpwdCheck();
        if(fields.unameVal && fields.emailVal && fields.pwdVal && fields.cpwdVal){
            return true;
        }
        else{
            return false;
        }
    });

    $(".checkPwd").focusin(()=> {
        if ($(".checkPwd").prop('type') === "password") {
            $(".togglePwdView").html('<i class="fa-solid fa-eye-slash"></i>');
            $(".togglePwdView").css("right", "0.25rem");
        } else {
            $(".togglePwdView").html('<i class="fa-solid fa-eye"></i>');
            $(".togglePwdView").css("right", "0.3125rem");
        }
    });

    $(".checkCPwd").focusin(()=> {
        if ($(".checkCPwd").prop('type') === "password") {
            $(".toggleCPwdView").html('<i class="fa-solid fa-eye-slash"></i>');
            $(".toggleCPwdView").css("right", "0.25rem");
        } else {
            $(".toggleCPwdView").html('<i class="fa-solid fa-eye"></i>');
            $(".toggleCPwdView").css("right", "0.3125rem");
        }
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
        fields.cpwdVal = false;
        fields.index = 0;
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