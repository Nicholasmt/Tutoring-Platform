
<html xmlns="">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
</head>
<body>
  <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" >
     <tr>
       <td align="center" class="td_1">
         <table class="content" width="10%" cellpadding="0" cellspacing="0" role="presentation">
        <!-- Start Header -->
            <tr>
              <td class="header" style="">
                <a href="{{ route('index')}}" class="header-link">
                 <img src="https://olukotide.picanasavings.com/front/assets/img/logo.svg" class="image-size mb-3" alt="Olukotide" height="60" width="60">
                </a>
             </td>
          </tr>
        <!-- End Header -->
        <tr>
          <td class="body" width="100%" cellpadding="0" cellspacing="0">
             <table class="inner-body table_3" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
               <!-- Body content -->
                <tr>
                   <td class="content-cell">
                      <!-- Start Body content -->
					    <div class="email-body">
                          <h4 class="mt">Hi {{$user->email}}</h4>
                            <h3 class="mb">You're almost there!  <span class="text-header"> </span></h3>
                            <p class="mb">Before you can start using Olukotide web App, you need to confirm your email address so we know its really you.
                             <br>We also use it to send you important information about your Olukotide account.</p>
                         </div>
                        <code class="warning-text">
                        </code>
                       <table class="action table_4" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" >
                          <tr>
                             <td align="center" class="td_5">
                               <table class="table_5" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" >
                                  <tr>
                                     <td align="center" class="td_6">
                                        <table class="table_6" border="0" cellpadding="0" cellspacing="0" role="presentation" >
                                           <tr>
                                              <td style="td_7">
                                                <a href="{{ route('confirm-email',$user->id)}}" class="button button-primary" target="_blank" rel="noopener" style="">Confirm your email</a>
                                              </td>
                                           </tr>
                                        </table>
                                     </td>
                                  </tr>
                               </table>
                             </td>
                          </tr>
                       </table>
                        <p class="">Thanks for joining us.</p>
                        
                        <!--End Body content -->
                   </td>
               </tr>
             </table>
          </td>
        </tr>
        <tr>
          <td class="td_8">
             <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
               <tr>
                  <td class="content-cell footer-text" align="center">
                    © {{date('Y')}}Olukotide. All rights reserved.
			      </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
  </td>
 </tr>
</table>
<style>
   .image-size{ 
        width: 200;
   }
   .email-body{
     text-align:left;
   }
</style>
 
<style>
	.logo-text{
        margin-top:-5%;
        color:white;
    }
	body
	{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;
	}
	.wrapper
	{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; 
        background-color: #f6f6f6; margin: 0; padding: 0; width: 100%;
	}
	
	.td_1
	{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;
	}
	
	.content
	{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;
	}
	.header
	{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; padding: 25px 0; text-align: center;
	}
	
	.header-link
	{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; color: #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; display: inline-block;
	}
	.logo
	{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; max-width: 100%; border: none; height: 75px; max-height: 75px; width: 200px;
	}
	
	.body
	{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; 
        background-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; margin: 0; padding: 0; width: 100%;
	}
	
	.table_3
	{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;
	}
	.table_4{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 30px auto; padding: 0; text-align: center; width: 100%;
	}
	.table_5{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;
	}
	.table_6{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;
	}
	 
	.text-body_1{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;
	   }
    .text-body_2
    {
        font-size:20px;
        font-weight:bolder;
        color:#1666ac;
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 20px; font-weight: bolder; color: #1666ac;
    }
	
	.text-body_3{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;
	}
	.td_5{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;
	}
	.td_6{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;
	}
	.td_7{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;
	}
	.td_8{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;
	}
	
	.button-primary{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -webkit-text-size-adjust: none; border-radius: 4px; display: inline-block; overflow: hidden; text-decoration: none;  
        border-bottom: 8px solid #033883;; border-left: 18px solid #033883;; 
        border-right: 18px solid #033883;; border-top: 8px solid #033883;;
        color: #fff;
        background-color: #033883;
         
	}
	
    .text-header
    {
        font-size:20px;
        font-weight:bolder;
         
        text-transform:capitalize;
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 20px; font-weight: bolder; 
        color: black; text-transform: capitalize;
    }
    .text-bold
    {
        font-weight:bolder;
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-weight: bolder;
    }
    .warning-text
    {
      font-weight:bolder;
      color:red;
	  font-weight: bolder; color: red;
    }
	.content-cell{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; max-width: 100vw; padding: 32px; 
        color: gray;
        text-align:center;
	}
	
	.footer{
		box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center; width: 570px;
        color:white;
	}
    .footer-text{
        color:#5181C4;
    }
	
	@media  only screen and (max-width: 600px) {
	.inner-body {
	width: 100% !important;
	}

	.footer {
	   width: 100% !important;
	   }
	}

	@media  only screen and (max-width: 500px) {
	.button {
	width: 100% !important;
  }
  }
</style>
  </body>
</html>