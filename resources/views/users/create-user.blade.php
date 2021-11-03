<x-layout>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h2 class="headingTitle">
                @if(isset($title) && isset($User))
                    {{$title}} : {{$User->name}}
                    @php 
                        $name = $User->name;
                        $role = "/users/update-user/";
                    @endphp
                @else
                    Add new user
                @endif
            </h2>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
            @endif
            @if(session()->has('success'))
                <p class="alert alert-success">{{ session()->get('success')}}</p>
            @endif
            <form method="POST" action="{{$role ?? '/create-user' }}">
                @CSRF
                @if(isset($title) && isset($User))
                    <input type="hidden" name="id" value="{{$User->id}}">
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input name="Name" value="@if(isset($User->name)){{$User->name}}@else{{old('Name')}}@endif" class="form-control @error('Name') is-invalid @enderror" id="Name" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Lastname">Last Name</label>
                            <input name="Lastname" value="@if(isset($User->lastname)){{$User->lastname}}@else{{old('Lastname')}}@endif" class="form-control @error('Lastname') is-invalid @enderror" id="Lastname" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Username">Username</label>
                            <input name="Username" value="@if(isset($User->username)){{$User->username}}@else{{old('Username')}}@endif" class="form-control @error('Username') is-invalid @enderror" id=Username" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Email">Email address</label>
                            <input type="Email" value="@if(isset($User->email)){{$User->email}}@else{{old('Email')}}@endif" name="Email" class="form-control @error('Email') is-invalid @enderror" id="Email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Role">Role</label>
                    <select name="Role" class="form-control @error('Role') is_invalid @enderror" id="Role" required>
                        <option selected disabled="true">@isset($User->userrole->role){{$User->userrole->role}}@else{{ "--Select role--"}}@endisset
                    </option>
                        @foreach($allRoles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>
                @if(isset($title) && isset($User))
                    <p>NB: Leave password blank if you dont wish to update it.</p>
                @endif
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input name="Password" type="password" class="form-control @error('Password') is-invalid @enderror" id="Password">
                </div>
                <div class="form-group">
                    <label for="Password_confirmation">Confirm password</label>
                    <input name="Password_confirmation" type="password" class="form-control @error('Password_confirmation') is-invalid @enderror" id="Password_confirmation">
                </div>
                <div class="form-group">
                    <input name="saveData" class="btn btn-success float-right" id="save" type="submit" value="{{ $title ?? 'Add User'}}">
                </div>

            </form>

        </div>
        <div class="col-md-1"></div>
    </div>
</x-layout>