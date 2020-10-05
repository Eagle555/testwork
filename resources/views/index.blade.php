<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0,">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students Info</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}">
</head>
<body>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="{{ action('StudentController@store') }}" method="POST">

            {{ csrf_field() }}
            <div class="modal-body">

                    <div class="form-group">
                        <label> First Name </label>
                        <input type="text" class="form-control" name="fname" placeholder="Enter First Name">
                    </div>

                    <div class="form-group">
                        <label> Last Name </label>
                        <input type="text" class="form-control" name="lname" placeholder="Enter Last Name">
                    </div>

                    <div class="form-group">
                        <label> Address </label>
                        <input type="text" name="address" class="form-control" placeholder="Enter address">
                    </div>

                    <div class="form-group">
                        <label> Mobile </label>
                        <input type="text" name="mobile" class="form-control" placeholder="Enter mobile number">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Data</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/student" method="POST" id="editForm">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="modal-body">

                    <div class="form-group">
                        <label> First Name </label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name">
                    </div>

                    <div class="form-group">
                        <label> Last Name </label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name">
                    </div>

                    <div class="form-group">
                        <label> Address </label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter address">
                    </div>

                    <div class="form-group">
                        <label> Mobile </label>
                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter mobile number">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/student" method="POST" id="deleteForm">

                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <div class="modal-body">
                    <input type="hidden" name="_method" value="DELETE">
                    <p>Do you want to delete data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark main-nav">
    <div class="container justify-content-center nav-center">
        <ul class="nav navbar-nav flex-fill w-100 flex-nowrap">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        Add Data
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a type="button" class="nav-link" data-toggle="modal" data-target="#addModal">
                        Add Data
                    </a>
                </li>
            @endguest
        </ul>
        <ul class="nav navbar-nav flex-fill w-100 justify-content-end">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>

<div class="container">

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
    @endif

    <br>
    <div class="table-responsive">
        <table id="datatable" class="table table-hover table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($students as $student)
                <tr>
                    <th> {{ $student->id }} </th>
                    <td> {{ $student->fname }} </td>
                    <td> {{ $student->lname }} </td>
                    <td> {{ $student->address }} </td>
                    <td> {{ $student->mobile }} </td>
                    @guest
                        <td>
                            <button class="btn btn-success edit" disabled> EDIT </button>
                            <button class="btn btn-danger delete"disabled> DELETE </button>
                        </td>
                    @else
                        <td>
                            <button class="btn btn-success edit"> EDIT </button>
                            <button class="btn btn-danger delete"> DELETE </button>
                        </td>
                    @endguest
                </tr>
              @endforeach
            </tbody>
        </table>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {

        var table = $('#datatable').DataTable();

        //Edit data
        table.on('click', '.edit', function () {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();

            $('#fname').val(data[1]);
            $('#lname').val(data[2]);
            $('#address').val(data[3]);
            $('#mobile').val(data[4]);

            $('#editForm').attr('action', '/student/'+data[0]);
            $('#editModal').modal('show');

        });

        //Delete data
        table.on('click', '.delete', function () {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();

            $('#id').val(data[0]);

            $('#deleteForm').attr('action', '/student/'+data[0]);
            $('#deleteModal').modal('show');

        });

    });

</script>

</body>
</html>
