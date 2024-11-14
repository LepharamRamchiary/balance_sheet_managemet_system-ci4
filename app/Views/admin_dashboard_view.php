<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<!-- Full-Screen Layout -->
<div class="container-fluid vh-100 d-flex">
    <div class="row w-100">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 p-3 bg-dark text-white d-flex flex-column">
            <h4 class="text-center mb-4">Admin Dashboard</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Member Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Kyc Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Wallet Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Member Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Log Out</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
            <h2>Welcome User</h2>

            <div class="row mb-4">
                <div class="col-sm-6 col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text">120</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Active Users</h5>
                            <p class="card-text">110</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Active Users</h5>
                            <p class="card-text">110</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
