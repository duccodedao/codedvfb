

function getPathFromUrl(url) {
    return url.split("?")[0];
}
function submitForm(url, method, href, api_token, data, button) {
    let textButton = button.html().trim();
    let setting = {
        type: method,
        url,
        data,
        dataType: "json",
        beforeSend: function () {
            button
                .prop("disabled", !0)
                .html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...'
                );
        },
        complete: function () {
            button.prop("disabled", !1).html(textButton);
        },
         success: function (response) {
            if (button.attr("callback")) {
                window[`${button.attr("callback")}`](response);
            }
            if (!button.attr("callback")) {
                swal(
                    response.message,
                    response.status === true ? "success" : "error"
                );
            }
            if (response.status === true && !button.attr("href") && !button.attr("callback")) {
                setTimeout(() => {
                    if (!href) {
                        window.location.reload();
                        return;
                    }
                    window.location.href = href;
                }, 2000);
            }
        },
        error: function (error) {
            console.log(error);
        },
    };
    if (api_token) {
        setting["headers"] = {
            "Api-Token": api_token,
        };
    }
    $.ajax(setting);
}

function swal(text, icon) {
    Swal.fire({
        heightAuto: false,
        icon,
        title: "Thông báo",
        text: text,
        confirmButtonText: "Tôi đã hiểu",
    });
}

function getTime() {
    return parseInt(new Date().getTime() / 1000);
}

function wait(t, e, n) {
    return e
        ? $(t).prop("disabled", !1).html(n)
        : $(t)
              .prop("disabled", !0)
              .html(
                  '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...'
              );
}

function formatNumber(nStr, decSeperate = ".", groupSeperate = ",") {
    nStr += "";
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? "." + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, "$1" + groupSeperate + "$2");
    }
    return x1 + x2;
}

function coppy(element) {
    window.getSelection().removeAllRanges();
    let range = document.createRange();
    range.selectNode(
        typeof element === "string" ? document.getElementById(element) : element
    );
    window.getSelection().addRange(range);
    document.execCommand("copy");
    window.getSelection().removeAllRanges();
    swal("Sao chép thành công", "success");
}

function statusOrder(status) {
    let msg = "";
    switch (status) {
        case "Success":
            msg =
                '<button type="button" class="btn btn-success btn-sm">Đã hoàn thành</button>';
            break;
        case "Pause":
            msg =
                '<button type="button" class="btn btn-danger btn-sm">Đã hủy</button>';
            break;
        case "Report":
            msg =
                '<button type="button" class="btn btn-warning btn-sm">Tạm dừng</button>';
            break;
        case "Refund":
            msg =
                '<button type="button" class="btn btn-success btn-sm">Đã hoàn tiền</button>';
            break;
        case "Waiting":
            msg =
                '<button type="button" class="btn btn-warning btn-sm">Chờ hủy</button>';
            break;
        case "Expired":
            msg =
                '<button type="button" class="btn btn-danger btn-sm">Đã hết hạn</button>';
            break;
        case "CookieDie":
            msg =
                '<button type="button" class="btn btn-danger btn-sm">Cookie die</button>';
            break;
        case "ProxyError":
            msg =
                '<button type="button" class="btn btn-warning btn-sm">Proxy lỗi</button>';
            break;
        default:
            msg =
                '<button type="button" class="btn btn-info btn-sm">Đang hoạt động</button>';
            break;
    }
    return msg;
}

function timeCreated(date) {
    return moment(date).format("YYYY-MM-DD HH:mm:ss");
}
function isURL(str) {
    var regex =
        /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
    var pattern = new RegExp(regex);
    return pattern.test(str);
}

function cancelOrder(url, code_order, id, fee = false) {
    let m = `Bạn có muốn hủy đơn ${code_order} ?, chúng tôi sẽ không hoàn tiền cho đơn đã hủy!`;
    if (fee) {
        m = `Sau khi hủy đơn ${code_order} bạn sẽ được hoàn lại số lượng chưa hoàn thành và trừ ${cancel_order} coin phí hủy đơn tránh Spam?`;
    }
    Swal.fire({
        title: "Xác nhận!",
        text: m,
        icon: "warning",
        showCancelButton: true,
        // confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Tôi đồng ý",
        cancelButtonText: "Đóng",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url,
                headers: {
                    "Api-Token": profile.api_token,
                },
                data: {
                    id,
                },
                dataType: "json",
                success: function (response) {
                    swal(
                        response.message,
                        response.status === true ? "success" : "error"
                    );
                    if (response.status === true) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                },
            });
        }
    });
}

