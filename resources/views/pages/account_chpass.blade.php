@extends('pages.account_main')

@section('styles')

@endsection

@section('layouts')
<div class="container-fluid">
    <div class="flex-fill">
        <p class="text-black-50">Change Password </p>
        <hr>
    </div>
    <div class="flex-fill">
        <form action="{{route('changePw')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" id="password" name="password" class="form-control"
                    placeholder="Enter your new password" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                <input type="password" id="cfpassword" name="cfpassword" class="form-control"
                    placeholder="Confirm your new password" required>
            </div>
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" id="currentPassword" name="currentPassword" class="form-control"
                    placeholder="Enter your current password" required>
            </div>
            <button type="submit" class="btn btn-success" style="align-content: flex-end">Save Changes</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
@include('utility.sweetAlert2')
@endsection
