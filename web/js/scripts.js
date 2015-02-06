/***
* scripts.js
*/

// jqGrid functions
function dateF(cellvalue, options, rowObject){
	return cellvalue.date.toString('yyyy-mm-dd');
}
function currency(cellvalue, options, rowObject){
    if(null==cellvalue) cellvalue = 0;
    return cellvalue.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}
function status(cellvalue, options, rowObject) {
	var html = cellvalue == 1 ? '<i class="fa fa-check-square-o" style="color:green"></i>' :"";
    return html;
}
function editar(cellvalue, options, rowObject) {
	// we are passing the url in formatoptions
	// id = cellvalue
	var url = options.colModel.formatoptions.url;
	url = url.replace('__id', cellvalue);
	html = '<a href="' + url + '" role="button" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';
	return html;
}
function borrar(cellvalue, options, rowObject) {
	// we are passing the url in formatoptions
	// id = cellvalue
	var url = options.colModel.formatoptions.url;
	url = url.replace('__id', cellvalue);
	html = '<a href="' + url + '" role="button" class="btn btn-xs btn-default"><i class="fa fa-trash-o"></i></a>';
	return html;
}
function jqGridLayout () {

	// jqGrid formatting
    // remove classes
    //$(".ui-pg-input").attr("style","width:10px;height:20px");
    $(".ui-pg-input").attr('style','width:20px')
    $(".ui-pg-selbox").attr("style","width:60px; height:20px;");
	$(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
	$(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
	//$(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
	//$(".ui-jqgrid-pager").removeClass("ui-state-default");
	$(".ui-jqgrid").removeClass("ui-widget-content");

	// add classes
	$(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
	$(".ui-jqgrid-btable").addClass("table table-bordered table-striped");

	$(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
	$(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
	$(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
	$(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
	$(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
	$(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
	$(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
	$(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");

	$(".ui-icon.ui-icon-seek-prev").wrap("<div class='btn btn-sm btn-default'></div>");
	$(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

	$(".ui-icon.ui-icon-seek-first").wrap("<div class='btn btn-sm btn-default'></div>");
	$(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");

	$(".ui-icon.ui-icon-seek-next").wrap("<div class='btn btn-sm btn-default'></div>");
	$(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

	$(".ui-icon.ui-icon-seek-end").wrap("<div class='btn btn-sm btn-default'></div>");
	$(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");

}

$(document).ready(function() {
	
	// submit delete forms
	$('#button-delete').on('click',function(e) {
		e.preventDefault();
		$('#delete-form').submit();
	});

	$('.datePicker').datepicker({minDate: 1, dateFormat: 'yy-mm-dd'});
	
	// set jqGrid defaults
	$.extend($.jgrid.defaults, {
	    pager: '#pager',
	    rowNum: 30,
	    rowList: [30, 50, 100, 150, 200],
        sortname: 'id',
        sortorder: 'desc',
        viewrecords: true,
        gridview: true,
        autowidth: true,
        height: '100%',
	});
	$.extend(jQuery.jgrid.del, {mtype: "DELETE"});
});