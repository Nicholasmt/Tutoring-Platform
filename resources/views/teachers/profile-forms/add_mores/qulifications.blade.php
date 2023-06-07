@foreach ($qualification as $key => $education)
    <hr><h4 class="text-capitalize font-16 text_color">More Qualification</h4>
        <div class="row mt-5">
        <div class="col-md-6">  
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label font-14">University / College:</label>
                <div class="col-sm-9">
                    <!-- <input type="text" class="form-control" placeholder="University / College" wire:model="university.{{$education}}"> -->
                       <select wire:model="university.{{$education}}" id="front_university_{{$education}}" class="form-control">
                            <option value="">Select University / College</option> 
                            @foreach ($universities->chunk(20) as $group)
                              @foreach ($group as $college)
                                <option value="{{$college->name}}">{{$college->name}}</option> 
                              @endforeach
                            @endforeach
                     </select>
                    @error('university.'.$education) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Result:</label>
                <div class="col-sm-9">
                    <select  wire:model="result.{{ $education }}" id="result.{{ $education }}" class="custom-select">
                        <option value="">Select Result</option> 
                        <option value="First class">First class</option> 
                        <option value="Second class">Second class</option>  
                        <option value="Third Class">Third Class</option> 
                    </select>
                    @error('result.'.$education) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Upload File:</label>
            <div class="col-sm-9">
                <div x-data="{ isUploading: false, progress: 0 }" 
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <input type="file" accept="image/png, image/gif, image/jpeg" class="form-control-file" wire:model="qualification_upload.{{ $education }}" id="qualification_upload.{{ $education }}">
                    <div x-show="isUploading" class="mt-2">
                        <progress max="100" x-bind:value="progress"></progress> <br>
                        <span class="text-info">pls... wait for the upload to complete before you proceed!</span>
                    </div>
                </div><br>
                
                @error('qualification_upload.'.$education) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                 @if (isset($qualification_upload[$education]))
                    Preview: <br>
                  @if (!is_string($qualification_upload[$education]))
                    <img src="{{ $qualification_upload[$education]->temporaryUrl() }}" class="image_fit" alt="" height="170" width="214"> 
                  @endif
                @endif
            </div>
            </div>

        <div class="form-group">
            <label class="">
            <input type="checkbox" wire:model.defer="edu_visibility.{{ $education }}"  class="custom-switch-input">
            <span class="custom-switch-indicator"></span>
            <span class="custom-switch-description mt-2">Make your qualification visible</span>
            </label>
        </div>

        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Degree:</label>
                <div class="col-sm-9">
                    <select id="degree.{{ $education }}"  wire:model="degree.{{ $education }}" class="custom-select">
                       <option value="">Select Degree</option> 
                        @if(isset($university[$education]))
                            @php
                                $selected = App\Models\University::where('name','like', "%{$university[$education]}%")->first();
                            @endphp 
                            @if($selected->degree == 1)
                                <option value="B.Sc">B.Sc</option> 
                                <option value="M.SC">M.SC</option>  
                                <option value="Undergraduate">Undergraduate</option>   
                                <option value="Postgraduate">Postgraduate</option>  
                            @else
                                <!-- <option value="O Level">O Level</option>  -->
                                <option value="HND">HND</option> 
                                <option value="ND">ND</option> 
                            @endif  
                        @endif
                    </select><br>
                    @error('degree.'.$education) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                </div>  
            </div>

            <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Passing Year:</label>
                <div class="col-sm-9">
                    <input type="month" class="form-control" placeholder="Passing Year" wire:model="passing_year.{{ $education }}">
                    @error('passing_year.'.$education) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                </div>
            </div>
            <div class="text-right mt-5">
            <button class="btn btn-danger btn-sm" wire:click.prevent="remove_qualification({{$key}})"><i class="fa fa-trash"></i> Remove</button>
        </div>
        </div>
    </div>
    @endforeach

    <script>
       @foreach ($qualification as $key_2 => $qualify)
        $(document).ready(function() {
            window.frontUniversitySelect=()=>{
                $('#front_university_{{$education}}').select2({
                    placeholder: 'Select University / College',
                    allowClear: true});
                   
              $('#front_university_{{$education}}').on('change', function (e) {
                    var data = $('#front_university_{{$education}}').select2("val");
                    @this.set('university.{{$education}}', data);
              });
            }
            frontUniversitySelect();
            window.livewire.on('loadFrontUniversity',()=>{
                frontUniversitySelect();
            });
         });
      @endforeach
    </script>