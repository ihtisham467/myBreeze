<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Sidebar from '@/Components/Sidebar.vue';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
// import Dropdown from '@/Components/Dropdown.vue';
// import DropdownLink from '@/Components/DropdownLink.vue';
// import NavLink from '@/Components/NavLink.vue';
// import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

// const showingNavigationDropdown = ref(false);

</script>

<template>
    <div class="wrapper">

        <!-- Navbar -->
        <Navbar />
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <ApplicationLogo />
                <span class="brand-text font-weight-light">{{ $page.props.setting.app_name }}</span>
            </a>

            <!-- Sidebar -->
            <Sidebar />
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div v-if="$page.props.flash.successMsg" class="alert alert-success m-3 alert-dismissible fade show" role="alert">
                {{ $page.props.flash.successMsg }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div v-if="$page.props.flash.errorMsg" class="alert alert-danger m-3 alert-dismissible fade show" role="alert">
                {{ $page.props.flash.errorMsg }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <slot />
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <Footer />
    </div>
</template>
