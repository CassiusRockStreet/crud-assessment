<x-layout>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h2 class="headingTitle">
                    View user
                    <a href="/users/view-user/{{$User->id}}" class="btn btn-primary float-right">Edit User</a>
            </h2>
            <form method="POST" action="{{$role ?? '/create-user' }}">
                @CSRF
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input name="Name" value="@if(isset($User->name)){{$User->name}}@else{{old('Name')}}@endif" class="form-control @error('Name') is-invalid @enderror" id="Name" type="text" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Lastname">Last Name</label>
                            <input name="Lastname" value="@if(isset($User->lastname)){{$User->lastname}}@else{{old('Lastname')}}@endif" class="form-control @error('Lastname') is-invalid @enderror" id="Lastname" type="text" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Username">Username</label>
                            <input name="Username" value="@if(isset($User->username)){{$User->username}}@else{{old('Username')}}@endif" class="form-control @error('Username') is-invalid @enderror" id=Username" type="text" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Email">Email address</label>
                            <input type="Email" value="@if(isset($User->email)){{$User->email}}@else{{old('Email')}}@endif" name="Email" class="form-control @error('Email') is-invalid @enderror" id="Email" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Role">Role</label>
                    <select name="Role" class="form-control @error('Role') is_invalid @enderror" id="Role" readonly>
                        <option selected disabled="true">
                        @isset($User->userrole->role)
                            {{$User->userrole->role}} 
                        @else 
                            {{ "--Select role--"}}
                        @endisset</option>
                        @foreach($allRoles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>

            </form>

        </div>
        <div class="col-md-1"></div>
    </div>
</x-layout>