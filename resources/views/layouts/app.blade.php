<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Expenses Tracker')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style type="text/tailwindcss">
        .url {
            @apply text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200 font-semibold;
        }

        .url-cancel {
            @apply px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 inline-block text-center;
        }

        .row-header {
            @apply px-6 py-3 text-xs font-medium text-gray-700 uppercase tracking-wide;
        }

        .row-details {
            @apply px-6 py-4 whitespace-nowrap;
        }

        .btn {
            @apply px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400;
        }

        .label {
            @apply block text-sm font-medium text-gray-700 mb-1;
        }
        .input {
            @apply w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-4 space-y-3">

    <nav class="bg-blue-50 shadow rounded-xl">
        <div class="container mx-auto px-4 py-5 flex justify-between items-center">
            <h1> Hi, {{ $globalUser->name ?? 'Guest' }} ! Track Your Money Expensed</h1>
            
            <div class="space-x-4">
                @if(session('user_id'))
                    <a href="{{ route('user.expenses.index', ['user' => session('user_id')]) }}" class="url hover:bg-gray-200">Expenses</a>
                    <a href="{{ route('expenses.report', ['type' => 'monthly']) }}" class="url hover:bg-gray-200">Report</a>
                    <a href="{{ route('register.show', ['register' => session('user_id')]) }}" class="url hover:text-blue-500">Profile</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="url hover:text-red-500">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login.index') }}" class="text-gray-700 hover:text-blue-500">Login</a>
                    <a href="{{ route('register.index') }}" class="text-gray-700 hover:text-blue-500">Register</a>
                @endif
            </div>
        </div>
    </nav>


     <div class="w-full h-full bg-white rounded-xl shadow-lg p-8 max-w-full mx-auto">
        <div class="space-y-4 h-full overflow-auto">
            @yield('content')
        </div>
    </div>

</body>
</html>
