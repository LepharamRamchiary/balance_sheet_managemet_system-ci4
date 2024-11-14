<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<div class="vh-100 d-flex">
    <!-- Sidebar -->
    <?= $this->include('partials/membersidebar'); ?>

    <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
        <h2>Member Wallet</h2>
        <!-- Wallet Management Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h5>Wallet Management</h5>
                    </div>
                    <div class="card-body">
                        <form action="/manage_wallet" method="POST">
                            <div class="mb-3">
                                <label for="wallet_balance" class="form-label">Wallet Balance</label>
                                <input type="number" class="form-control" id="wallet_balance" name="wallet_balance" placeholder="Enter amount to withdraw or deposit" required>
                            </div>
                            <div class="mb-3">
                                <label for="transaction_type" class="form-label">Transaction Type</label>
                                <select class="form-control" id="transaction_type" name="transaction_type" required>
                                    <option value="deposit">Deposit</option>
                                    <option value="withdraw">Withdraw</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Submit Transaction</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
