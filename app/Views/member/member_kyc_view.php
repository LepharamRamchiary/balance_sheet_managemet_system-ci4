<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<div class="vh-100 d-flex">
    <!-- Sidebar -->
    <?= $this->include('partials/membersidebar'); ?>

    <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
        <h2>Member KYC Section</h2>
        <!-- KYC Form Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-lg"> 
                    <div class="card-header bg-primary text-white">
                        <h5>KYC Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="/submit_kyc" method="POST" enctype="multipart/form-data">
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

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit KYC</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
