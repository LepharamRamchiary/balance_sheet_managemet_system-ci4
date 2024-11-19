<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<div class="vh-100 d-flex">
    <!-- Sidebar -->
    <?= $this->include('partials/membersidebar'); ?>

    <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
        <h2>Your Wallet</h2>

        <!-- Display Wallet Balance -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h5>Wallet Balance: ₹<?= number_format($balance, 2); ?></h5>
                    </div>
                    <div class="card-body">
                        <?php if (isset($successfull) && $successfull): ?>
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show">
                                <?= $successfull ?>

                            </div>
                        <?php endif; ?>

                        <?php if (isset($errors) && $errors): ?>
                            <div id="error-alert" class="alert alert-danger alert-dismissible fade show">
                                <?= $errors ?>

                            </div>
                        <?php endif; ?>
                        <form action="<?= base_url() . 'memberdashboard/memberwallet' ?>" method="POST">
                            <?= csrf_field(); ?>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount to withdraw or deposit" required>
                            </div>

                            <div class="mb-3">
                                <label for="t_type" class="form-label">Transaction Type</label>
                                <select class="form-control" id="t_type" name="t_type" required>
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

<script>
    setTimeout(() => {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');
        if (successAlert) successAlert.style.display = 'none';
        if (errorAlert) errorAlert.style.display = 'none';
    }, 3000);
</script>

<?= $this->endSection() ?>