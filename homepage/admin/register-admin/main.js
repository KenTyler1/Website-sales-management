

//function tham khảo
$(document).ready(function (e) {

    $("#reg-form").submit(function (event) {
        let $password = $("#password");
        let $confirm = $("#confirm_pwd");
        let $error = $("#confirm_error");
        if($password.val() === $confirm.val()){
            return true;
        }else{
            $error.text("Mật khẩu không khớp");
            event.preventDefault();
        }
    });

});
