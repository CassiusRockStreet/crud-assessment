<x-layout>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h2 class="headingTitle">
                @isset($caption)
                    {{ $caption }}
                @else
                    Add New User Role
                @endisset 
            </h2>

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
            @endif
            
            @if(session()->has('message'))
                <p class="alert alert-success">{{session()->get('message')}}</p>
            @endif
            
            @isset($viewRole)
                @php 
                    $checkisAdmin = ($viewRole->is_admin == "on") ? 'checked' : "";
                    $checkLengthFour = ($viewRole->length == "4") ? 'checked' : "";
                    $checkLengthEight = ($viewRole->length == "8") ? 'checked' : "";
                    $role = "/edit-role/";
                @endphp
                
            @endisset
            
            <form method="POST" action="{{$role ?? '/add-roles' }}">
                @CSRF
                @isset($viewRole)
                    <input type="hidden" value="{{$viewRole->id}}" name="id">
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="role">Role Name</label>
                            <input type="text" id="role" name="role" value="@isset($viewRole){{$viewRole->role}}@else{{old('role')}}@endisset"  class="form-control @error('role') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rules"><u>Password Rules/Policy</u></label><br>
                            <input type="radio" value="4" {{$checkLengthFour ?? ""}} name="length"> Minimum of 4 Characters<br>
                            <input type="radio" value="8" {{$checkLengthEight ?? ""}} name="length"> Minimum of 8 Charactes<br>
                            <input type="checkbox" {{$checkisAdmin ?? ""}} name="is_admin"> Mark this role as Administrator<br>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input name="saveData" class="btn btn-success float-right" id="save" type="submit" value="{{ $caption ?? 'Save Role'}}">
                </div>

            </form>

        </div>
        <div class="col-md-1"></div>
    </div>
</x-layout>