
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>profile with data and skills - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    @include('navbar')
    <div class="container">

        <a href="{{ route('dashboard') }}/admins" class="px-4 btn btn-info">Admins</a>
        <a href="{{ route('dashboard') }}/users" class="px-4 btn btn-primary">Users</a>
        <a href="{{ route('dashboard') }}" class="px-4 btn btn-success">All</a>

        @if ( $type == "users" )
            <h3 class="text-left">Users : </h3>
        @elseif( $type == "admins" )
            <h3 class="text-left">Admins : </h3>
        @else
            <h3 class="text-left">All : </h3>
        @endif

        <table class="table table-striped mt-1">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Role</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row"></th>
                    <td>
                        <a href="{{ route("user.show", ['id'=>$user->id]) }}">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->gender }}</td>
                    <th>
                        @if ( $user->role == "admin" )
                            <span class="badge bg-danger text-white">
                                {{ $user->role }}
                            </span>
                        @else
                            <span class="badge bg-primary  text-white">
                                {{ $user->role }}
                            </span>
                        @endif
                    </th>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @if ( $user->role != "admin" )
                            <a href="{{ route("user.edit", ["id" => $user->id]) }}" class="btn btn-info btn-sm m-1">Edit</a>
                            <form action="{{ route('user.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" href="" class="btn btn-danger btn-sm m-1">Delete</button>
                            </form>

                            @if ($user->active)
                            <form action="{{ route('user.deactivate') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-success btn-sm m-1">Deactivate</button>
                            </form>
                            @else
                            <form action="{{ route('user.activate') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button href="" class="btn btn-warning btn-sm m-1">Activate</button>
                            </form>
                            @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            {{-- pagination links --}}
            <div style="max-height: 80px; overflow:hidden">
                {{ $users->links() }}
            </div>

    </div>
</body>
</html>

{{--  --}}
