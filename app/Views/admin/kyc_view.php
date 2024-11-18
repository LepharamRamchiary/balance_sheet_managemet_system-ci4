<!-- views/kyc_management_view.php -->
<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<!-- Full-Screen Layout -->
<div class="container-fluid vh-100 d-flex">
    <div class="row w-100">
        <!-- Sidebar -->
        <?= $this->include('partials/sidebar'); ?>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
            <h2>KYC Management</h2>
            <p class="mb-4">Review and approve or reject KYC requests from members.</p>

            <?php if (!empty($success)): ?>
                <div id="success-alert" class="alert alert-success">
                    <?= esc($success); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div id="error-alert" class="alert alert-danger">
                    <?= esc($error); ?>
                </div>
            <?php endif; ?>

            <!-- KYC Data Table -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>KYC Status</th>
                            <th>Submitted Documents</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($kycRequests) && is_array($kycRequests)): ?>
                            <?php $count = 1; ?>
                            <?php foreach ($kycRequests as $request): ?>
                                <tr>
                                    <td><?= esc($count++); ?></td>
                                    <td><?= esc($request['name']); ?></td>
                                    <td><?= esc($request['email']); ?></td>
                                    <td>
                                        <span class="badge 
                                            <?= $request['kyc_status'] === 'approved' ? 'bg-success' : ($request['kyc_status'] === 'rejected' ? 'bg-danger' : 'bg-warning') ?>">
                                            <?= esc($request['kyc_status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url($request['doc']); ?>" target="_blank">View Document</a>
                                    </td>
                                    <td>
                                        <?php if ($request['kyc_status'] === 'pending'): ?>
                                            <a href="<?= base_url('admindashboard/approvekyc/' . $request['id']); ?>" class="btn btn-success btn-sm">Approve</a>
                                            <a href="<?= base_url('admindashboard/rejectkyc/' . $request['id']); ?>" class="btn btn-danger btn-sm">Reject</a>
                                        <?php else: ?>
                                            <span class="text-muted">No action needed</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No KYC requests found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    setTimeout(() => {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');
        if (successAlert) successAlert.style.display = 'none';
        if (errorAlert) errorAlert.style.display = 'none';
    }, 3000);
</script>

<?= $this->endSection() ?>