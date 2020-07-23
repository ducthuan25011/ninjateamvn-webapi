	load_coupon();
	function load_coupon(){
		$.ajax({ 
            url: domain + "Coupon",
            type: "POST",
            data: {
            	op: "load_coupon",
                _token: _token,
            } 
        }).done(function (e) {
        	if (e) {
        		e = JSON.parse(e);
				c.clear().draw(), c.rows.add(e).draw(), check_all("table_coupon_checkbox");
        	}
        });
	}
	var c = $("#table_coupon").DataTable({
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
                return '<div class="custom-control custom-checkbox">\n\t\t\t\t\t\t<input type="checkbox" class="custom-control-input table_coupon_checkbox" id="table_coupon_checkbox' + o.row + "\" value='" + n.id + '\'>\n\t\t\t\t\t\t<label class="custom-control-label" for="table_coupon_checkbox' + o.row + '"></label>\n\t\t\t\t\t</div>'
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
        	data: "discount",
            render: function(t, e, r, n) {                 
                return new Intl.NumberFormat().format(t);
            }
        }, {
        	data: "type",
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
                return "<button class='btn btn-sm btn-primary btn_edit_coupon' title='Sửa khuyến mại'><i class='fa fa-edit'></i></button>\n                <button class='btn btn-sm btn-primary btn-danger btn_delete_coupon' title='Xóa khuyến mại'><i class='fa fa-trash'></i></button>"
            }
        }]
	});
    $("body").on("click", ".add_coupon", (function() {
        let name= $("#txt_name").val();
        if (name == "") {return thongbao("Chưa nhập tên khuyến mại")};
        let discount = $("#txt_discount").val();
        if (discount == "") {return thongbao("Chưa nhập giảm giá khuyến mại")};
        let type = $("#select_type").val(),
            from = $("#txt_start_time").val(),
            to = $("#txt_end_time").val();
        if (from == "" || from == "__/__/____") { return thongbao("Chưa nhập thời gian bắt đầu")};
        if (to == "" || to == "__/__/____") { return thongbao("Chưa nhập thời gian kết thúc")};
        let fromdate = $("#txt_start_time").datetimepicker("getValue"),
            todate = $("#txt_end_time").datetimepicker("getValue");
        let = start_time = fromdate.getTime() / 1e3, end_time = todate.getTime() /1e3;
        if (start_time > end_time) {return thongbao("Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc")};
        end_time = end_time + 86400;
        $.ajax({
            url: domain + "Coupon",
            type: "POST",
            data: {
                op: "add_coupon",
                _token: _token,
                name: name,
                discount: discount,
                type: type,
                start_time: start_time,
                end_time: end_time
            } 
        }).done(function (e) {
            thongbao("Lưu thành công", "success"), load_coupon();
        });
    })) ,$("body").on("click", ".btn_delete_coupon", (function() {
        let array = [];
        let e = c.row($(this).parents("tr")).data();
        array.push(e.id);
        $.ajax({ 
            url: domain + "Coupon",
            type: "POST",
            data: {
                op: "action_coupon",
                _token: _token,
                id: array
            } 
        }).done(function (e) {
            thongbao("Xóa thành công", "success"),load_coupon();
        });
    })), $("body").on("click", ".delete_all", (function() {
        let array =[];
        if ($(".table_coupon_checkbox:checked").each((function() {
            array.push(this.value)
        })), 0 == array.length) return thongbao("Chưa chọn nội dung"), !1;
        $.ajax({
            url: domain + "Coupon",
            type: "POST",
            data: {
                op: "action_coupon",
                _token: _token,
                id: array
            } 
        }).done(function (e) {
            thongbao("Xóa thành công", "success"), load_coupon();
        });
    })) ,$("body").on("click", ".btn_edit_coupon", (function() {
        let e = c.row($(this).parents("tr")).data();
        $(".edit_coupon").attr("data-id", e.id);
        $(".edit_coupon").removeClass("hidden"), $(".add_coupon").addClass("hidden");
        $("#txt_name").val(e.name), $("#txt_discount").val(e.discount), $("#select_type").val(e.type).change();
        $("#txt_start_time").val(timeConverter(e.start_time, 2));
        $("#txt_end_time").val(timeConverter(e.end_time, 2));
    })), $("body").on("click", ".edit_coupon", (function(){
        let id = $(this).attr("data-id"),
            name= $("#txt_name").val();
        if (name == "") {return thongbao("Chưa nhập tên khuyến mại")};
        let discount = $("#txt_discount").val();
        if (discount == "") {return thongbao("Chưa nhập giảm giá khuyến mại")};
        let type = $("#select_type").val(),
            from = $("#txt_start_time").val(),
            to = $("#txt_end_time").val();
        if (from == "" || from == "__/__/____") { return thongbao("Chưa nhập thời gian bắt đầu")};
        if (to == "" || to == "__/__/____") { return thongbao("Chưa nhập thời gian kết thúc")};
        let fromdate = $("#txt_start_time").datetimepicker("getValue"),
            todate = $("#txt_end_time").datetimepicker("getValue");
        let = start_time = fromdate.getTime() / 1e3, end_time = todate.getTime() /1e3;
        if (start_time > end_time) {return thongbao("Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc")};
        end_time = end_time + 86400;
        $.ajax({ 
            url: domain + "Coupon",
            type: "POST",
            data: {
                op: "update_coupon",
                _token: _token,
                id: id,
                name: name,
                discount: discount,
                type: type,
                start_time: start_time,
                end_time: end_time
            } 
        }).done(function (e) {
            thongbao("Cập nhật thành công", "success"),load_coupon();
        });
    }))


