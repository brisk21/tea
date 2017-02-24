var getArgs = (function() {
    var sc = document.getElementsByTagName("script");
    var paramsArr = sc[sc.length - 1].src.split('?')[1].split('&');
    var args = {},
    argsStr = [],
    param,
    t,
    name,
    value;
    for (var ii = 0, len = paramsArr.length; ii < len; ii++) {
        param = paramsArr[ii].split('=');
        name = param[0],
        value = param[1];
        if (typeof args[name] == "undefined") {
            args[name] = value;
        } else if (typeof args[name] == "string") {
            args[name] = [args[name]];
            args[name].push(value);
        } else {
            args[name].push(value);
        }
    }
    return function() {
        return args;
    }
})();
document.writeln("<div id=\"wfdd\" style=\"text-align:center;margin:0 auto;\"><iframe id=\"wforder\" src=\"wforder\/template\/dd_" + getArgs()["wfid"] + ".html\" width=\"100%\" marginheight=\"0\" marginwidth=\"0\" frameborder=\"0\" scrolling=\"no\" onload=\"reinitwforder()\"><\/iframe><\/div>");
function reinitwforder() {
    var iframe = document.getElementById("wforder");
    try {
        var bHeight = iframe.contentWindow.document.body.scrollHeight;
        var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;
        var height = Math.max(bHeight, dHeight);
        iframe.height = height;
    } catch(ex) {}
}