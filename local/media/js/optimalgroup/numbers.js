OptimalGroup.number_format = function (e, t, n, i) {
    var r, o, s, a, l, u = "",
        t = '0',
        n = ' ',
        i = ' ';
    t = Math.abs(t);
    if (isNaN(t) || t < 0) {
        t = 2
    }
    n = n || ",";
    i = i || ".";
    e = (+e || 0).toFixed(t);
    if (e < 0) {
        u = "-";
        e = -e
    }
    r = parseInt(e, 10) + "";
    o = r.length > 3 ? r.length % 3 : 0;
    l = o ? r.substr(0, o) + i : "";
    s = r.substr(o).replace(/(\d{3})(?=\d)/g, "$1" + i);
    a = t ? n + Math.abs(e - r).toFixed(t).replace(/-/, "0").slice(2) : "";
    return u + l + s + a
};
OptimalGroup.plural = function (num, expressions) {
    var result;
    count = num % 100;
    if (count >= 5 && count <= 20) {
        result = expressions['2'];
    } else {
        count = count % 10;
        if (count == 1) {
            result = expressions['0'];
        } else if (count >= 2 && count <= 4) {
            result = expressions['1'];
        } else {
            result = expressions['2'];
        }
    }
    return result;
}
