function update(id, status, url)
{
	jQuery.ajax({
		url: url,
		type: "post",
		dataType: "json",
		data: {
			id: id,
			status: status
		},
		success: function(result){
			if(result['status']){
				window.location.reload();
			}
		}
	});
}