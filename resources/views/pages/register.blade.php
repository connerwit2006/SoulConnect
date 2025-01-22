<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
    <form action="{{ route('storeUser') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" minlength="16" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div>
            @if ($errors->has('password'))
            <span>{{ $errors->first('password') }}</span>
            @endif
        </div>
            <label for="nickname">Nickname:</label>
            <input type="text" id="nickname" name="nickname" required>
        </div>
        <div>
            <label for="oneliner">One-liner:</label>
            <input type="text" id="oneliner" name="one_liner" required>
        </div>
        <div>
            <label for="appreciate">Appreciate:</label>
            <input type="text" id="appreciate" name="appreciate" required>
        </div>
        <div>
            <label for="lookingfor">Looking for:</label>
            <input type="text" id="lookingfor" name="looking_for" required>
        </div>
        <div>
            <label for="facecard">Facecard:</label>
            <input type="file" id="facecard" name="face_card">
        </div>
        <div>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div>
            <label for="lookingforgender">Looking for Gender:</label>
            <select id="lookingforgender" name="looking_for_gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
        </div>
        <div>
            <label for="postcode">Postcode:</label>
            <input type="text" id="postcode" name="postcode" required>
        </div>
        <div>
            <label for="relationshiptype">Relationship Type:</label>
            <select id="relationshiptype" name="relationship_type" required>
                <option selected disabled>Kies een relatietype</option>
                <option value="friendly">Vriendelijk</option>
                <option value="romantic">Romantisch</option>
            </select>
        </div>
        <div>
            <label>
                <input type="checkbox" name="terms" value="1" required> Agree to terms
            </label>

        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</body>

</html>