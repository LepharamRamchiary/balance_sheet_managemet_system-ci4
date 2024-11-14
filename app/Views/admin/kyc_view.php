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

            <!-- KYC Data Table -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>KYC Status</th>
                            <th>Submitted Documents</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Dummy data for testing
                        $kyc_requests = [
                            ['id' => 1, 'name' => 'Alice Johnson', 'email' => 'alice@example.com', 'kyc_status' => 'Pending', 'documents' => 'ID Card, Address Proof'],
                            ['id' => 2, 'name' => 'Bob Smith', 'email' => 'bob@example.com', 'kyc_status' => 'Pending', 'documents' => 'Passport, Utility Bill'],
                            ['id' => 3, 'name' => 'Charlie Lee', 'email' => 'charlie@example.com', 'kyc_status' => 'Approved', 'documents' => 'Driver License, Tax Document'],
                        ];
                        ?>

                        <?php if (!empty($kyc_requests) && is_array($kyc_requests)): ?>
                            <?php foreach ($kyc_requests as $request): ?>
                                <tr>
                                    <td><?= esc($request['id']); ?></td>
                                    <td><?= esc($request['name']); ?></td>
                                    <td><?= esc($request['email']); ?></td>
                                    <td>
                                        <span class="badge <?= $request['kyc_status'] === 'Approved' ? 'bg-success' : 'bg-warning' ?>">
                                            <?= esc($request['kyc_status']); ?>
                                        </span>
                                    </td>
                                    <td><?= esc($request['documents']); ?></td>
                                    <td>
                                        <?php if ($request['kyc_status'] === 'Pending'): ?>
                                            <a href="<?= base_url('admin/kyc/approve/' . $request['id']); ?>" class="btn btn-success btn-sm">Approve</a>
                                            <a href="<?= base_url('admin/kyc/reject/' . $request['id']); ?>" class="btn btn-danger btn-sm">Reject</a>
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

<?= $this->endSection() ?>
