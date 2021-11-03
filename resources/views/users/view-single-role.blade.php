<x-layout>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h2 class="headingTitle">View role <a class="btn btn-primary float-right" href="/create-user">Edit role</a></h2>
            <div class="row">
            @isset($viewRole)
                @php 
                    $checkAlphabets= ($viewRole->alphabets == "on") ? 'checked' : "";
                    $checkNumber = ($viewRole->numbers == "on") ? 'checked' : "";
                    $checkisAdmin = ($viewRole->is_admin == "on") ? 'checked' : "";
                    $checkLengthFour = ($viewRole->length == "4") ? 'checked' : "";
                    $checkLengthEight = ($viewRole->length == "8") ? 'checked' : "";
                    $role = "/edit-role/";
                @endphp
                
            @endisset
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="role">Role Name</label>
                            <input type="text" id="role" name="role" value="@isset($viewRole)@isset($viewRole->role){{$viewRole->role}}@else{{'Null'}}@endisset
                            @else{{old('role')}}@endisset"  class="form-control @error('role') is-invalid @enderror" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rules"><u>Password Rules/Policy</u></label><br>
                            <input type="radio" value="4" {{$checkLengthFour ?? ""}} name="length" readonly> Minimum of 4 Characters<br>
                            <input type="radio" value="8" {{$checkLengthEight ?? ""}} name="length" readonly> Minimum of 8 Charactes<br>
                            <input type="checkbox" {{$checkisAdmin ?? ""}} name="is_admin" readonly> Mark this role as Administrator<br>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</x-layout>