<div class="block-content">
    <div class="row push">
        <div class="col-lg-10">
            {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@update', $member->id],
                'files'=>true])
           !!}
            <p>General</p>
            <div class="form-group mb-4">
                {!! Form::label('firstname','firstname:',['class'=>'form-label']) !!}
                {!! Form::text('firstname',$member->firstname ,['class'=>'form-control']) !!}
                @error('firstname')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('lastname','Lastname:',['class'=>'form-label']) !!}
                {!! Form::text('lastname',$member->lastname ,['class'=>'form-control']) !!}
                @error('lastname')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('email','Email:',['class'=>'form-label']) !!}
                {!! Form::text('email',$member->email ,['class'=>'form-control']) !!}
                @error('email')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('company','Company:',['class'=>'form-label']) !!}
                {!! Form::text('company',$member->company ,['class'=>'form-control']) !!}
                @error('company')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('age','Age:',['class'=>'form-label']) !!}
                {!! Form::date('age',$member->age ,['class'=>'form-control']) !!}
                @error('age')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('jobTitle','Job title:',['class'=>'form-label']) !!}
                {!! Form::text('jobTitle',$member->jobTitle ,['class'=>'form-control']) !!}
                @error('jobTitle')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('website','Website (use "https://") :',['class'=>'form-label']) !!}
                {!! Form::text('website',$member->website ,['class'=>'form-control']) !!}
                @error('website')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('notes','Notes:',['class'=>'form-label']) !!}
                {!! Form::textarea('notes',$member->notes ,['class'=>'form-control']) !!}
                @error('notes')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('mobile','Mobile:',['class'=>'form-label']) !!}
                {!! Form::text('mobile',$member->mobile ,['class'=>'form-control']) !!}
                @error('mobile')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('addressLine1','Address Line 1:',['class'=>'form-label']) !!}
                {!! Form::text('addressLine1',$member->addressLine1 ,['class'=>'form-control']) !!}
                @error('addressLine1')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('city','City:',['class'=>'form-label']) !!}
                {!! Form::text('city',$member->city ,['class'=>'form-control']) !!}
                @error('city')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('postalCode','PostalCode:',['class'=>'form-label']) !!}
                {!! Form::text('postalCode',$member->postalCode ,['class'=>'form-control']) !!}
                @error('postalCode')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('country','Country:',['class'=>'form-label']) !!}
                {!! Form::text('country',$member->country ,['class'=>'form-control']) !!}
                @error('country')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <div class="form-group mr-1">
                    <button type="submit" class="btn btn-alt-primary">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
