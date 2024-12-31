<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login</title>
</head>
<body class="bg-gray-800">

<main class="mx-auto flex min-h-screen w-full items-center justify-center">
  <section class="w-[30rem] flex flex-col items-center space-y-10 bg-gray-900 text-white rounded-lg shadow-lg p-8">
    <!-- Login Title -->
    <div class="text-center text-4xl font-medium">Log In</div>

    <form action="{{ route('login.post') }}" method="POST" class="w-full space-y-6">
      @csrf

      <!-- Username or Email Input -->
      <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-gray-500">
        <input
          type="text"
          placeholder="Username"
          class="w-full border-none bg-transparent outline-none placeholder:text-gray-400 focus:outline-none text-white"
          id="username" name="username"
        />
      </div>

      <!-- Password Input -->
      <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-gray-500">
        <input
          type="password"
          placeholder="Password"
          class="w-full border-none bg-transparent outline-none placeholder:text-gray-400 focus:outline-none text-white"
          id="password" name="password"
        />
      </div>

      <!-- Login Button -->
      <button type="submit"
        class="w-full transform rounded-sm bg-gray-600 py-2 font-bold text-white duration-300 hover:bg-gray-500"
      >
        LOG IN
      </button>

      <!-- Error Message -->
      @if ($errors->any())
        <div class="text-red-600 text-center mt-4">
            {{ $errors->first() }}
        </div>
      @endif
    </form>

  </section>
</main>

</body>
</html>
