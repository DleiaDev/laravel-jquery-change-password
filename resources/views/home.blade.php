@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center">Change Password</div>

          <div class="card-body">

            <!-- Change password form -->
            <form id="form">

              <!-- Current password -->
              <div class="form-group">
                <label for="old_password">Current password</label>
                <input
                id="old_password"
                class="form-control"
                type="password"
                name="old_password">
                <div class="error" id="old_password-error"></div>
              </div>

              <!-- New password-->
              <div class="form-group">
                <label for="new_password">New password</label>
                <input
                  id="new_password"
                  class="form-control"
                  type="password"
                  name="new_password">
                <div class="error" id="new_password-error"></div>
              </div>

              <!-- Repeat new password-->
              <div class="form-group">
                <label for="new_password_repeat">Repeat new password</label>
                <input
                  id="new_password_repeat"
                  class="form-control"
                  type="password"
                  name="new_password_repeat">
                <div class="error" id="new_password_repeat-error"></div>
              </div>

              <!-- Submit-->
              <div class="form-group">
                <button
                  id="submit-button"
                  class="btn btn-primary"
                  type="submit">
                    Change Password
                </button>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
