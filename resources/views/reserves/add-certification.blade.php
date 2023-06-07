@if($user->verify_ready == 1 || $user->is_verified == 1)
<div class="row" id="field_{{date('is')}}">
  <div class="ibox" id="{{date('is')}}">
  <div class="mt-4 ml-3">
    <h3>Certification {{$count}} </h3>
  </div>
  <div class="row mt-4 ml-5">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Title" value="{{old('certificate.' . $count-1 . '.title')}}" name="certificate[{{$count-1}}][title]"  required>
            <div class="invalid-feedback">
              Enter Title
            </div>
            </div>
         </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Description" value="{{old('certificate.' . $count-1 . '.description')}}" name="certificate[{{$count-1}}][description]" required >
            <div class="invalid-feedback">
              Enter Description
           </div>
           </div> 
        </div>
        </div>

      <div class="col-md-6">
      <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Issued</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Issued" value="{{old('certificate.' . $count-1 . '.issued')}}" name="certificate[{{$count-1}}][issued]"  required>
            <div class="invalid-feedback">
               Enter Issued
            </div>
            </div> 
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Upload File:</label>
            <div class="col-sm-9">
                <input type="file" class="form-control-file"  name="certificate[{{$count-1}}][certification_upload]" required>
             <div class="invalid-feedback">
               Upload a file
            </div>
            </div> 
        </div>
     </div>
    </div>
  </div>
  <div class="col-md-6 ml-5">
      <div class="form-group row"> <a class="btn btn-danger text-white" data-value="{{date('is')}}" id="remove-schedule-btn">Remove <i class="fa fa-window-close"></i></a></div>
  </div>
</div>
@else
<div class="row" id="field_{{date('is')}}">
  <div class="ibox" id="{{date('is')}}">
  <div class="mt-4 ml-3">
    <h3>Certification {{$count}} </h3>
  </div>
  <div class="row mt-4 ml-5">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Title" value="{{old('certificate.' . $count-1 . '.title')}}" name="certificate[{{$count-1}}][title]"  >
            <div class="invalid-feedback">
              Enter Title
            </div>
            </div>
         </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Description" value="{{old('certificate.' . $count-1 . '.description')}}" name="certificate[{{$count-1}}][description]"  >
            <div class="invalid-feedback">
              Enter Description
           </div>
           </div> 
        </div>
        </div>

      <div class="col-md-6">
      <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Issued</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Issued" value="{{old('certificate.' . $count-1 . '.issued')}}" name="certificate[{{$count-1}}][issued]"  >
            <div class="invalid-feedback">
               Enter Issued
            </div>
            </div> 
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Upload File:</label>
            <div class="col-sm-9">
                <input type="file" class="form-control-file"  name="certificate[{{$count-1}}][certification_upload]" >
             <div class="invalid-feedback">
               Upload a file
            </div>
            </div> 
        </div>
     </div>
    </div>
  </div>
  <div class="col-md-6 ml-5">
      <div class="form-group row"> <a class="btn btn-danger text-white" data-value="{{date('is')}}" id="remove-schedule-btn">Remove <i class="fa fa-window-close"></i></a></div>
  </div>
</div>
@endif