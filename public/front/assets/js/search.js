function smart_search(ev)
{
    let base_url = $('meta[name="site_url"]').attr("content");
    var search = $("#search").val();
    var privilege = $("#privilege").val();
    
     // check if search is empty
    if(search == "")
    {   
        $("#result_list").html("");
        $("#result").hide();
    }
    else
    {
        var role;
       $("#result").show();
        if(privilege == 3) {  role = "/parents";}
        // alert(role);
        $.get(base_url + role +"/smart-search", {search:search}, function (data,status,error) 
        {
            
             if(data)
            {
              $("#result_list").html(data);
            }
            else
            {
               $("#result_list").html(error);
            }

        });

    }
 };



$("body").on("keyup", "#search", smart_search);