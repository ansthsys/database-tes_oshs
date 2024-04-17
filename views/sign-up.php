<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Technical Test Esbi Batara Niaga Indonesia - Database Tes OSHS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./public/styles/style.css">
</head>

<body>
  <main class="">
    <section class="row g-0 vh-100 overflow-hidden">
      <div class="col-12 col-lg-6 d-none d-lg-flex align-items-center justify-content-center h-100">
        <div class="mt-5">
          <img src="./public/assets/banner-historia2-min.png" alt="banner" class="" height="600">
        </div>
      </div>

      <div class="col-12 col-lg-6 d-flex flex-column align-items-center justify-content-center h-100">
        <h1 class="header-title mb-5">Sign Up</h1>

        <form id="form-sign-up" action="./user/signUp" method="post" class="row align-items-center justify-content-center w-100">
          <div class="col-8 mb-4">
            <input name="name" class="form-control form-control-lg rounded-pill bg-secondary" style="--bs-bg-opacity: .05;" type="text" placeholder="Name" aria-label="Name" autocomplete="off" required>
          </div>

          <div class="col-8 mb-4">
            <input name="email" class="form-control form-control-lg rounded-pill bg-secondary" style="--bs-bg-opacity: .05;" type="email" placeholder="Email" aria-label="Email" aria-autocomplete="off" required>
          </div>

          <div class="col-8 mb-4">
            <input name="password" class="form-control form-control-lg rounded-pill bg-secondary" style="--bs-bg-opacity: .05;" type="password" placeholder="Password" aria-label="Password" aria-autocomplete="off" required>
          </div>

          <div class="col-8 mb-4 d-flex gap-2 align-items-center justify-content-start">
            <input id="tos" type="checkbox">
            <label for="tos">I agree all statement in <a href="#" class="text-decoration-none fw-medium" style="color: rgb(254, 168, 183);">Terms & Conditions</a></label>
          </div>

          <div class="col-8 mb-4 d-flex flex-column flex-md-row flex-lg-column flex-xl-row align-items-center justify-content-start gap-4">
            <button id="submit" type="submit" role="button" class="btn btn-lg rounded-pill btn-custom fw-semibold px-5 py-1" disabled="true">SIGN UP</button>
            <span>Already have account? <a href="#" class="text-decoration-none fw-medium" style="color: rgb(254, 168, 183);">Login</a></span>
          </div>
        </form>
      </div>
    </section>

    <section class="min-vh-100 py-5" style="background-color: pink">
      <div class="h-100 container">
        <h1 class="header-title mb-4" style="color: white;">List Users</h1>

        <div class="table-responsive border p-1 bg-white rounded-3">
          <table class="table">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($data->users as $idx => $item) { ?>
                <?php $status = boolval($item["status"]) ? true : false ?>
                <tr>
                  <th scope="row" class="text-center"><?= $idx + 1 ?></th>
                  <td class="text-center"><?= $item["name"] ?></td>
                  <td class="text-center"><?= $item["email"] ?></td>
                  <td class="text-center">
                    <span class="badge text-bg-<?= $status ? 'primary' : 'secondary' ?>">
                      <?= $status ? 'Active' : 'Inactive' ?>
                    </span>
                  </td>
                  <td class="text-center">
                    <div class="d-flex flex-row align-items-center justify-content-center gap-3">
                      <button id="btnEdit" type="button" role="button" class="btn btn-custom rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editUser" data-id="<?= $item["id"] ?>" data-name="<?= $item["name"] ?>" data-email="<?= $item["email"] ?>" data-status="<?= $item["status"] ?>">
                        <i class="bi bi-pencil-fill me-1 d-none d-lg-inline"></i>Edit
                      </button>

                      <button id="btnDelete" type="button" role="button" class="btn btn-outline-danger rounded-pill" data-id=<?= $item["id"] ?>>
                        <i class="bi bi-trash-fill me-1 d-none d-lg-inline"></i> Delete
                      </button>
                    </div>
                  </td>
                </tr>
              <?php } ?>

              <?php if (count($data->users) < 1) { ?>
                <tr>
                  <td colspan="5" class="text-center">No data available</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

        </div>
      </div>
    </section>

    <!-- Modal Edit -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="Edit User" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form action="./user/edit" method="post">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="idEdit" name="id" value="">

              <div class="mb-3 row">
                <label for="nameEdit" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control rounded-pill bg-secondary" style="--bs-bg-opacity: .05;" id="nameEdit" name="name" value="">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="emailEdit" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" readonly class="form-control rounded-pill bg-secondary" style="--bs-bg-opacity: .05;" id="emailEdit" name=email value="">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="statusEdit" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select name="status" id="statusEdit" class="form-select rounded-pill bg-secondary" style="--bs-bg-opacity: .05;">
                    <option value="" disabled>Select status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" role="button" class="btn btn-custom rounded-pill">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Form Delete -->
    <form id="formDelete" action="./user/delete" method="post" class="d-none">
      <input type="hidden" id="idDelete" name="id" value="">
    </form>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    // prevent button sign up before check tos
    $('#tos').on('change', function() {
      if ($(this).is(':checked')) {
        $('#form-sign-up #submit').prop('disabled', false);
      } else {
        $('#form-sign-up #submit').prop('disabled', true);
      }
    });

    // Modal Edit User Passing Data
    $(document).on("click", "#btnEdit", function() {
      const idEdit = $(this).data('id');
      const nameEdit = $(this).data('name');
      const emailEdit = $(this).data('email');
      const statusEdit = $(this).data('status');

      $(".modal-body #idEdit").val(idEdit);
      $(".modal-body #nameEdit").val(nameEdit);
      $(".modal-body #emailEdit").val(emailEdit);
      $(".modal-body #statusEdit").val(statusEdit);
    });

    // Confirmation delete user
    $(document).on("click", "#btnDelete", function(e) {
      const idDelete = e.target.getAttribute("data-id");

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          actions: "gap-3",
          confirmButton: "btn btn-outline-danger rounded-pill",
          cancelButton: "btn btn-custom rounded-pill"
        },
        buttonsStyling: false
      });

      swalWithBootstrapButtons.fire({
          title: "Delete User",
          text: "Are you sure delete this user?",
          icon: "warning",
          inputValue: "",
          showCancelButton: true,
          confirmButtonText: "Delete",
          cancelButtonText: "Cancel",
          reverseButtons: true
        })
        .then((result) => {
          if (result.isConfirmed) {
            $('#formDelete #idDelete').val(idDelete);
            $('#formDelete').submit();
          }
        })

    });
  </script>
</body>

</html>