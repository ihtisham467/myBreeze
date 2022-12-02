<template>

    <Head title="Permissions" />

    <AuthenticatedLayout>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permissions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <Link :href="route('dashboard')">Home</Link>
                            </li>
                            <li class="breadcrumb-item active">Permissions</li>
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
                                <ul class="nav nav-tabs" id="permissions" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="permissionsIndex-tab" data-toggle="pill"
                                            href="#permissionsIndex" role="tab" aria-controls="permissionsIndex"
                                            aria-selected="false">
                                            Permissions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="create-permission-tab" data-toggle="pill"
                                            href="#create-permission" role="tab" aria-controls="create-permission"
                                            aria-selected="false">
                                            Create Permission</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="permission-categories-tab" data-toggle="pill"
                                            href="#permission-categories" role="tab"
                                            aria-controls="permission-categories" aria-selected="false">Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="create_permission_category" data-toggle="pill"
                                            href="#custom-tabs-one-settings" role="tab"
                                            aria-controls="custom-tabs-one-settings" aria-selected="false">Create
                                            Category</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="permissionsContent">

                                    <div class="tab-pane fade active show" id="permissionsIndex" role="tabpanel"
                                        aria-labelledby="permissionsIndex-tab">
                                        <div v-for="category in categories" class="m-3">
                                            <p><strong>{{ category.title }}</strong></p>
                                            <div class="row">
                                                <div class="col-md-4"
                                                    v-for="(permission, index) in category.permissions">
                                                    <p>{{ index + 1 }}. {{ permission.name }} <a href="#" @click="destroyPermission(permission.id)" class="ml-2"><i class="fas fa-trash"></i></a></p>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="create-permission" role="tabpanel"
                                        aria-labelledby="create-permission-tab">
                                        <form @submit.prevent="submitPermission">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Category</label>
                                                        <select v-model="permissionForm.category_id"
                                                            class="form-control">
                                                            <option value="">Select Category</option>
                                                            <option v-for="category in categories" :value="category.id">
                                                                {{ category.title }}</option>
                                                        </select>
                                                        <small class="text-red" v-if="errors.category_id">{{
                                                                errors.category_id
                                                        }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Permission Name</label>
                                                        <input v-model="permissionForm.name" type="text"
                                                            class="form-control" placeholder="Enter Permission Name">
                                                        <small class="text-red" v-if="errors.name">{{ errors.name
                                                        }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" :disabled="permissionForm.processing"
                                                            class="btn btn-primary bg-blue">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="permission-categories" role="tabpanel"
                                        aria-labelledby="permission-categories-tab">
                                        <table class="table table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Title</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(category, index) in categories">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ category.title }}</td>
                                                    <td>
                                                    <button type="button" @click="destroyCategory(category.id)" class="btn btn-danger bg-red">Delete</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel"
                                        aria-labelledby="create_permission_category">
                                        <form @submit.prevent="submitCategory">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Category Title</label>
                                                        <input v-model="categoryForm.title" type="text"
                                                            class="form-control"
                                                            placeholder="Enter Permission Category Title">
                                                        <small class="text-red" v-if="errors.title">{{ errors.title
                                                        }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group pt-2">
                                                        <button type="submit" :disabled="categoryForm.processing"
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
        categories: Object,
        errors: Object
    },

    setup() {
        const categoryForm = useForm({
            title: '',
        })
        const permissionForm = useForm({
            name: '',
            category_id: '',
        })

        const destroyCategory = (id) => {
            if(confirm('Are you sure?')) {
                Inertia.delete(route('permission-categories.destroy', id))
            }
        }
        const destroyPermission = (id) => {
            if(confirm('Are you sure?')) {
                Inertia.delete(route('permissions.destroy', id))
            }
        }

        return { categoryForm, permissionForm, destroyCategory, destroyPermission }
    },

    methods: {
        submitCategory() {
            this.categoryForm.post(route('permission-categories.store'));
            this.categoryForm.title = ''
        },
        submitPermission() {
            this.permissionForm.post(route('permissions.store'));
        }
    }
}

</script>
