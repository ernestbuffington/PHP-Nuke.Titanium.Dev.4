function phpbbmail (host, user) {
    var res = ""
    var res_h = ""
    for (var n = 0; n < user.length; n++)
        res += String.fromCharCode(user.charCodeAt(n));
    for (var n = 0; n < host.length; n++)
        res_h += String.fromCharCode(host.charCodeAt(n));
    if (res.indexOf('@') < 0 )
        res = res + '@' + res_h;
     location = "mail" + "to:" + res;
}