<?php 
include(__DIR__ . '/../includes/admin_header.php');
?>

<div class="container mt-5">
    <h2 class="mb-4">System Reports & Analytics</h2>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Filter Reports</h5>
            <form id="reportFilterForm">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Report Type</label>
                        <select class="form-select" id="reportType">
                            <option value="all" selected>All Reports</option>
                            <option value="mood">Mood Analytics</option>
                            <option value="patients">Service Users</option>
                            <option value="staff">Staff Activity</option>
                            <option value="system">System Audit</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Date Range</label>
                        <select class="form-select" id="dateRange">
                            <option value="today">Today</option>
                            <option value="week" selected>This Week</option>
                            <option value="month">This Month</option>
                            <option value="quarter">This Quarter</option>
                            <option value="year">This Year</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="status">
                            <option value="all" selected>All</option>
                            <option value="completed">Completed</option>
                            <option value="processing">Processing</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Reports Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Generated Reports</h5>
            <div>
                <button class="btn btn-success btn-sm me-2">
                    <i class="bi bi-plus-circle"></i> Generate Report
                </button>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-download"></i> Export Selected
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Report Name</th>
                            <th>Category</th>
                            <th>Generated On</th>
                            <th>Period</th>
                            <th>Status</th>
                            <th>Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Weekly Mood Summary</td>
                            <td><span class="badge bg-primary">Mood</span></td>
                            <td>26 Jan 2026</td>
                            <td>This Week</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>1.2 MB</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-download"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Service User Allocation</td>
                            <td><span class="badge bg-info">Patients</span></td>
                            <td>24 Jan 2026</td>
                            <td>This Month</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>980 KB</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-download"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Staff Activity Log</td>
                            <td><span class="badge bg-warning text-dark">Staff</span></td>
                            <td>23 Jan 2026</td>
                            <td>Last 7 Days</td>
                            <td><span class="badge bg-secondary">Processing</span></td>
                            <td>Generating</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" disabled><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary" disabled><i class="bi bi-download"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link">Previous</a></li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h6>Total Reports</h6>
                    <h3>18</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h6>Completed</h6>
                    <h3>12</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h6>Processing</h6>
                    <h3>4</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h6>Data Volume</h6>
                    <h3>21 MB</h3>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include("../includes/footer.php"); ?>
