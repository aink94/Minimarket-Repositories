var table = $("#table").DataTable({
	"processing"   : true,
	"serverSide"   : true,
	"deferRender"  : false,
	"lengthChange" : false,
	"searching"    : false,
	"ordering"     : false,
	"info"         : false,
	"autoWidth"    : true,
	"ajax"		   : {
		"url"  : "penjualan/data",
		"data" : function(d){
			d.tanggal_awal = "",
			d.tanggal_akhir = ""
		}
	}
	// "ajax"		   : function (data, callback, settings) {
	// 	console.log("+++++++++++++++++++++++++ Data");
	// 	console.log(data);
	// 	console.log("+++++++++++++++++++++++++ Callback");
	// 	console.log(callback);
	// 	console.log("+++++++++++++++++++++++++ Setting");
	// 	console.log(settings);
	// }
});
$(function(){

});

// function buildSearchData(){
// 	var obj = {
// 	     "cmd" : "refresh",
// 	            "from": $("#from-date")+" "+$("#from-time").val(),
// 	            "to"  : $("#to-date").val()+" "+$("#to-time").val()
// 	};
// 	return obj;
// }

// function buildAjaxData (){
//         var settings = $("#table").DataTable().fnSettings();
//         console.log(settings);
         
//         var obj = {
//             //default params
//             "draw" : settings.iDraw,
//             "start" : settings._iDisplayStart,
//             "length" : settings._iDisplayLength,
//             "columns" : "",
//             "order": "",
             
//             "cmd" : "refresh",
//             "from": $("#from-date").val()+" "+$("#from-time").val(),
//             "to"  : $("#to-date").val()+" "+$("#to-time").val()
//             };
             
//             //building the columns
//             var col = new Array(); // array
             
//             for(var index in settings.aoColumns){
//                 var data = settings.aoColumns[index];
//                 col.push(data.sName);
                                 
//             }
             
//             var ord = {
//                 "column" : settings.aLastSort[0].col,
//                 "dir" : settings.aLastSort[0].dir
//             };
             
//             //assigning
//             obj.columns = col;
//             obj.order = ord;
             
//         return obj;
         
         
//     }

