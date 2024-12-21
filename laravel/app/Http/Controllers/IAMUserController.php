<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Aws\Iam\IamClient;
use Aws\Exception\AwsException;

class IAMUserController extends Controller
{
    public function listUsers()
    {
        $iamClient = new IamClient([
            'version' => 'latest',
            'region' => 'ap-southeast-2',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            $result = $iamClient->listUsers();
            $users = $result['Users'];

            return view('awsiamuserlist', compact('users'));
        } catch (Aws\Exception\AwsException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function storeUser(Request $request) {
        $request->validate([
            'username' => 'required|string|max:255',
            'policy' => 'required|string',
        ]);
        
        $username = $request->input('username');
        $policy = $request->input('policy');
        
        // Check if the IAM user already exists
        if ($this->userExists($username)) {
            return back()->with('error', 'IAM user already exists.');
        }

        // Provision the user if it does not exist
        $result = $this->provisionIAMUser($username, $policy);
        
        if ($result) {
            // Redirect to a new route with the user's details
            return redirect()->route('awsiamuser.details', ['username' => $username, 'policy' => $policy])
                ->with('success', 'IAM user created successfully.');
        } else {
            return back()->with('error', 'Failed to IAM user.');
        }
    }

    public function showUserDetails(Request $request) {
        $username = $request->query('username');
        $policy = $request->query('policy');
        
        return view('awsiamuserdetail', compact('username', 'policy'));
    }

    private function userExists($username) {
        $iamClient = new IamClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            $result = $iamClient->listUsers();
            foreach ($result['Users'] as $user) {
                if ($user['UserName'] === $username) {
                    return true; // User exists
                }
            }
        } catch (AwsException $e) {
            // Handle error
            return false;
        }

        return false; // User does not exist
    }

    private function provisionIAMUser($username, $policy) {
        $terraformserverip = env('TERRAFORM_SERVER_IP');
        $terraformserverport = env('FLASK_EXPOSE_PORT');
        $response = Http::timeout(180)->post("http://{$terraformserverip}:{$terraformserverport}/provision", [
            'policy' => $policy,
            'username' => $username,
        ]);
    
        return $response->successful();
    }
}
