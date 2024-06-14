<?php
// Route or controller method to handle user creation


// UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WalletType;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function createUser(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            // Add more validation rules as needed
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        // Set password, generate token, etc.

        // Save the user to the database
        $user->save();

        // Create wallet types for the user
        $mainAccount = new WalletType();
        $mainAccount->name = 'Main Account';
        $mainAccount->minimum_balance = 0.00;
        $mainAccount->monthly_interest_rate = 0.00;
        $mainAccount->user_id = $user->id;
        $mainAccount->save();

        $escrowAccount = new WalletType();
        $escrowAccount->name = 'Escrow Account';
        $escrowAccount->minimum_balance = 0.00;
        $escrowAccount->monthly_interest_rate = 0.00;
        $escrowAccount->user_id = $user->id;
        $escrowAccount->save();

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'main_account' => $mainAccount,
            'escrow_account' => $escrowAccount,
        ], 201);
    /**
     * Display a listing of the resource.
     */
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