function reportOrder(url, code_order, id) {
    Swal.fire({
        title: "Xác nhận!",
        text: `Bạn đã khắc phục lỗi đơn ở mục chi tiết và muốn kích hoạt đơn: ${code_order} ?`,
        icon: "warning",
        showCancelButton: true,
        // confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Tôi đồng ý",
        cancelButtonText: "Đóng",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url,
                headers: {
                    "Api-Token": profile.api_token,
                },
                data: {
                    id,
                },
                dataType: "json",
                success: function (response) {
                    swal(
                        response.message,
                        response.status === true ? "success" : "error"
                    );
                    if (response.status === true) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                },
            });
        }
    });
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function convert_to_id(link) {
    var result = null;
    link = link.trim();
    var post_id = link["match"](/(.*)\/posts\/([0-9]{8,})/);
    var photo_id = link["match"](/(.*)\/photo.php\?fbid=([0-9]{8,})/);
    var photo_id_2 = link["match"](/(.*)\/photo\?fbid=([0-9]{8,})/);
    var photo_id_3 = link["match"](/(.*)\/photo\/\?fbid=([0-9]{8,})/);
    var video_id = link["match"](/(.*)\/video.php\?v=([0-9]{8,})/);
    var story_id = link["match"](/(.*)\/story.php\?story_fbid=([0-9]{8,})/);
    var link_id = link["match"](/(.*)\/permalink.php\?story_fbid=([0-9]{8,})/);
    var other_id = link["match"](/(.*)\/([0-9]{8,})/);
    var other_id_2 = link["match"](/^[0-9.]+$/);
    var comment_id = link["match"](/(.*)comment_id=([0-9]{8,})/);

    if (post_id) {
        return (result = post_id[2]);
    }

    if (photo_id) {
        return (result = photo_id[2]);
    }

    if (video_id) {
        return (result = video_id[2]);
    }

    if (story_id) {
        return (result = story_id[2]);
    }

    if (link_id) {
        return (result = link_id[2]);
    }

    if (other_id) {
        return (result = other_id[2]);
    }

    if (other_id_2) {
        return (result = other_id_2[0]);
    }

    if (photo_id_2) {
        return (result = photo_id_2[2]);
    }

    if (photo_id_3) {
        return (result = photo_id_3[2]);
    }

    if (comment_id) {
        return (result += "_" + comment_id[2]);
    }
}

function igGetUsername(elm) {
    $("#buy").prop("disabled", true);
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        if (!isURL(link)) {
            $("#buy").prop("disabled", false);
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý");
        let username = link["match"](/instagram.com\/([a-zA-Z0-9_.-]+)/);
        if (username) {
            username = username[1];
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val(username);
        } else {
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val("");
        }
        $("#buy").prop("disabled", false);
    }, 100);
}

function igGetIdpost(elm) {
    $("#buy").prop("disabled", true);
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        if (!isURL(link)) {
            $("#buy").prop("disabled", false);
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý");
        let idpost = link["match"](/com\/p\/([a-zA-Z0-9_.-]+)/);
        if (idpost) {
            idpost = idpost[1];
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val(idpost);
        } else {
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val("");
        }
        $("#buy").prop("disabled", false);
    }, 100);
}

function ttGetUsername(elm) {
    $("#buy").prop("disabled", true);
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        if (!isURL(link)) {
            $("#buy").prop("disabled", false);
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý");
        let username = link["match"](/tiktok.com\/@([a-zA-Z0-9_.-]+)/);
        if (username) {
            username = username[1];
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val(username);
        } else {
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val("");
        }
        $("#buy").prop("disabled", false);
    }, 100);
}


function twtGetUsername(elm) {
    $("#buy").prop("disabled", true);
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        if (!isURL(link)) {
            $("#buy").prop("disabled", false);
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý");
        let username = link["match"](/twitter.com\/([a-zA-Z0-9_.-]+)/);
        if (username) {
            username = username[1];
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val(username);
        } else {
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val("");
        }
        $("#buy").prop("disabled", false);
    }, 100);
}



