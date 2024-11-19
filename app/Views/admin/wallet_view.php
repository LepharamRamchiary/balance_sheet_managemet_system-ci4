<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<div class="container-fluid vh-100 d-flex">
    <div class="row w-100">
        <!-- Sidebar -->
        <?= $this->include('partials/sidebar'); ?>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
            <h2>Pending Transactions</h2>
            <p class="mb-4">Manage pending deposit and withdrawal requests.</p>

            <?php if (session()->getFlashdata('success')): ?>
                <div id="success-alert" class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div id="error-alert" class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Wallet Management Table -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Request Amount</th>
                            <th>Transaction Type</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($wallets) && is_array($wallets)): ?>
                            <?php foreach ($wallets as $wallet): ?>
                                <tr>
                                    <td><?= $wallet['id']; ?></td>
                                    <td><?= $wallet['username']; ?></td>
                                    <td><?= $wallet['email']; ?></td>
                                    <td>$<?= number_format($wallet['amount'], 2); ?></td>
                                    <td>
                                        <span class="badge <?= $wallet['t_type'] === 'deposit' ? 'bg-success' : 'bg-warning' ?>">
                                            <?= ucfirst($wallet['t_type']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            <?= ucfirst($wallet['status']); ?>
                                        </span>
                                    </td>
                                    <td><?= date('Y-m-d H:i', strtotime($wallet['created_at'])); ?></td>
                                    <td>
                                        <?php if ($wallet['status'] === 'pending'): ?>
                                            <form action="<?= base_url('admindashboard/' . $wallet['t_type'] . '/' . $wallet['id']); ?>" method="post" class="d-inline">
                                                <button type="submit" class="btn btn-<?= $wallet['t_type'] === 'deposit' ? 'success' : 'warning' ?> btn-sm" onclick="return confirm('Are you sure you want to process this <?= $wallet['t_type'] ?>?')">
                                                    Process <?= ucfirst($wallet['t_type']); ?>
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Processed</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">No pending transactions found.</td>
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