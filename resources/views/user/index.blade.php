@extends('layouts.app')

@section('content')
{{-- add and edit user modal start --}}
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="edit_user_form" >
                @csrf
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="fname">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Complete Name" required>
                        </div>
                        <div class="col-lg">
                            <label for="lname">Surename</label>
                            <input type="text" name="surename" id="surename" class="form-control" placeholder="Complete Surename" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="email">Nick</label>
                        <input type="text" name="nick" id="nick" class="form-control" placeholder="Enter Nickname" required>
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_user_btn" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add and edit user modal end --}}
<div class="container">
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                    <h3 class="text-light">Administrar Usuarios</h3>
                </div>
                <div class="card-body" id="show_all_users">
                    <h1 class="text-center text-secondary my-5">Loading...</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
</script>

@endsection