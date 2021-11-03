<x-layout>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h2 class="headingTitle">All user <a class="btn btn-primary float-right" href="/create-user">Add new user</a></h2>
            <div class="tableScroll">
            <table id="table" class="responsive nowrap table table-condensed table-bordered table-stripped">
                <thead>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </thead>
                @foreach($users as $user)
                    <tr id="{{$user->id}}">
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->email}}</td>
                        <td>@isset($user->userrole->role){{ $user->userrole->role }}@else{{"Null"}} @endisset</td>
                        <td><a href="/users/view-user/{{$user->id}}">Edit</a> | <a href="/users/view-single-user/{{$user->id}}">View</a> | 
                        @if(Auth::user()->id == $user->id)
                            <a href="#" onclick="alert('You cant delete your own account.')">Delete</a>
                        @else
                        <a href="#" onclick="deleteUser('{{ $user->id }}')">Delete</a>
                        @endif
                    </td>
                    </tr>
                @endforeach
            </table>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    <script>
        $(document).ready( function () {
            
            $('#table').DataTable({
                responsive: true
            });
        } );
    </script>
</x-layout>
