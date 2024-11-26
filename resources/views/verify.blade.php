<form action="{{ route('verify') }}" method="POST">
    @csrf
    <label for="verification_code">Nhập mã xác thực:</label>
    <input type="text" id="verification_code" name="verification_code" required>
    <button type="submit">Xác thực</button>

    @if ($errors->has('verification_code'))
        <div>{{ $errors->first('verification_code') }}</div>
    @endif
</form>
