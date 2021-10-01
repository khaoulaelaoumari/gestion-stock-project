@extends('layouts/contentLayoutMaster')

@section('title', 'User List')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-user.css')) }}">
@endsection

@section('content')
<!-- users list start -->
<section class="app-user-list">
  <!-- users filter start -->
  <div class="card">
    <h5 class="card-header">Search Filter</h5>
    <div class="d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2">
      <div class="col-md-4 user_role"></div>
      <div class="col-md-4 user_plan"></div>
      <div class="col-md-4 user_status"></div>
    </div>
  </div>
  <!-- users filter end -->
  <!-- list section start -->
  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <table class="user-list-table table">
        <thead class="thead-light">
          <tr>
            {{-- <th></th> --}}
            <th>Nom</th>
            <th>Prenom</th>
            <th>Role</th>
            <th>Email</th>
            <th>Téléphone</th>
            <center><th>Actions</th></center>
          </tr>
        </thead>
      </table>
    </div>
    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" action="{{ route('add-User') }}" method="POST">
          @csrf
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter Utilisateur</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Nom</label>
              <input
                required
                type="text"
                class="form-control dt-full-name"
                id="basic-icon-default-fullname"
                placeholder="John Doe"
                name="name"
                aria-label="John Doe"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-uname">Prénom</label>
              <input
                required
                type="text"
                id="basic-icon-default-uname"
                class="form-control dt-uname"
                placeholder="Web Developer"
                aria-label="jdoe1"
                aria-describedby="basic-icon-default-uname2"
                name="prenom"
              />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input
                type="text"
                required
                id="basic-icon-default-email"
                class="form-control dt-email"
                placeholder="john.doe@example.com"
                aria-label="john.doe@example.com"
                aria-describedby="basic-icon-default-email2"
                name="email"
              />
              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-password">Mot de Passe</label>
              <input
                type="password"
                required
                id="basic-icon-default-password"
                class="form-control dt-password"
                placeholder="**********"
                aria-label="**********"
                aria-describedby="basic-icon-default-email2"
                name="password"
              />
            </div>
            <div class="form-group">
              <label class="form-label" for="user-role">Rôle</label>
              <select id="user-role" class="form-control" name="role" required>
                <option value="admin">Admin</option>
                <option value="Editeur">Editeur</option>
              </select>
            </div>
            <div class="form-group mb-2">
              <label class="form-label" for="user-phone">Numéro Téléphone</label>
              <input
              type="text"
              required
              class="form-control dt-full-name"
              id="user-phone"
              placeholder="062222222222"
              name="phone"
              aria-label="Téléphone"
              aria-describedby="basic-icon-default-fullname2"
            />
            </div>
            <button type="submit" class="btn btn-primary mr-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-edit">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" action="{{ route('edit-User') }}" method="POST" >
          @csrf
          <input type="hidden" name="id_user" id="id_user">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Modifier Utilisateur</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="name">Nom</label>
              <input
                required
                type="text"
                class="form-control dt-full-name"
                id="name"
                placeholder="John Doe"
                name="name"
                aria-label="John Doe"
                aria-describedby="name2"
              />
            </div>
            <div class="form-group">
              <label class="form-label" for="prenom">Prénom</label>
              <input
                required
                type="text"
                id="prenom"
                class="form-control dt-uname"
                placeholder="Web Developer"
                aria-label="jdoe1"
                aria-describedby="prenom2"
                name="prenom"
              />
            </div>
            <div class="form-group">
              <label class="form-label" for="email">Email</label>
              <input
                type="text"
                required
                id="email"
                class="form-control dt-email"
                placeholder="john.doe@example.com"
                aria-label="john.doe@example.com"
                aria-describedby="email2"
                name="email"
              />
              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            {{-- <div class="form-group">
              <label class="form-label" for="basic-icon-default-password">Mot de Passe</label>
              <input
                type="password"
                required
                id="basic-icon-default-password"
                class="form-control dt-password"
                placeholder="**********"
                aria-label="**********"
                aria-describedby="basic-icon-default-email2"
                name="password"
              />
            </div> --}}
            <div class="form-group">
              <label class="form-label" for="role">Rôle</label>
              <select id="role" class="form-control" name="role" required>
                <option value="admin">Admin</option>
                <option value="Editeur">Editeur</option>
              </select>
            </div>
            <div class="form-group mb-2">
              <label class="form-label" for="phone">Numéro Téléphone</label>
              <input
              type="text"
              required
              class="form-control dt-full-name"
              id="phone"
              placeholder="062222222222"
              name="phone"
              aria-label="Téléphone"
              aria-describedby="basic-icon-default-fullname2"
            />
            </div>
            <button type="submit" class="btn btn-primary mr-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- list section end -->
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection


@section('page-script')
  {{-- Page js files --}}

  <script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script>

  <script type="text/javascript">
  function editFunc(input){
    // $('#modals-slide-edit').modal('show');
    var row = input.parentNode.parentNode.parentNode;
    var table = $('.user-list-table').DataTable();
    var rowData = table.row(row).data();
    // console.log(rowData)
    $('#id_user').val(rowData.id);
    $('#name').val(rowData.name);
    $('#prenom').val(rowData.prenom);
    $('#email').val(rowData.email);
    $('#role').val(rowData.role);
    $('#phone').val(rowData.phone);
    }

    function deleteFunc(id){
      Swal.fire({
        title: 'Vous êtes sûr?',
        text: "Que vous voulez supprimer cet utilisateur!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, Supprimer!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
          console.log(id)
          $.ajax({
              type:"POST",
              url: "{{ route('delete-User')}}",
              data: { "_token": "{{ csrf_token() }}",id: id },
              dataType: 'json',
              success: function(res){
                $('.user-list-table').dataTable().fnDraw();
                if(res=='Success'){
                  // oTable.fnDraw(false);
                  Swal.fire({
                    icon: 'success',
                    title: 'Supprimé!',
                    text: 'Votre utilisateur est bien supprimé.',
                    customClass: {
                      confirmButton: 'btn btn-success'
                    }
          });
                }
             
              }
              });
         
        }
      });
    }
  
  </script>
@endsection
