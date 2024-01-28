<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Affiliation;
use App\Models\Catalog;
use App\Models\Comment;
use App\Models\User;
use Exception;
use Hamcrest\Core\IsEqual;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search', '');

        $users = User::with('affiliation');
        $affs = Affiliation::orderBy('name', 'asc')->get();

        if ($search) {
            $users->where(function ($query) use ($search) {
                $query->where('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $users->paginate(10);

        return view('admin.admin_users', compact('users', 'search', 'affs'));
    }


    public function index()
    {
        $users = User::with('affiliation')->paginate(10);
        $affs = Affiliation::orderBy('name', 'asc')->get();
        return view('admin.admin_users', compact('users', 'affs'));
    }

    public function showDashboard()
    {
        // Retrieve the user's full name or username
        $userName = auth()->user()->fullname ?: auth()->user()->username;

        // Clean up the user name (remove extra characters)
        $userName = trim($userName);

        // Query to count distinct authors in the 'authors' JSON column
        $cCounts = Catalog::where('authors', 'like', '%' . $userName . '%')->where('status', 1)->count();

        $comments = Comment::where('users_id', auth()->user()->id)->get();
        $cReviews = $comments->where('rating', '>', 0)->count();
        $cComments = $comments->count();

        return view('pages.accounts', compact('cCounts', 'cReviews', 'cComments'));
    }

    public function show($id)
    {
        // Retrieve a specific user
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        // Fetch the user's details from the database using the provided $id
        $selectUser = User::with('affiliation')->find($id);
        $affs = Affiliation::orderBy('name', 'asc')->get();
        if (!$selectUser) {
            // If the user is not found, returns an error or redirect to an error page
            return redirect()->back()->with('error', 'User not found');
        }

        // Pass the user data to the view for editing
        return view('admin.forms.edit_users', compact('selectUser', 'affs'));
        //return redirect()->back()->compact('selectUser', 'affs');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
        ]);

        if (!($request->input('password') === $request->input('cfpassword'))) {
            return back()->withErrors('error', "Input password does not match.");
        }

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        try {
            $URIpath = explode('0/', $request->input('photo_path'));
            $pathPic = $URIpath[1];
        } catch (Exception) {
            $pathPic = $request->input('photo_path');
        }


        $fn = $request->input('firstname') . " " . $request->input('middlename') . " " . $request->input('lastname');

        // Create the 'name' from 'firstname', 'middlename', and 'lastname'
        // Update the user's profile with the new data
        $user->username = $request->input('username');
        $user->fullname = $fn;
        $user->email = $request->input('email');
        $user->firstname = $request->input('firstname');
        $user->middlename = $request->input('middlename');
        $user->lastname = $request->input('lastname');
        $user->affiliation_id = $request->input('affiliation');
        $user->photo_path = $pathPic;
        if ($request->input('password'))
            $user->password = bcrypt($request->input('password'));
        $user->update();
        // Redirect back to the profile page or a success page
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function verifyIndex()
    {
        $requestsVerify = User::where('verify_status', 0)->paginate(10);
        return view('admin.admin_verifyUsers', compact('requestsVerify'));
    }

    public function requestVerify()
    {

        $user = User::findOrFail(auth()->user()->id);
        $user->verify_status = 0;
        $user->update();

        return redirect()->route('dashboard_profiles')->with('success', 'Your verify request is now being processed.');
    }

    public function getVerify(Request $request)
    {
        $user = User::findOrFail($request->input('id'));


        // SENDING EMAIL
        $senderEmail = "noreply@gmail.com";
        $receiverEmail = $request->input('email');

        $dummySenderEmail = 'noreply@gmail.com';
        $dummySenderName = 'NOMCAARRD E-Library';

        $messageAppend = "Your account verification has been declined";
        $messageAppend2 = "Your account verification has been successfully verified.";

        if ($request->input('status') == 1)
            $messageBody = $messageAppend2;
        else
            $messageBody = $messageAppend;

        $emailContent = "Hi " . $user->username . "! " . $messageBody;

        $mailSent = Mail::raw($emailContent, function ($message) use ($dummySenderEmail, $dummySenderName, $receiverEmail) {
            $message->subject('NOMCAARRD E-Library Email Verfication')
                ->from($dummySenderEmail, $dummySenderName)
                ->to($receiverEmail);
        });
        // SENDING EMAIL (END)

        if ($mailSent) {
            // Mail was sent successfully

            $user->verify_status = $request->input('status');
            if ($request->input('status') == 1) {
                $user->email_verified_at = now();
            }
            $user->update();
            return redirect()->back()->with('success', 'Email verification confirmation has been sent');
        } else {
            // Mail sending failed
            return redirect()->back()->with('error', 'Email confirmation failed to send.');
        }
    }

    public function updateAdmin(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
        ]);


        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        // Updates the 'name' from 'firstname', 'middlename', and 'lastname'
        $fullname = $request->input('lastname') . ", " . $request->input('firstname') . " " . $request->input('middlename');
        // Update the user's profile with the new data
        $user->username = $request->input('username');
        $user->fullname = $fullname;
        $user->firstname = $request->input('firstname');
        $user->middlename = $request->input('middlename');
        $user->lastname = $request->input('lastname');
        $user->affiliation_id = $request->input('affiliation') ?? $user->affiliation_id;
        $user->access_level = $request->input('access_level');
        $user->editedBy = auth()->user()->username;
        $user->update();
        // Redirect back to the profile page or a success page
        return redirect()->back()->with('success', 'User profile edited successfully!');
    }

    public function changePassword(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $request->validate([
            'currentPassword' => [
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ],
        ]);

        $password = $request->input('password');
        $cfpassword = ($request->input('cfpassword'));

        if ($password == $cfpassword) {
            $user->update(['password' => $password]);
            return redirect()->back()->with('success', 'Password changed successfully.');
        } else {
            return redirect()->back()->with('errors', 'Password does not match.');
        }
    }


    // app/Http/Controllers/AvatarController.php
    public function upload(Request $request)
    {
        $file = $request->file('avatar');
        $date = date("mdy");
        $customName = 'u' . auth()->user()->id . $date . "." . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/lib/users', $customName);

        return response()->json(['filePath' => asset('storage/lib/users/' . $customName)]);
    }
    // Add other methods like edit, update, delete based on your requirements
    public function destroy($id)
    {
        // Fetch the user's details from the database using the provided $id
        $user = User::find($id);

        if (!$user) {
            // If the user is not found, returns an error or redirect to an error page
            return redirect()->back()->with('error', 'Something went wrong. Try again!');
        }
        $user->delete();

        // Pass the user data to the view for editing
        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function myDocuments()
    {

    }
}
