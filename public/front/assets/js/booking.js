 function selected_time(ev)
 {
      let base_url = $('meta[name="site_url"]').attr("content");
      var value = $("#teacher").val();
      var date = $("#date").val();
      var selected_dates = $("#selected_dates").val();
      var selected = new Array();
      $("input[name=booking_time]:checked").each(function(){
            selected.push($(this).val());
      });
    //   alert(selected);
     
      $.get(base_url + "/parents/selected-time/" + value, {selected:selected,date:date,selected_dates:selected_dates}, function (data,status,error) {
        if (data) {
           $("#schedule_times").html(data);
         } else {
             $("#schedule_times").html(error);
         }
         
       });
     

   }




   function checkout(ev)
   {
        let base_url = $('meta[name="site_url"]').attr("content");
        var id = $("#teacher").val();
        var category = $("#category").val();
        var subject = $("#subject").val();
        var meetup = $("#meetup").val();
        var selected_dates = $("#selected_dates").val();
        var selected = new Array();
        $("input[name=booking_time]:checked").each(function(){
            selected.push($(this).val());
        });
       
        $.get(base_url + "/parents/checkout-booking", {id:id,selected:selected,selected_dates:selected_dates,meetup:meetup,subject:subject,category:category}, function (data,status,error) {
  
           if (data) {
               $("#checkout_booking").html(data);
              
           } else {
               $("#checkout_booking").html(error);
           }
          
       });
       ev.preventDefault();
     }


function booking_requests(ev)
{
     let base_url = $('meta[name="site_url"]').attr("content");
     let value = $(this).attr("value");
      $.get(base_url + "/teachers/view-booking-request/" + value, {}, function (data,status,error) {

       if (data) {
            $("#booking_requests").html(data);
           
        } else {
            $("#booking_requests").html(error);
        }
       
    });
  }

  function view_orders(ev)
{
     let base_url = $('meta[name="site_url"]').attr("content");
     let value = $(this).attr("value");
      $.get(base_url + "/parents/view-booking-request/" + value, {}, function (data,status,error) {

       if (data) {
            $("#booking_requests").html(data);
           
        } else {
            $("#booking_requests").html(error);
        }
       
    });
  }

  function online_Zoom_class(ev)
  {
       let base_url = $('meta[name="site_url"]').attr("content");
       var id = $("#booking").val();
       var time = $("#time").val();
        $.get(base_url + "/teachers/create-class", {time:time,id:id}, function (data,status,error) {
  
         if (data) {
              $("#zoom_class").html(data);
             
          } else {
              $("#zoom_class").html(error);
          }
         
      });
    }

    function checkout_bookings(ev)
    {
         let base_url = $('meta[name="site_url"]').attr("content");
         var id = $("#booking").val();
         var time = $("#time").val();
          $.get(base_url + "/teachers/create-class", {time:time,id:id}, function (data,status,error) {
    
           if (data) {
                $("#checkout").html(data);
               
            } else {
                $("#checkout").html(error);
            }
           
        });
      }
   
 
 $("body").on("click", "#selected", selected_time);
 $("body").on("click", "#checkout", checkout);
 $("body").on("click touchstart", "#booking_request", booking_requests);
 $("body").on("click touchstart", "#view_orders", view_orders);
 $("body").on("click touchstart", "#online_class", online_Zoom_class);
 $("body").on("click touchstart", "#book_button", checkout_bookings);
 