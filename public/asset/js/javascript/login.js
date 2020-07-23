$("#btn_login").click(function () {
    $("#thongbao").removeClass().addClass("text-primary").html("Đang kiểm tra thông tin ...");
    var e = $("#txt_user_name").val(),
        t = $("#txt_user_password").val();
    return "" == e ? (void $("#thongbao").removeClass().addClass("text-danger").html("Chưa nhập tên đăng nhập")) : "" == t
        ? (void $("#thongbao").removeClass().addClass("text-danger").html("Chưa nhập mật khẩu"))
        : void $.ajax({ 
            url: domain + "Login",
            type: "POST", 
            data: {
                _token: _token,
                email: e, 
                password: t 
            } 
        }).done(function (e) {
            (e && "success" === e)
            ? ($("#thongbao").removeClass().addClass("text-success").html("Đăng nhập thành công", "success"), setTimeout(function () {location.href = domain; }, 1e3))
            : ($("#thongbao").removeClass().addClass("text-danger").html(e));
        });
});