@foreach ($certification as $key => $cert)
    <hr> <h4 class="text-capitalize font-16 text_color">More Certification</h4>
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Certificate Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Certificate Name" wire:model="more_title.{{ $key }}">
                    @error('more_title.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Description</label>
                <div class="col-sm-9">
                    <textarea id="experience" wire:model="more_description.{{ $key }}" class="form-control" cols="80" rows="5" placeholder="Description"></textarea>
                    @error('more_description.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                </div>
            </div>

            <div class="form-group">
                <label class="">
                <input type="checkbox" wire:model="more_cert_visibility.{{ $key }}"  class="custom-switch-input">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description mt-2">Make your Certification visible</span>
                </label>
            </div>

        </div>
        <div class="col-md-6">
        <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Issued</label>
                <div class="col-sm-9">
                    <input type="month" class="form-control" wire:model="more_issued.{{$key}}" placeholder="Issued">
                    @error('more_issued.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
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
                    <input type="file" accept="image/png, image/gif, image/jpeg" class="form-control-file" wire:model="more_certification_upload.{{ $key }}">
                    <div x-show="isUploading" class="mt-2">
                        <progress max="100" x-bind:value="progress"></progress> <br>
                        <span class="text-info">pls... wait for the upload to complete before you proceed!</span>
                    </div>
                 </div><br>
                @error('more_certification_upload.'.$key)<div class="text-danger text-danger font-13 text-capitalize mr-5">{{$message}}</div> @enderror
                  @if (isset($more_certification_upload[$key]))
                   @if (!is_string($more_certification_upload[$key]))
                      Preview: <br>
                         <img src="{{ $more_certification_upload[$key]->temporaryUrl() }}" class="image_fit" alt="" height="170" width="214"> 
                      @endif
                 @endif
                </div>
            </div>
           <div class="float-right mt-3 mb-5">
            <button class="btn btn-danger btn-sm" wire:click.prevent="remove_certification({{$key}})"><i class="fa fa-trash"></i> Remove</button>
        </div>
        </div>
    </div> 
@endforeach