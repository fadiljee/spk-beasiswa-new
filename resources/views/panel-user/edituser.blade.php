@extends('panel-user.layout')

@section('title', 'Edit User')
@section('content')

<div class="content-wrapper">

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">FORM EDIT</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{route('updateuser', $user->id)}}" method="POST">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" value="{{$user->nama}}" placeholder="Input Nama">
                </div>
                <div class="form-group">
                  <label>No HP</label>
                  <input type="text" class="form-control" name="no_hp" value="{{$user->no_hp}}" placeholder="Input No HP">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Input Email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Input Password">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col-12 -->
      </div>
    </div>
  </section>



</div>
<!-- /.content-wrapper -->

@endsection
