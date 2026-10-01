$(function() {
    // Side Bar Toggle
    $('.hide-sidebar').click(function() {
	  $('#sidebar').hide('fast', function() {
	  	$('#content').removeClass('span9');
	  	$('#content').addClass('span12');
	  	$('.hide-sidebar').hide();
	  	$('.show-sidebar').show();
	  });
	});

	$('.show-sidebar').click(function() {
		$('#content').removeClass('span12');
	   	$('#content').addClass('span9');
	   	$('.show-sidebar').hide();
	   	$('.hide-sidebar').show();
	  	$('#sidebar').show('fast');
	});
});
function openCustomRoxy2(){
  $('#roxyCustomPanel2').dialog({modal:true, width:875,height:600});
}
function closeCustomRoxy2(){
  $('#roxyCustomPanel2').dialog('close');
}
function open_fms_file (id_input){
	$('#roxyCustomPanel2').dialog({modal:true, width:875,height:600});
	//window.open('/agwb/editor/filemanager/index.html?integration=custom', '','width=800,height=500');
//	window.KCFinder = {};
//    window.KCFinder.callBack = function(url) {
//		document.getElementById(id_input).value = url;
//        // Actions with url parameter here
//        window.KCFinder = null;
//    };
//    window.open('/agwb/editor/fms/browse.php?type=files', 'kcfinder_single','width=800,height=500');
}
function open_fms_file_location (location,id_input){
	window.KCFinder = {};
    window.KCFinder.callBack = function(url) {
		document.getElementById(id_input).value = url;
        // Actions with url parameter here
        window.KCFinder = null;
    };
    window.open('/agwb/editor/fms/browse.php?type=files', 'kcfinder_single','width=800,height=500');
}
function upload_fms_file_location (location){
    window.open('/agwb/editor/fms/browse.php?type=files&dir=files', 'kcfinder_single','width=800,height=500');
}