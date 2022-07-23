$().ready(function() {
    $("#validateForm").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "name":{ required: true, },
            "your_name":{ required: true, },
            "area":{ number: true, },
            "price":{ number: true, },
            "number":{ number: true, },
            "category_id":{ required: true, },
            "email":{ required: true, },
        },
        messages: {
            "name": {
                required: "Bắt buộc phải nhập ...",
            },
            "your_name": {
                required: "Bắt buộc phải nhập ...",
            },
            "area": {
                number: "Nhập số 88 / 8.8",
            },
            "price": {
                number: "Nhập số 88 / 8.8",
            },
            "number": {
                number: "Nhập số 88 / 8.8",
            },
            "category_id": {
                required: "Bắt buộc phải nhập ...",
            },
            "email": {required: "Bắt buộc phải nhập ...",},
        }
    });
});