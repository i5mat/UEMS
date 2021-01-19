@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">

                        <div class="card-header">Profile Info</div>

                        <div class="card-body">
                            <form action="/profile/{{ $user->id }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Name</label>
                                        <input name="name" type="text" class="form-control" id="validationCustom01" placeholder="Name" value="{{ $user->name }}" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">Email/Username</label>
                                        <input name="email" type="email" class="form-control" id="validationCustom02" placeholder="Email" value="{{ $user->email }}" required disabled>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustomUsername">Matric No.</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required value="{{ $user->matric_no }}" disabled>
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="validationCustomUsername">Faculty</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required value="@if(substr($user->matric_no, 1, -7) == 03) FTMK @else UTeM @endif" disabled>
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustomUsername">Date Created</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required value="{{ date('d-m-Y H:i A', strtotime($user->created_at)) }}" disabled>
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom05">Points</label>
                                        <input type="text" class="form-control" id="validationCustom05" placeholder="Point" value="{{ $user->point }}" required disabled>
                                        <div class="invalid-feedback">
                                            Please provide a valid point.
                                        </div>
                                    </div>
                                </div>

                                <label class="form-check-label">
                                    <a href="https://uems.test/password/reset">If you want to change password, click here!</a>
                                </label>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                        <label class="form-check-label" for="invalidCheck">
                                            Agree that the info given is correct.
                                        </label>
                                        <div class="invalid-feedback">
                                            You must agree before submitting.
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>

                            <script type="application/javascript">
                                // Example starter JavaScript for disabling form submissions if there are invalid fields
                                (function() {
                                    'use strict';
                                    window.addEventListener('load', function() {
                                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                        var forms = document.getElementsByClassName('needs-validation');
                                        // Loop over them and prevent submission
                                        var validation = Array.prototype.filter.call(forms, function(form) {
                                            form.addEventListener('submit', function(event) {
                                                if (form.checkValidity() === false) {
                                                    event.preventDefault();
                                                    event.stopPropagation();
                                                }
                                                form.classList.add('was-validated');
                                            }, false);
                                        });
                                    }, false);
                                })();
                            </script>

                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
