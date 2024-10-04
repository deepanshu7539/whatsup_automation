<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Contacts CSV</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
        @if(session('success'))
            <div class="bg-green-500 text-white text-center p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-xl font-semibold text-center mb-6">Upload Contacts CSV</h1>

        <form action="{{ route('sendMessages') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="contacts_file" class="block text-gray-700 mb-2">Upload CSV:</label>
                <input type="file" name="contacts_file" id="contacts_file" required class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 rounded-lg hover:bg-blue-600 transition duration-200">Send WhatsApp Messages</button>
        </form>
    </div>

</body>
</html>
