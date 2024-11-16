<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<div class="vh-100 d-flex">
    <!-- Sidebar -->
    <?= $this->include('partials/membersidebar'); ?>

    <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
        <h2>Member KYC Section</h2>

        <!-- Flash messages for success or error -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Validation errors -->
        <?php if (isset($validation) && count($validation->getErrors()) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($validation->getErrors() as $error): ?>
                        <li><?= esc($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- KYC Form Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h5>KYC Form</h5>
                    </div>
                    <div class="card-body">
                        <!-- Form Open -->
                        <?= form_open_multipart('/submit_kyc') ?> <!-- Match route with controller method -->
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="<?= old('dob') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="doc" class="form-label">Upload ID Document</label>
                                <input type="file" class="form-control"  name="doc" accept=".jpg,.png,.pdf,.jpng" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit KYC</button>
                            </div>
                        <?= form_close() ?> <!-- Form Close -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
