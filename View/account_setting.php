<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-10">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Account Settings</h2>

            <form>
                <!-- Personal Information Section -->
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Full Name</label>
                            <input type="text" class="form-control mt-1 block w-full" placeholder="Your full name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Email Address</label>
                            <input type="email" class="form-control mt-1 block w-full" placeholder="your@example.com">
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Change Password</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Current Password</label>
                            <input type="password" class="form-control mt-1 block w-full" placeholder="Current password">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">New Password</label>
                            <input type="password" class="form-control mt-1 block w-full" placeholder="New password">
                        </div>
                    </div>
                </div>

                <!-- Contact Preferences Section -->
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Contact Preferences</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">Receive Newsletters</span>
                            </label>
                        </div>
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">Receive Promotions</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary w-full md:w-auto">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
