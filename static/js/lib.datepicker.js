$(function() {
$( "#datepicker" ).datepicker(
     {  dateFormat: "d M yy"
     });
});
$(".datepicker").live("focus", function(){
    $('.datepicker').datepicker({  dateFormat: "d M yy"
     });
});

$(function() {
$( "#datepicker2" ).datepicker(
     {  dateFormat: "d M yy"
     });
});

$(function() {
$( "#datepicker3" ).datepicker(
     {  dateFormat: "d M yy"
     });
});
