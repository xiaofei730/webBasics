//表单验证对象
var formValiad = {
    //检测用户名
    checkUserName: function(){
        var userName = document.getElementById("user");
        var userInfo = document.getElementById("userInfo");
        var pattern = /^\w{6,}$/;
        if(userName.value.length == 0){
            userInfo.innerHTML = "用户名不为空";
            userInfo.className = "error";
            return false;
        }
        if(!pattern.test(userName.value)){
            userInfo.innerHTML = "用户名不合法";
            userInfo.className = "error";
            return false;
        }else{
            userInfo.innerHTML = "OK";
            userInfo.className = "success";
            return true;
        }
    },
    //检测密码
    checkPassword: function(){
        var pwd = document.getElementById("pwd");
        var pwdInfo = document.getElementById("pwdInfo");
        var pattern = /^\w{6,10}$/;
        if(pwd.value.length == 0){
            pwdInfo.innerHTML = "密码不为空";
            pwdInfo.className = "error";
            return false;
        }
        if(!pattern.test(pwd.value)){
            pwdInfo.innerHTML = "密码不合法";
            pwdInfo.className = "error";
            return false;
        }else{
            pwdInfo.innerHTML = "OK";
            pwdInfo.className = "success";
            return true;
        }
    },
    //检测确认密码
    checkConfirmPassword: function(){
        var agpwd = document.getElementById("agpwd");
        var pwd = document.getElementById("pwd");
        var agpwdInfo = document.getElementById("agpwdInfo");
        var pattern = /^\w{6,10}$/;
        if(agpwd.value.length == 0){
            agpwdInfo.innerHTML = "密码不为空";
            agpwdInfo.className = "error";
            return false;
        }
        if(!pattern.test(agpwd.value)){
            agpwdInfo.innerHTML = "密码不合法";
            agpwdInfo.className = "error";
            return false;
        }else if(pwd.value != agpwd.value){
            agpwdInfo.innerHTML = "两次密码不一致";
            agpwdInfo.className = "error";
            return false;
        }else{
            agpwdInfo.innerHTML = "OK";
            agpwdInfo.className = "success";
            return true;
        }
    },
    //检测手机号码
    checkPhone: function(){
        var phone = document.getElementById("phone");
        var phoneInfo = document.getElementById("phoneInfo");
        var pattern = /^1[3456789]\d{9}$/;
        if(phone.value.length == 0){
            phoneInfo.innerHTML = "手机号不为空";
            phoneInfo.className = "error";
            return false;
        }
        if(!pattern.test(phone.value)){
            phoneInfo.innerHTML = "手机号不合法";
            phoneInfo.className = "error";
            return false;
        }else{
            phoneInfo.innerHTML = "OK";
            phoneInfo.className = "success";
            return true;
        }
    },
    //表单提交验证
    checkForm: function(){
        var userRes = this.checkUserName();
        var pwdRes = this.checkPassword();
        var agpPwdRes = this.checkConfirmPassword();
        var phoneRes = this.checkPhone();

        return userRes && pwdRes && agpPwdRes && phoneRes;
    },
    //表单重置方法
    reset: function(){
        var userInfo = document.getElementById("userInfo");
        var pwdInfo = document.getElementById("pwdInfo");
        var agpwdInfo = document.getElementById("agpwdInfo");
        var phoneInfo = document.getElementById("phoneInfo");

        userInfo.className = pwdInfo.className = agpwdInfo.className = phoneInfo.className = "";
        userInfo.innerHTML = "请输入至少6位用户名";
        pwdInfo.innerHTML = "请输入6-10位密码";
        agpwdInfo.innerHTML = "请输入6-10位密码";
        phoneInfo.innerHTML = "请输入11位手机号码";
    }
}