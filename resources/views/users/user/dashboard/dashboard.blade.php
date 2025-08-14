@extends('users.user.layout.layout')

@section('content2')
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Quick Stats -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Current Courses</div>
                                <div class="text-lg fw-bold">5</div>
                            </div>
                            <i class="fas fa-book fa-2x text-white-50"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="#">View Courses</a>
                        <i class="fas fa-arrow-right text-white-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Assignments Due</div>
                                <div class="text-lg fw-bold">3</div>
                            </div>
                            <i class="fas fa-tasks fa-2x text-white-50"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="#">View Assignments</a>
                        <i class="fas fa-arrow-right text-white-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Upcoming Exams</div>
                                <div class="text-lg fw-bold">2</div>
                            </div>
                            <i class="fas fa-calendar-alt fa-2x text-white-50"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="#">View Schedule</a>
                        <i class="fas fa-arrow-right text-white-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Messages</div>
                                <div class="text-lg fw-bold">4</div>
                            </div>
                            <i class="fas fa-envelope fa-2x text-white-50"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="#">View Messages</a>
                        <i class="fas fa-arrow-right text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Upcoming Deadlines -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Upcoming Deadlines</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Math Assignment #3</h5>
                                    <small class="text-danger">Due tomorrow</small>
                                </div>
                                <p class="mb-1">Linear Algebra Problems</p>
                                <small>Math 101 - Prof. Smith</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Literature Essay</h5>
                                    <small class="text-warning">Due in 3 days</small>
                                </div>
                                <p class="mb-1">Analysis of Shakespeare's Sonnets</p>
                                <small>English 210 - Prof. Johnson</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Science Project</h5>
                                    <small class="text-primary">Due in 1 week</small>
                                </div>
                                <p class="mb-1">Physics Experiment Report</p>
                                <small>Physics 150 - Prof. Lee</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Grades -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Grades</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">View All Grades</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Assignment</th>
                                    <th>Grade</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Math 101</td>
                                    <td>Assignment #2</td>
                                    <td>92%</td>
                                    <td><span class="badge bg-success">Excellent</span></td>
                                </tr>
                                <tr>
                                    <td>History 210</td>
                                    <td>Midterm Exam</td>
                                    <td>85%</td>
                                    <td><span class="badge bg-primary">Good</span></td>
                                </tr>
                                <tr>
                                    <td>Physics 150</td>
                                    <td>Lab Report #3</td>
                                    <td>78%</td>
                                    <td><span class="badge bg-warning">Average</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Course Progress -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Course Progress</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Math 101 <span class="float-right">75%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">English 210 <span class="float-right">60%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Physics 150 <span class="float-right">40%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Computer Science 101 <span class="float-right">90%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">History 210 <span class="float-right">55%</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Announcements -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Announcements</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="small text-gray-500">October 10, 2023</div>
                            <span class="font-weight-bold">Math 101 Class Cancelled</span>
                            <p>Tomorrow's Math 101 class has been cancelled. The next lecture will be on Monday.</p>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div class="small text-gray-500">October 8, 2023</div>
                            <span class="font-weight-bold">Library Closure Notice</span>
                            <p>The main library will be closed this Saturday for maintenance work.</p>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div class="small text-gray-500">October 5, 2023</div>
                            <span class="font-weight-bold">Career Fair Announcement</span>
                            <p>The annual career fair will be held next week. Register now to secure your spot.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Widget -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Academic Calendar</h6>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Additional scripts for the dashboard -->
    <script>
        // Initialize calendar
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: new Date(),
                navLinks: true,
                editable: false,
                eventLimit: true,
                events: [
                    {
                        title: 'Math Midterm',
                        start: '2023-11-15',
                        end: '2023-11-15',
                        className: 'bg-danger'
                    },
                    {
                        title: 'Literature Essay Due',
                        start: '2023-11-18',
                        end: '2023-11-18',
                        className: 'bg-warning'
                    },
                    {
                        title: 'Science Project Presentation',
                        start: '2023-11-22',
                        end: '2023-11-22',
                        className: 'bg-info'
                    },
                    {
                        title: 'Thanksgiving Break',
                        start: '2023-11-23',
                        end: '2023-11-26',
                        className: 'bg-success'
                    }
                ]
            });
        });
    </script>
@endsection
