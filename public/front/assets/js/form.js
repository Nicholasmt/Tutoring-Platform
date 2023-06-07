function add_schedule(ev)
{
    let base_url = $('meta[name="site_url"]').attr("content");
    let counter=parseInt($('#counter_3').val());
    $("#schedule_btn").removeAttr("disabled");
    $('#counter_3').val(counter+=1);
    count = $('#counter_3').val();
    $.get(base_url + "/teachers/add-schedule/"+count, { }, function (data,status,error) {
        if (data) {
            $("#schedule_content").append(data);

        } else {
            $("#schedule_content").html(error);
        }
    });
 }

 function add_certification(ev)
{ 
    let base_url = $('meta[name="site_url"]').attr("content");
    let counter=parseInt($('#counter_2').val());
    $('#counter_2').val(counter+=1);
    count = $('#counter_2').val();
    $("#certifications_btn").removeAttr("disabled");
    $.get(base_url + "/teachers/add-certification/"+count, { }, function (data,status,error) {
        if (data) {
          
            $("#certification-contents").append(data);
           } 
        else {
            $("#certification-contents").html(error);
        }
    });
 }

 function add_qualification(ev)
 { 
     let base_url = $('meta[name="site_url"]').attr("content");
     let counter = parseInt($('#counter_1').val());
     $('#counter_1').val(counter+=1);
     count = $('#counter_1').val();
     $("#education_btn").removeAttr("disabled");
     $.get(base_url + "/teachers/add-qualification/"+count, { }, function (data,status,error) {
         if (data) {
           
             $("#qualification-contents").append(data);
            } 
         else {
             $("#qualification-contents").html(error);
         }
     });
  }

 function form_completed(ev)
 {
     let base_url = $('meta[name="site_url"]').attr("content");
     $.get(base_url + "/teachers/form-completed", { }, function (data,status,error) {
         if (data) {
             $("#completed-form").html(data);
 
         } else {
             $("#completed-form").html(error);
         }
     });
  }

 
function remove_form(ev) {
    let session=$(this).attr('data-value');
    $("#schedule_btn").attr("disabled",true);
    $("#education_btn").attr("disabled",true);
    $("#certifications_btn").attr("disabled",true);
    ev.preventDefault();
    $("#field_"+session).remove(); //Remove field htm
}

 



$("body").on("click touchstart", "#add-schedule-btn", add_schedule);
$("body").on("click touchstart", "#add-certification-btn", add_certification);
$("body").on("click touchstart", "#add-qualification-btn", add_qualification);
$("body").on("click touchstart", "#remove-schedule-btn", remove_form);
$("body").on("click touchstart", "#finish-btn", form_completed);

 