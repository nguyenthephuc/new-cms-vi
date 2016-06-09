// function login
function login($url)
{
	jQuery("#resutl_message").show();
	jQuery("#resutl_message").html('checking account...');
	jQuery.ajax({
		url: $url,
		type: "post",
		dataType: "json",
		data: {
			username: jQuery("input[name='username']").val(),
			password: jQuery("input[name='password']").val()
		},
		success: function(result){
			if(!result['status']){
				jQuery("#resutl_message").html(result['message']);
				if(result['remove']){
					jQuery("h3[class='panel-title']").html(result['message']).css("color", "red");
					jQuery("div[class='panel-body']").hide();
				}
			}
			else{
				jQuery("#resutl_message").html(result['message']);
				$(location).attr('href', result['redirect']);
			}
		}
	});
}

function messagebox(message, title, buttonText)
{
	buttonText = (buttonText == undefined) ? "Ok" : buttonText;
	title = (title == undefined) ? "The page says:" : title;

	var div = $('<div>');
	div.html(message);
	div.attr('title', title);
	div.dialog({
		autoOpen: true,
		modal: true,
		draggable: false,
		resizable: false,
		buttons: [{
			text: buttonText,
			click: function () {
				$(this).dialog("close");
				div.remove();
			}
		}]
	});
}

function PopupCenterDual(url, title, w, h) {
	// Fixes dual-screen position Most browsers Firefox
	var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
	var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
	width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
	height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

	var left = ((width / 2) - (w / 2)) + dualScreenLeft;
	var top = ((height / 2) - (h / 2)) + dualScreenTop;
	var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

	// Puts focus on the newWindow
	if (window.focus) {
		newWindow.focus();
	}
}

function remove_src(id_file, id_img, id_click)
{
    jQuery(id_file).val('');
    jQuery(id_img).removeAttr('src');
    jQuery(id_click).hide();

    jQuery('<input>').attr({
        type: 'hidden',
        name: id_file.replace('#',''),
        value: ''
    }).appendTo('form');
    jQuery(id_img).hide();
}

var preview = function(event, id, file, click) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById(id);
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);

    if(jQuery(file).val().length > 0){
        jQuery(click).css("display", "block");
    }
};

function to_slug(str) {
    // Chuyển hết sang chữ thường
    str = str.toString().toLowerCase();
    // xóa dấu
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
    // Xóa ký tự đặc biệt
    str = str.replace(/([^0-9a-z-\s])/g, '');
    // Xóa khoảng trắng thay bằng ký tự -
    str = str.replace(/(\s+)/g, '-');
    // xóa phần dự - ở đầu
    str = str.replace(/^-+/g, '');
    // xóa phần dư - ở cuối
    str = str.replace(/-+$/g, '');
    // return
    return str;
}