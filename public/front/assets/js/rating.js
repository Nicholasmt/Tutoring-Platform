 
  const allStars = document.querySelectorAll('.star');
  let current_rating = document.querySelector('.current_rating');
    allStars.forEach((star, i) =>{
    star.onclick = function() {
     let current_star_level = i + 1;
      // console.log(current_star_level);
      current_rating.innerText = `${current_star_level} of 5`;

      $("body").on("click", "#save_rating_btn", function(ev)
      {

          $('#feedbackModal').modal('toggle');
          
          let base_url = $('meta[name="site_url"]').attr("content");
          let value = $(this).attr("value");
          var title =$("input[name=title]").val();
          var zoom =$("input[name=zoom]").val();
          var booking =$("input[name=booking]").val();
          var message =$("textarea[name=message]").val();
        $.get(base_url + "/parents/save-rating/" + value, {current_star_level:current_star_level,title:title,message:message,zoom:zoom,booking:booking}, function (data,status,error) {
              if (data) {

                $("#ratingModal").modal('hide');

                $("#success_rating").html(data);
      
              } else {
                   $("#success_rating").html(error);
              }
          });

       });
      allStars.forEach((star,j) =>{
      if(current_star_level >= j+1)
      {
        star.innerHTML = '&#9733';
      }  
      else
      {
          star.innerHTML = '&#9734'; 
      }
       });

    };

 }); 


 
 
      

 
  

 
  