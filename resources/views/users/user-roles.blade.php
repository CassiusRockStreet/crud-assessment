<x-layout>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

            <h2 class="headingTitle">Manage Roles <a href="add-roles" class="btn btn-primary float-right">Add new roles</a></h2> 
            <div class="tableScroll">
            <table id="table" class="table table-condensed table-bordered table-stripped">
                <thead>
                    <th>Role</th>
                    <th>Min Characters</th>
                    <th>Administrator</th>
                    <th>Action</th>
                </thead>
                @foreach($allRoles as $role)
                    <tr id="{{$role->id}}">
                        <td>{{ $role->role }}</td>
                        <td>{{ $role->length }}</td>
                        <td>{{ $role->is_admin =="on" ? "Yes" : "No" }}</td>
                        <td><a href="/add-roles/{{$role->id}}">Edit</a> | <a href="/view-roles/{{$role->id}}">View</a> | 
                        @if(Auth::user()->role == $role->id)
                            <a href="#" onclick="alert('You cant delete the role your currently active on.')">Delete</a>
                        @else
                            <a href="#" onclick="deleteRole('{{ $role->id }}')">Delete</a>
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