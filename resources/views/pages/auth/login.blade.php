@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<main class="main-content mt-0">
	<div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
		style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
		<span class="mask bg-gradient-dark opacity-6"></span>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-5 text-center mx-auto">
					<h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
					<p class="text-lead text-white">Silahkan masuk...</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
			<div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
				<div class="card z-index-0">
					<div class="card-header text-center pt-4">
						<h5>Login</h5>
					</div>
					
					<div class="card-body">
						<div class="mb-3">
							<input type="email" class="form-control" id="email" placeholder="Masukkan Email" autocomplete="off">
						</div>
						<div class="mb-3">
							<input type="password" class="form-control" id="password" placeholder="Masukkan Password">
						</div>
						<div class="text-center">
							<button type="button" class="btn bg-gradient-dark w-100 my-4 mb-2" onClick="submit()">Login</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

@push('scripts')
<script>
function submit() {
    let formData = {
        email: $("#email").val(),
        password: $("#password").val()
    };

    $.ajax({
        type: "POST",
        url: "/login",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(response) {
            if(response.status === 'success') {
                Swal.fire({
                    title: 'Berhasil',
                    text: response.message,
                    icon: 'success',
                    allowOutsideClick: false,
                    showConfirmButton: false, 
                    timer: 2000, 
                    timerProgressBar: true,
                    willClose: () => {
                        window.location.href = "/dashboard";
                    }
                });
            } else {
                if (response.errors) {
                    let errorMsg = '';
                    for (let field in response.errors) {
                        if (Array.isArray(response.errors[field])) {
                            errorMsg += response.errors[field][0] + '<br>';
                        } else {
                            errorMsg += response.errors[field] + '<br>';
                        }
                    }
                    Swal.fire('Gagal', errorMsg, 'error');
                } else {
                    Swal.fire('Gagal', response.message, 'error');
                }
            }
        },
        error: function(xhr, status, error) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMsg = '';
                for (let field in errors) {
                    if (Array.isArray(errors[field])) {
                        errorMsg += errors[field][0] + '<br>';
                    } else {
                        errorMsg += errors[field] + '<br>';
                    }
                }
                Swal.fire('Validasi Gagal', errorMsg, 'error');
            } else {
                Swal.fire('Error', 'Terjadi kesalahan saat login.', 'error');
            }
        }
    });
}
</script>
@endpush