<x-layout>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h2 class="headingTitle">
                    Manage your profile
            </h2>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
            @endif
            @if(session()->has('success'))
                <p class="alert alert-success">{{ session()->get('success')}}</p>
            @endif
            <form method="POST" action="/user/update-profile">
                @CSRF
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input name="Name" value="@if(Auth::user()->name){{Auth::user()->name}}@else{{old('Name')}}@endif" class="form-control @error('Name') is-invalid @enderror" id="Name" type="text">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Lastname">Last Name</label>
                            <input name="Lastname" value="@if(Auth::user()->lastname){{Auth::user()->lastname}}@else{{old('Lastname')}}@endif" class="form-control @error('Lastname') is-invalid @enderror" id="Lastname" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Username">Username</label>
                            <input name="Username" value="@if(Auth::user()->username){{Auth::user()->username}}@else{{old('username')}}@endif" class="form-control @error('Username') is-invalid @enderror" id=Username" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Email">Email address</label>
                            <input type="Email" value="@if(Auth::user()->email){{Auth::user()->email}}@else{{old('Email')}}@endif" name="Email" class="form-control @error('Email') is-invalid @enderror" id="Email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Role">Your role: [You cant edit your role]</label>
                    <select name="Role" class="form-control @error('Role') is_invalid @enderror" id="Role" readonly>
                            <option value="{{ Auth::user()->role}}">{{ Auth::user()->userrole->role }}</option>
                    </select>
                </div>
                <p>NB: Leave password blank if you dont wish to update it.</p>
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input name="Password" type="password" class="form-control @error('Password') is-invalid @enderror" id="Password">
                </div>
                <div class="form-group">
                    <label for="Password_confirmation">Confirm password</label>
                    <input name="Password_confirmation" type="password" class="form-control @error('Password_confirmation') is-invalid @enderror" id="Password_confirmation">
                </div>
                <div class="form-group">
                    <input name="saveData" class="btn btn-success float-right" id="save" type="submit" value="Update profile">
                </div>
            </form>    

        </div>
        <div class="col-md-1"></div>
    </div>
</x-layout>