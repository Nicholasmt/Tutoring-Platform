@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div id="app">
<div class="loader"></div>
    <section class="section">
      <div class="container mt-4">
      <span class="auth-header">
			   <a href="{{ route('index')}}"><img class="text-left" src="{{ asset('front/assets/img/logo.svg')}}" alt="logo"></a>
		</span>
	   <div class="row justify-content-center mt-4">
          <div class="col-12 col-md-12 col-md-12 col-lg-12 col-xl-12">
            <!-- <a href="" class="">Back</a> -->
            <div class="card  mt-2">
              <div class="auth-header text-center mt-5">
                <h4 class="font-24">OLUKOTIDE’S PRIVACY POLICY</h4>
              </div>
              <div class="card-body">
			     <p class="">
                    OLUKOTIDE is an educational service agency offering premium and bespoke services to all our clients. We specialized in connecting parents with highly qualified, experienced and professional teachers/tutors. 
                    Welcome to the OLUKOTIDE team! Thanks for taking the time to learn more about us. We are striving to provide the best educational tutoring services to your precious children.
                    The OLUKOTIDE service (collectively, " OLUKOTIDE ", "the Site", or "the Service") is operated by OLUKOTIDE. By accessing this Platforms, you are agreeing to be bound by the Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this Platforms are protected by applicable copyright and trademark law. <br>
                    REGISTRATION DATA AND ACCOUNT SECURITY <br>
                    Upon subscribing to the OLUKOTIDE’s services, you will have an account and a password. Access to the site would only be available as long as all required fees are paid. You are responsible for ensuring the confidentiality of your account and password and restricting the access of others to your account.
                    You are also responsible for all activities that occur under your account or password. OLUKOTIDE reserves the right to refuse service, terminate accounts, remove or edit content, or cancel subscription in its sole discretion. <br>
                    USE LICENSE <br>
                    Permission is granted to a terminable non-exclusive, non-transferable license to use OLUKOTIDE Platforms for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
                    modify or copy the materials
                    use the materials for any commercial purpose, or for any public display (commercial or non-commercial)
                    attempt to decompile or reverse engineer any software contained on OLUKOTIDE Platforms
                    remove any copyright or other proprietary notations from the materials or
                    transfer the materials to another person or "mirror" the materials on any other server
                    This license shall automatically terminate if you violate any of these restrictions and may be terminated by OLUKOTIDE at any time <br>

                    TRADEMARKS <br>
                    OLUKOTIDE and other Company graphics, logos, designs, page headers, button icons, scripts and service names are registered trademarks, trademarks and/or as part of domain names, in connection with any product or service in any manner that is likely to cause confusion and may not be copied, imitated, or used, in whole or in part, without the prior written permission of the Company. <br>
                    WARRANTIES AND DISCLAIMERS <br>
                    The materials on OLUKOTIDE Platforms makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, OLUKOTIDE does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet Platforms or otherwise relating to such materials or on any sites linked to this site.
                    The Service may be temporarily unavailable from time to time for maintenance or other reasons. OLUKOTIDE assumes no responsibility for any error, omission, interruption, deletion, defect, delay in operation or transmission, communications line failure, theft or destruction or unauthorized access to, or alteration of, communications.
                    Under no circumstances will OLUKOTIDE be responsible for any loss or damage, to any User or personal injury or death, resulting from anyone’s use of the Site or the Service, any User Content or Third-Party Applications, Software or Content posted on or through the Site or the Service or transmitted to Users, or any interactions between users of the Site, whether online or offline. <br>
                    USER CONTENT <br>
                    You understand that except for advertising programs offered by us on the Site, the Service and the Site are available for your personal, non-commercial use only. You represent, warrant and agree that no materials of any kind submitted through your account or otherwise posted, transmitted, or shared by you on or through the Service will violate or infringe upon the rights of any third party, trademark, privacy, publicity or other personal or proprietary rights; or contain libelous, defamatory or otherwise unlawful material. <br>
                    USER CONDUCT <br>
                    You understand that the Site is available for your personal, non-commercial use only. You represent, warrant, and agree that no materials of any kind submitted through your account or otherwise posted, transmitted, or shared by you on or through the Service will violate or infringe upon the rights of any third party, trademark, privacy, publicity or other personal or proprietary rights; or contain libelous, defamatory or otherwise unlawful material. <br>
                    LIMITATION OF LIABILITY
                    In no event shall OLUKOTIDE be liable for any damages (damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on OLUKOTIDE Internet site, even if OLUKOTIDE authorized representative has been notified orally or in writing of the possibility of such damage
                    REVISIONS AND ERRATA <br>
                    The materials appearing on OLUKOTIDE Platforms could lude technical, typographical, or photographic errors. OLUKOTIDE does not warrant that any of the materials on its Platforms are accurate, complete, or current. OLUKOTIDE, may make changes to the materials contained on its Platforms at any time without notice. OLUKOTIDE does not, however, make any commitment to update the materials. <br>
                    LINKS <br>
                    OLUKOTIDE has not reviewed all of the sites linked to its Internet Platforms and is not responsible for the contents of any such linked site. The visibility of any link does not imply endorsement by OLUKOTIDE of the site. Use of any such linked Platforms is at the user’s own risk. <br>
                    SITE TERMS OF USE MODIFICATION <br>
                    OLUKOTIDE may revise these terms of use for its Platforms at any time without notice. By using this Platforms you are agreeing to be bound by the then current version of these Terms and Conditions of Use <br>
                    GOVERNING LAW <br>
                    Any claim relating to OLUKOTIDE’s Platforms shall be governed by the laws of the Federal Republic of Nigeria. <br>
                    PROPRIETARY RIGHTS <br>
                    You acknowledge and agree that the Service and any necessary software used in connection with the Service contain proprietary and confidential information that are protected by applicable intellectual property and other laws. You further acknowledge and agree that content contained in information presented to you through the Service is protected by copyrights, trademarks, service marks, patents or other proprietary rights and laws. <br>
                    INDEMNIFICATION <br>
                    You agree to indemnify, defend and hold harmless OLUKOTIDE, its officers, directors, employees, agents, other service providers, vendors or customers from and against all losses, expenses, damages and costs, resulting from any violation of these Terms and Conditions of Use by you or any harm you may cause to anyone in connection with your use of the Service. <br>
                    ENTIRE AGREEMENT
                    The Terms and Conditions of Use governs your use of the Service and constitutes the entire agreement between you and OLUKOTIDE. It supersedes any prior agreements between you and OLUKOTIDE. <br>
                    MISCELLANEOUS <br>
                    Any failure by OLUKOTIDE to exercise any rights or enforce any of the terms of these Terms and Conditions of Use shall not constitute a waiver of such rights or terms. If any provision of these Terms and Conditions of Use or its application in a particular circumstance is held to be invalid or unenforceable to any extent, the remainder of these Terms and Conditions of Use, or the application of such provision in other circumstances, shall not be affected thereby, and each provision hereof shall be valid and enforced to the fullest extent permitted by law. <br>
                    SUBSCRIPTION PERIOD <br>
                    You will be entitled to receive the Service only during the subscription period ("Subscription Period") specified by your payment confirmation. <br>

                    REDISTRIBUTION OF SERVICES <br>
                    You agree not to reproduce, duplicate, copy, sell, trade, resell or exploit for any commercial purposes, any portion of the Service use of the Service, or access to the Service. <br>
                    WAIVER AND SEVERABILITY OF TERMS <br>
                    The failure of OLUKOTIDE to exercise or enforce any right or provision of the Terms and Conditions of Use shall not constitute a waiver of such right or provision. If any provision of the Terms and Conditions of Use is found by a court of competent jurisdiction to be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties’ intentions as reflected in the provision, and the other provisions of the Terms and Conditions of Use remain in full force and effect. <br>
                    ELECTRONIC COMMUNICATIONS <br>
                    When you visit this Platforms and when you communicate with us electronically, for example by sending us an email or ordering our products online, you consent to receive communications from us electronically. We will communicate with you by email or by posting notices on this Platforms. You agree that all agreements, notices, disclosures, and other communications that we provide to you electronically satisfy any legal requirement that such communications be in writing. <br>
                    PRIVACY POLICY <br>
                    You consent to the collection, processing and storage by OLUKOTIDE of your personal information in accordance with the terms of OLUKOTIDE Privacy Policy, which is available at www.olukotide.picanasavings.com. You agree to comply with all applicable laws and regulations, and the terms of OLUKOTIDE’s Privacy Policy, with respect to any access, use and/or submission by you of any personal information in connection with this platform. <br>
                   </p>     
              </div>
             </div>
            </div>
           </div>
        </div>
      </div>
      <div class="text-left ml-4 text-black mt-5">
        <p><a target="_blank" >{{date('Y')}} &copy; Olukotide. All rights reserved.</i></a></p>
      </div>
    </section>
   
  </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('back/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('back/assets/js/custom.js')}}"></script>
</body>

@endsection