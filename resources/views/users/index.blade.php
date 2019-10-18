@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">Users</div>
        <div class="card-body">
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                 @if(!$user->isAdmin())
                                    <form action="{{ route('users.make-admin', $user->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                    </form>
                                 @endif
                            </td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h4 class="text-danger text-center">No User Yet</h4>
            @endif
        </div>
    </div>
@endsection
