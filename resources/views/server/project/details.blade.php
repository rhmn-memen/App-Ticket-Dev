@extends('layouts.app')
@section('title', 'Details Project')
@section('heading', 'Details Project')
@section('styles')
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
  <style>
    .select2-container .select2-selection--single {
      display: block;
      width: 100%;
      height: calc(1.5em + .75rem + 2px);
      padding: .375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 2;
      color: #6e707e;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #d1d3e2;
      border-radius: .35rem;
      transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #6e707e;
      line-height: 28px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
      display: block;
      padding-left: 0;
      padding-right: 0;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      margin-top: -2px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: calc(1.5em + .75rem + 2px);
      position: absolute;
      top: 1px;
      right: 1px;
      width: 20px;
    }
  </style>
@endsection
@section('content')
  <div class="card shadow mb-4 mt-2">
    <div class="card-header py-3">
      <!-- Button trigger modal -->
      <button
        type="button"
        class="btn btn-primary btn-sm btn-add"
      >
        <i class="fas fa-plus"></i>
      </button>
    </div>
    <form >
      @csrf
      <div class="card-body">
        <input type="hidden" name="id" value="{{ $project->id }}">
        <div class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            value="{{ $project->name }}"
            readonly
          />
        </div>
        <div class="form-group">
          <label for="name">Deskripsi</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            value="{{ $project->deskripsi }}"
            readonly
          />
        </div>
      </div>
      
    </form>
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
            </tr>
          </thead>
          <tbody>
            @if (count($user_project) > 0)
            @foreach ($user_project as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->user->name }}</td>
              </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('project.index') }}" class="btn btn-warning mr-2">Kembali</a>
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
           <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
           <button
             type="button"
             class="close"
             data-dismiss="modal"
             aria-label="Close"
           >
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <form action="{{ route('project.addUser') }}" method="POST">
           @csrf
           <div class="modal-body">
             <input type="hidden" name="project_id" value="{{ $project->id }}">
             <input type="hidden" name="id">
             <div class="form-group">
               <label for="name">User</label>
               <input
                 type="text"
                 class="form-control"
                 id="usr_name"
                 name="usr_name"
                 placeholder="Name Project"
                 required
               />
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
  <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
  <script>
    $(".btn-add").click(function(){
      $("#modal").modal("show");
      $(".modal-title").html("Tambah Project");
      $("#id").val("");
      $("#usr_name").val("");
    });
    if(jQuery().select2) {
      $(".select2").select2();
    }
    function inputNumber(e) {
      const charCode = (e.which) ? e.which : w.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
      return true;
    };
  </script>
@endsection
