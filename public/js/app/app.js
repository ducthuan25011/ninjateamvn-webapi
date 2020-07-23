var internet = "online";
window.addEventListener('load', function() {
    function updateOnlineStatus(event) {
        internet = navigator.onLine ? "online" : "offline";
        if (internet == "online") {
            close_loadding();
        } else {
            open_loadding(config_site.disconnect);
        }
    }
    window.addEventListener('online', updateOnlineStatus);
    window.addEventListener('offline', updateOnlineStatus);
});

function copyToClipboard(element) {
    $(element).select();
    document.execCommand("copy");
}

function get_data_es(url_get,param='{}'){
    var arr = url_get.split("/");
    return new Promise(function(resolve,reject){
        param = JSON.parse(param);
        $.ajax({ 
            url: domain + "Scan_uid", 
            type: "POST", 
            data: { op: "get_data", 
                _token: _token, 
                param: JSON.stringify(param),
                url_get: url_get 
            } 
        }).done(function (res) {
            resolve(JSON.parse(res));
        });
    });
}
function capitalize(string) { 
    return string.charAt(0).toUpperCase() + string.slice(1); 
}
function height_100(padding = 300,id="history_scan",height = 300){
	var width = $(document).width();
	if(width >= 992){
		$("#"+id).css("max-height","calc(100vh - "+padding+"px)");
	}else{
		$("#"+id).css("max-height",height+"px");
	}
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test( $email ) ) {
        $(".warning").removeClass("hidden");
        return false;
    } else {
        $(".warning").addClass("hidden");
    return true;
    }
}
function replace_emoji(string,type=1){
    string = string.replace(/[&#10;&#92;&#39;&#34;]+/g, ". ");
    // string = string.replace(/[&#10;&#92;&#39;&#34;]+/g, "\n");
    if(type == 1){// get emoji
        string = string.replace(/[0-9a-zA-Z. àáảãạâầấẩẫậăằắẳẵặđèéẻẽẹêềếểễệìíỉĩịòóỏõọôồốổỗộơờớởỡợùúủũụưừứửứựÀÁẢÃẠÂẦẤẨẪẬĂẰẮẲẴẶĐÈÉẺẼẸÊỀẾỂỄỆÌÍỈĨỊÒÓỎÕỌÔỒỐỔỖỘƠỜỚỞỠỢÙÚỦŨỤƯỪỨỬỨỰ]/g, "");
    }
    else{//replace emoji
        string = string.replace(/[^\r\n0-9a-zA-Z. _àáảãạâầấẩẫậăằắẳẵặđèéẻẽẹêềếểễệìíỉĩịòóỏõọôồốổỗộơờớởỡợùúủũụưừứửứựÀÁẢÃẠÂẦẤẨẪẬĂẰẮẲẴẶĐÈÉẺẼẸÊỀẾỂỄỆÌÍỈĨỊÒÓỎÕỌÔỒỐỔỖỘƠỜỚỞỠỢÙÚỦŨỤƯỪỨỬỨỰ]+/g, "");
        string = string.replace(/[\n]+/g, "\n");
    }
    string = string.replace(/ +/g, " ");
    return string;
}
function get_html_table_row(id_table,row){
	var table = document.getElementById(id_table);
	var rows = table.rows[row];
	return rows;
}
function get_html_table(id_table,row,cell){
	var table = document.getElementById(id_table);
	var rows = table.rows[row];
	var columns = rows.cells[cell].innerHTML;
	return columns;
}
function set_html_table(id_table,row,cell,value_html){
	var table = document.getElementById(id_table);
	table.rows[row].cells[cell].innerHTML=value_html;
}

//đồng bộ khi foreach
const waitFor = (ms) => new Promise(r => setTimeout(r, ms));
async function asyncForEach(array, callback) {
	for (let index = 0; index < array.length; index++) {
	  	await callback(array[index], index, array);
	}
}

function subword(string,number = 5){
    string = string.replace("post_share",config_site.post_share);
    var arr = string.split(" ");
    var arr_new = arr.slice(0, (number - 1));
    string_new = arr_new.join(" ")+" ...";
    return string_new;
}
function arrayUnique(array) {
    return new Promise(function(resolve, reject) {
        let unique = [...new Set(array)];
        resolve(unique);
    });
}

function update_phone(arr_data) {
// async function update_phone(arr_data) {
    // var arr_data = await arrayUnique(arr_data);
    if (arr_data.length == 0) { return false; }
    arr_data = arr_data.join("@ninja@");
    var fd = new FormData();
    fd.append('arr_userid', arr_data);
    fd.append('op', 'userid_phone');
    fd.append('_token', _token);
    $.ajax({
        url: domain + "Scan_comment_fanpage",
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
    });
}
// async function update_uid_phone_ES(arr_data) {
//     var arr_userid = await arrayUnique(arr_data);
function update_uid_phone_ES(arr_data) {
    if (arr_data.length == 0) { return false; }
    arr_data = arr_data.join("@ninja@");
    var fd = new FormData();
    fd.append('arr_userid', arr_data);
    fd.append('op', 'update_uid_phone_ES');
    fd.append('_token', _token);
    $.ajax({
        url: domain + "Async_phone",
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
    });
}

function extrac_number(string) {
    var phone = "";
    var table = "";
    string = string.replace(/[^0-9]/g, " ");
    string = string.replace(/   /g, " ");
    string = string.replace(/  /g, " ");
    arr_string = string.split(" ");
    if (arr_string.length > 0) {
        arr_string.forEach(function(element) {
            element = element.substring(0, 10);
            dauso = element.substring(0, 2);
            if (element.length == 10) {
                table = element.substring(0, 3);
                if (dauso !== "00" && parseInt(table) > 0) {
                    phone = "84" + (parseInt(element)).toString();
                }
            } else if (element.length == 11) {
                if (dauso == "84") {
                    table = "0" + element.substring(2, 2);
                    phone = element;
                }
            } else if (element.length > 11) {
                table = "0" + element.substring(2, 2);
                phone = element;
            }
        });
    }
    return [phone, table];
}

function extrac_postid(string) {
    var key_check ="www.facebook.com%2Fgroups%2F";
    var index_check = string.indexOf(key_check);
    if(index_check >= 0 ){
        return "";
        var key1 = "%2Fpermalink%2F";
    }
    else{
        var key1 = "videos%2F";
    }
    var key2 = "%2F&width=";
    var index1 = string.indexOf(key1) + key1.length;
    var index2 = string.indexOf(key2);
    return string.substring(index1, index2);
}

function formatNumber(num) {
    if (num == null || num == "") {
        return '0';
    }
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}
const isHTML = (str) => {
    const fragment = document.createRange().createContextualFragment(str);
    fragment.querySelectorAll('*').forEach(el => el.parentNode.removeChild(el));
    return !(fragment.textContent || '').trim();
}
function real_escap(string,type=1) {
    if(string == "" || string == null){
        return "";
    }
    var arr_replace = [11,20,21,22,23,24,25,26,27,28,29];
    string = replaceAll(string, String.fromCharCode(8), ' ');
    string = string.replace(/[\n]+/g, "\n");
    arr_replace.forEach(function(element){
        string = replaceAll(string, String.fromCharCode(element), '');
    });
    string = replaceAll(string, String.fromCharCode(13), '&#10;');
    string = replaceAll(string, '\t', ' ');
    string = replaceAll(string, '\n', '&#10;');
    string = replaceAll(string, '\\', '&#92;');
    string = replaceAll(string, "'", "&#39;");
    string = replaceAll(string, '"', '&#34;');
    string = string.replace(/ +/g, " ");
    return string;
}
function check_type_active(data) {
    if(data == null || data == ''){data = 0;}
    data = parseInt(data);
    var active = "";
    if (data == 0) {
        active = "Comment";
    } else if (data == 1) {
        active = "Like";
    } else if (data == 2) {
        active = "Love";
    } else if (data == 3) {
        active = "Wow";
    } else if (data == 4) {
        active = "Haha";
    } else if (data == 7) {
        active = "Sad";
    } else if (data == 8) {
        active = "Angry";
    } else if (data == 9) {
        active = "Share";
    } else {
        active = "Other";
    }
    return active;
}

function check_status_group(status){
	var status_new = "";
	switch (status) {
		case "OPEN":
			status_new = config_site.open;
		break;
		case "CLOSED":
			status_new = config_site.closed;
		break;
		default:
			status_new = "";
			break;
	}
	return status_new;
}
function reverse_array(arr) {
    var new_arr = new Array();
    if (arr.length > 0) {
        for (var i = (arr.length - 1); i >= 0; i--) {
            new_arr.push(arr[i]);
        }
    }
    return new_arr;
}

function resize_table() {
    var width = $(window).width();
    if (width > 992) {
        $("table.table").removeClass("nowrap");
    } else {
        $("table.table").addClass("nowrap");
    }
}

$(window).on("resize", function() {
    // resize_table();
});

function active_word_search(string, keyword) {
    if (string != "" && keyword != "") {
        if (isHTML(keyword) != false) {
            string = replaceAll(string, keyword, "<font class='bg-warning'>" + keyword + "</font>");
            keyword_new = keyword.charAt(0).toUpperCase() + keyword.slice(1);
            string = replaceAll(string, keyword_new, "<font class='bg-warning'>" + keyword_new + "</font>");
        }
    }
    return string;
}
$("body").on("click", ".table img.view_image", function() {
    var src = $(this).attr("src");
    window.open(src, "_blank");
});

function urlify(text) {
    var urlRegex = /(https?:\/\/[^\s]+)/g;
    return text.replace(urlRegex, function(url) {
        return '<a target="_blank" href="' + url + '">' + url + '</a>';
    });
}

function view_profile(uid) {
    var url = 'https://www.facebook.com/profile.php?id=' + uid;
    window.open(url, "_blank");
}

function view_post(post_id) {
    var url = 'https://www.facebook.com/' + post_id;
    window.open(url, "_blank");
}

function escapeRegExp(str) {
    return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}

function replaceAll(str, find, replace) {
    return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

function check_all(id_check, cl_check) {
    cl_check = cl_check || id_check;
    if ($("#" + id_check).length) {
        $("#" + id_check).prop("checked", false);
        $("#" + id_check).change(function() {
            if (this.checked) {
                $("." + cl_check).prop("checked", true);
            } else {
                $("." + cl_check).prop("checked", false);
            }
        });
    }
}
var check_yes_no = 0;

function check_yes_or_no(element) {
    check_yes_no = 1;
    if (element !== "") {
        $(element).click();
        check_yes_no = 0;
    }
}

function load_id_from_url(url) {
    var data = "";
    $.ajax({
        url: domain + "Home",
        type: 'POST',
        async: false,
        data: {
            op: "load_id_from_url",
            _token: _token,
            from_url: url
        },
    }).done(function(res) {
        data = res.replace(/[^0-9]+/g,"");
    });
    return data;
}

function speaking(msg) {
    return false;
    msg = msg.replace('<b>', "");
    msg = msg.replace('</b>', "");
    msg = msg.replace('<br>', "");
    // console.log(msg);
    msg = encodeURI(msg);
    var src_link = "";
    if (_lang_local == "vi") {
        src_link = "https://support.lsdsoftware.com/read-aloud/speak/" + _lang_local + "/GoogleTranslate%20Vietnamese?t=" + new Date().getTime() + "&q=" + msg;
    } else {
        src_link = "https://support.lsdsoftware.com/read-aloud/speak/" + _lang_local + "/GoogleTranslate%20English?t=" + new Date().getTime() + "&q=" + msg;
    }
    var ifrm = document.createElement("iframe");
    ifrm.setAttribute("src", src_link);
    ifrm.setAttribute("allow", 'autoplay');
    ifrm.style.display = "none";
    ifrm.style.width = "1px";
    ifrm.style.height = "1px";
    document.body.appendChild(ifrm);
}

function thongbao(msg, type) {
    speaking(msg);
    type = type || "warning";
    close_loadding();
    if(type == "warning"){
        toastr.warning(msg,config_site.notication);
    }else{
        toastr.success(msg,config_site.notication);
    }
    
    // var class_color = "bg-" + type;
    // $("#modal_thongbao").removeClass("d-none");
    // $("#modal_body_thongbao").html(msg);
    // $("#modal_body_thongbao").parent().parent().removeClass("bg-success bg-warning").addClass(class_color);
    // var i = 1;
    // var interval_time_focus = setInterval(function() {
    //     if (i == 3) {
    //         clearInterval(interval_time_focus);
    //     } else if (i == 2) {
    //         $("#modal_thongbao").addClass("d-none");
    //     }
    //     i++;
    // }, 1000);
}

function yes_or_no(msg, element) {
    speaking(msg)
    open_modal("confirm", "", msg, "<i class='fa fa-check'></i>&nbsp;" + config_site.allow_yes);
    var time_start = 20;
    var interval_time_start = setInterval(function() {
        time_start = time_start - 1;
        if (time_start === 0) {
            clearInterval(interval_time_start);
            close_modal("confirm");
        } else {
            $("#time_auto_close").html("(" + time_start + ")");
        }
    }, 1000);
    $('#btn_modal_confirm').off('click').click(function() {
        close_modal("confirm");
        setTimeout(function() {
            check_yes_or_no(element);
        }, 200);
    });
    $('#btn_modal_close_confirm').off('click').click(function() {
        clearInterval(interval_time_start);
    });
}

function check_time(number) {
    number = parseInt(number);
    if (number < 10) {
        string = "0" + number;
    } else {
        string = number;
    }
    return string;
}

function timeConverter(UNIX_timestamp, type) {
    type = type || 0;
    if (UNIX_timestamp == 0) {
        time = 0;
    } else {
        var a = new Date(UNIX_timestamp * 1000);
        var months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = check_time(a.getDate());
        var hours = check_time(a.getHours());
        var minus = check_time(a.getMinutes());
        var seconds = check_time(a.getSeconds());
        if (type == 0) {
            var time = date + '/' + month + '/' + year + ' ' + hours + ':' + minus;
        } else if (type == 1) {
            var time = date + '/' + month + '/' + year + ' ' + hours + ':' + minus + ':' + seconds;
        } else {
            var time = date + '/' + month + '/' + year;
        }
    }
    return time;
}

function open_modal(id, title, content, button, id_focus, modal_size) {
    id = id || "event";
    title = title || "";
    content = content || "";
    button = button || config_site.accept;
    id_focus = id_focus || "";
    modal_size = modal_size || "";
    if (modal_size !== "") {
        $("#modal_" + id + " .modal-dialog").addClass(modal_size);
    }
    if (title !== "") {
        $("#title_modal_" + id).html(title);
    }
    if (content !== "") {
        $("#modal_body_" + id).html(content);
    }
    $("#btn_modal_" + id).show();
    $("#btn_modal_" + id).html(button);
    $("#modal_" + id).modal("show");

    if (id_focus !== "") {
        $("#modal_" + id).on('show.bs.modal', function() {
            $(id_focus).focus();
        });
    }
}

function close_modal(id) {
    $("#modal_" + id).modal("hide");
}

function open_loadding(text_loadding, type = 0) {
    text_loadding = text_loadding || config_site.action_loadding;
    if (type == 1) {
        speaking(text_loadding)
    }
    $("#text_modal_loadding").html(text_loadding);
    $("#modal_loadding_data").removeClass("d-none").addClass("d-block");
}

function close_loadding() {
    $("#modal_loadding_data").removeClass("d-block").addClass("d-none");
}

function fun_check_info_token(token) {
    var result = "";
    var settings = {
        "async": false,
        "crossDomain": true,
        "url": "https://graph.facebook.com/me?access_token=" + token,
        "method": "GET",
        "headers": {}
    }
    $.ajax(settings).done(function(response) {
        if (response.id != undefined) {
            result = response;
        }
    });
    return result;
}

function fun_check_token(token) {
    var status = "die";
    var settings = {
        "async": false,
        "crossDomain": true,
        "url": "https://graph.facebook.com/100004408984172?access_token=" + token,
        "method": "GET",
        "headers": {}
    }
    $.ajax(settings).done(function(response) {
        if (response.id != undefined) {
            status = "live";
        }
    });
    return status;
}
function get_info_token(token) {
    var status = "die";
    var settings = {
        "async": false,
        "crossDomain": true,
        "url": "https://graph.facebook.com/me?access_token=" + token,
        "method": "GET",
        "headers": {}
    }
    $.ajax(settings).done(function(response) {
        status = response;
    });
    return status;
}
function get_info_uid(uid,token) {
    var status = "die";
    var settings = {
        "async": false,
        "crossDomain": true,
        "url": "https://graph.facebook.com/"+uid+"?access_token=" + token,
        "method": "GET",
        "headers": {}
    }
    $.ajax(settings).done(function(response) {
        status = response;
    });
    return status;
}
function fun_check_account(account_id, token) {
    var status = "";
    var settings = {
        "async": false,
        "crossDomain": true,
        "url": "https://graph.facebook.com/" + account_id + "?access_token=" + token,
        "method": "GET",
        "headers": {}
    }
    $.ajax(settings).done(function(response) {
        if (response.id != undefined) {
            status = response.name;
        }
    });
    return status;
}

function fun_check_friend(account_id, token) {
    var friendship_status = "";
    var settings = {
        "async": false,
        "crossDomain": true,
        "url": "https://graph.facebook.com/graphql?q=node(" + account_id + "){friendship_status}&access_token=" + token,
        "method": "GET",
        "headers": {},
        "data": {}
    }
    $.ajax(settings).done(function(response) {
        friendship_status = Object.values(response)[0].friendship_status;
    });
    return friendship_status;
}

function fun_post_info(post_id, token) {
    var result = "";
    var settings = {
        "async": false,
        "crossDomain": true,
        "url": "https://graph.facebook.com/" + post_id + "?fields=id,updated_time,from{id,name}&access_token=" + token,
        "method": "GET",
        "headers": {}
    }
    $.ajax(settings).done(function(response) {
        if (response.id != undefined) {
            result = response;
        }
    });
    return result;
}

function fun_video_info(post_id, token) {
    var result = "";
    var settings = {
        "async": false,
        "crossDomain": true,
        "url": "https://graph.facebook.com/" + post_id + "?fields=id,description,updated_time,created_time,from{id,name}&access_token=" + token,
        "method": "GET",
        "headers": {}
    }
    $.ajax(settings).done(function(response) {
        if (response.id != undefined) {
            result = response;
        }
    });
    return result;
}

function generateRandomInteger(min, max) {
    return Math.floor(min + Math.random() * (max + 1 - min))
}

function chunk(chunkSize, array) {
    return array.reduce(function(previous, current) {
        var chunk;
        if (previous.length === 0 ||
            previous[previous.length - 1].length === chunkSize) {
            chunk = []; // 1
            previous.push(chunk); // 2
        } else {
            chunk = previous[previous.length - 1]; // 3
        }
        chunk.push(current); // 4
        return previous; // 5
    }, []); // 6
}
var email_user;
$(document).ready(async function() {
    email_user = $("span.user-name").html();
    var href = window.location.href;
    var arr_href = href.split("?");
    href = arr_href[0];
    href = href.replace(/#/g, "");
    $(".main-menu .nav-item a").each(function() {
        if ($(this).attr("href") === href) {
            $(this).parent().addClass("active");
            $(this).attr("href", "javascript:");
        }
    });
    $(".main-menu li.active").parents("li.has-sub").addClass("open");
    $.ajaxSetup({
        statusCode: {
            400: function(data) {
                var code_error = data.responseJSON.error.code;
                if(code_error == 190){
                    thongbao(config_site.token_die);
                }
                else if(code_error == 100){
                    thongbao(config_site.account_notexist);
                }
                else{
                    thongbao(data.responseJSON.error.message);
                }
                // thongbao(data.responseJSON.error.message);
                // thongbao(config_site.token_die);
                // thongbao(config_site.error);
            },
            404: function() {
                // thongbao(config_site.not_found);
            },
            500: function() {
                thongbao(config_site.sever_error);
            }
        }
    });
    if ($(".select2").length) {
        $(".select2").select2({
            placeholder: {
                id: "-1",
                text: config_site.select_an_option,
                selected: 'selected'
            },
            allowClear: true,
            closeOnSelect: false,
            width: "100%",
        });
    }
    if ($(".datepicker").length) {
        $.datetimepicker.setLocale(_lang_local);
        $(".datepicker").datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
            mask: true,
            dayOfWeekStart: 1,
        });
    }
});