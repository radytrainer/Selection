
@extends('template')
@section('pageTitle', 'Selection-Committee - List User')
@section('content')
<div class="container">
    <h2 class="text-center">List of all Users</h2>
    <table id="tbl_users" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                @auth
                    @if(\Auth::user()->role_id==1)
                    <th>Action</th>
                    @endif
                @endauth
                <th>FirstName</th>
                <th>LastName</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            <tr>
                @auth
                    @if(Auth::user()->role_id==1)
                    <td>
                        <a href="{{url('users')}}/{{ $item->id }}/edit" data-toggle="tooltip" data-placement="left"
                            title="Edit User" >
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="{{route('users.destroy', $item->id)}}" data-toggle="modal" data-target="#delete"
                            data-placement="top" title="Delete User"
                            data-id="{{$item['id']}}" class="text-danger">
                            <i class=" material-icons">delete</i>
                        </a>
                        <a href="{{route('users.show', $item->id)}}"  data-toggle="modal" data-target="#ViewDetail"
                            data-id="{{$item['id']}}" data-fname="{{$item->firstname}}"
                            data-lname="{{$item['lastname']}}" data-role="{{$item['role_id']}}"
                            data-placement="right" title="Show User"
                            data-email="{{$item['email']}}">
                            <i class="large material-icons">visibility</i>
                        </a>
                    </td>
                    @endif
                @endauth
                <td>{{$item->firstname}}</td>
                <td>{{$item->lastname}}</td>
                <td>{{$item->email}}</td>
                @if($item->role_id == 1)
                    <td>Admin</td>
                @else
                    <td>Normal</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    @auth
        @if(Auth::user()->role_id==1)
            <a href="{{route('users.create')}}" class="btn btn-primary"
                data-toggle="tooltip" data-placement="right"
                title="Create a User">
                <i class="fas fa-user-plus"></i> Create a User
            </a>
        @endif
    @endauth
</div>
@endsection

{{-- Modal of delete user --}}
<div class="modal fade" tabindex="-1" role="dialog" id="delete">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete a User</h5>
          <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure want to Delete this user?.</p>
          <small id="users"></small>
        </div>
        <div class="modal-footer">
            <form action="" id="fid" method="post">
                @csrf
                @method('delete')
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit"  class="btn btn-primary">Yes</button>
        </form>
        </div>
      </div>
    </div>
  </div>


  {{-- end of modal delete user --}}

  {{-- Modal view user   --}}
    <div class="modal fade" id="ViewDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">View Detail information of User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <b>First Name: </b> <span id="fname"></span><br><br>
                <b>Last Name: </b><span id="lname"></span><br><br>
                <b>Email: </b><span id="email"></span><br><br>
                <b>Role User: </b><span id="role"></span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      {{-- end of modal user --}}




