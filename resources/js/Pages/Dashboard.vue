

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <Link :href="route('dashboard')">Home</Link>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
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
                    <div class="col-lg-12">

                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <h5 class="card-title">Setting Page Coming Soon!</h5>

                                <p class="card-text">
                                    Some quick example text to build on the card title and make up the bulk of
                                    the card's
                                    content.
                                </p>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div><!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AuthenticatedLayout, Head, Link
    },
    props: {

    },
    created() {
        // if (1===1) {
        // }
        // if ($page.props.flash.reloadPageOnce) {
        //     alert()
        // }
    }
};

</script>
