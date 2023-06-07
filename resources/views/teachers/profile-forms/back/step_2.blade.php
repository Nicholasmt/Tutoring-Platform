<div class="col-md-12 yes">
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Tell us about you:</label>
        <div class="col-sm-9">
        <textarea id="about" wire:model="about" class="form-control" cols="80"  rows="8" placeholder="Tell us about your education, the biggest obstacles you overcame, your achievements, and what drives you."></textarea>
        @error('about')<div class="text-danger font-13 text-capitalize"> {{$message}} </div>@enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Experiences:</label>
        <div class="col-sm-9">
        <textarea id="experience" wire:model="experience" class="form-control" cols="80" rows="5" placeholder="Tell us more about your education, your peak in career. Your skills that makes your education career different from others."></textarea>
        @error('experience')<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Introduction video:</label>
        <div class="col-sm-9">
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <input type="file" class="form-control-file"  accept="video/mp4,video/x-m4v,video/mkv,.mkv,video/*" wire:model="onboading_video" id="onboading_video">
                <div x-show="isUploading" class="mt-2">
                  <progress max="100" x-bind:value="progress"></progress> <br>
                  <span class="badge badge-info">pls... wait for the upload to complete before you proceed!</span>
                </div>
            </div>
            <span>Upload a one minutes introduction video of your self.</span><br>
            <span class="text-gray mt-3">Note: Video size must not be more than 10mb.</span>
              <div class="mt-0">
                @if (is_string($onboading_video))
                   <video src="{{ asset($pro_infos->onboading_video)}}" height="180" width="250" controls></video>
                @else
                <video src="{{ $onboading_video->temporaryUrl() }}" height="180" width="250" controls></video>
                @endif
                </div>
                @error('onboading_video')<div class="text-danger font-13 text-capitalize"> {{$message}} </div> @enderror
        </div>
    </div>
    </div>