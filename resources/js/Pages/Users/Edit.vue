<template>

    <Head title="Edit User" />

    <AuthenticatedLayout>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <Link :href="route('dashboard')">Home</Link>
                            </li>
                            <li class="breadcrumb-item active">Edit User</li>
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
                            <div class="card-body">
                                <form @submit.prevent="submitUser(userForm.id)">
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
                                                <input v-model="userForm.email" type="email" class="form-control"
                                                    placeholder="User Email">
                                                <small class="text-red" v-if="errors.email">{{ errors.email
                                                }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input v-model="userForm.password" type="password" class="form-control"
                                                    placeholder="User Password">
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
                                                <Link :href="route('users.index')" class="btn btn-danger mt-4 ml-3">Cancel</Link>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
        user: Object,
        roles: Object,
        errors: Object
    },

    setup(props) {
        const userForm = useForm({
            id: props.user.id,
            name: props.user.name,
            email: props.user.email,
            password: props.user.password,
            password_confirmation: '',
            role_id: props.user.roles[0].id,
        })

        return { userForm }
    },

    methods: {
        submitUser(id) {
            this.userForm.put(route('users.update', id));
        }
    }
}

</script>
