<!-- views/wallet_management_view.php -->
<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<!-- Full-Screen Layout -->
<div class="container-fluid vh-100 d-flex">
    <div class="row w-100">
        <!-- Sidebar -->
        <?= $this->include('partials/sidebar'); ?>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
            <h2>Wallet Management</h2>
            <p class="mb-4">View, deposit, or withdraw funds from member accounts.</p>

            <!-- Wallet Management Table -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Member Name</th>
                            <th>Email</th>
                            <th>Wallet Balance</th>
                            <th>Transaction Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Dummy data for testing
                        $wallet_data = [
                            ['id' => 1, 'name' => 'Alice Johnson', 'email' => 'alice@example.com', 'balance' => 5000, 'type' => 'Deposit'],
                            ['id' => 2, 'name' => 'Bob Smith', 'email' => 'bob@example.com', 'balance' => 3000, 'type' => 'Withdraw'],
                            ['id' => 3, 'name' => 'Charlie Lee', 'email' => 'charlie@example.com', 'balance' => 4500, 'type' => 'Deposit'],
                        ];
                        ?>

                        <?php if (!empty($wallet_data) && is_array($wallet_data)): ?>
                            <?php foreach ($wallet_data as $wallet): ?>
                                <tr>
                                    <td><?= esc($wallet['id']); ?></td>
                                    <td><?= esc($wallet['name']); ?></td>
                                    <td><?= esc($wallet['email']); ?></td>
                                    <td>$<?= esc($wallet['balance']); ?></td>
                                    <td><?= esc($wallet['type']); ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/wallet/deposit/' . $wallet['id']); ?>" class="btn btn-primary btn-sm">Deposit</a>
                                        <a href="<?= base_url('admin/wallet/withdraw/' . $wallet['id']); ?>" class="btn btn-warning btn-sm">Withdraw</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No wallet transactions found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
