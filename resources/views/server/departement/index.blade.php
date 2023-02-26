@extends('layouts.app')
@section('title', 'Departement')
@section('heading', 'Departement')
@section('styles')
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <!-- Button trigger modal -->
      <button
        type="button"
        class="btn btn-primary btn-sm btn-add"
      >
        <i class="fas fa-plus"></i>
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table
          class="table table-bordered table-striped table-hover"
          id="dataTable"
          width="100%"
          cellspacing="0"
        >
          <thead>
            <tr>
              <td>No</td>
              <td>Name</td>
              <td>Status</td>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($departement as $data)
            @php
              if ($data->status == 1) {
                $status = 'Active';
              } else if ($data->status == 2) {
                $status = 'In Active';
              }
            @endphp
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $status }}</td>
                <td>
                  <form
                    action="{{ route('departement.destroy', $data->id) }}"
                    method="POST"
                  >
                    @csrf
                    @method('delete')
                    <a
                      href="{{ route('departement.edit', $data->id) }}"
                      type="button"
                      class="btn btn-warning btn-sm btn-circle"
                      ><i class="fas fa-edit"></i
                    ></a>
                    <button
                      type="submit"
                      class="btn btn-danger btn-sm btn-circle"
                      onclick="return confirm('Yakin');"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Add Modal -->
  <div
  class="modal fade"
  id="modal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Departement</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('departement.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Name Departement" required
              />
            </div>
            <div class="form-group">
              <label for="name">Status</label><br>
              <input type="radio" name="status" id="status1" value="1">
              <label for="status1">Active</label>&nbsp;&nbsp;&nbsp;
              <input type="radio" name="status" id="status2" value="2">
              <label for="status2">In Active</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Kembali
            </button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });

    $(".btn-add").click(function(){
      $("#modal").modal("show");
      $(".modal-title").html("Tambah Departement");
      $("#id").val("");
      $("#name").val("");
    });

    $("#dataTable").on("click", ".btn-edit", function () {
      let id = $(this).data("id");
      let name = $(this).data("name");
      let status = $(this).data("status");
      $("#modal").modal("show");
      $(".modal-title").html("Edit Departement");
      $("#id").val(id);
      $("#name").val(name);
      $("#status").val(status);
    });
  </script>
@endsection
