/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function () {
  'use strict';

  var dtUserTable = $('.user-list-table'),
    newUserSidebar = $('.new-user-modal'),
    newUserForm = $('.add-new-user'),
    statusObj = {
      1: { title: 'Pending', class: 'badge-light-warning' },
      2: { title: 'Active', class: 'badge-light-success' },
      3: { title: 'Inactive', class: 'badge-light-secondary' }
    };

  var assetPath = '../../../app-assets/',
    userView = 'app-user-view.html',
    userEdit = 'app-user-edit.html';
  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    userView = assetPath + 'app/user/view';
    userEdit = assetPath + 'app/user/edit';
  }

  // Users List datatable
  if (dtUserTable.length) {
    dtUserTable.DataTable({
      processing:true,
      // serverSide: true,
      responsive: true,
        ajax: {
          url: `http://127.0.0.1:8000/admin/listUsers`,
          type: "get"
      }, 
      // ajax: "{{ url('listUsers') }}",
      // ajax: assetPath + 'data/user-list.json', // JSON file to add data
      columns: [
        // columns according to JSON
        // { data: 'responsive_id' },
        { data: 'name' },
        { data: 'prenom' },
        { data: 'role' },
        { data: 'email' },
        { data: 'phone' },
        
        { data: '' }
      ],
      columnDefs: [
        // {
        //   // For Responsive
        //   className: 'control',
        //   orderable: false,
        //   responsivePriority: 2,
        //   targets: 0
        // },
        {
          // User full name and username
          targets: 0,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['name'],
              $uname = full['prenom'];
              // $image = full['avatar'];
            // if ($image) {
            //   // For Avatar image
            //   var $output =
            //     '<img src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" height="32" width="32">';
            // } else {
            //   // For Avatar badge
            //   var stateNum = Math.floor(Math.random() * 6) + 1;
            //   var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
            //   var $state = states[stateNum],
            //     $name = full['full_name'],
            //     $initials = $name.match(/\b\w/g) || [];
            //   $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
            //   $output = '<span class="avatar-content">' + $initials + '</span>';
            // }
            // var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : '';
            // Creates full output for row
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              
              '<div class="d-flex flex-column">' +
              '<a href="' +
              userView +
              '" class="user_name text-truncate"><span class="font-weight-bold">' +
              $name +
              '</span></a>' +
              '<small class="emp_post text-muted">@' +
              $uname +
              '</small>' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },
        {
          // User Role
          targets: 2,
          render: function (data, type, full, meta) {
            var $role = full['role'];
            var roleBadgeObj = {
              Subscriber: feather.icons['user'].toSvg({ class: 'font-medium-3 text-primary mr-50' }),
              Author: feather.icons['settings'].toSvg({ class: 'font-medium-3 text-warning mr-50' }),
              Maintainer: feather.icons['database'].toSvg({ class: 'font-medium-3 text-success mr-50' }),
              Editeur: feather.icons['edit-2'].toSvg({ class: 'font-medium-3 text-info mr-50' }),
              admin: feather.icons['slack'].toSvg({ class: 'font-medium-3 text-danger mr-50' })
            };
            return "<span class='text-truncate align-middle'>" + roleBadgeObj[$role] + $role + '</span>';
          }
        },
        // {
        //   // User Status
        //   targets: 5,
        //   render: function (data, type, full, meta) {
        //     var $status = full['status'];

        //     return (
        //       '<span class="badge badge-pill ' +
        //       statusObj[$status].class +
        //       '" text-capitalized>' +
        //       statusObj[$status].title +
        //       '</span>'
        //     );
        //   }
        // },
        {
          // Actions
          targets: -1,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full,row, meta) {
            // console.log(this)
            return (
              '<div class="btn-group">' +
              '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-right">' +
              // '<a href="' +
              // userView +
              // '" class="dropdown-item">' +
              // feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) +
              // 'Details</a>' +
              // data-toggle="modal" data-target="#modals-slide-edit"
              '<button data-toggle="modal" data-target="#modals-slide-edit"  onClick="editFunc(this)' +
              // userEdit +
              '" class="dropdown-item">' +
              feather.icons['archive'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Edit</button>' +
              '<button id="confirm-text" onClick="deleteFunc('+full['id'] +')" class="dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Delete</button></div>' +
              // '</div>' +
              '</div>'
            );
          }
        }
      ],
      order: [[2, 'desc']],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
        '<"col-lg-12 col-xl-6" l>' +
        '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row mb-1"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search..'
      },
      // Buttons with Dropdown
      buttons: [
        {
          text: 'Ajouter Utilisateur',
          className: 'add-new btn btn-primary mt-50',
          attr: {
            'data-toggle': 'modal',
            'data-target': '#modals-slide-in'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['name'];
            }
          }),
          type: 'column',
          renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            tableClass: 'table',
            columnDefs: [
              {
                targets: 0,
                visible: false
              },
              {
                targets: 1,
                visible: false
              }
            ]
          })
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      initComplete: function () {
        // Adding role filter once table initialized
        this.api()
          .columns(2)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="UserRole" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Par rôle </option></select>'
            )
              .appendTo('.user_role')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
        // Adding plan filter once table initialized
        this.api()
          .columns(1)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Par Nom </option></select>'
            )
              .appendTo('.user_plan')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
        // Adding status filter once table initialized
        // this.api()
        //   .columns(1)
        //   .every(function () {
        //     var column = this;
        //     var select = $(
        //       '<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx"><option value=""> Par Prénom </option></select>'
        //     )
        //       .appendTo('.user_status')
        //       .on('change', function () {
        //         var val = $.fn.dataTable.util.escapeRegex($(this).val());
        //         column.search(val ? '^' + val + '$' : '', true, false).draw();
        //       });

        //     column
        //       .data()
        //       .unique()
        //       .sort()
        //       .each(function (d, j) {
        //         select.append(
        //           '<option value="' +
        //             statusObj[d].title +
        //             '" class="text-capitalize">' +
        //             statusObj[d].title +
        //             '</option>'
        //         );
        //       });
        //   });
      }
    });
  }

  // Check Validity
  function checkValidity(el) {
    if (el.validate().checkForm()) {
      submitBtn.attr('disabled', false);
    } else {
      submitBtn.attr('disabled', true);
    }
  }
  

  // Form Validation
  if (newUserForm.length) {
    newUserForm.validate({
      errorClass: 'error',
      rules: {
        'name': {
          required: true
        },
        'prenom': {
          required: true
        },
        'email': {
          required: true,
        },
        'role': {
          required: true,
        },
        'phone': {
          required: true,
        },
        'password':{
          required: true,
        }
      }
    });

    // newUserForm.on('submit', function (e) {
    //   var isValid = newUserForm.valid();
    //   e.preventDefault();
    //   if (isValid) {

    //     newUserSidebar.modal('hide');
    //   }
    // });
  }
  var confirmText = $('#confirm-text');

    // confirmText.on('click', function () {
    //   Swal.fire({
    //     title: 'Are you sure?',
    //     text: "You won't be able to revert this!",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonText: 'Yes, delete it!',
    //     customClass: {
    //       confirmButton: 'btn btn-primary',
    //       cancelButton: 'btn btn-outline-danger ml-1'
    //     },
    //     buttonsStyling: false
    //   }).then(function (result) {
    //     if (result.value) {
    //       Swal.fire({
    //         icon: 'success',
    //         title: 'Deleted!',
    //         text: 'Your file has been deleted.',
    //         customClass: {
    //           confirmButton: 'btn btn-success'
    //         }
    //       });
    //     }
    //   });
    // });
  

  // To initialize tooltip with body container
  $('body').tooltip({
    selector: '[data-toggle="tooltip"]',
    container: 'body'
  });
});
