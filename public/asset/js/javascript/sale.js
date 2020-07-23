	load_sale();load_customer();load_package();load_coupon();
	function load_sale(){
		$.ajax({ 
            url: domain + "Sale",
            type: "POST",
            data: {
            	op: "load_sale",
                _token: _token,
            } 
        }).done(function (e) {
        	if (e) {
        		e = JSON.parse(e);
				c.clear().draw(), c.rows.add(e).draw(), check_all("table_sale_checkbox");
        	}
        });
	}
	var c = $("#table_sale").DataTable({
		select: !1,
        filter: !0,
        ordering: !0,
        // scrollX: true,
        columns: [{
        	data: "stt",
            className: "text-center",
   	        render: function(t, e, n, o) {
                return '<div class="custom-control custom-checkbox">\n\t\t\t\t\t\t<input type="checkbox" class="custom-control-input table_sale_checkbox" id="table_sale_checkbox' + o.row + "\" value='" + n.id + '\'>\n\t\t\t\t\t\t<label class="custom-control-label" for="table_sale_checkbox' + o.row + '"></label>\n\t\t\t\t\t</div>'
            }
        }, {
            data: "stt",
            className: "text-center",
            render: function(t, e, r, n) {                 
                return n.row + 1
            }
        }, {
            data: "email",
        }, {
        	data: "package_name",
        }, {
        	data: "start_time",
            render: function(t, e, r, n) {                 
                return timeConverter(t, 1);
            }
        }, {
        	data: "end_time",
            render: function(t, e, r, n) {                 
                return timeConverter(t, 1);
            }
        }, {
            data: "price",
            render: function(t, e, r, n) {                 
                return new Intl.NumberFormat().format(t);
            }
        }, {
            data: "coupon_name",
        }, {
            data: "total_money",
            render: function(t, e, r, n) {                 
                return new Intl.NumberFormat().format(t);
            }
        }, {
            data: "status",
            render: function(t, e, r, n) {                 
                if (t == "lock") {return "<label style='color:red'>"+t+"</label>"}
                    else {return "<label style='color:#00b5b8!important'>"+t+"</label>"};
            }
        }, {
            data: "note",
            render: function(t, e, r) {
                return t && t != '' ? subword(t, 5) : '';
            }
        }, {
            data: "end_time",
            render: function(t, e, r, n) { 
                if (t < ((new Date).getTime() / 1e3)) {
                    return "<label style='color:red'>Đã hết hạn</label>";
                } else {
                    return "<label>Chưa hết hạn</label>";
                }                
            }
        }, {
            data: "action",
            className: "text-center",
            render: function(t, e, r) {
                if (r.status == "unlock") {
                    return "<button class='btn btn-sm btn-primary btn_edit_sale' title='Sửa sale'><i class='fa fa-edit'></i></button>\n                <button class='btn btn-sm btn-primary btn-danger btn_action' title='Khóa sale' data-action='lock'><i class='fa fa-lock' style='width:16px'></i></button>"
                } else {
                    return "<button class='btn btn-sm btn-primary btn_edit_sale' title='Sửa sale'><i class='fa fa-edit'></i></button>\n                <button class='btn btn-sm btn-primary btn-danger btn_action' title='Mở sale' data-action='unlock'><i class='fa fa-unlock'></i></button>"
                }
            }
        }]
	});

    function load_customer(){
        $.ajax({ 
            url: domain + "Customer",
            type: "POST",
            data: {
                op: "load_customer",
                _token: _token,
                status: "unlock"
            } 
        }).done(function (e) {
            if (e) {
                e = JSON.parse(e);
                e.forEach(function(i){
                    $(".list-customer").append('<option value="'+i.email+'">');
                })
            }
        });
    }
    function load_package(){
        $.ajax({ 
            url: domain + "Package",
            type: "POST",
            data: {
                op: "load_package",
                _token: _token,
            } 
        }).done(function (e) {
            if (e) {
                e = JSON.parse(e);
                e.forEach(function(i){
                    $(".list-package").append('<option id="'+i.id+'"value="'+i.id+'. '+i.name+'">');
                })
            }
        });
    }
    function load_coupon(){
        $.ajax({ 
            url: domain + "Coupon",
            type: "POST",
            data: {
                op: "load_coupon",
                _token: _token,
                expire : true
            } 
        }).done(function (e) {
            if (e) {
                e = JSON.parse(e);
                e.forEach(function(i){
                    $(".list-coupon").append('<option id="'+i.id+'" value="'+i.id+'. '+i.name+'">');
                })
            }
        });
    }

    $("body").on("click", ".add_sale", (function() {
        let email = $("#txt_email").val();
        if (email == '') {
            return thongbao("Chưa nhập Email"); 
        } else {
            let check_email = validateEmail(email);
            if(check_email == false) {
                return thongbao("Email chưa đúng định dạng");
            } 
        }
        let package = $("#txt_package").val();
        if (package == "") {return thongbao("Chưa nhập gói")};
        let package_id = package.split(".")[0];
        let coupon = $("#txt_coupon").val();
        let coupon_id = 0;
        if (coupon != "") {
            coupon_id = coupon.split(".")[0];
        }
        let note = $("#txt_note").val();
        $.ajax({ 
            url: domain + "Sale",
            type: "POST",
            data: {
                op: "add_sale",
                _token: _token,
                email: email,
                package_id: package_id,
                coupon_id: coupon_id,
                note: note
            } 
        }).done(function (e) {
            thongbao(e, "success"),load_sale();
        });
    })), $("body").on("click", ".btn_edit_sale", (function() {
        let e = c.row($(this).parents("tr")).data();
        let currentdate = new Date();
        let cur_month = currentdate.getMonth() + 1;
        let cur_year = currentdate.getFullYear();
        let dateTime = timeConverter(e.start_time, 2);
        let parts = dateTime.split("/");
        let month = parts[1],
            year = parts[2];
        if ((month >= cur_month && year == cur_year)|| year >= cur_year) {
            $("#txt_email").val(e.email), $("#txt_package").val(e.package_id+". "+e.package_name), $("#txt_coupon").val(e.coupon_id + ". "+e.coupon_name), $("#txt_note").val(e.note);
            $(".edit_sale").removeClass("hidden"), $(".add_sale").addClass("hidden");
            $("#txt_email").attr("readonly", true);
            $(".edit_sale").attr("data-id", e.id);
        } else {
            return thongbao("Chỉ sửa Sale được bắt đầu trong tháng hoặc muộn hơn");
        }
    })), $("body").on("click", ".edit_sale", (function() {
        let id = $(this).attr("data-id"),
            e = c.row($(this).parents("tr")).data(),
            email = $("#txt_email").val(),
            package = $("#txt_package").val();
        if (package == "") {return thongbao("Chưa nhập gói")};
        let package_id = package.split(".")[0],
            coupon = $("#txt_coupon").val(),
            coupon_id = 0;
        if (coupon != "") {
            coupon_id = coupon.split(".")[0];
        }
        let note = $("#txt_note").val();
        $.ajax({ 
            url: domain + "Sale",
            type: "POST",
            data: {
                op: "update_sale",
                _token: _token,
                email: email,
                package_id: package_id,
                coupon_id: coupon_id,
                note: note,
                id: id
            } 
        }).done(function (e) {
            thongbao(e, "success"),load_sale(), $("#txt_email").attr("readonly", false),$(".edit_sale").addClass("hidden"), $(".add_sale").removeClass("hidden");
        });
    })), $("body").on("click", ".edit_package", (function() {
        let id = $(this).attr("data-id");
        let name = $("#txt_name").val();
        if (name == "") {return thongbao("Chưa nhập tên gói")};
        let price = $("#txt_price").val();
        if (price == "") {return thongbao("Chưa nhập giá gói")};
        let time = $("#txt_time").val();
        if (time == "") {return thongbao("Chưa nhập thời gian gói")};
        let number_account = $("#txt_number_account").val();
        if (number_account == "") {return thongbao("Chưa nhập số lượng tài khoản")};
        $.ajax({ 
            url: domain + "Package",
            type: "POST",
            data: {
                op: "update_package",
                _token: _token,
                name: name,
                price: price,
                time: time,
                number_account: number_account,
                id: id
            } 
        }).done(function (e) {
            thongbao("Sửa thành công", "success"),load_package(), $(".edit_package").addClass("hidden"), $(".add_package").removeClass("hidden");
        });
    })), $("body").on("click", ".btn_action", (function() {
        let array = [],
            e = c.row($(this).parents("tr")).data(),
            action = $(this).attr("data-action");
        array.push(e.id), array.push(e.customer_id);
        $.ajax({ 
            url: domain + "Sale",
            type: "POST",
            data: {
                op: "action_sale",
                _token: _token,
                id: array,
                action: action
            }
        }).done(function (e) {
            thongbao(action +" thành công", "success"),load_sale();
        });
    })), $("body").on("click", ".action_all", (function() {
        let array =[],
            action = $(this).attr('data-action');
        if ($(".table_sale_checkbox:checked").each((function() {
            array.push(this.value)
        })), 0 == array.length) return thongbao("Chưa chọn nội dung"), !1;
        $.ajax({
            url: domain + "Sale",
            type: "POST",
            data: {
                op: "action_sale",
                _token: _token,
                id: array,
                action: action
            } 
        }).done(function (e) {
            thongbao(action +" thành công", "success"), load_sale();
        });
    }))


