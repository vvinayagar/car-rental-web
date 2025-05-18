@extends('layouts.app')

@section('content')
<script>
    function btnDelete(id) {
        if (confirm("Do you want to delete the row ?")) {
            document.getElementById("formDelete" + id).submit();
        }
    }

    function btnEdit(id) {
        if (confirm("Do you want to edit the row ?")) {
            window.location = '/user/' + id + "/edit";
            // document.getElementById("formEdit" + id).submit();
        }

    }

    function btnView(id) {

        window.location = '/user/' + id;

    }
</script>
<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <div class="d-flex justify-content-between align-items-center">
                <span>{{ __('User Management') }}</span>
                <button onclick="window.location = '{{ route('user.create') }}'" class="btn btn-primary">Create</button>
            </div>
        </div>

        <div class="card-body">
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Privilege</td>
                            <td>Action</td>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user["id"] }}
                            </td>
                            <td>
                                {{ $user["name"] }}
                            </td>
                            <td>
                                {{ $user["email"] }}
                            </td>
                            <td>
                                {{ $user["privilege"] }}
                            </td>
                            <td>

                                <div class="btn-group">
                                    <button class="btn btn-secondary" onclick="btnView('{{ $user['id']}}')">Show</button>
                                    <button class="btn btn-dark" onclick="btnEdit('{{ $user['id'] }}')">Edit</button>
                                    <button class="btn btn-danger" onclick="btnDelete('{{ $user['id']}}')">Delete</button>
                                    <div class="" style="display: none;">
                                        <form class="hide" id="formDelete{{ $user['id'] }}"
                                            action="{{ route('user.destroy', ['user' => $user['id']]) }}" method="post">
                                            <input class="btn btn-default" type="submit" value="Delete" />
                                            @method('delete')
                                            @csrf
                                        </form>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection