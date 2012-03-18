(function($) {
	$('#parentunitname').CascadingDropDownLiu('#parentunitname1', '/unit/getsecondlevelunit',
            {
		        promptText: '--全部--',
                loadingText: '加载中 ..',
                onLoading: function () {
                    $(this).css("background-color", "transparent");
                },
                onLoaded: function () {
                    $(this).animate({ backgroundcolor: '#ffffff' }, 300);
                }
            });
	alert("fff");
}
);