function submitForm(url, method, href, api_token, data, button) {
    let textButton = button.html().trim();
    let setting = {
        type: method,
        url,
        data,
        dataType: "json",
        beforeSend: function () {
            button
                .prop("disabled", !0)
                .html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...'
                );
        },
        complete: function () {
            button.prop("disabled", !1).html(textButton);
        },
        success: function (response) {
            if (button.attr("callback")) {
                window[`${button.attr("callback")}`](response);
            }
            swal(
                response.message,
                response.status === true ? "success" : "error"
            );
            if (response.status === true && !button.attr("href")) {
                setTimeout(() => {
                    if (!href) {
                        window.location.reload();
                        return;
                    }
                    window.location.href = href;
                }, 2000);
            }
        },
        error: function (error) {
            console.log(error);
        },
    };
    if (api_token) {
        setting["headers"] = {
            "Api-Token": api_token,
        };
    }
    $.ajax(setting);
}

function swal(text, icon) {
    Swal.fire({
        heightAuto: false,
        icon,
        title: "Thông báo",
        text: text,
        confirmButtonText: "Tôi đã hiểu",
    });
}

function getTime() {
    return parseInt(new Date().getTime() / 1000);
}

function wait(t, e, n) {
    return e
        ? $(t).prop("disabled", !1).html(n)
        : $(t)
            .prop("disabled", !0)
            .html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...'
            );
}

function formatNumber(nStr, decSeperate = ".", groupSeperate = ",") {
    nStr += "";
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? "." + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, "$1" + groupSeperate + "$2");
    }
    return x1 + x2;
}

function coppy(element) {
    window.getSelection().removeAllRanges();
    let range = document.createRange();
    range.selectNode(
        typeof element === "string" ? document.getElementById(element) : element
    );
    window.getSelection().addRange(range);
    document.execCommand("copy");
    window.getSelection().removeAllRanges();
    swal("Sao chép thành công", "success");
}

function statusOrder(status) {
    let msg = "";
    switch (status) {
        case "Success":
            msg =
                '<button type="button" class="btn btn-success btn-sm">Đã hoàn thành</button>';
            break;
        case "Pause":
            msg =
                '<button type="button" class="btn btn-danger btn-sm">Đã hủy</button>';
            break;
        case "Report":
            msg =
                '<button type="button" class="btn btn-warning btn-sm">Tạm dừng</button>';
            break;
        case "Refund":
            msg =
                '<button type="button" class="btn btn-success btn-sm">Đã hoàn tiền</button>';
            break;
        case "Waiting":
            msg =
                '<button type="button" class="btn btn-warning btn-sm">Chờ hủy</button>';
            break;
        case "Expired":
            msg =
                '<button type="button" class="btn btn-danger btn-sm">Đã hết hạn</button>';
            break;
        case "CookieDie":
            msg =
                '<button type="button" class="btn btn-danger btn-sm">Cookie die</button>';
            break;
        case "ProxyError":
            msg =
                '<button type="button" class="btn btn-warning btn-sm">Proxy lỗi</button>';
            break;
        default:
            msg =
                '<button type="button" class="btn btn-info btn-sm">Đang hoạt động</button>';
            break;
    }
    return msg;
}

function timeCreated(date) {
    return moment(date).format("YYYY-MM-DD HH:mm:ss");
}
console.log(
    "%c Zalo: 0398206564 %c",
    'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#00bbee;-webkit-text-fill-color:#00bbee;-webkit-text-stroke: 1px #00bbee;',
    "font-size:12px;color:#999999;"
);
function isURL(str) {
    var regex =
        /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
    var pattern = new RegExp(regex);
    return pattern.test(str);
}

function cancelOrder(url, code_order, id, fee = false) {
    let m = `Bạn có muốn hủy đơn ${code_order} ?, chúng tôi sẽ không hoàn tiền cho đơn đã hủy!`;
    if (fee) {
        m = `Sau khi hủy đơn ${code_order} bạn sẽ được hoàn lại số lượng chưa hoàn thành và trừ ${formatNumber(cancel_order)} coin phí hủy đơn tránh Spam?`;
    }
    Swal.fire({
        title: "Xác nhận!",
        text: m,
        icon: "warning",
        showCancelButton: true,
        // confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Tôi đồng ý",
        cancelButtonText: "Đóng",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url,
                headers: {
                    "Api-Token": profile.api_token,
                },
                data: {
                    id,
                },
                dataType: "json",
                success: function (response) {
                    swal(
                        response.message,
                        response.status === true ? "success" : "error"
                    );
                    if (response.status === true) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                },
            });
        }
    });
}

