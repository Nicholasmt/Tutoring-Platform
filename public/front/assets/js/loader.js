 

$("body").on("click touchstart", "#back_btn", function(ev){
    let div1 =$("#load-details");
    let div2 =$("#hide");
    div1.css({
       'display': 'none'
      });
   div2.show();
});


function load_teacher(ev)
{
    let base_url = $('meta[name="site_url"]').attr("content");
    let value = $(this).attr("value");
    $('#current_teachers').hide();
    $.get(base_url + "/parents/load-teacher/"+value, { }, function (data,status,error) {
        if (data) {
            $("#load-content").html(data);

        } else {
            $("#load-content").html(error);
        }
    });
 }
 function load_requests(ev)
{
    let base_url = $('meta[name="site_url"]').attr("content");
    let value = $(this).attr("value");
    let div = $('#hide');
    let div2 = $('#load-details');
    div2.show();
       div.css({
        'display': 'none'
       });
    $.get(base_url + "/parents/load-request/"+value, { }, function (data,status,error) {
        if (data) {
            $("#load-details").html(data);

        } else {
            $("#load-details").html(error);
        }
    });
 }



 function all_teacher(ev)
{
    let base_url = $('meta[name="site_url"]').attr("content");
    let value = $(this).attr("value");
    let hide_div = $('#hide_div');
    hide_div.css({'display': 'none'});
    $.get(base_url + "/parents/load-teacher/"+value, { }, function (data,status,error) {
        if (data) {
            $("#load-teachers").html(data);

        } else {
            $("#load-teachers").html(error);
        }
    });
 }

 function booking_details(ev)
 {
     let base_url = $('meta[name="site_url"]').attr("content");
     let value = $(this).attr("value");
     $.get(base_url + "/parents/booking-details/"+value, { }, function (data,status,error) {
         if (data) {
             $("#booking-details").html(data);
 
         } else {
             $("#booking-details").html(error);
         }
     });
  }

  function teacher_viewDetails(ev)
  {
      let base_url = $('meta[name="site_url"]').attr("content");
      let value = $(this).attr("value");
      $.get(base_url + "/teachers/booking-details/"+value, { }, function (data,status,error) {
          if (data) {
              $("#booking-details").html(data);
  
          } else {
              $("#booking-details").html(error);
          }
      });
   }

  
 function parent_message(ev)
 {
     let base_url = $('meta[name="site_url"]').attr("content");
     let value = $(this).attr("value");
     let action = $('#action');
       action.css({
        'display': 'none'
       });
     $.get(base_url + "/parents/load-message/"+value, { }, function (data,status,error) {
         if (data) {
             $("#message-content").html(data);
 
         } else {
             $("#message-content").html(error);
         }
     });
  }


  function teachers_message(ev)
  {
      let base_url = $('meta[name="site_url"]').attr("content");
      let value = $(this).attr("value");
      let hide_message = $('#hide_message');
      hide_message.css({
         'display': 'none'
        });
      $.get(base_url + "/teachers/load-message/"+value, { }, function (data,status,error) {
          if (data) {
              $("#message-content2").html(data);
  
          } else {
              $("#message-content2").html(error);
          }
      });
   }

   function class_details(ev)
   {
       let base_url = $('meta[name="site_url"]').attr("content");
       let value = $(this).attr("value");
       let myclass = $('#myclass');
       myclass.css({
          'display': 'none'
         });
       $.get(base_url + "/teachers/class-details/"+value, { }, function (data,status,error) {
           if (data) {
               $("#myclass-content").html(data);
   
           } else {
               $("#myclass-content").html(error);
           }
       });
    }

   

      function ratings(ev)
      {
          let base_url = $('meta[name="site_url"]').attr("content");
          let value = $(this).attr("value");
          $.get(base_url + "/parents/ratings/" + value, { }, function (data,status,error) {
              if (data) {
                  $("#rating-modal").html(data);
      
              } else {
                  $("#rating-modal").html(error);
              }
          });
       }

       function complaints(ev)
       {
           let base_url = $('meta[name="site_url"]').attr("content");
           let value = $(this).attr("value");
           $.get(base_url + "/parents/complain-modal/" + value, { }, function (data,status,error) {
               if (data) {
                   $("#complain-modal").html(data);
       
               } else {
                   $("#complain-modal").html(error);
               }
           });
        }
      

        function select_breaktime(ev)
        {
            let base_url = $('meta[name="site_url"]').attr("content");
            // var value = $(this).attr("value");
            var from_new = $("#from").val();
            var to_new = $("#to_btn").val();
            $.get(base_url + "/teachers/time-break", {from_new:from_new,to_new:to_new}, function (data,status,error) {
                if (data) {
                    $("#select_time").html(data);
        
                } else {
                    $("#select_time").html(error);
                }
            });
         }

         function breaktime_formWizard(ev)
        {
            let base_url = $('meta[name="site_url"]').attr("content");
            var from_2 = $(".from_btn2").val();
            var to_2 = $(".to_btn2").val();
            $.get(base_url + "/teachers/formWizard-timebrake/", {from_2:from_2,to_2:to_2}, function (data,status,error) {
                if (data) {
                    $("#pick_time").html(data);
        
                } else {
                    $("#pick_time").html(error);
                }
            });
         }


         function reject_confirm(ev)
         {

             let base_url = $('meta[name="site_url"]').attr("content");
             var value = $(this).attr("value");
             $.get(base_url + "/admin/decline-info", {value:value}, function (data,status,error) {
                 if (data) 
                 {
                     $("#confirm_reject").html(data);
                 } 
             else {
                     $("#confirm_reject").html(error);
                  }
             });

         };

 
 $("body").on("click touchstart", "#load_teacher_btn", load_teacher);
 $("body").on("click touchstart", "#load_request_btn", load_requests);
 $("body").on("click touchstart", "#all_teachers_btn", all_teacher);
 $("body").on("click touchstart", "#booking_details_btn", booking_details);
 $("body").on("click touchstart", "#details_btn", teacher_viewDetails);
 $("body").on("click touchstart", "#message_btn", parent_message);
 $("body").on("click touchstart", "#message_view_btn", teachers_message);
 $("body").on("click touchstart", "#myclass_btn", class_details);
 $("body").on("click touchstart", "#rating_btn", ratings);
 $("body").on("click touchstart", "#compliants_btn", complaints);
 $("body").on("change touchstart", "#to_btn", select_breaktime);
 $("body").on("change touchstart", ".to_btn2", breaktime_formWizard);
 $("body").on("click touchstart", "#decline_btn", reject_confirm);
 $("body").on("click touchstart", "#decline_btn_2", reject_confirm);

