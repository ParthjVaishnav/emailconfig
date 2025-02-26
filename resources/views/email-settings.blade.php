<div class="container">
    <h2>Email Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Email Configuration Form -->
    <form action="{{ route('email-settings.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Mailer</label>
            <input type="text" name="mailer" value="{{ $settings->mailer ?? 'smtp' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Host</label>
            <input type="text" name="host" value="{{ $settings->host ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Port</label>
            <input type="text" name="port" value="{{ $settings->port ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" value="{{ $settings->username ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" value="{{ $settings->password ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Encryption</label>
            <input type="text" name="encryption" value="{{ $settings->encryption ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>From Address</label>
            <input type="email" name="from_address" value="{{ $settings->from_address ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>From Name</label>
            <input type="text" name="from_name" value="{{ $settings->from_name ?? '' }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Settings</button>
    </form>

    <hr>

    <!-- Test Mail Sending Form -->
    <h3>Send Test Email</h3>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- Test Email Form -->
<form action="{{ route('send-test-email') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Enter Email to Send Test Mail</label>
        <input type="email" name="to_email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Send Test Email</button>
</form>
