<?php
namespace App\Imports;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Generate a random password
        $randomPassword = Str::random(8);

        // Handle avatar upload
        $avatarPath = null;
        if (isset($row['avatar']) && $row['avatar']) {
            $avatarPath = $this->storeFile($row['avatar'], 'uploads/user-avatars');
        }

        // Handle national ID front avatar upload
        $nationalIdFrontAvatarPath = null;
        if (isset($row['national_id_front_avatar']) && $row['national_id_front_avatar']) {
            $nationalIdFrontAvatarPath = $this->storeFile($row['national_id_front_avatar'], 'uploads/front-page-ids');
        }

        // Handle national ID behind avatar upload
        $nationalIdBehindAvatarPath = null;
        if (isset($row['national_id_behind_avatar']) && $row['national_id_behind_avatar']) {
            $nationalIdBehindAvatarPath = $this->storeFile($row['national_id_behind_avatar'], 'uploads/back-page-ids');
        }

        $user = User::updateOrCreate(
            ['email' => $row['email']],
            [
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($randomPassword), 
                'phone' => $row['phone'],
                'address' => $row['address'],
                'avatar' => $avatarPath, 
                // 'role' => $row['role'],
                
                //set the role by default customer
                'role' => 'customer',
                'created_by' => Auth::user()->id,
            ]
        );

        Customer::updateOrCreate(
            ['user_id' => $user->id],
            [
                'organisation_id' => Auth::user()->id,
                'customer_organisation_code' => $row['customer_organisation_code'],
                'national_id_no' => $row['national_id_no'],
                'national_id_front_avatar' => $nationalIdFrontAvatarPath, 
                'national_id_behind_avatar' => $nationalIdBehindAvatarPath, 
                'created_by' => Auth::user()->id,
            ]
        );

        // Optionally, you could send the generated password to the user via email
        // Mail::to($user->email)->send(new NewUserImported($user, $randomPassword));
    }

    private function storeFile($file, $path)
    {
        $fileName = time() . '_' . preg_replace('/\s+/', '_', strtolower($file));
        $filePath = Storage::disk('public')->putFileAs($path, $file, $fileName);
        return $filePath;
    }
}