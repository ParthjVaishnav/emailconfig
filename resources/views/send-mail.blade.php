


<div class="container">
    <h2>Send Email</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('send-mail') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Customer Email</label>
            <input type="email" name="customer_email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Email</button>
    </form>
</div>

