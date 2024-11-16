<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<div class="container-fluid vh-100">
    <div class="row w-100 h-100">
        <!-- Sidebar -->
        <?= $this->include('partials/membersidebar'); ?>
        <div class="col-md-9 col-lg-10 p-4 d-flex flex-column h-100">
            <h2 class="mb-4">Hi, <?= $userName; ?> Welcome to your Dashboard</h2>

            <!-- Cards Section -->
            <div class="row mb-4">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="card h-100 shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h5>You Can Now Update Your KYC</h5>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <p class="card-text">Ensure your KYC details are up-to-date to maintain a smooth experience on the platform.</p>
                            <a href="<?= base_url() . 'memberdashboard/submitmemberkyc' ?>" class="btn btn-primary mt-2">Update KYC</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Wallet Management -->
                <div class="col-md-6">
                    <div class="card h-100 shadow-lg">
                        <div class="card-header bg-success text-white">
                            <h5>You Can Deposit and Withdraw Funds</h5>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <p class="card-text">Manage your funds by depositing or withdrawing money into your wallet.</p>
                            <a href="<?= base_url() . 'memberdashboard/memberwallet' ?>" class="btn btn-success mt-2">Manage Wallet</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KYC Status Section -->
            <div class="card shadow-lg">
                <div class="card-header">
                    <h4>Your KYC Status</h4>
                </div>
                <div class="card-body">
                    <?php if ($kycStatus === 'approved'): ?>
                        <div class="alert alert-success">
                            <strong>Approved:</strong> Your KYC has been approved.
                        </div>
                    <?php elseif ($kycStatus === 'pending'): ?>
                        <div class="alert alert-warning">
                            <strong>Pending:</strong> Your KYC is under review. Please wait for admin approval.
                        </div>
                    <?php elseif ($kycStatus === 'rejected'): ?>
                        <div class="alert alert-danger">
                            <strong>Rejected:</strong> Your KYC was rejected. Please submit it again.
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <strong>Not Submitted:</strong> You have not submitted your KYC yet. Please submit it now.
                        </div>
                        <a href="<?= base_url('memberdashboard/submitmemberkyc') ?>" class="btn btn-primary">Submit KYC</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
