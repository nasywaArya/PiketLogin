<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Form Login</title>
  @vite('resources/css/app.css') 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-['Poppins']">
  <div class="flex justify-center items-center h-screen bg-[#ABD1C6]">
    <div class="w-95 p-8 shadow-lg bg-white rounded-[10px]">
      <h1 class="text-3xl block text-center font-bold text-[#004643]">Piket App</h1>
      <p class="text-center block text-[#078080] font-medium">Login To Your Account</p>

      <!-- FORM LOGIN -->
      <form action="{{ route('login.proses') }}" method="POST">
        @csrf
        <div class="mt-5">
          <label for="email" class="block text-base mb-1">Email</label>
          <input type="email" name="email" placeholder="Enter your email" class="border w-full border-[#D9D9D9] text-base px-2 py-1 font-medium rounded-xl focus:outline-none focus:ring-0 focus:border-[#0D3130] placeholder-[#0D3130]">

          <label for="password" class="block text-base mb-1 mt-4">Password</label>
          <input type="password" name="password" placeholder="Enter your password" class="border w-full border-[#D9D9D9] text-base px-2 py-1 font-medium rounded-xl focus:outline-none focus:ring-0 focus:border-[#0D3130] placeholder-[#0D3130]">

          <div class="mt-4">
            <button type="submit" class="border-1 border-[#F9BC60] bg-[#F9BC60] text-[#0D3130] py-1 w-full rounded-xl hover:bg-transparent hover:bg-[#F9BC60] font-semibold mb-2">
              Login
            </button>
          </div>
        </div>
      </form>
      @error('email')
    <div class="text-red-500 text-sm mt-1">
        {{ $message }}
    </div>
@enderror 
@error('password')
    <div class="text-red-500 text-sm mt-1">
        {{ $message }}
    </div>
@enderror
    </div>
  </div>
</body>
</html>
