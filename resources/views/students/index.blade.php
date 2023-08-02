<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <!-- place navbar here -->
    <h1 class=" container text-start">University Project</h1>
    <h1 class=" container text-end">Students</h1>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Main</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('students.index') }}" aria-current="page">Student
                            <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('courses.index')}}">Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">registration</a>
                    </li>
                </ul>
                <div>
                    Project by Pannawat
                </div>
            </div>
        </div>
    </nav>

    </header>
    <main>
        <div class="card container">
            <div class="row justify-content-center align-items-center g-2">
                <h1 class="text-center">Student List</h1>
            </div>
            <div class="row justify-content-end align-items-end m-2">
                <a href="{{ route('students.create') }}" class="btn btn-primary w-25">
                    Create Students
                </a>
            </div>
            @if ($message = Session::get('success'))
                <p class="alert alert-success">{{ $message }}</p>
            @endif
            <table class="table table-bordered">
                <tr class="text-center">
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
                @foreach ($students as $s)
                    <tr>
                        <td style="width:10%">{{ $s->stid }}</td>
                        <td>{{ $s->fname }}</td>
                        <td>{{ $s->lname }}</td>
                        <td style="width:15%">{{ $s->created_at }}</td>
                        <td style="width:15%"> {{ $s->updated_at }}</td>
                        <td style="width:15%">
                            <form action="{{ route('students.destroy', $s->stid) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="row justify-content-center align-items-center">
                                    <div class="col"style="margin-right:-15px">
                                        <a href="{{ route('students.edit', $s->stid) }}"
                                            class="w-100 btn btn-warning" >Edit</a>
                                    </div>
                                    <div class="col">
                                        <input type="submit" class="w-100 btn btn-danger" value="Delete">
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {!! $students->links('pagination::bootstrap-5') !!}
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
