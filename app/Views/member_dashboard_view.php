<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<!-- Full-Screen Layout for Member Dashboard -->
<div class="container-fluid vh-100 d-flex">
    <div class="row w-100">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 p-3 bg-dark text-white d-flex flex-column">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">KYC Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Wallet Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Log Out</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
            <h2 class="mb-4">Welcome, Member</h2>

            <!-- KYC Section -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>KYC Form</h5>
                        </div>
                        <div class="card-body">
                            <form action="/submit_kyc" method="POST">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_number" class="form-label">ID Number</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_document" class="form-label">Upload ID Document</label>
                                    <input type="file" class="form-control" id="id_document" name="id_document" accept=".jpg,.png,.pdf" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit KYC</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wallet Management Section -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
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
</div>

<?= $this->endSection() ?>
