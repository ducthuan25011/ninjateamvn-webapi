	load_account();
	function load_account(){
		$.ajax({ 
            url: domain + "Account",
            type: "POST",
            data: {
            	op: "load_account",
                _token: _token,
            } 
        }).done(function (e) {
        	if (e) {
        		e = JSON.parse(e);
				c.clear().draw(), c.rows.add(e).draw(), check_all("table_account_checkbox");
        	}
        });
	}
	var c = $("#table_account").DataTable({
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
                return '<div class="custom-control custom-checkbox">\n\t\t\t\t\t\t<input type="checkbox" class="custom-control-input table_account_checkbox" id="table_account_checkbox' + o.row + "\" value='" + n.id + '\'>\n\t\t\t\t\t\t<label class="custom-control-label" for="table_account_checkbox' + o.row + '"></label>\n\t\t\t\t\t</div>'
            }
        }, {
            data: "stt",
            className: "text-center",
            render: function(t, e, r, n) {                 
                return n.row + 1
            }
        }, {
            data: "uid",
        }, {
        	data: "name",
        }, {
        	data: "email",
        }, {
            data: "customer_name",
        }, {
            data: "action",
            className: "text-center",
            render: function(t, e, r) {
                return "<button class='btn btn-sm btn-primary btn-danger btn_delete_account' title='Xóa tài khoản'><i class='fa fa-trash'></i></button>"
            }
        }]
	});
    $("body").on("click", ".btn_delete_account", (function() {
        let array = [];
        let e = c.row($(this).parents("tr")).data();
        array.push(e.id);
        $.ajax({ 
            url: domain + "Account",
            type: "POST",
            data: {
                op: "action_account",
                _token: _token,
                id: array
            } 
        }).done(function (e) {
            thongbao("Xóa thành công", "success"),load_account();
        });
    })), $("body").on("click", ".delete_all", (function() {
        let array =[];
        if ($(".table_account_checkbox:checked").each((function() {
            array.push(this.value)
        })), 0 == array.length) return thongbao("Chưa chọn nội dung"), !1;
        $.ajax({
            url: domain + "Account",
            type: "POST",
            data: {
                op: "action_account",
                _token: _token,
                id: array
            } 
        }).done(function (e) {
            thongbao("Xóa thành công", "success"), load_account();
        });
    }))


