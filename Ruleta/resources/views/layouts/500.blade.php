@extends('layouts.admin')
@section('contenido')
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <div class="row flex-center p-5">
        <div class="col-12 col-xl-10 col-xxl-8">
            <div class="row justify-content-center g-5">
                <div class="col-12 col-lg-6 text-center order-lg-1"><img class="img-fluid w-lg-100 d-light-none"
                        src="../../assets/img/spot-illustrations/500-illustration.png" alt="" width="400" /><img
                        class="img-fluid w-md-50 w-lg-100 d-dark-none"
                        src="https://sofiaalpaso.com/static/media/error-img.f69c9617.svg" alt="" width="540" />
                </div>
                <div class="col-12 col-lg-6 text-center text-lg-start"><img class="img-fluid mb-6 w-50 w-lg-75 d-dark-none"
                        src="../../assets/img/spot-illustrations/500.png" alt="" /><img
                        class="img-fluid mb-6 w-50 w-lg-75 d-light-none"
                        src="../../assets/img/spot-illustrations/dark_500.png" alt="" />
                    <h2 class="text-800 fw-bolder mb-3">Error Desconocido!</h2>
                    <p class="text-900 mb-5"> {{ $laDatosView['Error'] }} </p><a
                        class="btn btn-danger"  href="localhost:8000">VOLVER A LA HOME</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
@endsection
