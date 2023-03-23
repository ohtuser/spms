<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            @if(user_info()->user_type == 1)
            <div class="nav">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Admins
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapTeacher" aria-expanded="false" aria-controls="collapTeacher">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Teacher
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapTeacher" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('teacher.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                            List
                        </a>
                        <a class="nav-link" href="{{ route('teacher.subject_assign') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                            Course Assign
                        </a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStudent" aria-expanded="false" aria-controls="collapseStudent">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Student
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseStudent" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('student.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                            List
                        </a>
                        <a class="nav-link" href="{{ route('student.subject_assign') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                            Course Assign
                        </a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ route('subject.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                    Course
                </a>
                <a class="nav-link" href="{{ route('batch.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-school"></i></div>
                    Batch
                </a>
                <a class="nav-link" href="{{ route('trimester.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-school"></i></div>
                    Trimester
                </a>
            </div>
            @else
                <div class="nav">
                    <a class="nav-link" href="{{ route('teacher.teacher.assigned_subject') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Assign Courses
                    </a>
                </div>
            @endif
        </div>
    </nav>
</div>
