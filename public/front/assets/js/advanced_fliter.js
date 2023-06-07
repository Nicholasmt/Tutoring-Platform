function subjects(ev)
{
     let base_url = $('meta[name="site_url"]').attr("content");
     var subject = $("#subject").val(); 
      if(subject) { 
        $('#explore').hide()
        $('#explore_paginate').hide()
        $('#show_fliter').show()
     }
     else{  
        $('#explore').hide()
        $('#explore_paginate').hide()
        $('#show_fliter').show()
    }
     $.get(base_url + "/advanced-fliter", {subject:subject}, function (data,status,error) {

       if (data) {
            $("#show_fliter").html(data);
           
        } else {
            $("#show_fliter").html(error);
        }
       
    });
  }
   
  function levels(ev)
  {
     let base_url = $('meta[name="site_url"]').attr("content");
     var level = $("#level").val(); 
      if(level) { 
        $('#explore').hide()
        $('#explore_paginate').hide()
        $('#show_fliter').show()
     }
     else{  
        $('#explore').hide()
        $('#explore_paginate').hide()
        $('#show_fliter').show()
    }
     $.get(base_url + "/advanced-fliter", {level:level}, function (data,status,error) {

       if (data) {
            $("#show_fliter").html(data);
           
        } else {
            $("#show_fliter").html(error);
        }
       
    });
  }

  function prices(ev)
  {
     let base_url = $('meta[name="site_url"]').attr("content");
     var price = $("#price").val(); 
      if(price) { 
        $('#explore').hide()
        $('#explore_paginate').hide()
        $('#show_fliter').show()
     }
     else{  
        $('#explore').hide()
        $('#explore_paginate').hide()
        $('#show_fliter').show()
    }
     $.get(base_url + "/advanced-fliter", {price:price}, function (data,status,error) {

       if (data) {
            $("#show_fliter").html(data);
           
        } else {
            $("#show_fliter").html(error);
        }
       
    });
  }

  function gender(ev)
  {
     let base_url = $('meta[name="site_url"]').attr("content");
     var gender = $("#gender").val(); 
      if(gender) { 
        $('#explore').hide()
        $('#explore_paginate').hide()
        $('#show_fliter').show()
     }
     else{  
        $('#explore').hide()
        $('#explore_paginate').hide()
        $('#show_fliter').show()
    }
     $.get(base_url + "/advanced-fliter", {gender:gender}, function (data,status,error) {

       if (data) {
            $("#show_fliter").html(data);
           
        } else {
            $("#show_fliter").html(error);
        }
       
    });
  }

  function days(ev)
  {
     let base_url = $('meta[name="site_url"]').attr("content");
     var day = $("#day").val(); 
      if(day) { 
        $('#explore').hide()
        $('#explore_paginate').hide()
        $('#show_fliter').show()
     }
     else{  
        $('#explore').hide()
        $('#explore_paginate').hide()
        $('#show_fliter').show()
    }
     $.get(base_url + "/advanced-fliter", {day:day}, function (data,status,error) {

       if (data) {
            $("#show_fliter").html(data);
           
        } else {
            $("#show_fliter").html(error);
        }
       
    });
  }

  $("body").on("change", "#subject", subjects);
  $("body").on("change", "#level", levels);
  $("body").on("change", "#price", prices);
  $("body").on("change", "#gender", gender);
  $("body").on("change", "#day", days);