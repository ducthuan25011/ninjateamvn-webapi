	load_customer();
	function load_customer(){
		$.ajax({ 
            url: domain + "Customer",
            type: "POST",
            data: {
            	op: "load_customer",
                _token: _token,
            } 
        }).done(function (e) {
        	if (e) {
        		e = JSON.parse(e);
				c.clear().draw(), c.rows.add(e).draw(), check_all("table_customer_checkbox");
        	}
        });
	}
	var c = $("#table_customer").DataTable({
		select: !1,
        filter: !0,
        ordering: !0,
        columns: [{
        	data: "stt",
            className: "text-center",
   	        render: function(t, e, n, o) {
                return '<div class="custom-control custom-checkbox">\n\t\t\t\t\t\t<input type="checkbox" class="custom-control-input table_customer_checkbox" id="table_customer_checkbox' + o.row + "\" value='" + n.id + '\'>\n\t\t\t\t\t\t<label class="custom-control-label" for="table_customer_checkbox' + o.row + '"></label>\n\t\t\t\t\t</div>'
            }
        }, {
            data: "stt",
            className: "text-center",
            render: function(t, e, r, n) {                 
                return n.row + 1
            }
        }, {
            data: "email"
        }, {
            data: "name",
        }, {
        	data: "phone",
        }, {
        	data: "referral",
        	render: function(t, e, r, n) {                 
                if (t == 0) {return ""}else {return t};
            }
        }, {
        	data: "is_admin",
        	render: function(t, e, n, o) {
        		let result = "Không";
        		t == 1 && (result = "Có");
        		return result;
            }
        }, {
        	data: "status",
            render: function(t, e, r, n) {                 
                if (t == "lock") {return "<label style='color:red'>"+t+"</label>"}
                    else {return "<label style='color:#00b5b8!important'>"+t+"</label>"};
            }
        }, {
            data: "action",
            className: "text-center",
            render: function(t, e, r) {
            	if (r.status == "unlock") {
                    return "<button class='btn btn-sm btn-primary btn_edit_customer' title='Sửa tài khoản'><i class='fa fa-edit'></i></button>\n                <button class='btn btn-sm btn-primary btn-danger btn_action' title='Khóa tài khoản' data-action='lock'><i class='fa fa-lock' style='width:16px'></i></button>"
            	} else {
                	return "<button class='btn btn-sm btn-primary btn_edit_customer' title='Sửa tài khoản'><i class='fa fa-edit'></i></button>\n 				<button class='btn btn-sm btn-primary btn-danger btn_action' title='Mở tài khoản' data-action='unlock'><i class='fa fa-unlock'></i></button>"
            	}
            }
        }]
	});

    $("body").on("click", ".btn_action", (function() {
    	let array = [];
		let e = c.row($(this).parents("tr")).data();
		let action = $(this).attr("data-action");
		array.push(e.id);
		$.ajax({
            url: domain + "Customer",
            type: "POST",
            data: {
            	op: "action_customer",
                _token: _token,
                action: action,
                id: array
            } 
        }).done(function (e) {
        	thongbao("Cập nhật thành công", "success"), load_customer();
        });
    }));
    $("body").on("click", ".action_all", (function() {
		let action = $(this).attr("data-action");
    	let array =[];
    	if ($(".table_customer_checkbox:checked").each((function() {
            array.push(this.value)
        })), 0 == array.length) return thongbao("Chưa chọn nội dung"), !1;
		$.ajax({
            url: domain + "Customer",
            type: "POST",
            data: {
            	op: "action_customer",
                _token: _token,
                action: action,
                id: array
            } 
        }).done(function (e) {
        	thongbao("Cập nhật thành công", "success"), load_customer();
        });
    }));

    $('#txt_email').first().keyup(function(){
	    $email = $(this).val();// use val here to get value of input
	    let res = validateEmail($email);
	});

    $("body").on("click", ".add_customer", (function() {
    	let email = $("#txt_email").val();
    	if (email == '') {
	    	return thongbao("Chưa nhập Email"); 
    	} else {
	    	let check_email = validateEmail(email);
	    	if(check_email == false) {
		    	return thongbao("Email chưa đúng định dạng");
	    	} 
    	}
    	let password = $("#txt_password").val();
    	if (password == "") {return thongbao("Chưa nhập Mật khẩu")};
    	let phone =$("#txt_phone").val();
    	if (phone == "") {return thongbao("Chưa nhập Số điện thoại")};
    	let name = $("#txt_name").val();
    	if (name == "") {return thongbao("Chưa nhập Tên")};
    	let referral = $("#txt_referral").val();
    	let status = $("#select_status").val();
    	let is_admin = $("#select_admin").val();
    	$.ajax({ 
            url: domain + "Customer",
            type: "POST",
            data: {
            	op: "cou_customer",
                _token: _token,
                email: email,
                password: password,
                phone: phone,
                name: name,
                referral: referral,
                status: status,
                is_admin: is_admin
            } 
        }).done(function (e) {
        	thongbao("Lưu thành công", "success"),load_customer();
        });
    }));

    $("body").on("click", "#view_password", (function() {
    	if('password' == $('#txt_password').attr('type')){
        	$('#txt_password').prop('type', 'text');
    	}else{
         	$('#txt_password').prop('type', 'password');
    	}
    }))
    $("body").on("click", ".btn_edit_customer", (function() {
		let e = c.row($(this).parents("tr")).data();
    	$("#txt_email").val(e.email);
    	$("#txt_password").val("");
    	$("#txt_phone").val(e.phone);
    	$("#txt_name").val(e.name);
    	$("#select_status").val(e.status).change();
    	$("#select_admin").val(e.is_admin).change();
        $(".edit_customer").attr("data-id", e.id),$(".edit_customer").removeClass("hidden"), $(".add_customer").addClass("hidden");
    	if (e.id != 0) {
	    	$.ajax({ 
	            url: domain + "Customer",
	            type: "POST",
	            data: {
	            	op: "load_referral",
	                _token: _token,
	                id: e.referral
	            } 
	        }).done(function (e) {
	        	$("#txt_referral").val(e);
	        });
    	}
    })), $("body").on("click", ".edit_customer", (function() {
        let id = $(this).attr("data-id");
        let email = $("#txt_email").val();
        if (email == '') {
            return thongbao("Chưa nhập Email"); 
        } else {
            let check_email = validateEmail($email);
            if(check_email == false) {
                return thongbao("Email chưa đúng định dạng");
            } 
        }
        let password = $("#txt_password").val();
        let phone =$("#txt_phone").val();
        if (phone == "") {return thongbao("Chưa nhập Số điện thoại")};
        let name = $("#txt_name").val();
        if (name == "") {return thongbao("Chưa nhập Tên")};
        let referral = $("#txt_referral").val();
        let status = $("#select_status").val();
        let is_admin = $("#select_admin").val();
        $.ajax({ 
            url: domain + "Customer",
            type: "POST",
            data: {
                op: "update_customer",
                _token: _token,
                email: email,
                password: password,
                phone: phone,
                name: name,
                referral: referral,
                status: status,
                is_admin: is_admin,
                id: id
            } 
        }).done(function (e) {
            thongbao("Lưu thành công", "success"),load_customer(),$(".edit_customer").addClass("hidden"), $(".add_customer").removeClass("hidden");
        });
    }))

