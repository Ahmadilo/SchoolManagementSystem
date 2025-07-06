<!DOCTYPE html>
<html>
<head>
    <title>Create Person</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Create Person</h1>

    @if ($errors->any())
        <div style="color: red;">
            <strong>There were some problems with your input:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('person.update', ['id' => 2]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>First Name:</label><br>
        <input type="text" name="first_name" value="{{ old('first_name') }}" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" value="{{ old('last_name') }}" required><br><br>

        <label>Date of Birth:</label><br>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required><br><br>

        <label>Gender:</label><br>
        <select name="gender" required>
            <option value="">--Select--</option>
            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            <option value="unKnown" {{ old('gender') == 'unKnown' ? 'selected' : '' }}>Unknown</option>
        </select><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}"><br><br>

        <label>Address:</label><br>
        <input type="text" name="address" value="{{ old('address') }}"><br><br>

        <label>Photo (optional):</label><br>
        <input type="file" name="photo"><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
