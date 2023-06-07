function requests_paginate(ev)
      {
          let base_url = $('meta[name="site_url"]').attr("content");
          ev.preventDefault();
          let page = $(this).attr("href").split("page=")[1];
           $("#request-hide").hide();
          $.get(base_url + "/parents/requests-page" +"?page="+ page, { }, function (data,status,error) {
              if (data) {
                  $("#requests-data").html(data);
      
              } else {
                  $("#requests-data").html(error);
              }
          });
       }


       function myTeachers_paginate(ev)
      {
          let base_url = $('meta[name="site_url"]').attr("content");
          ev.preventDefault();
          let page = $(this).attr("href").split("page=")[1];
           $("#close_myteachers").hide();
            $.get(base_url + "/parents/list-techers-page" +"?page="+ page, {}, function (data,status,error) {
              if (data) {
                  $("#my-techers").html(data);
      
              } else {
                  $("#my-techers").html(error);
              }
          });

       
       }


       function gridTeacher_paginate(ev)
       {
           let base_url = $('meta[name="site_url"]').attr("content");
           ev.preventDefault();
           let page = $(this).attr("href").split("page=")[1];
            $("#close-myTechersGrid").hide();
           $.get(base_url + "/parents/grid-teachers-page" +"?page="+ page, {}, function (data,status,error) {
               if (data) {
                   $("#my-techers-grid").html(data);
       
               } else {
                   $("#my-techers-grid").html(error);
               }
           });
        }

        function currentTeacher_paginate(ev)
        {
            let base_url = $('meta[name="site_url"]').attr("content");
            ev.preventDefault();
            let page = $(this).attr("href").split("page=")[1];
             $("#close-currentTeacher").hide();
            $.get(base_url + "/parents/current-teachers-page" +"?page="+ page, {}, function (data,status,error) {
                if (data) {
                    $("#current-teacher").html(data);
        
                } else {
                    $("#current-teacher").html(error);
                }
            });
         }

         function transactions_paginate(ev)
         {
             let base_url = $('meta[name="site_url"]').attr("content");
             ev.preventDefault();
             let page = $(this).attr("href").split("page=")[1];
              $("#close_transaction-page").hide();
             $.get(base_url + "/parents/transaction-page" +"?page="+ page, {}, function (data,status,error) {
                 if (data) {
                     $("#transaction-page").html(data);
         
                 } else {
                     $("#transaction-page").html(error);
                 }
             });
          }

          function transactions_paginate_2(ev)
          {
              let base_url = $('meta[name="site_url"]').attr("content");
              ev.preventDefault();
              let page = $(this).attr("href").split("page=")[1];
               $("#close_transaction-page_2").hide();
              $.get(base_url + "/teachers/transaction-page" +"?page="+ page, {}, function (data,status,error) {
                  if (data) {
                      $("#transaction-page_2").html(data);
          
                  } else {
                      $("#transaction-page_2").html(error);
                  }
              });
           }
 

 
 $("body").on("click touchstart", ".pagination a", requests_paginate);
 $("body").on("click touchstart", ".pagination a", myTeachers_paginate);
 $("body").on("click touchstart", ".pagination a", gridTeacher_paginate);
 $("body").on("click touchstart", ".pagination a", currentTeacher_paginate);
 $("body").on("click touchstart", ".pagination a", transactions_paginate);
 $("body").on("click touchstart", ".pagination a", transactions_paginate_2);