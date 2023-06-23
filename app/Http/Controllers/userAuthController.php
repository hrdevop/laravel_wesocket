<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class userAuthController extends Controller
{
    private $dummyUsers;

    public function __construct()
    {
        // Create an array of dummy users
        $this->dummyUsers = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('12345'),
                'id' => 'dd967a33-8f23-4cb2-b4ee-702afe119435',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => bcrypt('12345'),
                'id' => '4bad4d13-c59f-47fc-9bc2-4c4eb2b9a2e8',
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'password' => bcrypt('12345'),
                'id' => '38d60134-7c9a-46ba-b157-05b524844353',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily@example.com',
                'password' => bcrypt('12345'),
                'id' => 'cc74f23e-f3de-48f2-8e8e-ebdc137feab6',
            ],
            [
                'name' => 'Alex Clark',
                'email' => 'alex@example.com',
                'password' => bcrypt('12345'),
                'id' => '9bc21944-9885-4ea6-900b-28f2fea53086',
            ],
            [
                'name' => 'Sara Wilson',
                'email' => 'sara@example.com',
                'password' => bcrypt('12345'),
                'id' => '163356a2-9d12-49d2-a3c6-2b6ad40e127b',
            ],
            [
                'name' => 'Tom Johnson',
                'email' => 'tom@example.com',
                'password' => bcrypt('12345'),
                'id' => 'cf4c27e6-34e1-4b52-b571-dff29d365c29',
            ],
            [
                'name' => 'Olivia Davis',
                'email' => 'olivia@example.com',
                'password' => bcrypt('12345'),
                'id' => '84519514-701b-4f0c-bfb8-b80c6a83162e',
            ],
            [
                'name' => 'Max Brown',
                'email' => 'max@example.com',
                'password' => bcrypt('12345'),
                'id' => '2e2143cf-3b63-4cc5-996e-4a420b7d7ce9',
            ],
            [
                'name' => 'Lily Smith',
                'email' => 'lily@example.com',
                'password' => bcrypt('12345'),
                'id' => 'd9c012b1-2e36-4eec-9125-81b61ad6466c',
            ],
        ];
    }

    public function getUserName($userId)
    {
        foreach ($this->dummyUsers as $user) {
            if ($user['id'] === $userId) {
                // Authentication successful
                return ['id' => $userId, 'name' => $user['name']];
            }
        }

        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the provided credentials match any of the dummy users
        foreach ($this->dummyUsers as $user) {
            if ($request->email === $user['email'] && password_verify($request->password, $user['password'])) {
                // Authentication successful
                return response()->json(['message' => 'Login successful', 'user' => $user], 200);
            }
        }

        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }


}
