/*
scripts.js
*/

$(document).ready(function(){
	// submit delete forms
	$('#button-delete').on('click',function(e){
		e.preventDefault();
		$('#delete-form').submit();
	});
});