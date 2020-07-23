	load_package();
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
				c.clear().draw(), c.rows.add(e).draw(), check_all("table_package_checkbox");
        	}
        });
	}
	var c = $("#table_package").DataTable({
		select: !1,
        filter: !0,
        ordering: !0,
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json"
        },
        columns: [{
        	data: "stt",
            className: "text-center",
   	        render: function(t, e, n, o) {
                return '<div class="custom-control custom-checkbox">\n\t\t\t\t\t\t<input type="checkbox" class="custom-control-input table_package_checkbox" id="table_package_checkbox' + o.row + "\" value='" + n.id + '\'>\n\t\t\t\t\t\t<label class="custom-control-label" for="table_package_checkbox' + o.row + '"></label>\n\t\t\t\t\t</div>'
            }
        }, {
            data: "stt",
            className: "text-center",
            render: function(t, e, r, n) {                 
                return n.row + 1
            }
        }, {
            data: "name",
        }, {
        	data: "price",
            render: function(t, e, r, n) {                 
                return new Intl.NumberFormat().format(t);
            }
        }, {
        	data: "time",
        }, {
        	data: "number_account",
        }, {
            data: "action",
            className: "text-center",
            render: function(t, e, r) {
                return "<button class='btn btn-sm btn-primary btn_edit_package' title='Sửa gói'><i class='fa fa-edit'></i></button>\n                <button class='btn btn-sm btn-primary btn-danger btn_delete_package' title='Xóa gói'><i class='fa fa-trash'></i></button>"
            }
        }]
	});
    $("body").on("click", ".add_package", (function() {
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
                op: "add_package",
                _token: _token,
                name: name,
                price: price,
                time: time,
                number_account: number_account
            } 
        }).done(function (e) {
            thongbao("Lưu thành công", "success"),load_package();
        });
    })), $("body").on("click", ".btn_edit_package", (function() {
        let e = c.row($(this).parents("tr")).data();
        $("#txt_name").val(e.name), $("#txt_price").val(e.price), $("#txt_time").val(e.time), $("#txt_number_account").val(e.number_account);
        $(".edit_package").removeClass("hidden"), $(".add_package").addClass("hidden");
        $(".edit_package").attr("data-id", e.id);
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
    })), $("body").on("click", ".btn_delete_package", (function() {
        let array = [];
        let e = c.row($(this).parents("tr")).data();
        array.push(e.id);
        $.ajax({ 
            url: domain + "Package",
            type: "POST",
            data: {
                op: "action_package",
                _token: _token,
                id: array
            } 
        }).done(function (e) {
            thongbao("Xóa thành công", "success"),load_package();
        });
    })), $("body").on("click", ".delete_all", (function() {
        let array =[];
        if ($(".table_package_checkbox:checked").each((function() {
            array.push(this.value)
        })), 0 == array.length) return thongbao("Chưa chọn nội dung"), !1;
        $.ajax({
            url: domain + "Package",
            type: "POST",
            data: {
                op: "action_package",
                _token: _token,
                id: array
            } 
        }).done(function (e) {
            thongbao("Xóa thành công", "success"), load_package();
        });
    }))


