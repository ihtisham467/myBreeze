<template>

    <Head title="Setting" />

    <AuthenticatedLayout>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <Link :href="route('dashboard')">Home</Link>
                            </li>
                            <li class="breadcrumb-item active">Setting</li>
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
                                <form @submit.prevent="submitSetting">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">App Name</label>
                                                <input v-model="settingForm.app_name" type="text" class="form-control"
                                                    placeholder="Enter App Name">
                                                <small class="text-red" v-if="errors.app_name">{{ errors.app_name
                                                }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group pt-2">
                                                <button type="submit" :disabled="settingForm.processing"
                                                    class="btn btn-primary bg-blue">Save</button>
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
        setting: Object,
        errors: Object
    },

    setup(props) {
        const settingForm = useForm({
            app_name: props.setting.app_name,
        })

        return { settingForm }
    },

    methods: {
        submitSetting() {
            this.settingForm.post(route('setting.update'));
        }
    }
}

</script>
