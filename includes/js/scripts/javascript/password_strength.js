function strengthhelp() {
     window.open ('includes/passhelp.php','PasswordStrenghtMeter','toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=200');
}

function chkpwd(w) {
    var StrengthValue
    StrengthValue = 0;

    pwd_upper_case = /[A-Z]/;          // a uppercase letter present
    pwd_lower_case = /[a-z]/;          // a lowercase letter present
    pwd_digit = /\d/;             // a digit present
    pwd_other = /\W/;             // a non letter or digit present
    pwd_length = /^[a-z\d\W]{10,}$/i;

    if (pwd_upper_case.test(w) == true) {StrengthValue = StrengthValue + 1;};
    if (pwd_lower_case.test(w) == true) {StrengthValue = StrengthValue + 1;};
    if (pwd_digit.test(w) == true) {StrengthValue = StrengthValue + 1;};
    if (pwd_other.test(w) == true) {StrengthValue = StrengthValue + 1;};
    if (pwd_length.test(w) == true) {StrengthValue = StrengthValue + 1;};

    document.getElementById("divTEMP").innerHTML = window.pwd_strength + StrengthValue + "/5";

    if (StrengthValue == 0) {
    document.getElementById("div1").innerHTML = "";
    document.getElementById("div2").innerHTML = "";
    document.getElementById("div3").innerHTML = window.pwd_notrated;
    document.getElementById("div4").innerHTML = "";
    document.getElementById("div5").innerHTML = "";
    document.getElementById("td1").style.backgroundColor = "#EBEBEB";
    document.getElementById("td2").style.backgroundColor = "#EBEBEB";
    document.getElementById("td3").style.backgroundColor = "#EBEBEB";
    document.getElementById("td4").style.backgroundColor = "#EBEBEB";
    document.getElementById("td5").style.backgroundColor = "#EBEBEB";
    };

    if (StrengthValue == 1) {
    document.getElementById("div1").innerHTML = window.pwd_weak;
    document.getElementById("div2").innerHTML = "";
    document.getElementById("div3").innerHTML = "";
    document.getElementById("div4").innerHTML = "";
    document.getElementById("div5").innerHTML = "";
    document.getElementById("td1").style.backgroundColor = "#FF4545";
    document.getElementById("td2").style.backgroundColor = "#EBEBEB";
    document.getElementById("td3").style.backgroundColor = "#EBEBEB";
    document.getElementById("td4").style.backgroundColor = "#EBEBEB";
    document.getElementById("td5").style.backgroundColor = "#EBEBEB";
    };

    if (StrengthValue == 2) {
    document.getElementById("div1").innerHTML = "";
    document.getElementById("div2").innerHTML = window.pwd_med;
    document.getElementById("div3").innerHTML = "";
    document.getElementById("div4").innerHTML = "";
    document.getElementById("div5").innerHTML = "";
    document.getElementById("td1").style.backgroundColor = "#FFFF33";
    document.getElementById("td2").style.backgroundColor = "#FFFF33";
    document.getElementById("td3").style.backgroundColor = "#EBEBEB";
    document.getElementById("td4").style.backgroundColor = "#EBEBEB";
    document.getElementById("td5").style.backgroundColor = "#EBEBEB";
    };

    if (StrengthValue == 3) {
    document.getElementById("div1").innerHTML = "";
    document.getElementById("div2").innerHTML = "";
    document.getElementById("div3").innerHTML = window.pwd_strong;
    document.getElementById("div4").innerHTML = "";
    document.getElementById("div5").innerHTML = "";
    document.getElementById("td1").style.backgroundColor = "#FFD35E";
    document.getElementById("td2").style.backgroundColor = "#FFD35E";
    document.getElementById("td3").style.backgroundColor = "#FFD35E";
    document.getElementById("td4").style.backgroundColor = "#EBEBEB";
    document.getElementById("td5").style.backgroundColor = "#EBEBEB";
    };

    if (StrengthValue == 4) {
    document.getElementById("div1").innerHTML = "";
    document.getElementById("div2").innerHTML = "";
    document.getElementById("div3").innerHTML = "";
    document.getElementById("div4").innerHTML = window.pwd_stronger;
    document.getElementById("div5").innerHTML = "";
    document.getElementById("td1").style.backgroundColor = "#66FF66";
    document.getElementById("td2").style.backgroundColor = "#66FF66";
    document.getElementById("td3").style.backgroundColor = "#66FF66";
    document.getElementById("td4").style.backgroundColor = "#66FF66";
    document.getElementById("td5").style.backgroundColor = "#EBEBEB";
    };

    if (StrengthValue == 5) {
    document.getElementById("div1").innerHTML = "";
    document.getElementById("div2").innerHTML = "";
    document.getElementById("div3").innerHTML = "";
    document.getElementById("div4").innerHTML = "";
    document.getElementById("div5").innerHTML = window.pwd_strongest;
    document.getElementById("div5").innerHTML.textColor =  "#3ABB1C";
    document.getElementById("td1").style.backgroundColor = "#3ABB1C";
    document.getElementById("td2").style.backgroundColor = "#3ABB1C";
    document.getElementById("td3").style.backgroundColor = "#3ABB1C";
    document.getElementById("td4").style.backgroundColor = "#3ABB1C";
    document.getElementById("td5").style.backgroundColor = "#3ABB1C";
    };

    if (w.length < 4) {
    document.getElementById("div1").innerHTML = "";
    document.getElementById("div2").innerHTML = "";
    document.getElementById("div3").innerHTML = window.pwd_notrated;
    document.getElementById("div4").innerHTML = "";
    document.getElementById("div5").innerHTML = "";
    document.getElementById("td1").style.backgroundColor = "#EBEBEB";
    document.getElementById("td2").style.backgroundColor = "#EBEBEB";
    document.getElementById("td3").style.backgroundColor = "#EBEBEB";
    document.getElementById("td4").style.backgroundColor = "#EBEBEB";
    document.getElementById("td5").style.backgroundColor = "#EBEBEB";
    };
}