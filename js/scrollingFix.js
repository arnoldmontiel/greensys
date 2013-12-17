// Modal Opene / Background scrolling fix

//Adding class to hack the css when modal is opened. Overflow hidden will be applyed to modal-open body class.

$(function(){
$("#myModal").on("show", function () {
  $("body").addClass("modal-open");
}).on("hidden", function () {
  $("body").removeClass("modal-open")
});

$("#myModalSerie").on("show", function () {
  $("body").addClass("modal-open");
}).on("hidden", function () {
  $("body").removeClass("modal-open")
});
});



