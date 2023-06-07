<ul class="nav nav-tabs" id="myTab" role="tablist">
   <li class="nav-item">
        <a class="nav-link-2 active" id="all-tab" data-toggle="tab" href="#all" role="tab"
        aria-controls="all" aria-selected="false"> <label class="nav_image"> All </label></a>
    </li>
    <li class="nav-item">
        <a class="nav-link-2" id="in-progress-tab" data-toggle="tab" href="#in-progress" role="tab"
        aria-controls="in-progress" aria-selected="false"> <label class="nav_image"> In-Progress </label></a>
    </li>
    <li class="nav-item">
        <a class="nav-link-2" id="completed-tab" data-toggle="tab" href="#completed" role="tab"
        aria-controls="completed" aria-selected="false"> <label class="nav_image"> Completed </label></a>
    </li>
 </ul>
 <div class="tab-content" id="myTabContent">
   <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
      @include('teachers.myclasses.subtabs.grid.all')
   </div>
   <div class="tab-pane fade" id="in-progress" role="tabpanel" aria-labelledby="in-progress-tab">
      @include('teachers.myclasses.subtabs.grid.in-progress') 
   </div>
   <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
      @include('teachers.myclasses.subtabs.grid.completed')
   </div>

 </div>