<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<!-- Hero Content -->
<div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
    <div class="content content-full text-center pt-7 pb-5">
        <h1 class="h2 text-white mb-2">
            Company Credentials.
        </h1>
        <h2 class="h4 fw-normal text-white-75">
            Here you can change your Company Info that customers will see on your website!
        </h2>
    </div>
</div>
<!-- END Hero Content -->

<!-- Page Content -->
<div class="bg-body-extra-light">
    <div class="content">
        <div class="row items-push justify-content-center">
            <div class="col-md-10 col-xl-5">
                {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminCompanyCredentialsController@update',$credential->id],'files'=>true])!!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="frontend-contact-firstname">Firstname</label>
                                    <input type="text" class="form-control" name="company_firstname"
                                           value="{{ $credential->firstname }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="frontend-contact-lastname">Lastname</label>
                                    <input type="text" class="form-control" name="company_lastname"
                                           value="{{ $credential->lastname }}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Company Name</label>
                            <input type="text" class="form-control" name="company_name"
                                   value="{{ $credential->companyName }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Address </label>
                            <input type="text" class="form-control" name="company_address"
                                   value="{{ $credential->address }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Zip </label>
                            <input type="number" class="form-control" name="company_zip"
                                   value="{{ $credential->zip }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">City </label>
                            <input type="text" class="form-control" name="company_city"
                                   value="{{ $credential->city }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Country </label>
                            <input type="text" class="form-control" name="company_country"
                                   value="{{ $credential->country }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Phone </label>
                            <input type="text" class="form-control" name="company_phone"
                                   value="{{ $credential->phone }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Mobile </label>
                            <input type="text" class="form-control" name="company_mobile"
                                   value="{{ $credential->mobile }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Email</label>
                            <input type="email" class="form-control" name="company_email"
                                   value="{{ $credential->email }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Tag Line </label>
                            <input type="text" class="form-control" name="company_tagline"
                                   value="{{ $credential->tagline }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Url </label>
                            <input type="text" class="form-control" name="company_url"
                                   value="{{ $credential->url }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Facebook link </label>
                            <input type="text" class="form-control" name="company_facebook"
                                   value="{{ $credential->facebook }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Instagram link </label>
                            <input type="text" class="form-control" name="company_instagram"
                                   value="{{ $credential->instagram }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">Twitter link </label>
                            <input type="text" class="form-control" name="company_twitter"
                                   value="{{ $credential->twitter }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">LinkedIn link </label>
                            <input type="text" class="form-control" name="company_linkedin"
                                   value="{{ $credential->linkedin }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-email">VAT </label>
                            <input type="text" class="form-control" name="company_VAT"
                                   value="{{ $credential->VAT }}">
                        </div>


                        <div class="mb-4">
                            <label class="form-label" for="frontend-contact-msg">Remarks</label>
                            <textarea class="form-control" name="company_remarks" rows="7">{{ $credential->remarks }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Company Logo</label>
                            <div class="mb-4">

                                    @if($photos)
                                        @php
                                         $photo = \App\Models\Photo::where('credential_id', $credential->id)->first()
                                         @endphp

                                            @if($photo)
                                                <input type="hidden" name="photo" value="{{$photo->id}}">
                                            @endif
                                    @endif
                                    <img class="rounded" height="150" width="150" src="{{$photo ? asset('images/form_credentials') . $photo->file : 'http://placehold.it/62x62'}}" alt="{{$credential->firstname}}">
                            </div>
                            <div class="form-group mb-4">
                                <label class="form-label" for="frontend-contact-email">New Logo? </label>
                                <input type="file" class="form-control" id="frontend-contact-tagline" name="company_logo">
                            </div>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-alt-primary">
                                <i class="fa fa-paper-plane me-1 opacity-50"></i> Save
                            </button>
                        </div>
                    </form>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->


<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>
<?php require '../resources/inc/_global/views/footer_end.php'; ?>

