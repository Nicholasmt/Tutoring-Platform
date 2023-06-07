@foreach ($qualification as $key => $qualify)
    <hr><h4 class="text-capitalize font-16 text_color">More Qualification</h4>
        <div class="row mt-5">
        <div class="col-md-6">  
            <div class="form-group row" wire:ignore>
                <label for="inputPassword3" class="col-sm-3 col-form-label font-14">University / College:</label>
                <div class="col-sm-9">
                    <!-- <input type="text" class="form-control" placeholder="University / College" wire:model="more_university.{{$key}}"> -->
                     <select wire:model="more_university.{{$key}}" id="add_more_{{$key}}" class="custom-select">
                            <option value="">Select University / College</option> 
                            @foreach ($universities->chunk(20) as $group)
                               @foreach ($group as $college)
                                  <option value="{{$college->name}}">{{$college->name}}</option> 
                                 @endforeach
                            @endforeach
                      </select>  
                    @error('more_university.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Result:</label>
                <div class="col-sm-9">
                    <select  wire:model="more_result.{{ $key }}" class="custom-select">
                        <option value="">Select Result</option> 
                        <option value="First class">First class</option> 
                        <option value="Second class">Second class</option>  
                        <option value="Third Class">Third Class</option> 
                    </select>
                    @error('more_result.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
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
                    <input type="file" accept="image/png, image/gif, image/jpeg" class="form-control-file" wire:model="more_qualification_upload.{{ $key }}" id="qualification_upload.{{ $key }}">
                    <div x-show="isUploading" class="mt-2">
                        <progress max="100" x-bind:value="progress"></progress> <br>
                        <span class="text-info">pls... wait for the upload to complete before you proceed!</span>
                    </div>
                </div><br>
                
                @error('more_qualification_upload.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span> <br>@enderror
                 @if (isset($more_qualification_upload[$key]))
                    Preview: <br>
                  @if (!is_string($more_qualification_upload[$key]))
                    <img src="{{ $more_qualification_upload[$key]->temporaryUrl() }}" class="image_fit" alt="" height="170" width="214"> 
                  @endif
                @endif
            </div>
            </div>

        <div class="form-group">
            <label class="">
            <input type="checkbox" wire:model="more_edu_visibility.{{ $key }}"  class="custom-switch-input">
            <span class="custom-switch-indicator"></span>
            <span class="custom-switch-description mt-2">Make your qualification visible</span>
            </label>
        </div>

        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Degree:</label>
                <div class="col-sm-9">
                    <select id="degree.{{ $key }}"  wire:model="more_degree.{{ $key }}" class="custom-select">
                        @if (isset($more_university[$key]))
                               @php
                                    $selected = App\Models\University::where('name','like', "%{$university[$key]}%")->first();
                                @endphp 
                                <option value="">Select Degree</option> 
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
                    @error('more_degree.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                </div>  
            </div>

            <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Passing Year:</label>
                <div class="col-sm-9">
                    <input type="month" class="form-control" placeholder="Passing Year" wire:model="more_passing_year.{{ $key }}">
                    @error('more_passing_year.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
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
            window.moreUniversitySelect=()=>{
                $('#add_more_{{$key_2}}').select2({
                    placeholder: 'Select University / College',
                    allowClear: true});
                   
              $('#add_more_{{$key_2}}').on('change', function (e) {
                    var data = $('#add_more_{{$key_2}}').select2("val");
                    @this.set('more_university.{{$key_2}}', data);
              });
            }
            moreUniversitySelect();
            window.livewire.on('loadMoreUniversity',()=>{
                moreUniversitySelect();
            });
         });
      @endforeach
    </script>