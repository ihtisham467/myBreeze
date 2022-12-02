<template>

    <Head title="Roles" />

    <AuthenticatedLayout>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Roles</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <Link :href="route('dashboard')">Home</Link>
                            </li>
                            <li class="breadcrumb-item active">Roles</li>
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
                                <ul class="nav nav-tabs" id="roles" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="rolesIndex-tab" data-toggle="pill"
                                            href="#rolesIndex" role="tab" aria-controls="rolesIndex"
                                            aria-selected="false">
                                            Roles</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="createRole-tab" data-toggle="pill" href="#createRole"
                                            role="tab" aria-controls="createRole" aria-selected="false">
                                            Create Role</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="rolesContent">

                                    <div class="tab-pane fade active show" id="rolesIndex" role="tabpanel"
                                        aria-labelledby="rolesIndex-tab">
                                        <table class="table table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Name</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(role, index) in roles">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ role.name }}</td>
                                                    <td>
                                                        <Link :href="route('role_permissions', role.id)" title="Role Permissions" v-if="$page.props.permissions.set_role_permissions">
                                                        <i class="fa fa-bars"></i>
                                                        </Link>
                                                        <span v-if="role.name !== 'Admin'">
                                                        <a href="#" v-if="$page.props.permissions.delete_role" class="ml-3" type="button"
                                                            @click="destroyRole(role.id)">
                                                            <i class="fa fa-trash"></i>    
                                                        </a>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="createRole" role="tabpanel"
                                        aria-labelledby="createRole-tab">
                                        <form @submit.prevent="submitRole">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Role Name</label>
                                                        <input v-model="roleForm.name" type="text" class="form-control"
                                                            placeholder="Enter Role Name">
                                                        <small class="text-red" v-if="errors.name">{{ errors.name
                                                        }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group pt-2">
                                                        <button type="submit" :disabled="roleForm.processing"
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
        roles: Object,
        errors: Object
    },

    setup() {
        const roleForm = useForm({
            name: '',
        })

        const destroyRole = (id) => {
            if (confirm('Are you sure?')) {
                Inertia.delete(route('roles.destroy', id))
            }
        }

        return { roleForm, destroyRole }
    },

    methods: {
        submitRole() {
            this.roleForm.post(route('roles.store'));
            this.roleForm.title = ''
        }
    }
}

</script>
