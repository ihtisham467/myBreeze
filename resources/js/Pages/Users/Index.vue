<template>

    <Head title="Users" />

    <AuthenticatedLayout>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <Link :href="route('dashboard')">Home</Link>
                            </li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="users" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="usersIndex-tab" data-toggle="pill"
                                            href="#usersIndex" role="tab" aria-controls="usersIndex"
                                            aria-selected="false">
                                            Users</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="createUser-tab" data-toggle="pill" href="#createUser"
                                            role="tab" aria-controls="createUser" aria-selected="false">
                                            Create User</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="usersContent">

                                    <div class="tab-pane fade active show" id="usersIndex" role="tabpanel"
                                        aria-labelledby="usersIndex-tab">
                                        <table class="table table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(user, index) in users">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ user.name }}</td>
                                                    <td>{{ user.email }}</td>
                                                    <td>{{ user.roles[0].name }}</td>
                                                    <td>
                                                        <Link :href="route('users.edit', user.id)">
                                                        <i class="fa fa-edit"></i>
                                                        </Link>
                                                        <a href="#" v-if="user.name !== 'Admin'" class="ml-2" type="button"
                                                            @click="destroyUser(user.id)">
                                                        <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="createUser" role="tabpanel"
                                        aria-labelledby="createUser-tab">
                                        <form @submit.prevent="submitUser">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Name</label>
                                                        <input v-model="userForm.name" type="text" class="form-control"
                                                            placeholder="User Name">
                                                        <small class="text-red" v-if="errors.name">{{ errors.name
                                                        }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email</label>
                                                        <input v-model="userForm.email" type="email"
                                                            class="form-control" placeholder="User Email">
                                                        <small class="text-red" v-if="errors.email">{{ errors.email
                                                        }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Password</label>
                                                        <input v-model="userForm.password" type="password"
                                                            class="form-control" placeholder="User Password">
                                                        <small class="text-red" v-if="errors.password">{{
                                                                errors.password
                                                        }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputPasswordConfirmation1">Confirm Password</label>
                                                        <input v-model="userForm.password_confirmation" type="password"
                                                            class="form-control" placeholder="Confirm Password">
                                                        <small class="text-red" v-if="errors.password_confirmation">{{
                                                                errors.password_confirmation
                                                        }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputRole1">Role</label>
                                                        <select v-model="userForm.role_id" class="form-control">
                                                            <option value="">Select Role</option>
                                                            <option v-for="role in roles" :value="role.id">{{ role.name
                                                            }}</option>
                                                        </select>
                                                        <small class="text-red" v-if="errors.role_id">{{ errors.role_id
                                                        }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group pt-2">
                                                        <button type="submit" :disabled="userForm.processing"
                                                            class="btn btn-primary bg-blue mt-4">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        AuthenticatedLayout, Head, Link
    },
    props: {
        users: Object,
        roles: Object,
        errors: Object
    },

    setup() {
        const userForm = useForm({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            role_id: '',
        })

        const destroyUser = (id) => {
            if (confirm('Are you sure?')) {
                Inertia.delete(route('users.destroy', id))
            }
        }

        return { userForm, destroyUser }
    },

    methods: {
        submitUser() {
            this.userForm.post(route('users.store'));
            this.userForm.title = ''
        }
    }
}

</script>