function reportOrder(url, code_order, id) {
    Swal.fire({
        title: "Xác nhận!",
        text: `Bạn đã khắc phục lỗi đơn ở mục chi tiết và muốn kích hoạt đơn: ${code_order} ?`,
        icon: "warning",
        showCancelButton: true,
        // confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Tôi đồng ý",
        cancelButtonText: "Đóng",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url,
                headers: {
                    "Api-Token": profile.api_token,
                },
                data: {
                    id,
                },
                dataType: "json",
                success: function (response) {
                    swal(
                        response.message,
                        response.status === true ? "success" : "error"
                    );
                    if (response.status === true) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                },
            });
        }
    });
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
console.log(
    "%c Admin Mod: Lê Tuấn Tài %c",
    'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#00bbee;-webkit-text-fill-color:#00bbee;-webkit-text-stroke: 1px #00bbee;',
    "font-size:12px;color:#999999;"
);



function convert_to_id(link) {
    var result = null;
    link = link.trim();
    var post_id = link["match"](/(.*)\/posts\/([0-9]{8,})/);
    var photo_id = link["match"](/(.*)\/photo.php\?fbid=([0-9]{8,})/);
    var photo_id_2 = link["match"](/(.*)\/photo\?fbid=([0-9]{8,})/);
    var photo_id_3 = link["match"](/(.*)\/photo\/\?fbid=([0-9]{8,})/);
    var video_id = link["match"](/(.*)\/video.php\?v=([0-9]{8,})/);
    var story_id = link["match"](/(.*)\/story.php\?story_fbid=([0-9]{8,})/);
    var link_id = link["match"](/(.*)\/permalink.php\?story_fbid=([0-9]{8,})/);
    var other_id = link["match"](/(.*)\/([0-9]{8,})/);
    var other_id_2 = link["match"](/^[0-9.]+$/);
    var comment_id = link["match"](/(.*)comment_id=([0-9]{8,})/);

    if (post_id) {
        return (result = post_id[2]);
    }

    if (photo_id) {
        return (result = photo_id[2]);
    }

    if (video_id) {
        return (result = video_id[2]);
    }

    if (story_id) {
        return (result = story_id[2]);
    }

    if (link_id) {
        return (result = link_id[2]);
    }

    if (other_id) {
        return (result = other_id[2]);
    }

    if (other_id_2) {
        return (result = other_id_2[0]);
    }

    if (photo_id_2) {
        return (result = photo_id_2[2]);
    }

    if (photo_id_3) {
        return (result = photo_id_3[2]);
    }

    if (comment_id) {
        return (result += "_" + comment_id[2]);
    }
}

function igGetUsername(elm) {
    $("#buy").prop("disabled", true);
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        if (!isURL(link)) {
            $("#buy").prop("disabled", false);
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý");
        let username = link["match"](/instagram.com\/([a-zA-Z0-9_.-]+)/);
        if (username) {
            username = username[1];
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val(username);
        } else {
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val("");
        }
        $("#buy").prop("disabled", false);
    }, 100);
}

function igGetIdpost(elm) {
    $("#buy").prop("disabled", true);
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        if (!isURL(link)) {
            $("#buy").prop("disabled", false);
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý");
        let idpost = link["match"](/com\/p\/([a-zA-Z0-9_.-]+)/);
        if (idpost) {
            idpost = idpost[1];
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val(idpost);
        } else {
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val("");
        }
        $("#buy").prop("disabled", false);
    }, 100);
}
console.log(
    "%c Contact: https://www.facebook.com/taile.official.2006 %c",
    'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#00bbee;-webkit-text-fill-color:#00bbee;-webkit-text-stroke: 1px #00bbee;',
    "font-size:12px;color:#999999;"
);
function ttGetUsername(elm) {
    $("#buy").prop("disabled", true);
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        if (!isURL(link)) {
            $("#buy").prop("disabled", false);
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý");
        let username = link["match"](/tiktok.com\/@([a-zA-Z0-9_.-]+)/);
        if (username) {
            username = username[1];
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val(username);
        } else {
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val("");
        }
        $("#buy").prop("disabled", false);
    }, 100);
}

function twtGetUsername(elm) {
    $("#buy").prop("disabled", true);
    setTimeout(() => {
        let link = $("[name=" + elm + "]").val();
        if (!isURL(link)) {
            $("#buy").prop("disabled", false);
            return;
        }
        $("[name=" + elm + "]")
            .prop("disabled", true)
            .val("Đang xử lý");
        let username = link["match"](/twitter.com\/([a-zA-Z0-9_.-]+)/);
        if (username) {
            username = username[1];
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val(username);
        } else {
            $("[name=" + elm + "]")
                .prop("disabled", false)
                .val("");
        }
        $("#buy").prop("disabled", false);
    }, 100);
}
