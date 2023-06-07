<ul class="nav nav-tabs" id="myTab" role="tablist">
   <li class="nav-item">
        <a class="nav-link-2 active" id="list-all-tab" data-toggle="tab" href="#list-all" role="tab"
        aria-controls="list-all" aria-selected="false"> <label class="nav_image"> All </label></a>
    </li>
    <li class="nav-item">
        <a class="nav-link-2" id="list-in-progress-tab" data-toggle="tab" href="#list-in-progress" role="tab"
        aria-controls="list-in-progress" aria-selected="false"> <label class="nav_image"> In-Progress </label></a>
    </li>
    <li class="nav-item">
        <a class="nav-link-2" id="list-completed-tab" data-toggle="tab" href="#list-completed" role="tab"
        aria-controls="list-completed" aria-selected="false"> <label class="nav_image"> Completed </label></a>
    </li>
 </ul>
 <div class="tab-content" id="myTabContent">
   <div class="tab-pane fade show active" id="list-all" role="tabpanel" aria-labelledby="list-all-tab">
      @include('teachers.myclasses.subtabs.list.all')
   </div>
   <div class="tab-pane fade" id="list-in-progress" role="tabpanel" aria-labelledby="list-in-progress-tab">
      @include('teachers.myclasses.subtabs.list.in-progress') 
   </div>
   <div class="tab-pane fade" id="list-completed" role="tabpanel" aria-labelledby="list-completed-tab">
      @include('teachers.myclasses.subtabs.list.completed')
   </div>

 </div>