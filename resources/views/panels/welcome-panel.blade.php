@php

    $levelAmount = 'level';

    if (Auth::User()->level() >= 2) {
        $levelAmount = 'levels';

    }

@endphp

<div class="card">
    <div class="card-header @role('admin', true) bg-secondary text-white @endrole">

        Welcome {{ Auth::user()->name }}

        @role('admin', true)
        <span class="pull-right badge badge-primary" style="margin-top:4px">
                Admin Access
            </span>
        @else
            <span class="pull-right badge badge-warning" style="margin-top:4px">
                User Access
            </span>
            @endrole

    </div>
    <div class="card-body">
        <h2 class="lead">

            <button type="button" class="btn btn-success">Add New Bot</button>

        </h2>

        <table class="table table-striped table-sm data-table">
            <caption id="user_count">
                5 user total
            </caption>
            <thead class="thead">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th class="hidden-xs">Email</th>
                <th class="hidden-xs">First Name</th>
                <th class="hidden-xs">Last Name</th>
                <th>Role</th>
                <th class="hidden-sm hidden-xs hidden-md">Created</th>
                <th class="hidden-sm hidden-xs hidden-md">Updated</th>
                <th>Actions</th>
                <th class="no-search no-sort"></th>
                <th class="no-search no-sort"></th>
            </tr>
            </thead>

            <tbody id="users_table">
            <tr>
                <td>1</td>
                <td>admin</td>
                <td class="hidden-xs"><a href="mailto:admin" title="email admin">admin</a></td>
                <td class="hidden-xs">Letitia</td>
                <td class="hidden-xs">Hilpert</td>
                <td><span class="badge badge-warning">Admin</span></td>
                <td class="hidden-sm hidden-xs hidden-md">2018-06-24 13:57:37</td>
                <td class="hidden-sm hidden-xs hidden-md">2018-06-24 13:57:37</td>
                <td>
                    <form method="POST" action="http://localhost:8000/users/1" accept-charset="UTF-8"
                          data-toggle="tooltip" title="" data-original-title="Delete">
                        <input name="_token" type="hidden" value="PGQZYh149aYgV5mINbeWIYIv4Tw3miX2bsdpDtjG"> <input
                                name="_method" type="hidden" value="DELETE">
                        <button type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User"
                                data-message="Are you sure you want to delete this user ?" class="btn btn-danger btn-sm"
                                style="width: 100%;">
                            <i aria-hidden="true" class="fa fa-trash-o fa-fw"></i> <span class="hidden-xs hidden-sm">Delete</span><span
                                    class="hidden-xs hidden-sm hidden-md"> User</span></button>
                    </form>
                </td>
                <td><a href="http://localhost:8000/users/1/edit" data-toggle="tooltip" title=""
                       class="btn btn-sm btn-info btn-block" data-original-title="Edit">
                        <i aria-hidden="true" class="fa fa-pencil fa-fw"></i> <span
                                class="hidden-xs hidden-sm">Edit</span><span
                                class="hidden-xs hidden-sm hidden-md"> User</span></a></td>
            </tr>
            </tbody>
            <tbody id="search_results"></tbody>
            <tbody id="search_results"></tbody>
        </table>


        @role('admin')

        <hr>

        <p>
            You have permissions:
            @permission('view.users')
            <span class="badge badge-primary margin-half margin-left-0">
                        {{ trans('permsandroles.permissionView') }}
                    </span>
            @endpermission

            @permission('create.users')
            <span class="badge badge-info margin-half margin-left-0">
                        {{ trans('permsandroles.permissionCreate') }}
                    </span>
            @endpermission

            @permission('edit.users')
            <span class="badge badge-warning margin-half margin-left-0">
                        {{ trans('permsandroles.permissionEdit') }}
                    </span>
            @endpermission

            @permission('delete.users')
            <span class="badge badge-danger margin-half margin-left-0">
                        {{ trans('permsandroles.permissionDelete') }}
                    </span>
            @endpermission

        </p>

        @endrole

    </div>
</div>
