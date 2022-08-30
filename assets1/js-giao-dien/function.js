$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });


    let pathMenu = window.location.href;
    $("ul#sidebar a").each(function () {
        if (this.href === getPathFromUrl(pathMenu)) {
            $(this).addClass("active");
            $(this).parent().closest("li").addClass("active");
            let subMenu = $(this).parent().closest("ul");
            if (subMenu) {
                subMenu.show();
                $(this).parent().parent().closest("li").addClass("active");
            }
        }
    });
 $(".contact-head").click(function (e) {
        e.stopPropagation();
        $(".contact-button").toggleClass("button-closed");
        $(".contact-head").toggleClass("button-head-opened");
        $(".contact-head-icon").toggleClass("d-none");
    });
    $(window).click(function () {
        if ($(".contact-head.button-head-opened").length) {
            $(".contact-head.button-head-opened").click();
        }
    });
    let channel = pusher.subscribe("notification");
    if (typeof profile !== "undefined") {
        channel.bind(`user-${profile.id}`, function (payload) {
            // toastr[`${payload.status}`](`${payload.message}`,'Thông báo');
            swal(`${payload.message}`, `${payload.status}`);
        });
    }

    $('[data-toggle="tooltip"]').tooltip();
    $("form[submit-ajax=LTT]").submit(function (e) {
        e.preventDefault();
        let _this = this;
        let url = $(_this).attr("action");
        let method = $(_this).attr("method");
        let href = $(_this).attr("href");
        let api_token = $(_this).attr("api_token");
        let data = $(_this).serialize();
        let button = $(_this).find("button[type=submit]");
        if (button.attr("order")) {
            Swal.fire({
                title: "Xác nhận thanh toán!",
                text: button.attr("order"),
                icon: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Tôi đồng ý",
                cancelButtonText: "Đóng",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "warning",
                        title: "Đang xử lý, vui lòng chờ, nghiêm cấm tắt trình duyệt, f5 trang tránh hụt đơn mất tiền!",
                        timer: 180000,
                        timerProgressBar: true,
                        showCancelButton: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                    submitForm(url, method, href, api_token, data, button);
                }
            });
        } else {
            submitForm(url, method, href, api_token, data, button);
        }
    });
    
     $.each($(".dataTables-LTT"), function (indexInArray, valueOfElement) {
        let setting = {
            order: [],
            stateSave: true,
            language: {
                search: "Tìm Kiếm",
                zeroRecords: "<center>Không tìm thấy kết quả dữ liệu</center>",
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                infoEmpty: "Hiển thị 0 đến 0 của 0 mục",
                lengthMenu: "Hiển thị _MENU_ mục",
                infoFiltered: "(Được lọc từ _MAX_ mục)",
                loadingRecords: "Đang lấy dữ liệu...",
                paginate: {
                    previous: "<i class='fa fa-chevron-left'>",
                    next: "<i class='fa fa-chevron-right'>",
                },
                emptyTable: "<center>Không có dữ liệu để hiển thị</center>",
            },
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"],
            ],
        };
        let api = $(this).attr("ajax-api");
        if (api) {
            let config = JSON.parse(api);
            let api_token = config.api_token;
            setting["processing"] = true;
            let ajaxConfig = {
                type: config.method,
                url: config.url,
                data: config.data ?? {},
                dataType: "json",
            };
            if (api_token) {
                ajaxConfig["headers"] = {
                    "Api-Token": api_token,
                };
            }
            setting["ajax"] = ajaxConfig;
            setting["columns"] = window[`${$(this).attr("columns")}`]();
        }
        $(this).DataTable(setting);
    });
});
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
                    if (response.href){
                        window.location.href = response.href;
                    }
                    else if (!href) {
                        window.location.reload();
                        return;
                    } else {
                        window.location.reload();
                    }
                }, 2000);
            }
        },
        error: function (error) {
            console.log(error);
        },
        href: function (href) {
            console.log(window.location.href = href);
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
