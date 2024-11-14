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

            <!-- Member Management Table -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Dummy data for testing
                        $members = [
                            ['id' => 1, 'name' => 'Alice Johnson', 'email' => 'alice@example.com', 'status' => 'Active'],
                            ['id' => 2, 'name' => 'Bob Smith', 'email' => 'bob@example.com', 'status' => 'Blocked'],
                            ['id' => 3, 'name' => 'Charlie Lee', 'email' => 'charlie@example.com', 'status' => 'Active'],
                        ];
                        ?>

                        <?php if (!empty($members) && is_array($members)): ?>
                            <?php foreach ($members as $member): ?>
                                <tr>
                                    <td><?= esc($member['id']); ?></td>
                                    <td><?= esc($member['name']); ?></td>
                                    <td><?= esc($member['email']); ?></td>
                                    <td>
                                        <span class="badge <?= $member['status'] === 'Active' ? 'bg-success' : 'bg-danger' ?>">
                                            <?= esc($member['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($member['status'] === 'Active'): ?>
                                            <a href="<?= base_url('admin/member/block/' . $member['id']); ?>" class="btn btn-danger btn-sm">Block</a>
                                        <?php else: ?>
                                            <a href="<?= base_url('admin/member/activate/' . $member['id']); ?>" class="btn btn-success btn-sm">Activate</a>
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

<?= $this->endSection() ?>
