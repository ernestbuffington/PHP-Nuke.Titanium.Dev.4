var reimg_version = 1.000005;
var reimg_imagepopupviewer = reimage_viewer;
var reimg_css = '  .reimg { width: 1px; height: 1px; visibility: hidden; }';
if (window.reimg_maxWidth) {
    if (window.reimg_swapPortrait) {
        reimg_css += '.reimg-width-portrait { width: auto; height: ' + reimg_maxWidth + 'px; }'
    }
}
if (window.reimg_maxHeight) {
    reimg_css += '.reimg-height { width: auto; height: ' + reimg_maxHeight + 'px; }'
    if (window.reimg_swapPortrait) {
        reimg_css += '.reimg-height-portrait { width: ' + reimg_maxHeight + 'px; height: auto; }'
    }
}
if (window.reimg_relWidth) {
    reimg_css += '.reimg-rel { width: ' + reimg_relWidth + '%; height: auto; }'
}
if (window.reimg_autoLink) {
    reimg_css += '.reimg-link { cursor: pointer !important; }'
}
if (window.reimg_zoomImg) {
    reimg_css += 'span.reimg-zoom { position: absolute; margin: 1px; }'
    reimg_css += 'img.reimg-zoom { border: none !important; cursor: pointer !important;' + (window.reimg_zoomStyle ? ' ' + reimg_zoomStyle : '') + ' }'
    if (window.reimg_zoomHover) {
        reimg_css += 'img.reimg-zoom:hover { ' + reimg_zoomHover + ' }'
    }
}
reimg_css += '.reimg-loading { border: none !important;' + (window.reimg_loadingStyle ? ' ' + reimg_loadingStyle : '') + ' }'
if (window.reimg_borderBackground) {
    reimg_css += '.reimg-link { border: 2px solid rgb(0, 102, 153); padding: 2px; background-color: white; }'
}
var head = document.head || document.getElementsByTagName('head')[0];
var style = document.createElement('style');
style.type = 'text/css';
style.appendChild(document.createTextNode(reimg_css));
head.appendChild(style);
var reimg_opera = 0;
if (window.opera && window.navigator && window.navigator.userAgent) {
    var reimg_opera_match = window.navigator.userAgent.match(/\bOpera\/([\d.]+)/);
    if (reimg_opera_match) {
        reimg_opera = reimg_opera_match[1];
    }
}
var reimg_msie = 0;
if (window.navigator && window.navigator.userAgent) {
    var reimg_msie_match = window.navigator.userAgent.match(/\bMSIE ([\d.]+)/);
    if (reimg_msie_match) {
        reimg_msie = reimg_msie_match[1];
    }
}
var reimg_zoomLink = null;
var reimg_realSize = new Array();

function reimg_zoomIn(e) {
    if (!e) {
        e = window.event;
    }
    target = this;
    if (e) {
        if (target == window) {
            target = e.target ? e.target : e.srcElement;
        }
        if (typeof(e.stopPropagation) != "undefined") {
            e.stopPropagation();
        } else {
            e.cancelBubble = true;
        }
    }
    if (!target) {
        return false;
    }
    if (!reimg_zoomLink) {
        reimg_zoomLink = document.createElement("a");
        reimg_zoomLink.setAttribute('data-' + reimage_viewer, '');
        reimg_zoomLink.rel = "nofollow";
        if (window.reimg_zoomTarget == "_blank") {
            try {
                reimg_zoomLink.target = "_blank";
            } catch (err) {}
        }
        document.body.appendChild(reimg_zoomLink);
    }
    if (target.className.match(/(^|\s)reimg-zoom(\s|$)/)) {
        reimg_zoomLink.href = target.parentNode.nextSibling.src;
    } else {
        reimg_zoomLink.href = target.src;
    }
    if (window.reimg_zoomTarget == "_blank") {
        if (reimg_zoomLink.target && typeof(reimg_zoomLink.click) != "undefined") {
            reimg_zoomLink.click();
        } else {
            window.open(reimg_zoomLink.href);
        }
    } else {
        window.location.href = reimg_zoomLink.href;
    }
    return false;
}
reimg_toDo = null;

