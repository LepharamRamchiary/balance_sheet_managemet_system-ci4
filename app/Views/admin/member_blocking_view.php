<!-- views/member_management_view.php -->
<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<!-- Full-Screen Layout -->
<div class="container-fluid vh-100 d-flex">
    <div class="row w-100">
        <!-- Sidebar -->
        <?= $this->include('partials/sidebar'); ?>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
            <h2>Member Management</h2>
            <p class="mb-4">View and manage active or blocked members.</p>

            <?php if (!empty($success)): ?>
                <div id="success-alert" class="alert alert-success">
                    <?= $success; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div id="error-alert" class="alert alert-danger">
                    <?= $error; ?>
                </div>
            <?php endif; ?>

            <!-- Member Management Table -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($members) && is_array($members)): ?>
                            <?php $count = 1; ?>
                            <?php foreach ($members as $member): ?>
                                <tr>
                                    <td><?= $count++; ?></td>
                                    <td><?= $member->username  ?></td>
                                    <td><?= $member->email  ?></td>
                                    <td>
                                        <span class="badge <?= $member->status === 'active' ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $member->status; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($member->status === 'active'): ?>
                                            <a href="<?= base_url('admindashboard/blockuser/' . $member->id); ?>" class="btn btn-danger btn-sm">Block</a>
                                        <?php else: ?>
                                            <a href="<?= base_url('admindashboard/activateuser/' . $member->id); ?>" class="btn btn-success btn-sm">Activate</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No members found.</td>
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