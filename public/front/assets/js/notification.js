$(document).ready(function () {
   $("#messages").on("click", function() {
     if($('input[name="messages"]').is(':checked'))
    {
        $('#message').val("1",true);
    }
     else
    {
       $('#message').val("0",true);
    }
  });
  $("#activities").on("click", function() {
    if($('input[name="activities"]').is(':checked'))
   {
       $('#activity').val("1",true);
   }
    else
   {
      $('#activity').val("0",true);
   }
 });
 $("#offer").on("click", function() {
    if($('input[name="offer"]').is(':checked'))
   {
       $('#offers').val("1",true);
   }
    else
   {
      $('#offers').val("0",true);
   }
 });
 $("#everythings").on("click", function() {
    if($('input[name="everythings"]').is(':checked'))
   {
       $('#everything').val("1",true);
   }
    else
   {
      $('#everything').val("0",true);
   }
 });
 $("#send_as_emails").on("click", function() {
    if($('input[name="send_as_emails"]').is(':checked'))
   {
       $('#send_as_email').val("1",true);
   }
    else
   {
      $('#send_as_email').val("0",true);
   }
 });

 $("#no_pushs").on("click", function() {
    if($('input[name="no_pushs"]').is(':checked'))
   {
       $('#no_push').val("1",true);
   }
    else
   {
      $('#no_push').val("0",true);
   }
 });

 $(".education_visible").on("click", function() {
   if($('input[name="education_visible"]').is(':checked'))
  {
      $('#edu_visibility').val("1",true);
  }
   else
  {
     $('#edu_visibility').val("0",true);
  }
});

// $(".cert_visible").on("click", function() {
//    if($('input[name="visible"]').is(':checked'))
//   {
//       $('.cert_visible').val("1",true);
//   }
//    else
//   {
//      $('.cert_visible').val("0",true);
//   }
// });


});