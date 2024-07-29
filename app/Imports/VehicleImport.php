<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehicleImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        // Handle avatar upload
        $avatarPath = null;
        if (isset($row['vehicle_avatar']) && $row['vehicle_avatar']) {
            $avatarPath = $this->storeFile($row['vehicle_avatar'], 'images');
        }

        $organisationId = null;
        if (Auth::user()->role == 'organisation') {
            $organisationId = Auth::user()->id;
        }

        Vehicle::updateOrCreate(
            [
                'created_by' => Auth::user()->id,
                /***
                 * Organisation ID Handling: The organisation_id is determined based on the
                 *  logged-in user’s role. If the user’s role is organisation, the ID
                 *  of the logged-in user is set as organisation_id. If the user is an admin,
                 *  it remains null.
                 */
                'organisation_id' => $organisationId,
                'model' => $row['model'],
                'make' => $row['make'],
                'year' => $row['year'],
                'color' => $row['color'],
                'seats' => $row['seats'],
                'class' => $row['class'],
                'plate_number' => $row['plate_number'],
                'fuel_type' => $row['fuel_type'],
                'engine_size' => $row['engine_size'],
                'avatar' => $avatarPath,
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