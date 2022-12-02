<template>
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $page.props.auth.user.name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <Link class="nav-link active" :href="route('dashboard')">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <!-- <span class="right badge badge-danger">New</span> -->
                    </p>
                    </Link>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Admin
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" v-if="$page.props.role === 'SuperAdmin'">
                            <Link :href="route('permissions.index')" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </Link>
                        </li>
                        <li class="nav-item" v-if="$page.props.permissions.view_roles">
                            <Link :href="route('roles.index')" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </Link>
                        </li>
                        <li class="nav-item" v-if="$page.props.permissions.view_users">
                            <Link :href="route('users.index')" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </Link>
                        </li>
                        <li class="nav-item" v-if="$page.props.permissions.update_app_setting">
                            <Link :href="route('setting.index')" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Setting</p>
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('profile.edit')" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </Link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <Link class="nav-link" :href="route('logout')" method="post">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Logout
                        <!-- <span class="right badge badge-danger">New</span> -->
                    </p>
                    </Link>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: {
        Link,
    },
}
</script>