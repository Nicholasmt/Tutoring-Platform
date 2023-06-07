@if ($user->verify_ready == 1 || $user->is_verified == 1)
  <!-- Qualification 3 start -->
<div class="row" id="field_{{date('is')}}">
<div class="ibox" id="{{date('is')}}">
 <div class="mt-4 ml-3">
   <h3>Qualification {{$count}}</h3>
</div>
<div class="row mt-5 ml-5">
  <div class="col-md-6">
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label">University / College:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="University / College" value="{{old('education.' . $count-1 . '.university')}}" name="education[{{$count-1}}][university]" required>
         <div class="invalid-feedback">
            Enter University / College
        </div>
        </div>
        
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label">Result:</label>
        <div class="col-sm-9">
            <select name="education[{{$count-1}}][result]" class="custom-select" id="inputGroupSelect05">
                <option value="First class" @if(old('education.' . $count-1 . '.result') == 'First class') selected @endif>First class</option> 
                <option value="Second class" @if(old('education.' . $count-1 . '.result') == 'Second class') selected @endif>Second class</option>  
                <option value="Third Class" @if(old('education.' . $count-1 . '.result') == 'Third Class') selected @endif>Third Class</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label">Upload File:</label>
        <div class="col-sm-9">
            <input type="file"  class="form-control-file" name="education[{{$count-1}}][result_upload]" required>
        <div class="invalid-feedback">
            Upload a file
        </div>
        </div>
       
    </div>
</div>

<div class="col-md-6">
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label">Degree:</label>
        <div class="col-sm-9">
            <select name="education[{{$count-1}}][degree]" class="custom-select" id="inputGroupSelect05">
                <option value="B.Sc" @if(old('education.' . $count-1 . '.degree') == 'B.Sc') selected @endif>B.Sc</option> 
                <option value="M.SC" @if(old('education.' . $count-1 . '.degree') == 'M.SC') selected @endif>M.SC</option>  
                <option value="O Level" @if(old('education.' . $count-1 . '.degree') == 'O Level') selected @endif>O Level</option> 
                <option value="Undergraduate" @if(old('education.' . $count-1 . '.degree') == 'Undergraduate') selected @endif>Undergraduate</option>   
                <option value="Postgraduate" @if(old('education.' . $count-1 . '.degree') == 'MoPostgraduateday') selected @endif>Postgraduate</option>  
                <option value="HND" @if(old('education.' . $count-1 . '.degree') == 'HND') selected @endif>HND</option> 
                <option value="ND" @if(old('education.' . $count-1 . '.degree') == 'ND') selected @endif>ND</option>   
            </select>
        </div>  
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label">Passing Year:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Passing Year" value="{{old('education.' . $count-1 . '.passing_year')}}" name="education[{{$count-1}}][passing_year]" required>
         <div class="invalid-feedback">
            Enter Passing year
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
<!-- Qualification 3 ends -->
   
@else
    <!-- Qualification 3 start -->
<div class="row" id="field_{{date('is')}}">
<div class="ibox" id="{{date('is')}}">
 <div class="mt-4 ml-3">
   <h3>Qualification {{$count}}</h3>
</div>
<div class="row mt-5 ml-5">
  <div class="col-md-6">
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label">University / College:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="University / College" value="{{old('education.' . $count-1 . '.university')}}" name="education[{{$count-1}}][university]" >
         <div class="invalid-feedback">
            Enter University / College
        </div>
        </div>
        
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label">Result:</label>
        <div class="col-sm-9">
            <select name="education[{{$count-1}}][result]" class="custom-select" id="inputGroupSelect05">
                <option value="First class" @if(old('education.' . $count-1 . '.result') == 'First class') selected @endif>First class</option> 
                <option value="Second class" @if(old('education.' . $count-1 . '.result') == 'Second class') selected @endif>Second class</option>  
                <option value="Third Class" @if(old('education.' . $count-1 . '.result') == 'Third Class') selected @endif>Third Class</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label">Upload File:</label>
        <div class="col-sm-9">
            <input type="file"  class="form-control-file" name="education[{{$count-1}}][result_upload]">
        <div class="invalid-feedback">
            Upload a file
        </div>
        </div>
       
    </div>
</div>

<div class="col-md-6">
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label">Degree:</label>
        <div class="col-sm-9">
            <select name="education[{{$count-1}}][degree]" class="custom-select" id="inputGroupSelect05">
                <option value="B.Sc" @if(old('education.' . $count-1 . '.degree') == 'B.Sc') selected @endif>B.Sc</option> 
                <option value="M.SC" @if(old('education.' . $count-1 . '.degree') == 'M.SC') selected @endif>M.SC</option>  
                <option value="O Level" @if(old('education.' . $count-1 . '.degree') == 'O Level') selected @endif>O Level</option> 
                <option value="Undergraduate" @if(old('education.' . $count-1 . '.degree') == 'Undergraduate') selected @endif>Undergraduate</option>   
                <option value="Postgraduate" @if(old('education.' . $count-1 . '.degree') == 'MoPostgraduateday') selected @endif>Postgraduate</option>  
                <option value="HND" @if(old('education.' . $count-1 . '.degree') == 'HND') selected @endif>HND</option> 
                <option value="ND" @if(old('education.' . $count-1 . '.degree') == 'ND') selected @endif>ND</option>   
            </select>
        </div>  
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label">Passing Year:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Passing Year" value="{{old('education.' . $count-1 . '.passing_year')}}" name="education[{{$count-1}}][passing_year]" >
         <div class="invalid-feedback">
            Enter Passing year
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
<!-- Qualification 3 ends -->
 
@endif