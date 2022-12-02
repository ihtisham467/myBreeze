<template>

    <Head title="Role Permissions" />

    <AuthenticatedLayout>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ role.name }} Permissions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <Link :href="route('dashboard')">Home</Link>
                            </li>
                            <li class="breadcrumb-item active">{{ role.name }} Permissions</li>
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
                                <form @submit.prevent="submit(role.id)">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div v-for="category in categories" class="m-3">
                                                <h1><strong>{{ category.title }}</strong></h1>
                                                <div class="row">
                                                    <div class="col-md-4"
                                                        v-for="(permission, index) in category.permissions">
                                                        <label><input v-model="form.permissions" type="checkbox" :value="permission.id"/> {{ permission.name }}</label>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group pt-2">
                                                <button type="submit" :disabled="form.processing"
                                                    class="btn btn-primary bg-blue">Update</button>
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
        categories: Object,
        role: Object,
        rolePermissions: Object,
        errors: Object
    },

    setup(props) {
        const form = useForm({
            permissions: props.rolePermissions,
        })

        return { form }
    },

    methods: {
        submit(id) {
            this.form.put(route('update_role_permissions', id));
        }
    }
}

</script>