function reimg_resize(img, realWidth, realHeight, passLevel) {
    if (!reimg_toDo) {
        reimg_toDo = new Array();
    }
    if (!img) {
        return;
    }
    if (img.readyState == "complete" && img.complete && !passLevel && reimg_msie < 9.0) {
        return;
    }
    if (!passLevel) {
        passLevel = 0;
    }
    var maxWidth = window.reimg_maxWidth;
    var maxHeight = window.reimg_maxHeight;
    var relWidth = 0;
    if (window.reimg_relWidth && !realWidth && !realHeight) {
        var div = document.createElement("div");
        div.style.width = reimg_relWidth + "%";
        div.style.height = "1px";
        div.style.visibility = "hidden";
        img.parentNode.insertBefore(div, img);
        relWidth = div.offsetWidth;
        img.parentNode.removeChild(div);
    }
    img.style.visibility = "hidden";
    var className = img.className;
    if (className) {
        img.className = className.replace(/(^|.*\s)reimg(\s+(.*)|$)/, '$1$3');
    }
    var fileName = img.parentNode.href;
    if (fileName) {
        var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        switch (fileExtension) {
            case 'jpg':
            case 'gif':
            case 'png':
                if (img.parentNode.className == 'postlink') {
                    img.parentNode.className = reimg_imagepopupviewer;
                    img.className = 'reimg-both';
                }
                break;
        }
    }
    var width = img.width;
    var height = img.height;
    if (!width) {
        console.log(img.src);
        img.src = "images/noimage.png";
    } else {
        if (!(width && height) && passLevel >= 1 && reimg_ajax_url && img.src) {
            var dimensions = get_dimensions_ajax(img.src);
            if (dimensions) {
                if (dimensions.length == 2) {
                    realWidth = width = dimensions[0];
                    realHeight = height = dimensions[1];
                }
            }
        }
        if (!(width && height)) {
            if (passLevel < 1) {
                reimg_toDo[reimg_toDo.length] = [img, realWidth, realHeight];
                if (className) {
                    img.className = className;
                }
            } else {
                if (img.previousSibling && img.previousSibling.className && img.previousSibling.className.match(/(^|\s)reimg-loading(\s|$)/)) {
                    img.parentNode.removeChild(img.previousSibling);
                }
            }
            img.style.visibility = "";
            return;
        }
        if (img.previousSibling && img.previousSibling.className && img.previousSibling.className.match(/(^|\s)reimg-loading(\s|$)/)) {
            img.parentNode.removeChild(img.previousSibling);
        }
        var swap;
        if (window.reimg_swapPortrait && height > width) {
            swap = true;
            if (!(img.height && img.width)) {
                var width_tmp = width;
                var height_tmp = height;
                width = height_tmp;
                height = width_tmp;
            } else {
                width = img.height;
                height = img.width;
            }
        } else {
            swap = false;
        }
        var relForce = false;
        if (relWidth) {
            img.style.width = reimg_relWidth + "%";
            if (!reimg_opera || reimg_opera >= 9.5) {
                if (img.offsetWidth && img.offsetWidth > relWidth) {
                    relForce = true;
                }
            } else {
                relForce = true;
            }
            img.style.width = "";
            if (!maxWidth || relWidth < maxWidth) {
                maxWidth = relWidth;
            } else {
                relWidth = 0;
            }
        }
        if (window.reimg_swapPortrait && maxWidth && maxHeight && maxHeight > maxWidth) {
            maxWidth += maxHeight;
            maxHeight = maxWidth - reimg_maxHeight;
            maxWidth -= maxHeight;
        }
        className = "";
        if (maxWidth && width > maxWidth) {
            height = Math.round(height / (width / maxWidth));
            width = maxWidth;
            if (height && maxHeight && height > maxHeight) {
                width = Math.round(width / (height / maxHeight));
                height = maxHeight;
                className = "reimg-both";
                relWidth = 0;
            } else if (relForce) {
                className = "reimg-rel-force";
                relWidth = 0;
            } else {
                className = "reimg-" + (relWidth ? "rel" : "width") + (swap ? "-portrait" : "");
            }
        } else if (maxHeight && height > maxHeight) {
            width = Math.round(width / (height / maxHeight));
            height = maxHeight;
            if (width && maxWidth && width > maxWidth) {
                height = Math.round(height / (width / maxWidth));
                width = maxWidth;
                className = "reimg-both";
            } else if (relForce) {
                className = "reimg-rel-force";
            } else {
                className = "reimg-height" + (swap ? "-portrait" : "");
            }
            relWidth = 0;
        }
        if (swap) {
            width += height;
            height = width - height;
            width -= height;
        }
        if (!(className || (realWidth && realWidth > width) || (realHeight && realHeight > height))) {
            img.style.visibility = "";
            return;
        }
        if (!realWidth) {
            realWidth = img.width;
        }
        if (!realHeight) {
            realHeight = img.height;
        }
        if (relWidth) {
            img.style.maxWidth = ((window.reimg_maxWidth && reimg_maxWidth < img.width) ? reimg_maxWidth : realWidth) + "px";
        }
        if (className) {
            if (img.style.width) {
                img.style.width = "";
            }
            if (img.style.height) {
                img.style.height = "";
            }
            img.className = (img.className ? img.className + " " : "") + className;
        }
        img.width = width;
        img.height = height;
        img.style.visibility = "";
        if (window.reimg_autoLink) {
            var parent = img.parentNode;
            while (parent && parent.tagName) {
                var tag = parent.tagName.toLowerCase();
                if (tag == "a" && parent.href) {
                    break;
                }
                if (tag == "div" || tag == "td" || tag == "body") {
                    parent = null;
                    break;
                }
                parent = parent.parentNode;
            }
            if (!parent) {
                if (window.reimg_zoomAlt) {
                    img.title = reimg_zoomAlt.replace(/%1\$d/, realWidth).replace(/%2\$d/, realHeight);
                }
                img.className = (img.className ? img.className + " " : "") + "reimg-link";
                if (typeof(img.addEventListener) != "undefined") {
                    img.addEventListener("click", reimg_zoomIn, false);
                } else if (typeof(img.attachEvent) != "undefined") {
                    img.attachEvent("onclick", reimg_zoomIn);
                }
            }
        }
        if (window.reimg_zoomImg) {
            if (img.previousSibling && (!img.previousSibling.tagName || img.previousSibling.tagName.toLowerCase() != "br")) {}
            var span = document.createElement("span");
            var zoom = document.createElement("img");
            zoom.src = reimg_zoomImg;
            if (window.reimg_zoomAlt) {
                zoom.alt = "";
            } else {
                zoom.alt = "";
            }
            zoom.className = span.className = "reimg-zoom";
            zoom.onclick = reimg_zoomIn;
            span.appendChild(zoom);
            img.parentNode.insertBefore(span, img);
        }
    }
}
var reimg_preLoadLoadingImg;

