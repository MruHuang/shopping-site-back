        
function putCookies() {
    var commodity_name = document.getElementById('commodity_name').value;
    var commodity_price = document.getElementById('commodity_price').value;
    var original_price = document.getElementById('original_price').value;
    var commodity_amount = document.getElementById('commodity_amount').value;
    var commodity_introduction = document.getElementById('commodity_introduction').value;
    var commodity_video = document.getElementById('commodity_video').value;

    document.cookie = "commodity_name="+commodity_name;
    document.cookie = "commodity_price="+commodity_price;
    document.cookie = "original_price="+original_price;
    document.cookie = "commodity_amount="+commodity_amount;
    document.cookie = "commodity_introduction="+commodity_introduction;
    document.cookie = "commodity_video="+commodity_video;
    return true;
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function getHtmlCookies(){
    document.getElementById('commodity_name').value=getCookie('commodity_name');
    document.getElementById('commodity_price').value=getCookie('commodity_price');
    document.getElementById('original_price').value=getCookie('original_price');
    document.getElementById('commodity_amount').value=getCookie('commodity_amount');
    document.getElementById('commodity_introduction').value=getCookie('commodity_introduction');
    document.getElementById('commodity_video').value=getCookie('commodity_video');
}