function reimg_loading(imgOrPassLevel) {
    if (!window.reimg_loadingImg) {
        return;
    }
    if (imgOrPassLevel != 1) {
        if (imgOrPassLevel && !reimg_preLoadLoadingImg) {
            reimg_preLoadLoadingImg = document.createElement("img");
            reimg_preLoadLoadingImg.src = imgOrPassLevel;
        }
        if (window.reimg_loadingImg && typeof(window.setTimeout) != "undefined") {
            window.setTimeout("reimg_loading(1);", 1000);
        }
        return;
    }
    var images = document.getElementsByTagName("img");
    if (images) {
        var loading = new Array();
        for (var i = 0; i < images.length; i++) {
            if (images[i].className.match(/(^|\s)reimg(\s|$)/)) {
                loading[loading.length] = images[i];
            }
        }
        for (var i = 0; i < loading.length; i++) {
            var img = document.createElement("img");
            img.src = reimg_loadingImg;
            if (window.reimg_loadingAlt) {
                img.alt = img.title = reimg_loadingAlt;
            } else {
                img.alt = "";
            }
            img.className = "reimg-loading";
            loading[i].parentNode.insertBefore(img, loading[i]);
        }
    }
}

function reimg_onLoad(e) {
    if (reimg_toDo) {
        for (var i = 0; i < reimg_toDo.length; i++) {
            reimg_resize(reimg_toDo[i][0], reimg_toDo[i][1], reimg_toDo[i][2], 1);
        }
        reimg_toDo = null;
    } else {
        var images = document.getElementsByTagName("img");
        if (images) {
            for (var i = 0; i < images.length; i++) {
                if (images[i].className.match(/(^|\s)reimg(\s|$)/)) {
                    reimg_resize(images[i], null, null, 1);
                }
            }
        }
    }
    return true;
}

function get_dimensions_ajax(imgsrc) {
    var returnary = false;
    var dimensions_request = false;
    if (window.XMLHttpRequest) {
        dimensions_request = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        try {
            dimensions_request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                dimensions_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }
    if (!dimensions_request) {
        return false;
    }
    dimensions_request.onreadystatechange = function() {
        if (dimensions_request.readyState == 4) {
            if (dimensions_request.status == 200) {
                returnary = dimensions_request.responseText.split('||');
            }
        }
    };
    dimensions_request.open('GET', reimg_ajax_url + '?img=' + escape(imgsrc), false);
    dimensions_request.send(null);
    return returnary;
}
if (window.onload_functions) {
    onload_functions[onload_functions.length] = "reimg_onLoad();";
} else if (typeof(window.addEventListener) != "undefined") {
    window.addEventListener("load", reimg_onLoad, false);
} else if (typeof(window.attachEvent) != "undefined") {
    window.attachEvent("onload", reimg_onLoad);
}